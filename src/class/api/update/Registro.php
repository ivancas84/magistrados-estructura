<?php
require_once("class/model/Ma.php");
require_once("function/php_input.php");
set_time_limit ( 0 );

class RegistroUpdateApi  {
  public $entityName = "afiliacion";
  public $container;
  public $permission = "w";

  public function main(){
    $data = php_input();

    $sql = "";

    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["organo", "=", $data["organo"]],
      ["estado", "=", "Enviado"],
      
    ]);



    $ids = $this->container->getDb()->ids($data["registro"], $render);

    $row = ["estado" => "Creado"];
    if(!empty($ids)) $sql .= $this->container->getSqlo($data["registro"])->updateAll($row, $ids);
    

    if(empty($ids)) throw new Exception("No existen elementos para el periodo seleccionado", 404);
    $this->container->getDb()->multi_query_transaction($sql);    
  }

}

