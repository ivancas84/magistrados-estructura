<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class MdbScript extends BaseController{
 /**
   * Formulario para cargar alumnos de comision
   * ./script/calificacion_form
   */

  public function main(){
    $headers = (isset($_GET["headers"]))? $_GET["headers"] : "legajo, apellidos, fecha_nacimiento, funcionario, magistrado, tribunal, tipo_documento, numero_documento, telefono_laboral, telefono_particular"; 
    require_once("class/script/Mdb.html");
  }
}