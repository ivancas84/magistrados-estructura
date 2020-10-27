<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TipoDocumentoEntity extends Entity {
  public $name = "tipo_documento";
  public $alias = "td";
  public $nf = ['descripcion'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'descripcion'];
  public $unique = ['id'];


}
