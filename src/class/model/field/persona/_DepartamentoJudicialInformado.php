<?php

require_once("class/model/Field.php");

class _FieldPersonaDepartamentoJudicialInformado extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "departamento_judicial_informado";
  public $alias = "dji";


  public function getEntity(){ return $this->container->getEntity('persona'); }

  public function getEntityRef(){ return $this->container->getEntity('departamento_judicial'); }


}
