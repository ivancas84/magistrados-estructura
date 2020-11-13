<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ImporteTramiteExcepcionalEntity extends Entity {
  public $name = "importe_tramite_excepcional";
  public $alias = "ite";
  public $nf = ['creado'];
  public $mu = ['tramite_excepcional'];
  public $_u = ['importe'];
  public $notNull = ['id', 'creado', 'tramite_excepcional', 'importe'];
  public $unique = ['id', 'importe'];


}
