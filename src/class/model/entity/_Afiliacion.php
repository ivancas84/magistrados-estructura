<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AfiliacionEntity extends Entity {
  public $name = "afiliacion";
  public $alias = "afil";
  public $nf = ['motivo', 'estado', 'creado', 'enviado', 'evaluado', 'modificado', 'observaciones', 'codigo'];
  public $mu = ['persona'];
  public $_u = [];
  public $notNull = ['id', 'motivo', 'estado', 'creado', 'persona'];
  public $unique = ['id'];


}
