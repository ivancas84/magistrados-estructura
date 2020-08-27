<?php

require_once("class/Container.php");

$container = new Container();
$structure = array (
  $container->getEntity("afiliacion"),
  $container->getEntity("cargo"),
  $container->getEntity("departamento_judicial"),
  $container->getEntity("file"),
  $container->getEntity("organo"),
  $container->getEntity("persona"),
  $container->getEntity("tipo_documento"),
);

  Entity::setStructure($structure);

