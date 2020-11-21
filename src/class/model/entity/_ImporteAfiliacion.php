<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ImporteAfiliacionEntity extends Entity {
  public $name = "importe_afiliacion";
  public $alias = "ia";
  public $nf = ['creado', 'valor', 'periodo'];
  public $mu = ['afiliacion'];
  public $_u = [];
  public $notNull = ['id', 'creado', 'afiliacion', 'valor', 'periodo'];
  public $unique = ['id'];


}
