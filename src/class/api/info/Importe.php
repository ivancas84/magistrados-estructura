<?php
require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';
use Luecano\NumeroALetras\NumeroALetras;
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
    $this->data = php_input();

    $fam = floatval($this->consultarConfiguracionValor("FAM")["valor"]);
    $cuotaAsociativa = floatval($this->consultarConfiguracionValor("Cuota Asociativa")["valor"]);

    $importeAfiliaciones = array_combine_key(
      $this->consultarImporteAfiliaciones(), 
      "afi_departamento_judicial"
    );

    $viaticos = array_combine_key(
      $this->consultarViaticos(), 
      "departamento_judicial"
    );

    $departamentosJudiciales = array_combine_key(
      $this->consultarDepartamentosJudiciales(), 
      "id"
    );

    $formatter = new NumeroALetras();

    foreach($departamentosJudiciales as $id => &$dj){
      $dj["importe"] = (array_key_exists($id, $importeAfiliaciones)) ? floatval($importeAfiliaciones[$id]["valor_sum"]) : 0;
      $dj["afiliaciones"] = (array_key_exists($id, $importeAfiliaciones)) ? intval($importeAfiliaciones[$id]["count"]) : 0;
      $dj["cuota_asociativa"] = round($dj["importe"] * $cuotaAsociativa, 2);
      $dj["fam"] = round($dj["afiliaciones"] * $fam, 2);
      $dj["total_deduccion"] = round($dj["fam"] + $dj["cuota_asociativa"],2);
      $dj["viatico"] = (array_key_exists($id, $viaticos)) ? floatval($viaticos[$id]["valor"]) : 0;
      $dj["total_pagar"] = round($dj["importe"] - $dj["total_deduccion"], 2); 
      $dj["total"] = round($dj["total_pagar"] + $dj["viatico"], 2);
      $dj["valor_fam"] = $fam;
      $dj["valor_cuota_asociativa"] = $cuotaAsociativa;
      $dj["total_pagar_letras"] = $formatter->toInvoice($dj["total_pagar"], 2, "PESOS"); 

      
    }

    if((array_key_exists("departamento_judicial", $this->data)) && !empty($this->data["departamento_judicial"])) return $departamentosJudiciales[$this->data["departamento_judicial"]];
    return array_values($departamentosJudiciales);
  }

  protected function consultarConfiguracionValor($nombre){
    $render = new Render();
    $render->setCondition([
      ["desde.ym","<=",$this->data["periodo"]],
      ["nombre","=",$nombre]
    ]);
    $render->setOrder(["desde"=>"DESC"]);
    return $this->container->getDb()->first("configuracion_valor", $render);
  }

  protected function consultarImporteAfiliaciones(){
    $render = new Render();
    $render->setFields(["count", "valor.sum"]);
    $render->setGroup(["afi-departamento_judicial"]);
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym","=",$this->data["periodo"]],
      ["afi-codigo","=~","161"]
    ]);

    if(array_key_exists("organo",$this->data) && !empty($this->data["organo"])) $render->addCondition(["afi-organo","=",$this->data["organo"]]);    
    if(array_key_exists("departamento_judicial",$this->data) && !empty($this->data["departamento_judicial"])) $render->addCondition(["afi-departamento_judicial","=",$this->data["departamento_judicial"]]);    
    //echo "<pre>".$this->container->getSqlo("importe_afiliacion")->select($render);
    return $this->container->getDb()->advanced("importe_afiliacion", $render);
  }

  protected function consultarDepartamentosJudiciales(){
    $render = new Render();
    $render->setSize(false);
    return $this->container->getDb()->all("departamento_judicial", $render);
  }

  protected function consultarViaticos(){
    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym","=",$this->data["periodo"]]
    ]);

    if(array_key_exists("departamento_judicial",$this->data) && !empty($this->data["departamento_judicial"])) $render->addCondition(["departamento_judicial","=",$this->data["departamento_judicial"]]);    

    return $this->container->getDb()->all("viatico", $render);
  }
  

}
