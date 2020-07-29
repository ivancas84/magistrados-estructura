<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DepartamentoJudicialEntity extends Entity {
  public $name = "departamento_judicial";
  public $alias = "dj";
 
  public function getPk(){
    return Field::getInstanceRequire("departamento_judicial", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("departamento_judicial", "codigo"),
      Field::getInstanceRequire("departamento_judicial", "nombre"),
    );
  }


}
