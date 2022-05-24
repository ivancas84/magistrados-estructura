<?php
require_once("class/model/Ma.php");
require_once("function/php_input.php");
set_time_limit ( 0 );

class ArchivoSueldosPersistApi  {
  public $entityName = "archivo_sueldos";
  public $container;
  public $permission = "w";

  public function main(){
    $data = php_input();

    $progress = intval($data["progress"])+1;

    $render = $this->container->getRender("log");
    $render->setPage($progress);
    $render->setSize(1);
    $render->setParams(["user"=>$data["log"]]);
    $render->setOrder(["created"=>"asc"]);

    $db = new Ma(TXN_HOST, TXN_USER, TXN_PASS, TXN_DBNAME);
    $db->container = $this->container;

    $row = $db->one("log", $render);

    try {
      $db2 = new Db(DATA_HOST);
      $db2->container = $this->container;
      $db2->multi_query_transaction($row["description"]);
    } catch(Exception $ex){
      echo "ERROR: " . $row["id"] . " " . $row["description"];
      throw $ex;
    }

    return ["progress" => $progress];

  }

}

