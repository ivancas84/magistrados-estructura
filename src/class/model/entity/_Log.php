<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _LogEntity extends Entity {
  public $name = "log";
  public $alias = "loa";
  public $nf = ['type', 'description', 'user', 'created'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'created'];
  public $unique = ['id'];


}
