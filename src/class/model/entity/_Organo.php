<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _OrganoEntity extends Entity {
  public $name = "organo";
  public $alias = "orga";
 
  public function getPk(){
    return Field::getInstanceRequire("organo", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("organo", "descripcion"),
    );
  }


}
