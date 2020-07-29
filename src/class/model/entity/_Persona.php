<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
 
  public function getPk(){
    return Field::getInstanceRequire("persona", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("persona", "nombres"),
      Field::getInstanceRequire("persona", "apellidos"),
      Field::getInstanceRequire("persona", "legajo"),
      Field::getInstanceRequire("persona", "numero_documento"),
      Field::getInstanceRequire("persona", "telefono_laboral"),
      Field::getInstanceRequire("persona", "telefono_particular"),
      Field::getInstanceRequire("persona", "fecha_nacimiento"),
      Field::getInstanceRequire("persona", "email"),
      Field::getInstanceRequire("persona", "creado"),
      Field::getInstanceRequire("persona", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("persona", "cargo"),
      Field::getInstanceRequire("persona", "organo"),
      Field::getInstanceRequire("persona", "departamento_judicial"),
      Field::getInstanceRequire("persona", "departamento_judicial_informado"),
      Field::getInstanceRequire("persona", "tipo_documento"),
    );
  }


}
