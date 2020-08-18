<?php

require_once("class/model/Field.php");

class _FieldPersonaTelefonoLaboral extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "telefono_laboral";
  public $alias = "tl";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }


}
