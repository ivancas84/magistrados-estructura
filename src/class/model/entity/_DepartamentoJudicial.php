<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DepartamentoJudicialEntity extends Entity {
  public $name = "departamento_judicial";
  public $alias = "dj";
 
  public function getPk(){
    return $this->container->getField("departamento_judicial", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("departamento_judicial", "codigo"),
      $this->container->getField("departamento_judicial", "nombre"),
    );
  }


}
