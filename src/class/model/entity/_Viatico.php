<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ViaticoEntity extends Entity {
  public $name = "viatico";
  public $alias = "viat";
  public $nf = ['creado', 'valor', 'periodo'];
  public $mu = ['departamento_judicial'];
  public $_u = [];
  public $notNull = ['id', 'creado', 'valor', 'periodo', 'departamento_judicial'];
  public $unique = ['id'];


}
