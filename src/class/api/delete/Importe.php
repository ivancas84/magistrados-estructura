<?php
require_once("class/model/Ma.php");
require_once("function/php_input.php");
set_time_limit ( 0 );

class ImporteDeleteApi  {
  public $entityName = "importe";
  public $container;
  public $permission = "w";

  public function main(){
    $data = php_input();
    $periodo = new DateTime($data["periodo"]);

    $sql = "";

    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym", "=", $data["periodo"]],
      ["afi_per-organo", "=", $data["organo"]]
    ]);
    $ids = $this->container->getDb()->ids("importe_afiliacion", $render);    
    if(!empty($ids)) $sql .= $this->container->getSqlo("importe_afiliacion")->deleteAll($ids);
    
    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym", "=", $data["periodo"]],
      ["organo", "=", $data["organo"]]
    ]);
    $idsV = $this->container->getDb()->ids("viatico", $render);    
    if(!empty($idsV)) $sql .= $this->container->getSqlo("viatico")->deleteAll($idsV);

    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym", "=", $data["periodo"]],
      ["te_per-organo", "=", $data["organo"]]
    ]);
    $idsT = $this->container->getDb()->ids("importe_tramite_excepcional", $render);
    if(!empty($idsT)) $sql .= $this->container->getSqlo("importe_tramite_excepcional")->deleteAll($idsT);


    if(empty($ids) && empty($idsT) && empty($idsV)) throw new Exception("No existen elementos para el periodo seleccionado", 404);
    $this->container->getDb()->multi_query_transaction($sql);    
  }

}

