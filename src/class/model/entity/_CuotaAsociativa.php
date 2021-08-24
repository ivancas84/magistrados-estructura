<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CuotaAsociativaEntity extends Entity {
  public $name = "cuota_asociativa";
  public $alias = "ca";
  public $nf = ['desde', 'valor', 'creado'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['desde', 'valor', 'creado', 'id'];
  public $unique = ['id'];


}
