<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _FileEntity extends Entity {
  public $name = "file";
  public $alias = "file";
 
  public function getPk(){
    return $this->container->getField("file", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("file", "name"),
      $this->container->getField("file", "type"),
      $this->container->getField("file", "content"),
      $this->container->getField("file", "size"),
      $this->container->getField("file", "created"),
    );
  }


}
