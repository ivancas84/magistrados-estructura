<?php

require_once("class/model/Field.php");

class _FieldAfiliacionCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "current_timestamp()";
  public $length = false;
  public $main = false;
  public $name = "creado";
  public $alias = "cre";


  public function getEntity(){ return Entity::getInstanceRequire('afiliacion'); }


}
