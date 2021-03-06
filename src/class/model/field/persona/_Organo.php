<?php

require_once("class/model/Field.php");

class _FieldPersonaOrgano extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "organo";
  public $alias = "org";


  public function getEntity(){ return $this->container->getEntity('persona'); }

  public function getEntityRef(){ return $this->container->getEntity('organo'); }


}
