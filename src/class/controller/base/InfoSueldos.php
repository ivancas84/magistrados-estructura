<?php

require_once("class/controller/Base.php");
require_once("class/model/Sqlo.php");
require_once("class/model/Db.php");


class InfoSueldosBase extends Base {
  /**
   * Generar informe de sueldos
   */
  public $entityName = "info_sueldos";

  public function main($params = null) {
    $afiliacionesCreadas = $this->consultarAfiliacionesCreadas();
    
    $sql = "";
    foreach($afiliacionesCreadas as $ac){
      $ac_ = [
        "id" => $ac["id"],
        "enviado" => new DateTime(),
      ];

      $update = EntitySqlo::getInstanceRequire("afiliacion")->update($ac_);
      $sql .= $update["sql"];
    }
    
    if(!empty($sql)){
      $db = Db::open();
      $db->multi_query_last($sql);
    }
    
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
      ["estado", "=", "Creado"],
      ["motivo", "=", ["Alta", "Baja"]],
    ];

    return Ma::open()->all("afiliacion", $render);
  }

}