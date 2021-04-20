<?php
require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("function/filter_file.php");
require_once("function/filter_post.php");
require_once("function/php_input.php");
require_once("function/set_log_db.php");
require_once("function/nombres_parecidos.php");


set_time_limit ( 0 );

class ArchivoSueldosUploadApi extends UploadApi {
  public $entityName = "archivo_sueldos";

  public $organo;
  public $periodo;

  public $archivo = ["afiliacion"=>[], "tramite_excepcional"=>[]]; //registros obtenidos del archivo
  /**
   * array asociativo legajo => registro, se ignoran los valores que no cumplan las condiciones (filas vacia o duplicados)
   */

  public $departamentosJudiciales;
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

  public function main() {
    parent::main(); //crear metadatos y subir archivo
    
    $this->organo = filter_post("organo");
    $this->periodo = new DateTime(filter_post("periodo"));
    $this->evaluado = new DateTime();
    $this->respuesta["file"] = $this->fileValue->_toArray("json");
    $this->respuesta["evaluado"] = $this->periodo->format("c");
    $this->respuesta["errors"] = [];
    $this->respuesta["afiliacion"] = [];
    $this->respuesta["tramite_excepcional"] = [];    

    $this->verificarPeriodo(); //Analizar si no existen evaluaciones para el periodo ingresado  
    $this->consultarDepartamentosJudiciales(); //consultar departamentos judiciales (array asociativo donde la llave es el codigo del departamento judicial)

    $this->definirRegistros(); //Definir archivo["afiliacion"] y archivo["tramite_excepcional"] a evaluar
    
    if(!count($this->archivo["afiliacion"]) && !count($this->archivo["tramite_excepcional"])) throw new Exception("No existen registros 40 para procesar");
    
    
    $this->procesarRegistrosExistentes("afiliacion"); //respuesta de afiliacion_altas_existentes y afiliacion_bajas_automaticas
    $this->procesarRegistrosExistentes("tramite_excepcional"); //respuesta de tramite_excepcional_altas_existentes y tramite_excepcional_bajas_automaticas

    $this->procesarRegistrosAltasEnviadas("afiliacion"); //respuesta de afiliacion_altas_aprobadas y afiliacion_altas_rechazadas
    $this->procesarRegistrosAltasEnviadas("tramite_excepcional"); //respuesta de tramite_excepcional_altas_aprobadas y tramite_excepcional_altas_rechazadas

    $this->procesarRegistrosBajasEnviadas("afiliacion"); //respuesta de afiliacion_bajas_aprobadas y afiliacion_bajas_rechazadas
    $this->procesarRegistrosBajasEnviadas("tramite_excepcional"); //respuesta de tramite_excepcional_bajas_aprobadas y tramite_excepcional_bajas_rechazadas

    $this->consultarPersonas(); //consultar personas de registos restantes
    $this->verificarOrgano(); //verificar que las personas consultadas pertenezcan al mismo organo indicado
    $this->procesarRegistrosRestantes("afiliacion"); //respuesta de afiliacion_altas_automaticas
    $this->procesarRegistrosRestantes("tramite_excepcional"); //respuesta de tramite_excepcional_altas_automaticas

    $log = set_log_db(["type"=>"archivo sueldos " . $this->organo . " creado", "description"=>$this->sql]);
    $this->respuesta["log"] = $log;

    return $this->respuesta;
  }

  public function verificarPeriodo(){    
    $render = new Render();
    $render->setCondition([
      ["periodo.ym", "=", $this->periodo->format("Y-m")],
      ["afi_per-organo","=",$this->organo]
    ]);        
    $cantidad = $this->container->getDb()->count("importe_afiliacion", $render);
    if($cantidad > 0) throw new Exception("Ya existen importes para el período ingresado");

    $render = new Render();
    $render->setCondition([
      ["periodo.ym", "=", $this->periodo->format("Y-m")],
      ["te_per-organo","=",$this->organo]
    ]);        
    $cantidad = $this->container->getDb()->count("importe_tramite_excepcional", $render);
    if($cantidad > 0) throw new Exception("Ya existen importes para el período ingresado");
  }


  public function definirRegistros(){
    $this->variablesOrgano();
    $lines = $this->fileGetContents();
    
    for($i = 0; $i < count($lines); $i++){
      $lines[$i] = trim($lines[$i]);
      
      mb_internal_encoding('ISO-8859-1');    
      $text = html_entity_decode($lines[$i], ENT_QUOTES, "ISO-8859-1");                 
      $length = mb_strlen($text);

      if($length != $this->longitudFila){ //if adicional para mayor eficiencia        
        if($length > $this->longitudFila)  //longitud menor se ignora, longitud mayor se guarda error
          array_push($this->respuesta["errors"], "La longitud de la fila " . ($i + 1) . " supera el máximo permitido");
        // else
        //  array_push($this->respuesta["errors"], "La longitud de la fila " . ($i + 1) . " es inferior al mínimo permitido: " . $length);
        continue;
      }

      $reg = $this->definirRegistroDeLinea($lines[$i]);

      if(!array_key_exists($reg["codigo_departamento"],$this->departamentosJudiciales)) {
             array_push($this->respuesta["errors"], "SIN PROCESAR: Legajo " . $reg["legajo"] . " no existe departamento judicial");
        continue;
      }

      $l = $reg["legajo"];
      switch($reg["codigo_afiliacion"]){
        case "161": case "162": case "1621": case "1622":
          if(key_exists($l, $this->archivo["afiliacion"])){
            array_push($this->respuesta["errors"], "Legajo " . $l . " es un registro 40 repetido, se sumaran los importes");
            $this->archivo["afiliacion"][$l]["monto"] = floatval($this->archivo["afiliacion"][$l]["monto"]) + floatval($reg["monto"]);
            continue 2;
          }

          $this->archivo["afiliacion"][$reg["legajo"]] = $reg;
        break;

        case "1631": case "1632":
          if(!key_exists($l, $this->archivo["afiliacion"])){
            array_push($this->respuesta["errors"], "Legajo " . $l . " es un registro 80 y no existe registro 40");
          }

          if(key_exists($l, $this->archivo["tramite_excepcional"])){
            array_push($this->respuesta["errors"], "Legajo " . $l . " es un registro 80 repetido, se sumaran importes");
            $this->archivo["tramite_excepcional"][$l]["monto"] = floatval($this->archivo["tramite_excepcional"][$l]["monto"]) + floatval($reg["monto"]);
            continue 2;
          }

          $this->archivo["tramite_excepcional"][$reg["legajo"]] = $reg;
        break;

        default:
          array_push($this->respuesta["errors"], "Legajo " . $l . " sera ignorado");
          continue 2; //ignorar descripcion de afiliacion
      }      
    }
  }

  public function variablesOrgano(){
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

  protected function definirRegistroDeLinea($line){
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

  public function consultarDepartamentosJudiciales(){
    $departamentosJudiciales = $this->container->getDb()->all("departamento_judicial");
    $this->departamentosJudiciales = array_combine_key($departamentosJudiciales, "codigo");
  }

  public function procesarRegistrosExistentes($tipo){    
    $registrosExistentes = $this->consultarRegistrosExistentes($tipo);

    $this->respuesta[$tipo]["altas_existentes"] = [];
    $this->respuesta[$tipo]["bajas_automaticas"] = [];
    
    foreach($registrosExistentes as $legajo => $registro){
      if(!empty($this->archivo[$tipo][$legajo])) { //el registro esta en el archivo y ya existia en la base
        array_push($this->respuesta[$tipo]["altas_existentes"], $registro);
        $this->actualizarDepartamentoJudicialRegistro($registro["per_departamento_judicial_informado"], $registro["per_id"], $tipo, $legajo);         

        $nombre1 = "";
        if(!empty($registro["per_nombres"])) $nombre1 .= $registro["per_nombres"] . " ";
        $nombre1 .= $registro["per_apellidos"];
        $nombre2 = "";
        if(!empty($this->archivo[$tipo][$legajo]["nombres"])) $nombre2 .= $this->archivo[$tipo][$legajo]["nombres"] . " ";
        $nombre2 .= $this->archivo[$tipo][$legajo]["apellidos"];
        $this->verificarNombres($nombre1, $nombre2, $legajo);
        if($tipo == "tramite_excepcional") $this->verificarImporteRegistro80($tipo, $legajo, $registro["monto"], $this->archivo[$tipo][$legajo]["monto"]);
        $this->agregarImporteRegistro($tipo, $registro["id"], $this->archivo[$tipo][$legajo]["monto"]);
        unset($this->archivo[$tipo][$legajo]); //eliminar registro del archivo que ya fue procesada
      } else {
        array_push($this->respuesta[$tipo]["bajas_automaticas"], $registro);
        $this->crearRegistroActualizar($tipo, $registro["persona"], "Baja");
      }
    }
  }

  public function procesarRegistrosAltasEnviadas($tipo){
    $enviadas = $this->consultarRegistrosAltasEnviadas($tipo);
    $this->respuesta[$tipo]["altas_aprobadas"] = [];
    $this->respuesta[$tipo]["altas_rechazadas"] = [];

    foreach($enviadas as $legajo => $registro){
      if(!empty($this->archivo[$tipo][$legajo])) {
        $this->actualizarDepartamentoJudicialRegistro($registro["per_departamento_judicial_informado"], $registro["per_id"], $tipo, $legajo); 
        
        $nombre1 = "";
        if(!empty($registro["per_nombres"])) $nombre1 .= $registro["per_nombres"] . " ";
        $nombre1 .= $registro["per_apellidos"];
        $nombre2 = "";
        if(!empty($this->archivo[$tipo][$legajo]["nombres"])) $nombre2 .= $this->archivo[$tipo][$legajo]["nombres"] . " ";
        $nombre2 .= $this->archivo[$tipo][$legajo]["apellidos"];
        $this->verificarNombres($nombre1, $nombre2, $legajo);
        
        $this->evaluarRegistro($tipo, $registro["id"], "Aprobado");
        if($tipo == "tramite_excepcional") $this->verificarImporteRegistro80($tipo, $legajo, $registro["monto"], $this->archivo[$tipo][$legajo]["monto"]);
        array_push($this->respuesta[$tipo]["altas_aprobadas"], $registro);
        $this->agregarImporteRegistro($tipo, $registro["id"], $this->archivo[$tipo][$legajo]["monto"]);
        unset($this->archivo[$tipo][$legajo]);
      } else {
        $this->evaluarRegistro($tipo, $registro["id"], "Rechazado");
        array_push($this->respuesta[$tipo]["altas_rechazadas"], $registro);
      }
    }
  }

  public function procesarRegistrosBajasEnviadas($tipo){
    $enviadas = $this->consultarRegistrosBajasEnviadas($tipo);
    $this->respuesta[$tipo]["bajas_aprobadas"] = [];
    $this->respuesta[$tipo]["bajas_rechazadas"] = [];
    foreach($enviadas as $legajo => $registro){
      if(empty($this->archivo[$tipo][$legajo])) {
        $this->evaluarRegistro($tipo, $registro["id"], "Aprobado");
        array_push($this->respuesta[$tipo]["bajas_aprobadas"], $registro);
      } else {        
        $this->evaluarRegistro($tipo, $registro["id"], "Rechazado");
        $monto = (!empty($registro["monto"])) ? $registro["monto"] : null;
        $this->crearRegistroActualizar($tipo, $registro["persona"], "Alta", $monto );
        $this->actualizarDepartamentoJudicialRegistro($registro["per_departamento_judicial_informado"], $registro["per_id"], $tipo, $legajo); 

        $nombre1 = "";
        if(!empty($registro["per_nombres"])) $nombre1 .= $registro["per_nombres"] . " ";
        $nombre1 .= $registro["per_apellidos"];
        $nombre2 = "";
        if(!empty($this->archivo[$tipo][$legajo]["nombres"])) $nombre2 .= $this->archivo[$tipo][$legajo]["nombres"] . " ";
        $nombre2 .= $this->archivo[$tipo][$legajo]["apellidos"];
        $this->verificarNombres($nombre1, $nombre2, $legajo);
        
        if($tipo == "tramite_excepcional") $this->verificarImporteRegistro80($tipo, $legajo, $registro["monto"], $this->archivo[$tipo][$legajo]["monto"]);        
        $this->agregarImporteRegistro($tipo, $registro["id"], $this->archivo[$tipo][$legajo]["monto"]);
        array_push($this->respuesta[$tipo]["bajas_rechazadas"], $registro);
        unset($this->archivo[$tipo][$legajo]);
      }
    }
  }

  public function procesarRegistrosRestantes($tipo) {
    $this->respuesta[$tipo]["altas_automaticas"] = [];
    if(empty($this->archivo[$tipo])) return;
    
    foreach($this->archivo[$tipo] as $legajo => $registro) {
      $idPersona = $this->definirIdPersona($registro, $tipo, $legajo);
      $id = $this->crearRegistro($tipo, $idPersona, "Alta", $registro["monto"]);
      $this->agregarImporteRegistro($tipo, $id, $registro["monto"]);

      array_push($this->respuesta[$tipo]["altas_automaticas"], $registro);
    }
  }
  
  public function consultarRegistrosExistentes($tipo){    
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["motivo", "=", "Alta"],
      ["evaluado.is_set","=",true],
      ["per-organo", "=", $this->organo]
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
    return array_combine_key($existentes, "per_legajo");
  }

  protected function consultarRegistrosAltasEnviadas($tipo){
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", ["Alta","Modificación"]],
      ["per-organo", "=", $this->organo]
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
    return array_combine_key($enviadas, "per_legajo");
  }

  protected function consultarRegistrosBajasEnviadas($tipo){
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Baja"],
      ["per-organo", "=", $this->organo],
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
    return array_combine_key($enviadas, "per_legajo");
  }


  protected function agregarImporteRegistro($tipo, $id, $valor){
    $importe = [$tipo=>$id, "valor"=>$valor, "periodo"=>$this->periodo];
    //echo "<pre>"; 
    //print_r($importe);
    $p = $this->container->getControllerEntity("persist_sql", "importe_" . $tipo)->id($importe);
    $this->sql .= $p["sql"];
  }

  public function crearRegistroActualizar($tipo, $idPersona, $motivo, $valor=null){    
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

    if($tipo == "tramite_excepcional") {
      $registro["monto"] = $valor;
    }

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql",$tipo)->main($registro);
    $this->sql .= $persist["sql"];
  }

  public function evaluarRegistro($tipo, $id, $estado){
    $registro = [
      "id" => $id,
      "evaluado" => $this->evaluado,
      "estado" => $estado,
    ];

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql", $tipo)->main($registro);
    $this->sql .= $persist["sql"];
  }  

  public function crearRegistro($tipo, $idPersona, $motivo, $valor = null){    
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

    if($tipo == "tramite_excepcional") {
      $registro["monto"] = $valor;
    }

    $persist = $this->container->getControllerEntity("persist_sql", $tipo)->id($registro);
    $this->sql .= $persist["sql"];
    return $persist["id"];
  }

  public function consultarPersonas(){
    if(empty($this->archivo["afiliacion"]) && empty($this->archivo["tramite_excepcional"])) return [];
    $legajos = array_column($this->archivo["afiliacion"], "legajo");
    $legajos = array_merge($legajos, array_column($this->archivo["tramite_excepcional"], "legajo"));

    $render = new Render();
    $render->addCondition(["legajo","=",$legajos]);
    $render->setSize(false);

    $personas = $this->container->getDb()->all("persona", $render);
    $this->personas = (!empty($personas)) ? array_combine_key($personas, "legajo") : [];
  }

  public function definirIdPersona($registro, $tipo, $legajo){
    if(array_key_exists($legajo,$this->personas)) {
      $this->actualizarDepartamentoJudicialRegistro($this->personas[$legajo]["departamento_judicial_informado"], $this->personas[$legajo]["id"], $tipo, $legajo); 
      
      $nombre1 = "";
      if(!empty($this->personas[$legajo]["nombres"])) $nombre1 .= $this->personas[$legajo]["nombres"] . " ";
      $nombre1 .= $this->personas[$legajo]["apellidos"];
      $nombre2 = "";
      if(!empty($this->archivo[$tipo][$legajo]["nombres"])) $nombre2 .= $this->archivo[$tipo][$legajo]["nombres"] . " ";
      $nombre2 .= $this->archivo[$tipo][$legajo]["apellidos"];
      $this->verificarNombres($nombre1, $nombre2, $legajo);

    } else {
      $this->crearPersona($registro, $legajo);
    }
    return $this->personas[$legajo]["id"];
  }

  public function crearPersona($registro, $legajo){
    if(!array_key_exists($registro["codigo_departamento"],$this->departamentosJudiciales)) throw new Exception("El departamento judicial informado en el archivo no existe en la base de datos, codigo " . $registro["codigo_departamento"]);
    
    $persistSql = $this->container->getControllerEntity("persist_sql","persona");
    $registro["organo"] = $this->organo;
    $registro["departamento_judicial"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $registro["departamento_judicial_informado"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $p = $persistSql->id($registro);
    $this->sql .= $p["sql"];
    $this->personas[$legajo] = $registro;
    $this->personas[$legajo]["id"] = $p["id"];
  }

  protected function verificarNombres($nombre1, $nombre2, $legajo){
    if(!nombres_parecidos(
      $nombre1, 
      $nombre2,
    )) array_push($this->respuesta["errors"], "Legajo " . $legajo . " no coincide el nombre con el del archivo");
  }

  protected function verificarOrgano(){
    foreach($this->personas as $persona){
      if($persona["organo"]!=$this->organo) array_push($this->respuesta["errors"], "Legajo " . $persona["legajo"] . " esta cargado con otro organo");
    }          
  }

  protected function actualizarDepartamentoJudicialRegistro($departamentoJudicialInformado, $idPersona, $tipo, $legajo){
    /**
     * Para los registros existentes en el archivo y en la base de datos
     * Se realiza una verificacion (y si corresponde actualizacion) del departamento judicial informado
     **/    
    switch($this->archivo[$tipo][$legajo]["codigo_afiliacion"]){
      case "162": case "1621": $codigo = "10"; break;
      case "1622": $codigo = "19"; break;
      case "1615": $codigo = "08"; break;
      default: $codigo = $this->archivo[$tipo][$legajo]["codigo_departamento"];

    }

    if(!array_key_exists($codigo,$this->departamentosJudiciales)) throw new Exception("El departamento judicial informado en el archivo no existe en la base de datos, codigo " . $codigo);
    $idDepartamentoJudicial = $this->departamentosJudiciales[$codigo]["id"];
    if($idDepartamentoJudicial !== $departamentoJudicialInformado){
      $v = $this->container->getValue("persona");
      $v->_set("id", $idPersona);
      $v->_set("departamento_judicial_informado", $idDepartamentoJudicial);
      $v->_call("reset")->_call("check");
      $this->sql .= $this->container->getSqlo("persona")->update($v->_toArray("sql"));
      if($v->logs->isError()) throw new Exception("Error al actualizar departamento judicial legajo " . $legajo. ": " . $v->logs->toString());
    }
  }

  protected function verificarImporteRegistro80($tipo, $legajo, $importeDb, $importeArchivo){
    if(($tipo == "tramite_excepcional")
      && (floatval($importeDb) != floatval($importeArchivo))) array_push($this->respuesta["errors"], "El importe del registro 80 para " . $legajo . " no coincide");
  }  
}

