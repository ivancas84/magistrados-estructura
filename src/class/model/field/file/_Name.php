<?php

require_once("class/model/Field.php");

class _FieldFileName extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "name";
  public $alias = "nam";


  public function getEntity(){ return $this->container->getEntity('file'); }


}
