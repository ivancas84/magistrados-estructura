<?php
require_once("class/api/Base.php");
require_once("class/model/Render.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_key2.php");

class Importe162InfoApi extends BaseApi {
  /**
   * Controlador base
   * Elementos en comun a todos los controladores
   **/
  
  public $entityName = "importe162"; 
  public $permission = "R";

  public function main() {
    $this->data = php_input();

    // $fam = intval($this->consultarConfiguracionValor("FAM")["valor"]);
    //$cuotaAsociativa = floatval($this->consultarConfiguracionValor("Cuota Asociativa")["valor"]);

    $importeAfiliaciones = array_combine_key2(
      $this->consultarImporteAfiliaciones(), 
      ["afi_departamento_judicial", "afi_organo"]
    );

    // $viaticos = array_combine_key(
    //   $this->consultarViaticos(), 
    //   "departamento_judicial"
    // );

    // $departamentosJudiciales = array_combine_key(
    //   $this->consultarDepartamentosJudiciales(), 
    //   "id"
    // );

    $response = [];

    foreach($importeAfiliaciones as $id => $dj) {
      $dj["importe"] = (array_key_exists($id, $importeAfiliaciones)) ? floatval($importeAfiliaciones[$id]["valor_sum"]) : 0;
      $dj["afiliaciones"] = (array_key_exists($id, $importeAfiliaciones)) ? intval($importeAfiliaciones[$id]["count"]) : 0;
      if($dj["afiliaciones"]) array_push($response, $dj);
    }

    return array_values($response);
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
    $render->setGroup(["afi-departamento_judicial", "afi-organo", "afi_dj-nombre","afi_dj-codigo","afi_org-descripcion"]);
    $render->setSize(false);
    $render->setCondition([
      ["periodo.ym","=",$this->data["periodo"]],
      ["afi-codigo","=~","162"]
    ]);

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
