<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CargoEntity extends Entity {
  public $name = "cargo";
  public $alias = "carg";
 
  public function getPk(){
    return $this->container->getField("cargo", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("cargo", "descripcion"),
    );
  }


}
