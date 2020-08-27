<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TipoDocumentoEntity extends Entity {
  public $name = "tipo_documento";
  public $alias = "td";
 
  public function getPk(){
    return $this->container->getField("tipo_documento", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("tipo_documento", "descripcion"),
    );
  }


}
