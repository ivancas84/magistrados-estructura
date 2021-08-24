<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _FamEntity extends Entity {
  public $name = "fam";
  public $alias = "fam";
  public $nf = ['desde', 'valor', 'creado'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['desde', 'valor', 'creado', 'id'];
  public $unique = ['id'];


}
