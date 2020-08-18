<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEnviado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "enviado";
  public $alias = "env";


  public function getEntity(){ return Entity::getInstanceRequire('afiliacion'); }


}
