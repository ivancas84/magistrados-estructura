<?php

require_once("class/api/Base.php");

class ArchivoAfiliacionesCreateApi extends BaseApi {
  /**
   * Generar informe de sueldos
   */

  public $dir = null;
  public $permission = "write";

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);

    $idOrgano = $this->filterOrgano();
    $afiliacionesCreadas = $this->consultarAfiliacionesCreadas($idOrgano);
    $detail = [];
    $sql = "";
    $path = $this->createPath($idOrgano);
    $file = $this->openFile($path);
    foreach($afiliacionesCreadas as $ac){
      $value = $this->valueToUpdate($ac["id"]);
      $sql .= $this->container->getSqlo("afiliacion")->update($value->_toArray("sql"));
      array_push($detail, "afiliacion".$value->_get("id"));
      $this->fwrite($file, $ac);      
    }
    fclose($file);
    if(!empty($sql)) $this->container->getDb()->multi_query_last_log($sql);

    return [
      "path" => $path,
      "detail" => $detail,
    ];
  }
  
  public function filterOrgano(){
    require_once("class/tools/Filter.php");
    $data = file_get_contents("php://input");
    if(!$data) throw new Exception("Error al obtener datos de input");
    $data = json_decode($data, true);
    if (!isset($data["organo"])) throw new Exception("El órgano no se encuentra definido");
    return $data["organo"];
  }
  
  public function consultarAfiliacionesCreadas($idOrgano){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Creado"],
      ["motivo", "=", ["Alta", "Baja"]],
      ["per-organo", "=", $idOrgano],
    ];

    $r = $this->container->getDb()->all("afiliacion", $render);
    if(empty($r)) throw new Exception("No existen afiliaciones creadas para el órgano solicitado");
    return $r;
  }

  public function valueToUpdate($idAfiliacion){
    $value = $this->container->getValue("afiliacion");
    $value->_fastSet("id", $idAfiliacion);
    $value->_fastSet("enviado", new DateTime());
    $value->_fastSet("estado", "Enviado");
    return $value;
  }

  public function createPath($idOrgano){
    $dir = $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_FILE . "/";
    $subpath = date("Y/");
    if(!file_exists($dir)) mkdir($dir.$subpath, 0755, true);
    $idOrgano = $this->container->getDb()->get("organo", $idOrgano);
    require_once("function/acronym.php");
    return $subpath.date("Y-m_").acronym($idOrgano["descripcion"]).".txt";    
  }

  public function openFile($path){
    $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_FILE . "/".$path, "w");
    if(!$file) throw new Exception("Error al crear archivo");
    return $file;
  }

  public function fwrite($file, $ac){    
    $v = $this->container->getRel("afiliacion")->value($ac);
    fwrite($file, $v["persona"]->_get("nombres"));
  }
}