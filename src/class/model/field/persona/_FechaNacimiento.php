<?php

require_once("class/model/Field.php");

class _FieldPersonaFechaNacimiento extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "fecha_nacimiento";
  public $alias = "fn";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }


}
