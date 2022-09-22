<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("class/controller/Base.php");

class MdbProcesarScript extends BaseController{
 

  public function main(){
    $import = $this->container->getImport("mdb");
    $import->headers = array_map('trim', explode(",",$_REQUEST["headers"])); //encabezados a procesar
    $import->source = $_REQUEST["source"]; //informacion a procesar
    $import->main();
    echo "<pre>" . $import->sql();
    //$import->summary();

  }    
 
}
