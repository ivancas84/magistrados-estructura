<?php
require_once("class/model/Render.php");
require_once("class/tools/Validation.php");

class RegistroActualizablePersist {

  public $entityName;
  public $container;

  public $noModificadas = []; //afiliaciones no modificadas (se consultan para el caso de que)

  public function main($data){    
    $persist = $this->container->getControllerEntity("registro_actualizable_persist_sql",$this->entityName);
    $this->container->getDb()->multi_query_transaction_log($persist["sql"]);
    return ["id" => $persist["id"], "detail" => $persist["detail"]];
  }
}