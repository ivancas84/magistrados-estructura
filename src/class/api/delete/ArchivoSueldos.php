<?php
require_once("class/model/Ma.php");
require_once("function/php_input.php");
set_time_limit ( 0 );

class ArchivoSueldosDeleteApi  {
  public $entityName = "archivo_sueldos";
  public $container;
  public $permission = "w";

  public function main(){
    $data = php_input();
    $evaluado = new DateTime($data["evaluado"]);
    $db = $this->container->getDb();
    //$db->query("DELETE FROM importe_afiliacion WHERE creado >= '" . $evaluado->format("Y-m-d h:i:s") . "'");
    //$db->query("DELETE FROM importe WHERE creado >= '" . $evaluado->format("Y-m-d h:i:s") . "'");
    //$db->query("DELETE FROM afiliacion WHERE creado >= '" . $evaluado->format("Y-m-d h:i:s") . "'");
  }

}

