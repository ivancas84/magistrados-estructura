<?php

require_once("class/model/Field.php");

class _FieldPersonaNombres extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "nombres";
  public $alias = "nom";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }


}
