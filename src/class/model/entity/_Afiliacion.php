<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AfiliacionEntity extends Entity {
  public $name = "afiliacion";
  public $alias = "afil";
 
  public function getPk(){
    return $this->container->getField("afiliacion", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("afiliacion", "motivo"),
      $this->container->getField("afiliacion", "estado"),
      $this->container->getField("afiliacion", "creado"),
      $this->container->getField("afiliacion", "enviado"),
      $this->container->getField("afiliacion", "evaluado"),
      $this->container->getField("afiliacion", "modificado"),
      $this->container->getField("afiliacion", "observaciones"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("afiliacion", "persona"),
    );
  }


}
