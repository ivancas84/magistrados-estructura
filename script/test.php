<?php
require_once("../config/config.php");
require_once("class/Container.php");

$container = new Container();
$v = $container->getValue("afiliacion")->_call("setDefault");

$render = new Render();
$render->addCondition([["maxx","=","123"], ["estado","=","Autorizada", "OR"]]);
$render->setOrder(["estado"=>"ASC"]);
echo $container->getSqlo("afiliacion")->all($render);

