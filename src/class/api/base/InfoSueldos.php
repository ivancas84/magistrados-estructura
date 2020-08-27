<?php

require_once("class/api/Base.php");
require_once("class/model/Sqlo.php");
require_once("class/model/DbLog.php");
require_once("class/model/Ma.php");

class InfoSueldosBase extends Base {
  /**
   * Generar informe de sueldos
   * @todo tiene caracteristicas de controlador de persistencia, se puede redefinir
   */
  public $entityName = "info_sueldos";

  public function main() {
    $afiliacionesCreadas = $this->consultarAfiliacionesCreadas();
    $sql = "";

    $detail = [];
    foreach($afiliacionesCreadas as $ac){
      $ac_ = [
        "id" => $ac["id"],
        "enviado" => new DateTime(),
        "estado" => "Enviado"
      ];

      $update = $this->container->getSqlo("afiliacion")->update($ac_);
      $sql .= $update["sql"];
      if(!empty($update["sql"])) array_push($detail, "afiliacion".$update["id"]);
    }
    
    if(!empty($sql)) $this->db->multi_query_last_log($sql);

    return [
      "id" => null, //id del archivo creado
      "detail" => $detail
    ];
    
    /*
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    $txt = "John Doe\n";
    fwrite($myfile, $txt);
    $txt = "Jane Doe\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    */
  }

  
  public function consultarAfiliacionesCreadas(){
    $render = [
      ["modificado_is_set", "=", false],
      //["estado", "=", "Creado"],
      //["motivo", "=", ["Alta", "Baja"]],
    ];

    return $this->db->all("afiliacion", $render);
  }

}