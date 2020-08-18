<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEvaluado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "evaluado";
  public $alias = "eva";


  public function getEntity(){ return Entity::getInstanceRequire('afiliacion'); }


}
