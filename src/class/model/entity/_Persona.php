<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
 
  public function getPk(){
    return $this->container->getField("persona", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("persona", "nombres"),
      $this->container->getField("persona", "apellidos"),
      $this->container->getField("persona", "legajo"),
      $this->container->getField("persona", "numero_documento"),
      $this->container->getField("persona", "telefono_laboral"),
      $this->container->getField("persona", "telefono_particular"),
      $this->container->getField("persona", "fecha_nacimiento"),
      $this->container->getField("persona", "email"),
      $this->container->getField("persona", "creado"),
      $this->container->getField("persona", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("persona", "cargo"),
      $this->container->getField("persona", "organo"),
      $this->container->getField("persona", "departamento_judicial"),
      $this->container->getField("persona", "departamento_judicial_informado"),
      $this->container->getField("persona", "tipo_documento"),
    );
  }


}
