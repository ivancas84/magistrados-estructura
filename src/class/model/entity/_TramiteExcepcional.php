<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TramiteExcepcionalEntity extends Entity {
  public $name = "tramite_excepcional";
  public $alias = "te";
  public $nf = ['motivo', 'estado', 'creado', 'enviado', 'evaluado', 'modificado', 'observaciones', 'desde', 'hasta', 'monto'];
  public $mu = ['persona', 'sucursal'];
  public $_u = [];
  public $notNull = ['id', 'motivo', 'estado', 'creado', 'persona', 'sucursal'];
  public $unique = ['id'];


}