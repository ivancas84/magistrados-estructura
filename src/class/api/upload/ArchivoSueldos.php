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

  public $afiliacionesArchivo = []; //afiliaciones obtenidos del archivo
  /**
   * array asociativo legajo => registro, se ignoran los valores que no cumplan las condiciones (filas vacia o duplicados)
   */

  public $tramitesExcepcionalesArchivo = []; //tramitesExcepcionales obtenidos del archivo
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
   * "detail" => array con el detalle de las afiliaciones modificadas
   */
  
  public $evaluado; //fecha de evaluado (se carga con la fecha actual)
  
  public $detail = [];
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
    $this->respuesta["evaluado"] = $this->evaluado->format("Y-m");
    $this->respuesta["errors"] = [];    

    $this->verificarPeriodo(); //Analizar si no existen evaluaciones para el periodo ingresado
    $this->definirRegistros(); //Definir afiliacionesArchivo y tramitesExcepcionalesArchivo a evaluar
    if(!count($this->afiliacionesArchivo)) throw new Exception("No existen afiliaciones para procesar");
    $this->consultarDepartamentosJudiciales(); //consultar departamentos judiciales (array asociativo donde la llave es el codigo del departamento judicial)
    $this->procesarAfiliacionesExistentes();    //respuesta de altas_existentes y bajas_automaticas
    $this->procesarAfiliacionesAltasEnviadas(); //respuesta de altas_aprobadas y altas_rechazadas
    $this->procesarAfiliacionesBajasEnviadas(); //respuesta de bajas_aprobadas y bajas_rechazadas
    $this->consultarPersonas(); //consultar personas de registos restantes
    $this->procesarAfiliacionesRestantes(); //respuesta de altas_automaticas

    
    set_log_db(["type"=>"archivo sueldos " . $this->organo . " creado", "description"=>$this->sql]);

    return $this->respuesta;
  }

  public function consultarDepartamentosJudiciales(){
    $departamentosJudiciales = $this->container->getDb()->all("departamento_judicial");
    $this->departamentosJudiciales = array_combine_key($departamentosJudiciales, "codigo");
  }

  public function verificarPeriodo(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["evaluado.ym", "=", $this->periodo],
      ["per-organo", "=", $this->organo]
    ];

    $cantidad = $this->container->getDb()->count("afiliacion", $render);
    if($cantidad > 0) throw new Exception("El período ingresado ya fue evaluado");
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
      "monto" => trim(substr($line,68,$this->longitudMonto)),
      "numero"  => substr($line,81,$this->longitudNumero),
    ];
    $nombre = explode(",", 
                  trim(
                    substr($line,44,24)
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

  public function definirRegistros(){
    $this->variablesOrgano();
    $lines = $this->fileGetContents();
    
    for($i = 0; $i < count($lines); $i++){
      $lines[$i] = trim($lines[$i]);



      if(strlen($lines[$i]) != $this->longitudFila){ //if adicional para mayor eficiencia        
        if(strlen($lines[$i]) > $this->longitudFila)  //longitud menor se ignora, longitud mayor se guarda error
          array_push($this->response["errors"], "La longitud de la fila " . ($i + 1) . " supera el máximo permitido");
        continue;
      }

      $reg = $this->definirRegistroDeLinea($lines[$i]);

      switch($reg["descripcion_afiliacion"]){
        case "C.MAG.SOCIOS":
          if(key_exists($reg["legajo"], $this->afiliacionesArchivo)){
            array_push($this->response["errors"], "Legajo " . $reg["legajo"] . " es una afiliacion repetida");
            continue 2;
          }

          $this->afiliacionesArchivo[$reg["legajo"]] = $reg;
        break;

        case "Bco.Ciudad":
          if(key_exists($reg["legajo"], $this->tramitesExcepcionalesArchivo)){
            array_push($this->response["errors"], "Legajo " . $reg["legajo"] . " es un tramite excepcional repetido");
            continue 2;
          }
          $this->tramitesExcepcionalesArchivo[$reg["legajo"]] = $reg;
        break;

        default:
          continue 2; //ignorar descripcion de afiliacion
      }      
    }
  }

  public function evaluarAfiliacion($idAfiliacion, $estado){
    $afiliacion = [
      "id" => $idAfiliacion,
      "evaluado" => $this->evaluado,
      "estado" => $estado,
    ];

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql", "afiliacion")->main($afiliacion);
    $this->sql .= $persist["sql"];
    $this->detail = array_merge($this->detail, $persist["detail"]); 

  }

  public function crearAfiliacionActualizar($idPersona, $motivo){    
    $afiliacion = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql","afiliacion")->main($afiliacion);
    $this->sql .= $persist["sql"];
    $this->detail = array_merge($this->detail, $persist["detail"]);
  }

  public function crearAfiliacion($idPersona, $motivo){    
    $afiliacion = [
      "persona" => $idPersona,
      "creado" => $this->evaluado->format("c"),
      "evaluado" => $this->evaluado->format("c"),
      "motivo" => $motivo,
      "estado" => "Aprobado",
    ];

    $persist = $this->container->getPersist()->id("afiliacion", $afiliacion);
    $this->sql .= $persist["sql"];
    array_push($this->detail, "afiliacion".$persist["id"]);
    return $persist["id"];
  }

  public function procesarAfiliacionesExistentes(){    
    $afiliacionesExistentes = $this->consultarAfiliacionesExistentes();

    $this->respuesta["altas_existentes"] = [];
    $this->respuesta["bajas_automaticas"] = [];
    $idPersonas = [];

    foreach($afiliacionesExistentes as $legajo => $afiliacion){
      if(!empty($this->afiliacionesArchivo[$legajo])) { //la afiliacion esta en el archivo y ya existia en la base
        array_push($this->respuesta["altas_existentes"], $afiliacion);
        $this->agregarImporteAfiliacion($afiliacion["id"], $this->afiliacionesArchivo[$legajo]["monto"]);
        unset($this->afiliacionesArchivo[$legajo]); //eliminar afiliacion del archivo que ya fue procesada
      } else {
        array_push($this->respuesta["bajas_automaticas"], $afiliacion);
        $this->crearAfiliacionActualizar($afiliacion["persona"], "Baja");
      }
    }
  }

  public function consultarAfiliacionesExistentes(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["motivo", "=", "Alta"],
      ["evaluado.is_set","=",true],
      ["per-organo", "=", $this->organo]
    ];

    $existentes = $this->container->getDb()->all("afiliacion", $render);
    return array_combine_key($existentes, "per_legajo");
  }


  public function crearPersona($registro){
    $persistSql = $this->container->getPersist();
    $registro["organo"] = $this->organo;
    $registro["departamento_judicial"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $registro["departamento_judicial_informado"] = $this->departamentosJudiciales[$registro["codigo_departamento"]]["id"];
    $p = $persistSql->id("persona", $registro);
    $this->sql .= $p["sql"];
    $this->detail = array_merge($this->detail, ["persona".$p["id"]]);
    return $p["id"];
  }


  public function definirIdPersona($legajo, $registro){
    if(array_key_exists($legajo,$this->personas)) return $this->personas[$legajo]["id"];
    return $this->crearPersona($registro);
  }

  public function procesarAfiliacionesRestantes() {
    $this->respuesta["altas_automaticas"] = [];
    if(empty($this->afiliacionesArchivo)) return;
    
    foreach($this->afiliacionesArchivo as $legajo => $registro) {
      $idPersona = $this->definirIdPersona($legajo, $registro);
      $id = $this->crearAfiliacion($idPersona, "Alta");
      $this->agregarImporteAfiliacion($id, $registro["monto"]);

      array_push($this->respuesta["altas_automaticas"], $registro);
    }
  }

  protected function consultarAfiliacionesAltasEnviadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Alta"],
      ["per-organo", "=", $this->organo]
    ];

    $enviadas = $this->container->getDb()->all("afiliacion", $render);
    return array_combine_key($enviadas, "per_legajo");
  }

  public function procesarAfiliacionesAltasEnviadas(){
    $enviadas = $this->consultarAfiliacionesAltasEnviadas();

    $this->respuesta["altas_aprobadas"] = [];
    $this->respuesta["altas_rechazadas"] = [];

    foreach($enviadas as $legajo => $afiliacion){
      if(!empty($this->afiliacionesArchivo[$legajo])) {
        $this->evaluarAfiliacion($afiliacion["id"], "Aprobado");
        array_push($this->respuesta["altas_aprobadas"], $afiliacion);
        $this->agregarImporteAfiliacion($afiliacion["id"], $this->afiliacionesArchivo[$legajo]["monto"]);
        unset($this->afiliacionesArchivo[$legajo]);
      } else {
        $this->evaluarAfiliacion($afiliacion["id"], "Rechazado");
        array_push($this->respuesta["altas_rechazadas"], $afiliacion);
      }
    }
  }

  public function consultarPersonas(){
    $legajos = array_column($this->afiliacionesArchivo, "legajo");
    
    $render = new Render();
    $render->addCondition(["legajo","=",$legajos]);
    $render->setSize(0);

    $personas = $this->container->getDb()->all("persona", $render);
    $this->personas = array_combine_key($personas, "legajo");
  }

  protected function consultarAfiliacionesBajasEnviadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Baja"],
      ["per-organo", "=", $this->organo],
    ];

    $enviadas = $this->container->getDb()->all("afiliacion", $render);
    return array_combine_key($enviadas, "per_legajo");
  }
  public function procesarAfiliacionesBajasEnviadas(){
    $enviadas = $this->consultarAfiliacionesBajasEnviadas();
    $this->respuesta["bajas_aprobadas"] = [];
    $this->respuesta["bajas_rechazadas"] = [];
    foreach($enviadas as $legajo => $afiliacion){
      if(empty($this->afiliacionesArchivo[$legajo])) {
        $this->evaluarAfiliacion($afiliacion["id"], "Aprobado");
        array_push($this->respuesta["bajas_aprobadas"], $afiliacion);
      } else {        
        $this->evaluarAfiliacion($afiliacion["id"], "Rechazado");
        $this->crearAfiliacion($afiliacion["persona"], "Alta");
        $this->agregarImporteAfiliacion($afiliacion["id"], $this->afiliacionesArchivo[$legajo]["monto"]);
        array_push($this->respuesta["bajas_rechazadas"], $afiliacion);
        unset($this->afiliacionesArchivo[$legajo]);
      }
    }

  }


  protected function agregarImporteAfiliacion($idAfiliacion, $valor){
    $persist = $this->container->getPersist();
    $importe = ["valor"=>$valor, "periodo"=>$this->periodo];
    $p = $persist->id("importe", $importe);
    $this->sql .= $p["sql"];
    
    $importe = ["afiliacion"=>$idAfiliacion, "importe"=>$p["id"]];
    $p = $persist->id("importe_afiliacion", $importe);
    $this->sql .= $p["sql"];
  }

}

