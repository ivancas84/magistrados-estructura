<?php

require_once("class/model/Field.php");

class _FieldPersonaTipoDocumento extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "tipo_documento";
  public $alias = "td";


  public function getEntity(){ return $this->container->getEntity('persona'); }

  public function getEntityRef(){ return $this->container->getEntity('tipo_documento'); }


}
