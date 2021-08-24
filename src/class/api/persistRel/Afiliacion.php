<?php

require_once("class/api/Base.php");

class AfiliacionPersistRelApi extends BaseApi {

  public function main(){  
    $data = file_get_contents("php://input");
    if(empty($data = json_decode($data, true))) throw new Exception("Conjunto de datos vacío");
    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql",$this->entityName)->main($data["afiliacion"]);
    $this->container->getDb()->multi_query_transaction($persist["sql"]);
    return ["id" => $persist["id"], "detail" => $persist["detail"]];
  }

}

