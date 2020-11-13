<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ImporteEntity extends Entity {
  public $name = "importe";
  public $alias = "impo";
  public $nf = ['valor', 'periodo', 'creado'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'valor', 'periodo', 'creado'];
  public $unique = ['id'];


}
