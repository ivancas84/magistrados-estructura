<?php

require_once("class/model/Field.php");

class _FieldPersonaLegajo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "legajo";
  public $alias = "leg";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }


}
