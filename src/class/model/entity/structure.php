<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("afiliacion"),
  Entity::getInstanceRequire("cargo"),
  Entity::getInstanceRequire("departamento_judicial"),
  Entity::getInstanceRequire("organo"),
  Entity::getInstanceRequire("persona"),
  Entity::getInstanceRequire("tipo_documento"),
);

  Entity::setStructure($structure);

