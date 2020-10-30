<?php

require_once("class/tools/Filter.php");

class AfiliacionPersistApi {

  public function main(){  
    $data = file_get_contents("php://input");
    if(!$data) throw new Exception("Error al obtener datos de input");    
    if(empty($data = json_decode($data, true))) throw new Exception("Conjunto de datos vacío");
    $persist = $this->container->getControllerEntity("registro_actualizable_persist","afiliacion")->main($data);    return ["id"=>$persist["id"], "detail"=>$persist["detail"]];
  }

}

