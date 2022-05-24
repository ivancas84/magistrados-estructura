<?php
require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_key2.php");

require_once("function/filter_file.php");
require_once("function/filter_post.php");
require_once("function/php_input.php");
require_once("function/set_log_db.php");
require_once("function/nombres_parecidos.php");

mb_internal_encoding('ISO-8859-1');
set_time_limit ( 0 );

class ArchivoSueldosUploadApi extends UploadApi {
  public $entityName = "archivo_sueldos";

  public $organo;
  public $periodo;

  public $archivo = ["afiliacion"=>[], "tramite_excepcional"=>[]]; //registros obtenidos del archivo
  /**
   * array asociativo legajo => registro, se ignoran los valores que no cumplan las condiciones (filas vacia o duplicados)
   */

  public $departamentoJudicial_;
  public $legajos40 = [];
  public $legajos80 = [];
  public $personas = []; 
  public $respuesta = []; //respuesta al cliente
  /**
   * Array asociativo con los siguientes elementos
   * "file" => metadatos (valores) del archivo
   * "evaluado" => date con la fecha de evaluado
   * "altas_existentes" => array con altas existentes que fueron mantenidas
   * "bajas_automaticas" => array con bajas no enviadas que fueron informadas
   * "altas_aprobadas" => array con altas enviadas que fueron aceptadas
   * "altas_rechazadas" => array con altas enviadas que fueron rechazadas
   * "bajas_aprobadas" => array con bajas enviadas que fueron aceptadas
   * "bajas_rechazadas" => array con bajas enviadas que fueron rechazadas
   * "errors" => array con los errores identificados
   */
  
  public $evaluado; //fecha de evaluado (se carga con la fecha actual)
  
  public $sql = "";

  public $longitudFila; //longitud de la fila del archivo
  public $longitudNumero; //longitud del numero del archivo
  public $longitudValor; //longitud del valor del archivo
  public $user;
  /**
   * El atributo user, se utiliza para identificar el conjunto de logs a ac-
   * tualizar.
   * Anteriormente se utilizaba un unico campo para almacenar la informacion.
   * Pero se saturaba el servidor.
   * Se hizo una leve modificacion del codigo para almacenar cada sentencia
   * en un log separado. Hace mas lento el procesamiento pero no satura el 
   * servidor.
   */

  public function main() {
    $this->user = uniqid();

    parent::main(); //crear metadatos y subir archivo
    
    $this->organo = filter_post("organo");
    $this->periodo = new DateTime(filter_post("periodo"));
    $this->evaluado = new DateTime();
    $this->respuesta["file"] = $this->fileValue->_toArray("json");
    $this->respuesta["evaluado"] = $this->periodo->format("c");
    $this->respuesta["errors"] = [];
    $this->respuesta["afiliacion"] = [];
    $this->respuesta["tramite_excepcional"] = [];    

    $this->noProcesarSiExistenImportesEnPeriodo(); //Analizar si no existen evaluaciones para el periodo ingresado  
    $this->departamentoJudicial_(); //consultar departamentos judiciales (array asociativo donde la llave es el codigo del departamento judicial)

    $this->registro_(); //Definir archivo["afiliacion"] y archivo["tramite_excepcional"] a evaluar
   
    if(!count($this->archivo["afiliacion"]) 
    && !count($this->archivo["tramite_excepcional"])) throw new Exception("No existen registros para procesar");    
    
    $this->processRegistroExistente_("afiliacion"); //respuesta de afiliacion_altas_existentes y afiliacion_bajas_automaticas
    $this->processRegistroExistente_("tramite_excepcional"); //respuesta de tramite_excepcional_altas_existentes y tramite_excepcional_bajas_automaticas

    $this->processRegistroAltaEnviada_("afiliacion"); //respuesta de afiliacion_altas_aprobadas y afiliacion_altas_rechazadas
    $this->processRegistroAltaEnviada_("tramite_excepcional"); //respuesta de tramite_excepcional_altas_aprobadas y tramite_excepcional_altas_rechazadas
     
    
    $this->processRegistroBajaEnviada_("afiliacion"); //respuesta de afiliacion_bajas_aprobadas y afiliacion_bajas_rechazadas
    $this->processRegistroBajaEnviada_("tramite_excepcional"); //respuesta de tramite_excepcional_bajas_aprobadas y tramite_excepcional_bajas_rechazadas

    $this->consultarPersonasDeRegistrosRestantes(); //consultar personas de registos restantes
    $this->procesarRegistrosRestantes("afiliacion"); //respuesta de afiliacion_altas_automaticas
    $this->procesarRegistrosRestantes("tramite_excepcional"); //respuesta de tramite_excepcional_altas_automaticas

    //$log = set_log_db(["type"=>"archivo sueldos " . $this->organo . " creado", "description"=>$this->sql]);
    $this->respuesta["log"] = $this->user;

    return $this->respuesta;
  }

  public function noProcesarSiExistenImportesEnPeriodo(){    
    $render = new Render();
    $render->setCondition([
      ["periodo.ym", "=", $this->periodo->format("Y-m")],
      ["afi-organo","=",$this->organo]
    ]);        
    $cantidad = $this->container->getDb()->count("importe_afiliacion", $render);
    if($cantidad > 0) throw new Exception("Ya existen importes para el período ingresado");

    $render = new Render();
    $render->setCondition([
      ["periodo.ym", "=", $this->periodo->format("Y-m")],
      ["te-organo","=",$this->organo]
    ]);        
    $cantidad = $this->container->getDb()->count("importe_tramite_excepcional", $render);
    if($cantidad > 0) throw new Exception("Ya existen importes para el período ingresado");
  }


  public function registro_(){
    $this->attrControl_(); //definir atributos de control para las lineas del archivo en base al organo
    $lines = $this->fileGetContents();

    for($i = 0; $i < count($lines); $i++){
      $lines[$i] = trim($lines[$i]);
      if(!$this->errorLongitudLineaSiSuperaMaximo($lines, $i)) continue;
      $reg = $this->registro($lines[$i]);
      if(!$this->errorCodigoDepartamentoSiNoExiste($reg)) continue;
      
      $l = $reg["legajo"].UNDEFINED.$reg["codigo_afiliacion"];
      switch($reg["codigo_afiliacion"]){
        case "161": case "162": case "1621": case "1622":
          $this->warningLegajo40SiEstaRepetido($reg);
          if(!$this->sumarImportesRegistro40SiEstaRepetido($l, $reg)) continue 2;
          $this->archivo["afiliacion"][$l] = $reg;
        break;

        case "1631": case "1632":
          $this->warningLegajo40SiNoExiste($reg);
          if(!$this->sumarImportesRegistro80SiEstaRepetido($l, $reg)) continue 2;
          $this->archivo["tramite_excepcional"][$l] = $reg;
        break;

        default:
          array_push($this->respuesta["errors"], "Registro " . $l . " tiene código no valido, será ignorado");
          continue 2; //ignorar descripcion de afiliacion
      }      
    }
  }

  protected function warningLegajo40SiEstaRepetido($reg){
    if(in_array($reg["legajo"], $this->legajos40)) array_push($this->respuesta["errors"], "Legajo " . $reg["legajo"] . " es un legajo con dos registros 40");
    else array_push($this->legajos40, $reg["legajo"]);
  }

  protected function warningLegajo40SiNoExiste($reg){
    if(!in_array($reg["legajo"], $this->legajos40)){
      array_push($this->respuesta["errors"], "Legajo " . $reg["legajo"] . " tiene registro 80 y no tiene registro 40");
    }
  }

  protected function sumarImportesRegistro40SiEstaRepetido($idRegistro, $registro){
    if(key_exists($idRegistro, $this->archivo["afiliacion"])){
      array_push($this->respuesta["errors"], "Registro " . $idRegistro . " es un registro 40 repetido, se sumaran los importes");
      $this->archivo["afiliacion"][$idRegistro]["monto"] = floatval($this->archivo["afiliacion"][$idRegistro]["monto"]) + floatval($registro["monto"]);
      return false;
    }
    return true;
  }

  protected function sumarImportesRegistro80SiEstaRepetido($idRegistro, $registro){
    if(key_exists($idRegistro, $this->archivo["tramite_excepcional"])){
      array_push($this->respuesta["errors"], "Registro " . $idRegistro . " es un registro 80 repetido, se sumaran importes");
      $this->archivo["tramite_excepcional"][$idRegistro]["monto"] = floatval($this->archivo["tramite_excepcional"][$idRegistro]["monto"]) + floatval($registro["monto"]);
      return false;
    }
    return true;

  }

  protected function errorLongitudLineaSiSuperaMaximo($lines, $i){
    $text = html_entity_decode($lines[$i], ENT_QUOTES, "ISO-8859-1");                 
    $length = mb_strlen($text);

    if($length != $this->longitudFila){ //if adicional para mayor eficiencia        
      if($length > $this->longitudFila)  //longitud menor se ignora, longitud mayor se guarda error
        array_push($this->respuesta["errors"], "La longitud de la fila " . ($i + 1) . " supera el máximo permitido");
      // else
      //  array_push($this->respuesta["errors"], "La longitud de la fila " . ($i + 1) . " es inferior al mínimo permitido: " . $length);
      return false;
    }
  
    return true;
  }

  protected function errorCodigoDepartamentoSiNoExiste($reg){
    if(!array_key_exists($reg["codigo_departamento"],$this->departamentoJudicial_)) {
      array_push($this->respuesta["errors"], "SIN PROCESAR: Legajo " . $reg["legajo"] . " no existe departamento judicial");
      return false;
    }
    return true;
  }

  public function attrControl_(){
    //definir variables de los archivos en base al organo
    if($this->organo == "1"){ //administracion de justicia
      $this->longitudFila = 84; //aplicando trim
      $this->longitudNumero = 3;
      $this->longitudValor = 12;
    } else { //procuracion
      $this->longitudFila = 87; //aplicando trim
      $this->longitudNumero = 5;
      $this->longitudValor = 13;
    }
  }

  public function fileGetContents(){
    //obtener contenido de archivo y almacenarlo en array
    $destination = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_UPLOAD . DIRECTORY_SEPARATOR . $this->fileValue->_get("content");
    $content = file_get_contents ($destination);
    return explode(PHP_EOL, $content);
  }

  protected function registro($line){
    /**
     * obtiene un registro en funcion de la linea 
     * considerando las variables segun el organo
     */
    $reg = [
      "codigo_departamento" => substr($line,0,2),
      "codigo_afiliacion" => trim(substr($line,3,4)),
      "descripcion_afiliacion" => trim(substr($line,8,12)),
      "legajo" => substr($line,37,6),
      "monto" => trim(substr($line,69,$this->longitudValor)),
      "numero"  => substr($line,81,$this->longitudNumero),
    ];
    $nombre = explode(",", 
                  trim(
                    substr($line,44,25)
                  )
              );
    $reg["apellidos"] = $nombre[0];
    if(key_exists(1, $nombre) && !empty(trim($nombre[1]))) $reg["nombres"] = $nombre[1];    

    if(!empty($reg["apellidos"]) && !ctype_upper(str_replace(" ", "", $reg["apellidos"]))) {
      foreach (str_split($reg["apellidos"]) as $index => $char) {        
        if(!ctype_upper($char) && $char != " ") $reg["apellidos"] = substr_replace($reg["apellidos"],"Ñ",$index,1);
      }
    }


    if(!empty($reg["nombres"]) && !ctype_upper(str_replace(" ", "", $reg["nombres"]))) {
      foreach (str_split($reg["nombres"]) as $index => $char) {
        if(!ctype_upper($char) && $char != " ") $reg["nombres"][$index] = substr_replace($reg["apellidos"],"Ñ",$index,1);
      }
    }

    return $reg;
  }

  public function departamentoJudicial_(){
    $departamentoJudicial_ = $this->container->getDb()->all("departamento_judicial");
    $this->departamentoJudicial_ = array_combine_key($departamentoJudicial_, "codigo");
  }

  public function processRegistroExistente_($tipo){    
    $registrosExistentes = $this->registroExistente_($tipo);

    $this->respuesta[$tipo]["altas_existentes"] = [];
    $this->respuesta[$tipo]["bajas_automaticas"] = [];

    foreach($registrosExistentes as $identifierRegistro => $registro){
      if(key_exists($identifierRegistro, $this->archivo[$tipo])) { //el registro esta en el archivo y ya existia en la base
        array_push($this->respuesta[$tipo]["altas_existentes"], $registro);
        
        $this->actualizarDepartamentoJudicialSiEsDistinto(
          $registro["departamento_judicial_informado"], 
          $registro["id"], 
          $tipo, 
          $identifierRegistro
        );         

        if($tipo == "tramite_excepcional") $this->warningImporteRegistro80SiEsDistinto(
          $identifierRegistro, 
          $registro["monto"], 
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );

        $this->insertImporteRegistro(
          $tipo, 
          $registro["id"], 
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );

        unset($this->archivo[$tipo][$identifierRegistro]); //eliminar registro del archivo que ya fue procesada
      } else {
        array_push($this->respuesta[$tipo]["bajas_automaticas"], $registro);

        $monto = (key_exists("monto", $registro)) ? $registro["monto"] : null;

        $this->insertRegistro(
          $tipo, 
          $registro["persona"], 
          "Baja", 
          $registro["codigo"],
          $registro["organo"],
          $registro["departamento_judicial"],
          $registro["departamento_judicial_informado"],
          $monto
        );
      }
    }
  }

  protected function warningNombreSiEsDistinto($nombres, $apellidos, $tipo, $identifierRegistro){
    $nombre1 = "";
    if(!empty($nombres)) $nombre1 .= $nombres . " ";
    $nombre1 .= $apellidos;
    $nombre2 = "";
    if(!empty($this->archivo[$tipo][$identifierRegistro]["nombres"])) 
      $nombre2 .= $this->archivo[$tipo][$identifierRegistro]["nombres"] . " ";
    $nombre2 .= $this->archivo[$tipo][$identifierRegistro]["apellidos"];
    return $this->warningNombreSiEsDistintos($nombre1, $nombre2, $identifierRegistro);
  }

  public function processRegistroAltaEnviada_($tipo){
    $enviadas = $this->registroAltaEnviada_($tipo);
    $this->respuesta[$tipo]["altas_aprobadas"] = [];
    $this->respuesta[$tipo]["altas_rechazadas"] = [];

    foreach($enviadas as $identifierRegistro => $registro){
      if(key_exists($identifierRegistro, $this->archivo[$tipo])) {
        $this->actualizarDepartamentoJudicialSiEsDistinto(
          $registro["departamento_judicial_informado"], 
          $registro["id"], 
          $tipo, 
          $identifierRegistro
        );

        $this->warningNombreSiEsDistinto(
          $registro["per_nombres"],
          $registro["per_apellidos"],
          $tipo, 
          $identifierRegistro
        );

        $this->evaluarRegistroExistente(
          $tipo, 
          $registro["id"], 
          "Aprobado"
        );

        if($tipo == "tramite_excepcional") $this->warningImporteRegistro80SiEsDistinto(
          $identifierRegistro, 
          $registro["monto"], 
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );

        array_push($this->respuesta[$tipo]["altas_aprobadas"], $registro);
        
        $this->insertImporteRegistro(
          $tipo, 
          $registro["id"],
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );

        unset($this->archivo[$tipo][$identifierRegistro]);
      } else {
        $this->evaluarRegistroExistente(
          $tipo, 
          $registro["id"], 
          "Rechazado"
        );

        array_push($this->respuesta[$tipo]["altas_rechazadas"], $registro);
      }
    }
  }

  public function processRegistroBajaEnviada_($tipo){
    $enviadas = $this->registroBajaEnviada_($tipo);
    $this->respuesta[$tipo]["bajas_aprobadas"] = [];
    $this->respuesta[$tipo]["bajas_rechazadas"] = [];
    foreach($enviadas as $identifierRegistro => $registro){
      if(!key_exists($identifierRegistro, $this->archivo[$tipo])) {
        $this->evaluarRegistroExistente($tipo, $registro["id"], "Aprobado");
        array_push($this->respuesta[$tipo]["bajas_aprobadas"], $registro);
      } else {        
        $this->evaluarRegistroExistente($tipo, $registro["id"], "Rechazado");
        $monto = (!empty($registro["monto"])) ? $registro["monto"] : null;
      
        $this->insertRegistro(
          $tipo, 
          $registro["persona"], 
          "Alta", 
          $registro["codigo"],
          $registro["organo"],
          $registro["departamento_judicial"],
          $registro["departamento_judicial_informado"], 
          $monto 
        );
        
        $this->actualizarDepartamentoJudicialSiEsDistinto(
          $registro["departamento_judicial_informado"], 
          $registro["id"], 
          $tipo, 
          $identifierRegistro
        ); 

        $this->insertImporteRegistro(
          $tipo, 
          $registro["id"],
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );

        $this->warningNombreSiEsDistinto(
          $registro["per_nombres"],
          $registro["per_apellidos"],
          $tipo, 
          $identifierRegistro
        );
        
        if($tipo == "tramite_excepcional") $this->warningImporteRegistro80SiEsDistinto(
          $identifierRegistro, 
          $registro["monto"], 
          $this->archivo[$tipo][$identifierRegistro]["monto"]
        );
        
        array_push($this->respuesta[$tipo]["bajas_rechazadas"], $registro);
        
        unset($this->archivo[$tipo][$identifierRegistro]);
      }
    }
  }

  public function procesarRegistrosRestantes($tipo) {
    $this->respuesta[$tipo]["altas_automaticas"] = [];
    if(empty($this->archivo[$tipo])) return;
    
    foreach($this->archivo[$tipo] as $identifierRegistro => $registro) {
      $idPersona = $this->setIdPersona($registro, $tipo, $identifierRegistro);
      $idDepartamentoJudicial = $this->idDepartamentoJudicial($registro["codigo_departamento"]);
      
      $id = $this->insertRegistro(
        $tipo, 
        $idPersona, 
        "Alta", 
        $registro["codigo_afiliacion"],
        $this->organo, 
        $idDepartamentoJudicial, 
        $idDepartamentoJudicial, 
        $registro["monto"]
      );
      $this->insertImporteRegistro($tipo, $id, $registro["monto"]);
      array_push($this->respuesta[$tipo]["altas_automaticas"], $registro);
    }
  }
  
  public function registroExistente_($tipo){    
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["motivo", "=", "Alta"],
      // ["evaluado.is_set","=",true],
      ["organo", "=", $this->organo]
    ]);

    if($tipo == "tramite_excepcional") {
      $render->addCondition([
        [
          ["desde.ym","<=",$this->periodo->format("Y-m")], 
          ["hasta.ym",">=",$this->periodo->format("Y-m")]
        ],
        [
          ["desde","=",false, "OR"], 
          ["hasta","=",false]
        ],
      ]);
    
    }

    $render->setSize(false);

    $existentes = $this->container->getDb()->all($tipo, $render);
    return array_combine_key2($existentes, ["per_legajo","codigo"]);
  }

  protected function registroAltaEnviada_($tipo){
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", ["Alta","Modificación"]],
      ["organo", "=", $this->organo]
    ]);

    if($tipo == "tramite_excepcional") {
      $render->addCondition([
        [
          ["desde.ym","<=",$this->periodo->format("Y-m")], 
          ["hasta.ym",">=",$this->periodo->format("Y-m")]
        ],
        [
          ["desde","=",false, "OR"], 
          ["hasta","=",false]
        ],
      ]);
    }

    $render->setSize(false);
    return array_combine_key2(
      $this->container->getDb()->all($tipo, $render), 
      ["per_legajo","codigo"]
    );
  }

  protected function registroBajaEnviada_($tipo){
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Baja"],
      ["organo", "=", $this->organo],
    ]);
    if($tipo == "tramite_excepcional") {
      $render->addCondition([
        [
          ["desde.ym","<=",$this->periodo->format("Y-m")], 
          ["hasta.ym",">=",$this->periodo->format("Y-m")]
        ],
        [
          ["desde","=",false, "OR"], 
          ["hasta","=",false]
        ],
      ]);
    }
    $render->setSize(false);

    $enviadas = $this->container->getDb()->all($tipo, $render);
    return array_combine_key2($enviadas, ["per_legajo","codigo"]);
  }


  protected function insertImporteRegistro($tipo, $id, $valor){
    $importe = [$tipo=>$id, "valor"=>$valor, "periodo"=>$this->periodo];
    $p = $this->container->getControllerEntity("persist_sql", "importe_" . $tipo)->id($importe);
    $log = set_log_db(["user"=>$this->user, "description"=>$p["sql"]]);

  }

  public function insertRegistro(
    $tipo, 
    $idPersona, 
    $motivo, 
    $codigoRegistro, 
    $idOrgano, 
    $idDepartamentoJudicial, 
    $idDepartamentoJudicialInformado, 
    $valor=null
  ){    
    /**
     * se inserta uno nuevo y se modifican los existentes del mismo codigo registro
     */
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
      "codigo" => $codigoRegistro,
      "departamento_judicial" => $idDepartamentoJudicial,
      "departamento_judicial_informado" => $idDepartamentoJudicialInformado,
      "organo" => $idOrgano,
    ];

    if($tipo == "tramite_excepcional") $registro["monto"] = $valor;

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql",$tipo)->main($registro);
    $log = set_log_db(["user"=>$this->user, "description"=>$persist["sql"]]);
    return $persist["id"];
  }



  public function evaluarRegistroExistente($tipo, $id, $estado){
    $registro = [
      "id" => $id,
      "evaluado" => $this->evaluado,
      "estado" => $estado,
    ];

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql", $tipo)->main($registro);
    $log = set_log_db(["user"=>$this->user, "description"=>$persist["sql"]]);

  }  

  /**
   * @deprecated
  public function crearRegistro($tipo, $idPersona, $motivo, $idOrgano, $idDepartamentoJudicial, $idDepartamentoJudicialInformado, $valor = null){    
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
      ""
    ];

    if($tipo == "tramite_excepcional") {
      $registro["monto"] = $valor;
    }

    $persist = $this->container->getControllerEntity("persist_sql", $tipo)->id($registro);
    $log = set_log_db(["user"=>$this->user, "description"=>$persist["sql"]]);
    return $persist["id"];
  }
  */

  public function consultarPersonasDeRegistrosRestantes(){
    if(empty($this->archivo["afiliacion"]) && empty($this->archivo["tramite_excepcional"])) return [];
    $legajos = array_column($this->archivo["afiliacion"], "legajo");
    $legajos = array_merge($legajos, array_column($this->archivo["tramite_excepcional"], "legajo"));

    $render = new Render();
    $render->addCondition(["legajo","=",$legajos]);
    $render->setSize(false);

    $personas = $this->container->getDb()->all("persona", $render);
    $this->personas = (!empty($personas)) ? array_combine_key($personas, "legajo") : [];
  }

  public function setIdPersona($registro, $tipo, $identifierRegistro){
    $legajo = $this->archivo[$tipo][$identifierRegistro]["legajo"];
    if(key_exists($legajo,$this->personas)) {
      $this->warningNombreSiEsDistinto(
        $this->personas[$legajo]["nombres"], 
        $this->personas[$legajo]["apellidos"], 
        $tipo, 
        $identifierRegistro
      );

    } else {
      $this->crearPersona(
        $registro, 
        $legajo
      );
    }
    return $this->personas[$legajo]["id"];
  }

  public function crearPersona($registro, $legajo){
    $persistSql = $this->container->getControllerEntity("persist_sql","persona");
    $p = $persistSql->id($registro);
    $log = set_log_db(["user"=>$this->user, "description"=>$p["sql"]]);
    $this->personas[$legajo] = $registro;
    $this->personas[$legajo]["id"] = $p["id"];
  }

  protected function warningNombreSiEsDistintos($nombre1, $nombre2, $identifierRegistro){
    if(!nombres_parecidos(
      $nombre1, 
      $nombre2,
    )) {
      array_push($this->respuesta["errors"], "Registro " . $identifierRegistro . " no coincide el nombre con el del archivo");
    }
  }



  protected function idDepartamentoJudicial($codigo){
    if(!array_key_exists($codigo,$this->departamentoJudicial_)) throw new Exception("El departamento judicial informado en el archivo no existe en la base de datos, codigo " . $codigo);
    return $this->departamentoJudicial_[$codigo]["id"];
  }

  protected function actualizarDepartamentoJudicialSiEsDistinto($idDepartamentoJudicialInformado, $idRegistro, $tipo, $identifierRegistro){
    /**
     * Para los registros existentes en el archivo y en la base de datos
     * Se realiza una verificacion (y si corresponde actualizacion) del departamento judicial informado
     **/
    $idDepartamentoJudicialArchivo = $this->idDepartamentoJudicial(
      $this->archivo[$tipo][$identifierRegistro]["codigo_departamento"]
    );
    

    if($idDepartamentoJudicialArchivo != $idDepartamentoJudicialInformado){
      $v = $this->container->getValue($tipo);
      $v->_set("id", $idRegistro);
      $v->_set("departamento_judicial_informado", $idDepartamentoJudicialArchivo);
      $v->_call("reset")->_call("check");
      $sql = $this->container->getSqlo($tipo)->update($v->_toArray("sql"));
      $log = set_log_db(["user"=>$this->user, "description"=>$sql]);

      if($idDepartamentoJudicialInformado){
        if($v->logs->isError()) throw new Exception("Error al actualizar departamento judicial id " . $identifierRegistro. ": " . $v->logs->toString());
        array_push($this->respuesta["errors"], "El departamento judicial es distinto " . $identifierRegistro);
      }

    }
  }

  protected function warningImporteRegistro80SiEsDistinto($identifierRegistro, $importeDb, $importeArchivo){
    if(floatval($importeDb) != floatval($importeArchivo)) array_push($this->respuesta["errors"], "El importe del registro 80 para " . $identifierRegistro . " no coincide");
  }  
}

