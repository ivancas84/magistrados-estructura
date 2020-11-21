<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");

class ArchivoAfiliacionesCreateApi extends BaseApi {
  /**
   * Generar informe de sueldos
   */

  public $dir = null;
  public $permission = "w";

  protected $data = []; //parametros
  protected $afiliacionesCreadas = []; //afiliaciones creadas que seran enviadas
  protected $path; //path donde se definira el archivo
  protected $file; //referencia al archivo
  protected $detail = []; //detalle de entidades modificadas

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);

    $this->data = php_input();
    $this->verificarAfiliacionesEnviadas(); //verificar si hay afiliaciones enviadas en el periodo ingresado
    $this->consultarAfiliacionesCreadas(); //consultar afiliaciones creadas
    $this->createPath();
    $this->openFile();
    $this->enviarAfiliaciones();

    return [
      "path" => $this->path,
      "detail" => $this->detail,
    ];
  }
  
  protected function verificarAfiliacionesEnviadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Enviado"],
      ["per-organo", "=", $this->data["organo"]],
      ["enviado.ym","=",$this->data["periodo"]]
    ];

    if($this->container->getDb()->count("afiliacion", $render)) 
      throw new Exception("El periodo ingresado ya fue enviado");
  }
  
  public function consultarAfiliacionesCreadas(){
    $render = [
      ["modificado.is_set", "=", false],
      ["estado", "=", "Creado"],
      ["motivo", "=", ["Alta", "Baja"]],
      ["per-organo", "=", $this->data["organo"]],
    ];

    $this->afiliacionesCreadas = $this->container->getDb()->all("afiliacion", $render);
    if(empty($this->afiliacionesCreadas)) throw new Exception("No existen afiliaciones creadas para el órgano solicitado");
  }

  

  public function createPath(){
    $dir = $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_FILE . "/";
    $subpath = date("Y/");
    if(!file_exists($dir)) mkdir($dir.$subpath, 0755, true);
    $organo = $this->container->getDb()->get("organo", $this->data["organo"]);
    require_once("function/acronym.php");
    $periodo = new DateTime($this->data["periodo"]);
    $this->path = $subpath.$periodo->format("Y-m_").acronym($organo["descripcion"]).".txt";    
  }

  protected function openFile(){
    $this->file = fopen($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_FILE . "/".$this->path, "w");
    if(!$this->file) throw new Exception("Error al crear archivo");
  }

  protected function enviarAfiliaciones(){    
    $sql = "";
    
    foreach($this->afiliacionesCreadas as $ac){
      $value = $this->valueToUpdate($ac["id"]);
      $sql .= $this->container->getSqlo("afiliacion")->update($value->_toArray("sql"));
      array_push($this->detail, "afiliacion".$value->_get("id"));
      $this->fwrite($ac);      
    }
    fclose($this->file);
    if(!empty($sql)) $this->container->getDb()->multi_query_last($sql);
  }

  private function fwrite($ac){    
    $v = $this->container->getRel("afiliacion")->value($ac);
    fwrite($this->file, $v["persona"]->_get("nombres"));
  }

  private function valueToUpdate($idAfiliacion){
    $value = $this->container->getValue("afiliacion");
    $value->_fastSet("id", $idAfiliacion);
    $value->_fastSet("enviado", new DateTime());
    $value->_fastSet("estado", "Enviado");
    return $value;
  }
}