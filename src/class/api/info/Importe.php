<?php
require_once("class/api/Base.php");
require_once("class/model/Render.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");
class ImporteInfoApi extends BaseApi {
  /**
   * Controlador base
   * Elementos en comun a todos los controladores
   **/
  
  public $entityName = "importe"; 
  public $permission = "R";

  public function main() {
    $data = php_input();
    
    $render = new Render();

    $render->setFields(["count", "imp-valor.sum"]);

    $render->setGroup(["afi_per-departamento_judicial"]);

    $render->setCondition([
      ["afi-modificado","=",false],
      ["afi-evaluado","=",true],
      ["afi-estado","=","Aprobado"],
      ["afi-motivo","=","Alta"],
    ]);

    $calculosIniciales = array_combine_key(
      $this->container->getDb()->advanced("importe_afiliacion", $render), 
      "afi_per_departamento_judicial"
    );

    $render = new Render();
    $render->setSize(false);

    $departamentosJudiciales = array_combine_key(
      $this->container->getDb()->all("departamento_judicial", $render), 
      "id"
    );

    foreach($departamentosJudiciales as $id => &$dj){
      $dj["importe"] = (array_key_exists($id, $calculosIniciales)) ? $calculosIniciales[$id]["imp_valor_sum"] : 0;
      $dj["afiliaciones"] = (array_key_exists($id, $calculosIniciales)) ? $calculosIniciales[$id]["count"] : 0;
      $dj["cuota_asociativa"] = $dj["importe"] * CUOTA_ASOCIATIVA;
      $dj["fam"] = $dj["cuota_asociativa"] * FAM;
      $dj["total_deduccion"] = $dj["fam"] + $dj["cuota_asociativa"];
      $dj["viatico"] = 0;
      $dj["total_pagar"] = $dj["importe"] - $dj["total_deduccion"]; 
      $dj["total"] = $dj["total_deduccion"] + $dj["viatico"];


    }
    print_r($departamentosJudiciales);


  }

}
