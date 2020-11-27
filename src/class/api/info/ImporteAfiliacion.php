<?php
require_once("class/api/Base.php");
require_once("class/model/Render.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");
class ImporteAfiliacionInfoApi extends BaseApi {
  /**
   * Controlador base
   * Elementos en comun a todos los controladores
   **/
  
  public $entityName = "importe"; 
  public $permission = "R";

  public function main() {
    $data = php_input();
    
    $render = new Render();
    $render->setSize(false);

    $render->setCondition([
      ["periodo.ym","=",$data["periodo"]],
      ["afi_per-departamento_judicial"],
      ["afi_per-organo","=",$data["organo"]]
    ]);

    if($data["cargo"]) $render->addCondition(["afi_per-cargo","=",$data["cargo"]]);
    if($data["departamento_judicial_informado"]) $render->addCondition(["afi_per-cargo","=",$data["cargo"]]);


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
      $dj["importe"] = (array_key_exists($id, $calculosIniciales)) ? floatval($calculosIniciales[$id]["valor_sum"]) : 0;
      $dj["afiliaciones"] = (array_key_exists($id, $calculosIniciales)) ? floatval($calculosIniciales[$id]["count"]) : 0;
      $dj["cuota_asociativa"] = round($dj["importe"] * CUOTA_ASOCIATIVA, 2);
      $dj["fam"] = round($dj["cuota_asociativa"] * FAM, 2);
      $dj["total_deduccion"] = round($dj["fam"] + $dj["cuota_asociativa"],2);
      $dj["viatico"] = 0;
      $dj["total_pagar"] = round($dj["importe"] - $dj["total_deduccion"], 2); 
      $dj["total"] = round($dj["total_deduccion"] + $dj["viatico"], 2);


    }

    return array_values($departamentosJudiciales);
  }

}
