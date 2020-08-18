<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEstado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "estado";
  public $alias = "est";


  public function getEntity(){ return Entity::getInstanceRequire('afiliacion'); }


}
