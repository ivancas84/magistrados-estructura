<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DepartamentoJudicialEntity extends Entity {
  public $name = "departamento_judicial";
  public $alias = "dj";
  public $nf = ['codigo', 'nombre'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'codigo'];
  public $unique = ['id'];


}
