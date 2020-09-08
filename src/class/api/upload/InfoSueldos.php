<?php

require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("class/tools/Filter.php");
set_time_limit ( 0 );


class InfoSueldosUploadApi extends UploadApi {
  public $entityName = "info_sueldos";

  public $registros = [];
  public $evaluado;
  public $organo;

  public $errors = [];
  public $detail = [];
    
  public function main() {
    $file = Filter::fileRequired("file");
    $this->organo = Filter::postRequired("organo");
    $this->evaluado = date("c");

    if ( $file["error"] > 0 ) throw new Exception ( "Error al subir archivo");
    
    $this->createDir();
    $fileValue = $this->createFileValue($file);
    $destination = $this->moveUploadedFile($file, $fileValue);
    $f = $this->insertFile($fileValue);

    $this->registros = $this->definirRegistros($destination);

    $ret = [
      "file"=>$f,
      "evaluado" => $this->evaluado,
    ];

    $resultado = $this->procesarExistentes();
    $ret["altas_existentes"] = $resultado["altas_existentes"];
    $ret["bajas_automaticas"] = $resultado["bajas_automaticas"];


    $resultado = $this->procesarAltasEnviadas();
    $ret["altas_aprobadas"] = $resultado["altas_aprobadas"];
    $ret["altas_rechazadas"] = $resultado["altas_rechazadas"];
   

    $resultado = $this->procesarBajasEnviadas();
    $ret["bajas_aprobadas"] = $resultado["bajas_aprobadas"];
    $ret["bajas_rechazadas"] = $resultado["bajas_rechazadas"];


    $ret["altas_automaticas"] = $this->procesarRestantes();


    $ret["errors"] = $this->errors;
    $ret["detail"] = $this->detail;

    return $ret;
  }

  public function evaluarAfiliacion($afiliaciones, $estado){
    foreach($afiliaciones as $afiliacion){
      $afiliacion_ = [
        "id" => $afiliacion["id"],
        "evaluado" => $this->evaluado,
        "estado" => $estado,
      ];

      try{
        $persist = $this->container->getController("afiliacion_persist")->main($afiliacion_);
        $this->detail = array_merge($this->detail, $persist["detail"]); 
      } catch (Exception $exception) {
        array_push($this->errors, "Error al actualizar afiliacion: " . $afiliacion["legajo"] . ": " . $exception->getMessage());
      }
    }
  }
  
  public function crearAfiliacion($afiliaciones, $motivo){
    foreach($afiliaciones as $afiliacion){
      $afiliacion_ = [
        "persona" => $afiliacion["persona"],
        "creado" => $this->evaluado,
        "evaluado" => $this->evaluado,
        "motivo" => $motivo,
        "estado" => "Aprobado",
      ];

      try{
        $this->container->getController("afiliacion_persist")->main($afiliacion_);
      } catch (Exception $exception) {
        array_push($this->errors, "Error al crear afiliacion: " . $afiliacion["legajo"] . ": " . $exception->getMessage());
      }
    }
  }

  public function procesarExistentes(){
    $render = [
      ["modificado_is_set", "=", false],
      ["estado", "=", "Aprobado"],
      ["motivo", "=", "Alta"],
    ];

    $existentes = $this->container->getDb()->all("afiliacion", $render);
    $existentes = array_combine_key($existentes, "per_legajo");

    $aprobadas = [];
    $bajadas = [];
    foreach($existentes as $key => $afiliacion){
      if(!empty($this->registros[$key])) {
        unset($this->registros[$key]);
        array_push($aprobadas, $afiliacion);
      }
      else {
        array_push($bajadas, $afiliacion);
      }
    }
    $this->crearAfiliacion($bajadas, "Baja");

    return [
      "altas_existentes" => count($aprobadas),
      "bajas_automaticas" => count($bajadas),
    ];
  }


  public function procesarRestantes(){
    if(empty($this->registros)) return 0;
    $legajos = array_column($this->registros, "legajo");
    
    $render = new Render();
    $render->addCondition(["legajo","=",$legajos]);
    $render->setSize(0);

    $personas = $this->container->getDb()->all("persona", $render);
    $personas = array_combine_key($personas, "legajo");

    $departamentosJudiciales = $this->container->getDb()->all("departamento_judicial");
    $departamentosJudiciales = array_combine_key($departamentosJudiciales, "codigo");

    $persistLog = $this->container->getController("persist_log");

    $altasAutomaticas = 0;
    foreach($this->registros as $legajo => $registro) {
      if(!key_exists($registro["codigo_departamento"], $departamentosJudiciales)){
        array_push($this->errors, "Error al crear persona: " . $registro["legajo"] . ": No existe el código de Departamento " . $registro["codigo_departamento"]);
        continue;
      }
      if(array_key_exists($legajo,$personas)){
        $id = $personas[$legajo]["id"];
      } else {
        $persona = $this->container->getValues("persona");
        $persona->_setDefault();
        $persona->setApellidos($registro["apellidos"]);
        if(isset($registro["nombres"])) $persona->setNombres($registro["nombres"]);
        $persona->setLegajo($legajo);
        $persona->setOrgano($this->organo);
        $persona->setDepartamentoJudicial($departamentosJudiciales[$registro["codigo_departamento"]]["id"]);
        $persona->setDepartamentoJudicialInformado($departamentosJudiciales[$registro["codigo_departamento"]]["id"]);
        $persona->_reset();
        $insert = $this->container->getDb()->insert("persona", $persona->_toArray());
        $id = $insert["id"];
      }
      $altasAutomaticas++;

      $afiliacion = [
        "persona" => $id,
        "creado" => $this->evaluado,
        "evaluado" => $this->evaluado,
        "motivo" => "Alta",
        "estado" => "Aprobado",
      ];

    
      $this->container->getController("afiliacion_persist")->main($afiliacion);
    }

    return $altasAutomaticas;
  }


  public function procesarAltasEnviadas(){
    $render = [
      ["modificado_is_set", "=", false],
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

    return [
      "altas_aprobadas" => count($aprobadas),
      "altas_rechazadas" => count($rechazadas),
    ];
  }

  public function procesarBajasEnviadas(){
    $render = [
      ["modificado_is_set", "=", false],
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

    return [
      "bajas_aprobadas" => count($aprobadas),
      "bajas_rechazadas" => count($rechazadas),
    ];

  }

  public function definirRegistros($destination){
    $content = file_get_contents ($destination);
    $lines = explode(PHP_EOL, $content); // Replace PHP_EOL with "\r\n" or "\n" or "\r" if you like
    $registros = [];
    $errores = [];
    for($i = 0; $i < count($lines); $i++){
      if(strlen($lines[$i]) >= 85 && strlen($lines[$i]) <= 87){
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

        if(key_exists($reg["legajo"], $registros)){
          array_push($this->errors, "Legajo " . $reg["legajo"] . " se encuentra repetido");
          continue;
        }

        $registros[$reg["legajo"]] = $reg;
      }
    }

    return $registros;
  }

}

