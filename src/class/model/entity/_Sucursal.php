<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _SucursalEntity extends Entity {
  public $name = "sucursal";
  public $alias = "sucu";
  public $nf = ['descripcion'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'descripcion'];
  public $unique = ['id'];


}
