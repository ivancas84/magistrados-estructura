<?php
require_once("class/model/Render.php");
require_once("class/tools/Validation.php");

class ExistenRegistrosEnviados {

  public $container;

  protected function cantidadRegistrosEnviados($tipo) {
    $render = $this->container->getRender();
    $render->setCondition([
      ["modificado","=",false],
      ["estado","=","Enviado"],
    ]);
    return $this->container->getDb()->count($tipo, $render);
  }

  public function main() {
    if($this->cantidadRegistrosEnviados("afiliacion")) return true;
    if($this->cantidadRegistrosEnviados("tramite_excepcional")) return true;
    return false;
  }

}