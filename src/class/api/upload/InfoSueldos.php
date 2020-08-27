<?php

require_once("class/api/Upload.php");
require_once("function/array_combine_key.php");
require_once("class/model/DbLog.php");

class InfoSueldosUpload extends Upload {
  public $entityName = "info_sueldos";

  public function main() {
    $file = Filter::fileRequired("file"); 

    if ( $file["error"] > 0 ) throw new Exception ( "Error al subir archivo");
    
    $this->createDir();
    $fileValue = $this->createFileValue($file);
    $destination = $this->moveUploadedFile($file, $fileValue);
    $f = $this->insertFile($fileValue);

    $evaluado = new DateTime();
    $registros = $this->definirRegistros($destination);

    $resultado = $this->procesarAltasEnviadas($evaluado, $registros);
    
    return [
      "file"=>$f, 
      "altas_aprobadas" => $resultado["altas_aprobadas"],
      "altas_rechazadas" => $resultado["altas_rechazadas"],
      "evaluado" => $evaluado->format("c")
    ];
  }

  public function procesarAltasEnviadas($evaluado, $registros){
    $render = [
      ["modificado_is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Alta"],
    ];

    $altasEnviadas = $this->db->all("afiliacion", $render);

    array_combine_key($altasEnviadas, "per_legajo");

    $altasAprobadas = [];
    $altasRechazadas = [];
    foreach($altasEnviadas as $key => $afiliacion){
      if(!empty($registros[$key])) {
        unset($registros[$key]);
        array_push($altasAprobadas, $afiliacion);
      }
      else {
        array_push($altasRechazadas, $afiliacion);
      }
    }

    foreach($altasAprobadas as $afiliacion){
      $afiliacion_ = [
        "id" => $afiliacion["id"],
        "estado" => "Aprobada",
        "evaluado" => $evaluado
      ];

      $update = $this->container->getSqlo("afiliacion")->update($afiliacion_);
      $this->db->query_log($update["sql"]);
    }

    foreach($altasRechazadas as $afiliacion){
      $afiliacion_ = [
        "id" => $afiliacion["id"],
        "estado" => "Rechazada",
        "evaluado" => $evaluado
      ];

      $update = $this->container->getSqlo("afiliacion")->update($afiliacion_);
      $this->db->query_log($update["sql"]);
    }

    return [
      "altas_aprobadas" => count($altasAprobadas),
      "altas_rechazadas" => count($altasRechazadas),
    ];

  }



    // 
    
    /*
    array_unique_combine($afiliacionesExistentes, "legajo");

    $cantidadAfiliacionesExistentes = 0;
    $afiliacionesExistentesQueDebenDarseDeBaja = [];
    foreach($afiliacionesExistentes as $key => $afiliacion){
      if(!empty($registros[$key])) {
        unset($registros[$key]);
        $cantidadAfiliacionesExistentes++; //cantidad de afiliaciones existentes que permaneceran
        //aprobado != hoy, estado = alta
      }
      else {
        array_push($afiliacionesExistentesQueDebenDarseDeBaja, $afiliacion); //afiliaciones existentes que seran dadas de baja forzadamente 
        //no enviadas, completa evaluacion y creada con fecha de hoy, y estado = baja
      }
    }

    $afiliacionesNuevas = $this->consultarAfiliacionesNuevas(); 
    array_unique_combine($afiliacioneNuevas, "legajo");

    $afiliacionesNuevasQueDebenSerAprobadas = [];
    $afiliacionesNuevasQueDebenSerRechazadas = [];
    foreach($afiliacioneNuevas as $key => $afiliacion){
      if(!empty($registros[$key]) {
        unset($registros[$key]);
        array_push($afiliacionesNuevasQueDebenSerAprobadas, $afiliacion);
        //enviado != hoy, estado = alta
      }
      else {
        array_push($afiliacionesNuevasQueDebenSerRechazadas, $afiliacion);
      }
    }

    
    $afiliacionesBajadas = $this->consultarAfiliacionesBajadas(); 
    array_unique_combine($afiliacionesBajadas, "legajo");

    $afiliacionesBajadasQueDebenSerAprobadas = [];
    $afiliacionesBajadasQueDebenSerRechazadas = [];
    foreach($afiliacioneNuevas as $key => $afiliacion){
      if(!empty($registros[$key]) {
        unset($registros[$key]);
        array_push($afiliacionesBajadasQueDebenSerAprobadas, $afiliacion);
        //enviado != hoy, estado = alta
      }
      else {
        array_push($afiliacionesBajadasQueDebenSerRechazadas, $afiliacion);
      }
    }

    if(!empty($registros)){
      //afiliaciones que no fueron enviadas
    }*/

  public function consultarAfiliacionesExistentes(){
    $render = [
      ["modificado_is_set", "=", false],
      ["estado", "=", "Aprobado"],
    ];

    return $this->db->all("afiliacion", $render);
  }

  public function altasEnviadas(){
    
  }

  public function consultarAfiliacionesBajadas(){
    $render = [
      ["modificado_is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["motivo", "=", "Baja"],
    ];

    return $this->db->all("afiliacion", $render);
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
          array_push($errores, "ERROR FILA " . ($i+1) . ": El legajo se encuentra repetido");
          continue;
        }

        $registros[$reg["legajo"]] = $reg;
      }
    }

    return $registros;
  }

}

