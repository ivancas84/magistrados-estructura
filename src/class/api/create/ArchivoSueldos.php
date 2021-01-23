<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");

class ArchivoSueldosCreateApi extends BaseApi {
  /**
   * Generar informe de sueldos
   */

  public $dir = null;
  public $permission = "w";

  protected $data = []; //parametros
  protected $registrosCreados = []; //registros (afiliaciones o tramites excepcionales) creados que seran enviados
  protected $path; //path donde se definira el archivo
  protected $file; //referencia al archivo
  protected $detail = []; //detalle de entidades modificadas

  public function main() {
    $this->data = php_input();

    $this->container->getAuth()->authorize($this->data["tipo"], $this->permission);

    $this->verificarPeriodo(); //verificar si hay afiliaciones enviadas en el periodo ingresado
    $this->consultarRegistrosCreados(); //consultar afiliaciones creadas
    $this->createPath();
    $this->openFile();
    $this->enviarRegistros();

    return [
      "path" => $this->path,
      "detail" => $this->detail,
    ];
  }
  
  protected function verificarPeriodo(){
    $prefix = ($this->data["tipo"] == "afiliacion") ? "afi" : "te";
    $render = [
      ["periodo.ym","=",$this->data["periodo"]],
      [$prefix."_per-organo", "=", $this->data["organo"]],
    ];

    if(
      $this->container->getDb()->count("importe_".$this->data["tipo"], $render) 
    ) 
      throw new Exception("El periodo ingresado ya fue enviado");
  }
  
  public function consultarRegistrosCreados(){

    $periodo = new DateTime($this->data["periodo"]);
    $render= new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Creado"],
      ["motivo", "=", ["Alta", "Baja","Modificación"]],
      ["per-organo", "=", $this->data["organo"]],
    ]);

    /*
    No se contempla por el momento el chequeo de fechas
    Porque por ejemplo se puede dar de baja un registro fuera de las fechas
    O a lo sumo se podria controlar el motivo, si es alta controlar fechas
    si es baja no controlar fechas.
    Por el momento no se controlan, se deja comentado el codigo a continuacion

    if($this->data["tipo"] == "tramite_excepcional"){
      $render->addCondition([
        [
          ["desde.ym","<=",$periodo->format("Y-m")],
          ["hasta.ym",">=",$periodo->format("Y-m")]
        ],
        [
          ["desde","=",false, "OR"],
          ["hasta","=",false]
        ]
      ]);
    }*/

    $this->registrosCreados = $this->container->getDb()->all($this->data["tipo"], $render);
    if(empty($this->registrosCreados)) throw new Exception("No existen registros creados para el órgano solicitado");
  }

  

  public function createPath(){    
    $dir = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_FILE . DIRECTORY_SEPARATOR;
    $dir_ = ($this->data["tipo"] == "afiliacion") ? "40" : "80";
    $subpath = $dir_ . DIRECTORY_SEPARATOR . date("Y") . DIRECTORY_SEPARATOR ;
    if(!file_exists($dir.$subpath)) {
      mkdir($dir.$subpath, 0755, true);
    }
    $organo = $this->container->getDb()->get("organo", $this->data["organo"]);
    require_once("function/acronym.php");
    $periodo = new DateTime($this->data["periodo"]);
    $this->path = $subpath.$periodo->format("Y-m_").acronym($organo["descripcion"]).".txt";    
  }

  protected function openFile(){
    $this->file = fopen($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_FILE . DIRECTORY_SEPARATOR.$this->path, "w");
    if(!$this->file) throw new Exception("Error al crear archivo");
  }

  protected function enviarRegistros(){
    $sql = "";
    
    foreach($this->registrosCreados as $ac){
      $value = $this->valueToUpdate($ac["id"]);
      $sql .= $this->container->getSqlo($this->data["tipo"])->update($value->_toArray("sql"));
      array_push($this->detail, $this->data["tipo"].$value->_get("id"));
      $this->fwrite($ac);      
    }
    fclose($this->file);
    if(!empty($sql)) $this->container->getDb()->multi_query_last($sql);
  }

  private function fwrite($ac){    
    $v = $this->container->getRel($this->data["tipo"])->value($ac);
    //if($v["organo"] == "Ministerio Público"){

      $codigo = "010";
      $codigo .= $v["persona"]->_get("legajo");
      $codigo .= "40";
      $codigo .= "00000000000";
      $codigo .= ($v[$this->data["tipo"]]->_get("motivo") == "Alta") ? "3" : "4";
      $codigo .= "                                                     ";
      $codigo .= ($v["departamento_judicial"]->_get("nombre") != "San Isidro") ? "1" : " ";
      $codigo .= "                     ";
      $codigo .= ($v["departamento_judicial"]->_get("nombre") == "San Isidro") ? "1" : " ";
    //}  
    fwrite($this->file,  $codigo.PHP_EOL);
  }

  private function valueToUpdate($idAfiliacion){
    $value = $this->container->getValue($this->data["tipo"]);
    $value->_fastSet("id", $idAfiliacion);
    $value->_fastSet("enviado", new DateTime());
    $value->_fastSet("estado", "Enviado");
    return $value;
  }
}