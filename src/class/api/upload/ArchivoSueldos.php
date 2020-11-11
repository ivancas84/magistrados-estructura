<?php

require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("function/filter_file.php");
require_once("function/filter_post.php");
require_once("function/php_input.php");
set_time_limit ( 0 );

class ArchivoSueldosUploadApi extends UploadApi {
  public $entityName = "archivo_sueldos";

  public $organo;
  public $periodo;

  public $registros = []; //registros obtenidos del archivo
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
  
  public $evaluado;
  
  public $errors = [];
  public $detail = [];
  public $sql = "";
    
  public function main() {
    parent::main(); //crear metadatos y subir archivo
    
    $this->organo = filter_post("organo");
    $this->periodo = filter_post("periodo");
    $this->evaluado = new DateTime();
    
    $this->verificarPeriodo(); //Analizar si no existen evaluaciones para el periodo ingresado
    $this->definirRegistros(); //Definir registros a evaluar
    $this->consultarDepartamentosJudiciales(); //consultar departamentos judiciales (array asociativo donde la llave es el codigo del departamento judicial)
    

    $this->response["file"] = $this->fileValue->_toArray("json");
    $this->response["evaluado"] = $this->evaluado->format("Y-m");

    $this->procesarExistentes();    //respuesta de altas_existentes y bajas_automaticas
    $this->procesarAltasEnviadas(); //respuesta de altas_aprobadas y altas_rechazadas
    $this->procesarBajasEnviadas(); //respuesta de bajas_aprobadas y bajas_rechazadas
    
    $this->consultarPersonas(); //consultar personas de registos restantes
    $this->procesarRestantes();     //respuesta de altas_automaticas
    print_r($this->errors);
    throw new Exception("die");
    return $respuesta;
  }

  public function consultarDepartamentosJudiciales(){
    $departamentosJudiciales = $this->container->getDb()->all("departamento_judicial");
    $this->departamentosJudiciales = array_combine_key($departamentosJudiciales, "codigo");
  }
  
  public function verificarPeriodo(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["evaluado.ym", "=", $this->periodo]
    ];

    $cantidad = $this->container->getDb()->count("afiliacion", $render);
    if($cantidad > 0) throw new Exception("El período ingresado ya fue evaluado");
  }

  public function definirRegistros(){
    $destination = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_UPLOAD . DIRECTORY_SEPARATOR . $this->fileValue->_get("content");
    $content = file_get_contents ($destination);
    $lines = explode(PHP_EOL, $content); // Replace PHP_EOL with "\r\n" or "\n" or "\r" if you like
    $this->registros = [];
    $errores = [];
    for($i = 0; $i < count($lines); $i++){
      if(strlen($lines[$i]) < 85 || strlen($lines[$i]) > 87) continue;
      /** 
       * Los registros tienen una longitud de 85 - 87
       */

      $reg = [
        "codigo_departamento" => substr($lines[$i],0,2),
        "codigo_afiliacion" => substr($lines[$i],3,3),
        "descripcion_afiliacion" => substr($lines[$i],8,12),
        "legajo" => substr($lines[$i],37,6),
        "monto" => substr($lines[$i],73,7),
        "numero"  => substr($lines[$i],81,3),
      ];

      $nombre = explode(",", substr($lines[$i],44,24));
      $reg["apellidos"] = $nombre[0];
      if(key_exists(1, $nombre)) $reg["nombres"] = $nombre[1];

      if(key_exists($reg["legajo"], $this->registros)){
        array_push($this->errors, "Legajo " . $reg["legajo"] . " se encuentra repetido");
        continue;
      }

      $this->registros[$reg["legajo"]] = $reg;      
    }
  }

  public function evaluarAfiliacion($afiliaciones, $estado){
    foreach($afiliaciones as $afiliacion){
      $afiliacion_ = [
        "id" => $afiliacion["id"],
        "evaluado" => $this->evaluado,
        "estado" => $estado,
      ];

      try{
        $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql", "afiliacion")->main($afiliacion_);
        $this->sql .= $persist["sql"];
        $this->detail = array_merge($this->detail, $persist["detail"]); 
      } catch (Exception $exception) {
        array_push($this->errors, "Error al actualizar afiliacion: " . $afiliacion["legajo"] . ": " . $exception->getMessage());
      }
    }
  }
  
  

  public function crearAfiliacion($idPersona, $motivo){    
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

  public function procesarExistentes(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["motivo", "=", "Alta"],
      ["evaluado.is_set","=",true]
    ];

    $existentes = $this->container->getDb()->all("afiliacion", $render);
    $existentes = array_combine_key($existentes, "per_legajo");

    $this->respuesta["altas_existentes"] = 0;
    $this->respuesta["bajas_automaticas"] = 0;
    $idPersonas = [];

    foreach($existentes as $key => $afiliacion){
      if(!empty($this->registros[$key])) {
        unset($this->registros[$key]);
        $this->respuesta["altas_existentes"]++;
      }
      else {
        $this->respuesta["bajas_automaticas"]++;
        try{
          $persistAfiliacion = $this->crearAfiliacion($afiliacion["persona"], "Baja");
        } catch (Exception $exception) {
          array_push($this->errors, "Error al crear afiliacion: " . $exception->getMessage());
          continue;
        }        
      }
    }
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

  public function procesarRestantes(){
    $this->respuesta["altas_automaticas"] = 0;
    if(empty($this->registros)) return;
    

    foreach($this->registros as $legajo => $registro) {
      if(!key_exists($registro["codigo_departamento"], $this->departamentosJudiciales)){
        array_push($this->errors, "Error al crear persona: " . $registro["legajo"] . ": No existe el código de Departamento " . $registro["codigo_departamento"]);
        continue;
      }
   
      try{
        $idPersona = $this->definirIdPersona($legajo, $registro);
      } catch (Exception $exception) {
        array_push($this->errors, "Error al crear persona para el legajo " . $legajo . ": " . $exception->getMessage());
        continue;
      }

      try{
        $persistAfiliacion = $this->crearAfiliacion($idPersona, "Alta");
      } catch (Exception $exception) {
        array_push($this->errors, "Error al crear afiliacion para el legajo " . $legajo . ": " . $exception->getMessage());
        continue;
      }
      
      $this->respuesta["altas_automaticas"]++;
    }
  }


  public function procesarAltasEnviadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Alta"],
    ];

    $enviadas = $this->container->getDb()->all("afiliacion", $render);
    $enviadas = array_combine_key($enviadas, "per_legajo");

    $aprobadas = [];
    $rechazadas = [];
    foreach($enviadas as $key => $afiliacion){
      if(!empty($this->registros[$key])) {
        unset($this->registros[$key]);
        array_push($aprobadas, $afiliacion);
      }
      else {
        array_push($rechazadas, $afiliacion);
      }
    }

    $this->evaluarAfiliacion($aprobadas, "Aprobado");
    $this->evaluarAfiliacion($rechazadas, "Rechazado");

    $this->respuesta["altas_aprobadas"] = count($aprobadas);
    $this->respuesta["altas_rechazadas"] = count($rechazadas);
  }

  public function consultarPersonas(){
    $legajos = array_column($this->registros, "legajo");
    
    $render = new Render();
    $render->addCondition(["legajo","=",$legajos]);
    $render->setSize(0);

    $personas = $this->container->getDb()->all("persona", $render);
    $this->personas = array_combine_key($personas, "legajo");

  }

  public function procesarBajasEnviadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Baja"],
    ];

    $enviadas = $this->container->getDb()->all("afiliacion", $render);
    $enviadas = array_combine_key($enviadas, "per_legajo");

    $aprobadas = [];
    $rechazadas = [];
    foreach($enviadas as $key => $afiliacion){
      if(empty($this->registros[$key])) {
        array_push($aprobadas, $afiliacion);
      } else {
        unset($this->registros[$key]);
        array_push($rechazadas, $afiliacion);
      }
    }

    $this->evaluarAfiliacion($aprobadas, "Aprobado");
    $this->evaluarAfiliacion($rechazadas, "Rechazado");

    $this->respuesta["bajas_aprobadas"] = count($aprobadas);
    $this->respuesta["bajas_rechazadas"] = count($rechazadas);
  }

}

