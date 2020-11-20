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

    $db = new Ma(TXN_HOST, TXN_USER, TXN_PASS, TXN_DBNAME);
    $db->container = $this->container;

    $row = $db->get("log", $data["log"]);
    
    $progress = intval($data["progress"]);
    $description = explode(";", $row["description"]);
  
    for($i = $progress; $i < count($description)-1; $i++) { //la ultima sentencia es una cadena vacia, se ignora
      try {
        $db2 = new Db(DATA_HOST);
        $db2->container = $this->container;
        $db2->query($description[$i]);
        if($i && !($i % 50)) break;
      } catch(Exception $ex){
        echo "ERROR: " . $description[$i];
        throw $ex;
      }
    }

    return ["progress" => $i, "total"=> count($description)-1];

  }

}

