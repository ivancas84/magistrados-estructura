<?php

require_once("class/model/Field.php");

class _FieldFileSize extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "10";
  public $main = false;
  public $name = "size";
  public $alias = "siz";


  public function getEntity(){ return Entity::getInstanceRequire('file'); }


}
