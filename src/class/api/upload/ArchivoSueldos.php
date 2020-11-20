<?php
require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("function/filter_file.php");
require_once("function/filter_post.php");
require_once("function/php_input.php");
require_once("function/set_log_db.php");
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
  public $personas; 
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
  public $longitudMonto; //longitud del monto del archivo

  public function main() {
    parent::main(); //crear metadatos y subir archivo
    
    $this->organo = filter_post("organo");
    $this->periodo = filter_post("periodo");
    $this->evaluado = new DateTime();
    $this->respuesta["file"] = $this->fileValue->_toArray("json");
    $this->respuesta["evaluado"] = (new DateTime($this->periodo))->format("c");
    $this->respuesta["errors"] = [];
    $this->respuesta["afiliacion"] = [];
    $this->respuesta["tramite_excepcional"] = [];    

    $this->verificarPeriodo(); //Analizar si no existen evaluaciones para el periodo ingresado  
    $this->definirRegistros(); //Definir archivo["afiliacion"] y archivo["tramite_excepcional"] a evaluar
    
    if(!count($this->archivo["afiliacion"])) throw new Exception("No existen afiliaciones para procesar");
    
    $this->consultarDepartamentosJudiciales(); //consultar departamentos judiciales (array asociativo donde la llave es el codigo del departamento judicial)
    
    $this->procesarRegistrosExistentes("afiliacion"); //respuesta de afiliacion_altas_existentes y afiliacion_bajas_automaticas
    $this->procesarRegistrosExistentes("tramite_excepcional"); //respuesta de tramite_excepcional_altas_existentes y tramite_excepcional_bajas_automaticas

    $this->procesarRegistrosAltasEnviadas("afiliacion"); //respuesta de afiliacion_altas_aprobadas y afiliacion_altas_rechazadas
    $this->procesarRegistrosAltasEnviadas("tramite_excepcional"); //respuesta de tramite_excepcional_altas_aprobadas y tramite_excepcional_altas_rechazadas

    $this->procesarRegistrosBajasEnviadas("afiliacion"); //respuesta de afiliacion_bajas_aprobadas y afiliacion_bajas_rechazadas
    $this->procesarRegistrosBajasEnviadas("tramite_excepcional"); //respuesta de tramite_excepcional_bajas_aprobadas y tramite_excepcional_bajas_rechazadas

    $this->consultarPersonas(); //consultar personas de registos restantes
    $this->procesarRegistrosRestantes("afiliacion"); //respuesta de afiliacion_altas_automaticas
    $this->procesarRegistrosRestantes("tramite_excepcional"); //respuesta de tramite_excepcional_altas_automaticas

    $log = set_log_db(["type"=>"archivo sueldos " . $this->organo . " creado", "description"=>$this->sql]);
    $this->respuesta["log"] = $log;

    return $this->respuesta;
  }

  public function verificarPeriodo(){    
    $render = new Render();
    $render->setCondition([
      ["imp-periodo.ym", "=", $this->periodo],
      ["afi_per-organo","=",$this->organo]
    ]);        
    $cantidad = $this->container->getDb()->count("importe_afiliacion", $render);
    if($cantidad > 0) throw new Exception("Ya existen importes para el período ingresado");

    $render = new Render();
    $render->setCondition([
      ["imp-periodo.ym", "=", $this->periodo],
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

      if(strlen($lines[$i]) != $this->longitudFila){ //if adicional para mayor eficiencia        
        if(strlen($lines[$i]) > $this->longitudFila)  //longitud menor se ignora, longitud mayor se guarda error
          array_push($this->respuesta["errors"], "La longitud de la fila " . ($i + 1) . " supera el máximo permitido");
        continue;
      }

      $reg = $this->definirRegistroDeLinea($lines[$i]);

      switch($reg["descripcion_afiliacion"]){
        case "C.MAG.SOCIOS":
          if(key_exists($reg["legajo"], $this->archivo["afiliacion"])){
            array_push($this->respuesta["errors"], "Legajo " . $reg["legajo"] . " es una afiliacion repetida");
            continue 2;
          }

          $this->archivo["afiliacion"][$reg["legajo"]] = $reg;
        break;

        case "Bco.Ciudad":
          if(!key_exists($reg["legajo"], $this->archivo["afiliacion"])){
            array_push($this->respuesta["errors"], "Legajo " . $reg["legajo"] . " es un tramite excepcional y no existe afiliacion");
          }

          if(key_exists($reg["legajo"], $this->archivo["tramite_excepcional"])){
            array_push($this->respuesta["errors"], "Legajo " . $reg["legajo"] . " es un tramite excepcional repetido");
            continue 2;
          }

          $this->archivo["tramite_excepcional"][$reg["legajo"]] = $reg;
        break;

        default:
          continue 2; //ignorar descripcion de afiliacion
      }      
    }
  }

  public function variablesOrgano(){
    //definir variables de los archivos en base al organo
    if($this->organo == "1"){ //administracion de justicia
      $this->longitudFila = 84; //aplicando trim
      $this->longitudNumero = 3;
      $this->longitudMonto = 12;
    } else { //procuracion
      $this->longitudFila = 87; //aplicando trim
      $this->longitudNumero = 5;
      $this->longitudMonto = 13;
    }
  }

  public function fileGetContents(){
    //obtener contenido de archivo y almacenarlo en array
    $destination = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_UPLOAD . DIRECTORY_SEPARATOR . $this->fileValue->_get("content");
    $content = file_get_contents ($destination);
    return explode(PHP_EOL, $content);
  }

  public function definirRegistroDeLinea($line){
    //obtiene un registro en funcion de la linea considerando las variables segun el organo
    $reg = [
      "codigo_departamento" => substr($line,0,2),
      "codigo_afiliacion" => substr($line,3,3),
      "descripcion_afiliacion" => trim(substr($line,8,12)),
      "legajo" => substr($line,37,6),
      "monto" => trim(substr($line,69,$this->longitudMonto)),
      "numero"  => substr($line,81,$this->longitudNumero),
    ];
    $nombre = explode(",", 
                  trim(
                    substr($line,44,25)
                  )
              );
    $reg["apellidos"] = $nombre[0];
    if(key_exists(1, $nombre)) $reg["nombres"] = $nombre[1];    

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
        $this->evaluarRegistro($tipo, $registro["id"], "Aprobado");
        array_push($this->respuesta[$tipo]["altas_aprobadas"], $registro);
        $this->agregarImporteRegistro($registro["id"], $this->archivo[$tipo][$legajo]["monto"]);
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
        $this->crearRegistro($tipo, $registro["persona"], "Alta");
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
      $idPersona = $this->definirIdPersona($legajo, $registro);
      $id = $this->crearRegistro($tipo, $idPersona, "Alta");
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
          ["desde.ym",">=",$this->periodo], 
          ["hasta.ym","<=",$this->periodo]
        ],
        [
          ["desde.ym","=",false, "OR"], 
          ["hasta.ym","=",false]
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
      ["motivo", "=", "Alta"],
      ["per-organo", "=", $this->organo]
    ]);

    if($tipo == "tramite_excepcional") {
      $render->addCondition([
        [
          ["desde.ym",">=",$this->periodo], 
          ["hasta.ym","<=",$this->periodo]
        ],
        [
          ["desde.ym","=",false, "OR"], 
          ["hasta.ym","=",false]
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
          ["desde.ym",">=",$this->periodo], 
          ["hasta.ym","<=",$this->periodo]
        ],
        [
          ["desde.ym","=",false, "OR"], 
          ["hasta.ym","=",false]
        ],
      ]);
    }
    $render->setSize(false);

    $enviadas = $this->container->getDb()->all($tipo, $render);
    return array_combine_key($enviadas, "per_legajo");
  }


  protected function agregarImporteRegistro($tipo, $id, $valor){
    $persist = $this->container->getController("persist_sql");
    $importe = ["valor"=>$valor, "periodo"=>$this->periodo];
    $p = $persist->id("importe", $importe);
    $this->sql .= $p["sql"];
    
    $importe = [$tipo=>$id, "importe"=>$p["id"]];
    $p = $persist->id("importe_" . $tipo, $importe);
    $this->sql .= $p["sql"];
  }

  public function crearRegistroActualizar($tipo, $idPersona, $motivo){    
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

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

  public function crearRegistro($tipo, $idPersona, $motivo){    
    $registro = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

    $persist = $this->container->getController("persist_sql")->id($tipo, $registro);
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
    $this->personas = array_combine_key($personas, "legajo");
  }

  public function definirIdPersona($legajo, $registro){
    if(array_key_exists($legajo,$this->personas)) return $this->personas[$legajo]["id"];
    return $this->crearPersona($registro);
  }

  public function crearPersona($registro){
    $persistSql = $this->container->getController("persist_sql");
    $registro["organo"] = $this->organo;
    $registro["departamento_judicial"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $registro["departamento_judicial_informado"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $p = $persistSql->id("persona", $registro);
    $this->sql .= $p["sql"];
    return $p["id"];
  }

}

