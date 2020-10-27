<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _OrganoEntity extends Entity {
  public $name = "organo";
  public $alias = "orga";
  public $nf = ['descripcion'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'descripcion'];
  public $unique = ['id'];


}
