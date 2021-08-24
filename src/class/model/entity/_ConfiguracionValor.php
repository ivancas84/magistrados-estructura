<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ConfiguracionValorEntity extends Entity {
  public $name = "configuracion_valor";
  public $alias = "cv";
  public $nf = ['desde', 'valor', 'creado', 'nombre'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['desde', 'valor', 'creado', 'id', 'nombre'];
  public $unique = ['id'];


}
