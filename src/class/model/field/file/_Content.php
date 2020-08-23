<?php

require_once("class/model/Field.php");

class _FieldFileContent extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "content";
  public $alias = "con";


  public function getEntity(){ return Entity::getInstanceRequire('file'); }


}
