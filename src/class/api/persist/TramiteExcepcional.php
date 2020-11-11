<?php

require_once("class/api/Base.php");

class TramiteExcepcionalPersistApi extends BaseApi {

  public function main(){    
    $data = file_get_contents("php://input");
    if(!$data) throw new Exception("Error al obtener datos de input");    
    if(empty($data = json_decode($data, true))) throw new Exception("Conjunto de datos vacío");
    $persist = $this->container->getControllerEntity("registro_actualizable_persist","tramite_excepcional")->main($data);
    return ["id"=>$persist["id"], "detail"=>$persist["detail"]];
  }

}

