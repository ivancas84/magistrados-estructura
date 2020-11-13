<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ImporteAfiliacionEntity extends Entity {
  public $name = "importe_afiliacion";
  public $alias = "ia";
  public $nf = ['creado'];
  public $mu = ['afiliacion'];
  public $_u = ['importe'];
  public $notNull = ['id', 'creado', 'afiliacion', 'importe'];
  public $unique = ['id', 'importe'];


}
