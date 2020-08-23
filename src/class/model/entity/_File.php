<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _FileEntity extends Entity {
  public $name = "file";
  public $alias = "file";
 
  public function getPk(){
    return Field::getInstanceRequire("file", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("file", "name"),
      Field::getInstanceRequire("file", "type"),
      Field::getInstanceRequire("file", "content"),
      Field::getInstanceRequire("file", "size"),
      Field::getInstanceRequire("file", "created"),
    );
  }


}
