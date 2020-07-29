<?php

require_once("class/model/Field.php");

class _FieldDepartamentoJudicialNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "nombre";
  public $alias = "nom";


  public function getEntity(){ return Entity::getInstanceRequire('departamento_judicial'); }


}
