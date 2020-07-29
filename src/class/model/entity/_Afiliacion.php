<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AfiliacionEntity extends Entity {
  public $name = "afiliacion";
  public $alias = "afil";
 
  public function getPk(){
    return Field::getInstanceRequire("afiliacion", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("afiliacion", "motivo"),
      Field::getInstanceRequire("afiliacion", "estado"),
      Field::getInstanceRequire("afiliacion", "creado"),
      Field::getInstanceRequire("afiliacion", "enviado"),
      Field::getInstanceRequire("afiliacion", "evaluado"),
      Field::getInstanceRequire("afiliacion", "modificado"),
      Field::getInstanceRequire("afiliacion", "observaciones"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("afiliacion", "persona"),
    );
  }


}
