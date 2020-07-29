<?php

require_once("class/model/Field.php");

class _FieldPersonaDepartamentoJudicialInformado extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "departamento_judicial_informado";
  public $alias = "dji";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('departamento_judicial'); }


}
