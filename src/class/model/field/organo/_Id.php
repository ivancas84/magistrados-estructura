<?php

require_once("class/model/Field.php");

class _FieldOrganoId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = true;
  public $name = "id";
  public $alias = "id";


  public function getEntity(){ return Entity::getInstanceRequire('organo'); }


}
