<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TipoDocumentoEntity extends Entity {
  public $name = "tipo_documento";
  public $alias = "td";
 
  public function getPk(){
    return Field::getInstanceRequire("tipo_documento", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("tipo_documento", "descripcion"),
    );
  }


}
