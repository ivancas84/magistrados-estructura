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
    /**
     * periodo
     * organo
     * tipo
     */

  protected $registroCreado_ = []; //registros (afiliaciones o tramites excepcionales) creados que seran enviados
  
  protected $path; //path donde se definiran los archivos
  protected $file; //referencia al archivo principal
    /**
     * El archivo principal es el que sera enviado al Área de Administración
     */

  protected $fileDetail; //referencia al archivo de detalle
    /**
     * El archivo detalle, es similar al principal pero permite visualizar los datos de una forma mas amigable
     */

  protected $detail = []; //detalle de entidades modificadas

  public function main() {
    $this->data = php_input();
    $this->checkPeriodo(); 
    /**
     * Verificar si hay afiliaciones enviadas en el periodo ingresado.
     * Si existen importes para el tipo de registro, periodo y organo se con-
     * sidera procesado.
     */
    $this->registroCreado_();
    /**
     * consultar registros creados.
     * Los registros creados son aquellos que tienen:
     *   Motivo "Creado".
     *   Estado "Alta", "Baja" o  "Modificado".
     *   Fecha de modificacion NO asignada.
     */
    $this->createPath();
    /**
     * Crear estructura de directorios donde se almacenara el archivo
     */
    $this->openFiles();
    /**
     * Abrir archivos para cargar el contenido.
     * Se abren dos archivos, uno para el area de sueldos y otro con el 
     * detalle.
     */
    $this->sendRegistro_(); 
    /**
     * registrar en base de datos que fue enviado y crear archivos.
     * El registro en la base de datos consiste en:
     *   Cambiar motivo a Enviado.
     *   Registrar fecha de enviado.
     */
    $this->closeFiles();

    return [
      "path" => $this->path,
      "detail" => $this->detail,
    ];
  }
  
  protected function checkPeriodo(){
    //if($this->data["tipo"] != "afiliacion") return; //solo se verifica para registros 40
    $prefix = ($this->data["tipo"] == "afiliacion") ? "afi" : "te";
    $render = [
      ["periodo.ym","=",$this->data["periodo"]],
      [$prefix."-organo", "=", $this->data["organo"]],
    ];

    if(
      $this->container->getDb()->count("importe_".$this->data["tipo"], $render) 
    ) 
      throw new Exception("El periodo ingresado ya fue enviado");
  }
  
  public function registroCreado_(){
    $periodo = new DateTime($this->data["periodo"]);
    $render = new Render();
    $render->setCondition([
      ["modificado.is_set", "=", false],
      ["estado", "=", "Creado"],
      ["motivo", "=", ["Alta", "Baja","Modificación"]],
      ["organo", "=", $this->data["organo"]],
    ]);

    if($this->data["tipo"] == "tramite_excepcional"){
      $render->addCondition([
        ["desde","=",true],
        ["hasta","=",true]
      ]);
    }
    /*
    No se contempla por el momento el chequeo de fechas

    if($this->data["tipo"] == "tramite_excepcional"){
      $render->addCondition([
        [
          ["desde.ym","<=",$periodo->format("Y-m")],
          ["hasta.ym",">=",$periodo->format("Y-m")]
        ],
        //[
        //  ["desde","=",false, "OR"],
        //  ["hasta","=",false]
        //]
      ]);
    }*/

    $this->registroCreado_ = $this->container->getDb()->all($this->data["tipo"], $render);
    if(empty($this->registroCreado_)) throw new Exception("No existen registros creados para el órgano solicitado");
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
    $this->path = $subpath.$periodo->format("Y-m_").acronym($organo["descripcion"]);    
  }

  protected function openFiles(){
    $this->file = fopen($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_FILE . DIRECTORY_SEPARATOR.$this->path.".txt", "w");
    $this->fileDetail = fopen($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . PATH_FILE . DIRECTORY_SEPARATOR.$this->path."_detalle.txt", "w");

    if(!$this->file || !$this->fileDetail) throw new Exception("Error al crear archivo");
  }

  protected function closeFiles(){
    fclose($this->file);
    fclose($this->fileDetail);
  }


  protected function sendRegistro_(){
    $sql = "";
    
    fwrite($this->fileDetail, "COLEGIO DE MAGISTRADOS Y FUNCIONARIOS DEL PODER JUDICIAL DE LA PROVINCIA DE BUENOS AIRES" . PHP_EOL);
    fwrite($this->fileDetail, date("d/m/Y") . " " . $this->registroCreado_[0]["org_descripcion"] .  PHP_EOL);
    $tipo = ($this->data["tipo"] == "afiliacion") ? "Registro 40" : "Registro 80"; 
    fwrite($this->fileDetail, $tipo .  PHP_EOL . PHP_EOL);
    
    
    foreach($this->registroCreado_ as $ac){
      $sql .= $this->persistRegistro($ac);
      $this->uploadFile($ac);      
    }
    if(!empty($sql)) $this->container->getDb()->multi_query_last($sql);
  }

  protected function persistRegistro($ac){
    $value = $this->container->getValue($this->data["tipo"]);
    $value->_fastSet("id", $ac["id"]);
    $value->_fastSet("enviado", new DateTime());
    $value->_fastSet("estado", "Enviado");
    array_push($this->detail, $this->data["tipo"].$value->_get("id"));
    return $this->container->getSqlo($this->data["tipo"])->update($value->_toArray("sql"));
  }
  
  private function uploadFile($ac){    
    $v = $this->container->getRel($this->data["tipo"])->value($ac);
    if($this->data["tipo"]=="afiliacion") {
      $codigo = $this->codigoAfiliacion($v);
      $detalle = $this->detalle($v, "afiliacion");
    } else {
      if($this->data["organo"]=="1"){
        $codigo = $this->codigoTramiteExcepcionalAj($v);
      } else {
        $codigo = $this->codigoTramiteExcepcionalMp($v);
      }
      $detalle = $this->detalle($v, "tramite_excepcional");
    }  
    fwrite($this->file,  $codigo.PHP_EOL);
    fwrite($this->fileDetail,  $detalle . PHP_EOL);
  }

  protected function codigoAfiliacion($v){
    $codigo = "010"; //3 1..3 
    $codigo .= $v["persona"]->_get("legajo"); //6 4..9 legajo
    $codigo .= "40"; //2 10..11
    $codigo .= "00000000000"; //11 12..22
    $codigo .= ($v[$this->data["tipo"]]->_get("motivo") == "Alta") ? "3" : "4"; //1 23
    $codigo .= "                                                     "; //53 24..76
    $codigo .= ($v["afiliacion"]->_get("codigo") != "162") ? "1" : " "; //1 77
    
    //$codigo .= ($v["departamento_judicial"]->_get("nombre") != "San Isidro") ? "1" : " "; //1 77
    $codigo .= "                     "; //21 78..98
    //$codigo .= ($v["departamento_judicial"]->_get("nombre") == "San Isidro") ? "1" : " "; //1 99
    $codigo .= ($v["afiliacion"]->_get("codigo") == "162") ? "1" : " "; //1 99
    
    return $codigo;
  }

  protected function codigoTramiteExcepcionalMp($v){
    $codigo = "010"; //3 1..3 empresa (ministerio publico 010)
    $codigo .= $v["persona"]->_get("legajo"); //6 4..9 legajo
    $codigo .= "80"; //2 10..11 registro
    $codigo .= "163"; //3 12..14 concepto
    /**
     * codigo que identifica a la entidad externa
     * que practica algun descuento sobre la liquidacion de haberes
     * de algunos agentes pertenecientes al Ministerio Publico
     */
    $codigo .= "2"; //1 15 subconcepto (para mp es 2?)
    /**
     * numero que permite distinguir entre distintos item de un mismo concepto
     */
    $codigo .= "00000"; //5 16..20 ceros (no se utilizan)
    $codigo .= "  "; //2 21..22 orden/sec 
    /**
     * numero que se utiliza para identificar 
     * que un agente posee mas de un descuento 
     * para el mismo concepto, subconcepto, fecha de proceso y entidad
     */
    $codigo .= $v["tramite_excepcional"]->_get("desde", "y"); //2 23..24 año desde
    $codigo .= $v["tramite_excepcional"]->_get("desde", "m"); //2 25..26 mes desde
    $codigo .= "0"; //1 27 digito (siempre vale 0)
    $codigo .= $v["tramite_excepcional"]->_get("hasta", "y"); //2 28..29 año hasta
    $codigo .= $v["tramite_excepcional"]->_get("hasta", "m"); //2 30..31 mes hasta
    $codigo .= "00"; //2 32..33 ceros 2
    $codigo .= str_pad( //10 34..43 importe a descontar
      str_replace(".","",$v->_get("monto")),10,0,STR_PAD_LEFT
    ); 
    $codigo .= "        "; //8 44..51 ceros 3
    $codigo .= " "; //1 52 automatico 
    /**
     * la descripcion dice que debe ser 0 
     * pero en los ejemplos esta blanco
     */
    $codigo .= "   "; //3 53..55 ceros 4
    $codigo .= str_pad($v["sucursal"]->_get("descripcion"),16); //16 56..71 descripcion 
    $codigo .= "000"; //3 72..74 (puede ser ceros o blancos)
    $codigo .= str_pad($v["persona"]->_get("numero_documento"),8,"0",STR_PAD_LEFT);
    $codigo .= str_pad(substr($v["persona"]->_get("apellidos"),0,20),20," ",STR_PAD_LEFT);
    $codigo .= str_pad(substr($v["persona"]->_get("nombres"),0,20),20," ",STR_PAD_LEFT);
    return $codigo;
  }

  protected function codigoTramiteExcepcionalAj($v){
    $codigo = "010"; //3 1..3 empresa (ministerio publico 010)
    $codigo .= $v["persona"]->_get("legajo"); //6 4..9 legajo
    $codigo .= "80"; //2 10..11 registro
    $codigo .= "163"; //3 12..14 concepto (moreno 156)
    $codigo .= "2"; //1 15 subconcepto (para aj es 2)
    $codigo .= "00000"; //5 16..20 ceros
    $codigo .= "  "; //2 21..22 orden/secuencia 
    /**
     * numero que se utiliza para identificar 
     * que un agente posee mas de un descuento 
     * para el mismo concepto, subconcepto, fecha de proceso y entidad
     * ej 01, 02, etc
     */
    $codigo .= "0"; //1 23 completar con 0
    $codigo .= substr($v["tramite_excepcional"]->_get("desde", "y"),-1); //24 1 año desde
    $codigo .= $v["tramite_excepcional"]->_get("desde", "m"); //2 25..26 mes desde
    $codigo .= "0"; //1 27 completar con 0
    $codigo .= substr($v["tramite_excepcional"]->_get("hasta", "y"),-2); //24 1 año desde
    $codigo .= $v["tramite_excepcional"]->_get("hasta", "m"); //2 25..26 mes desde
    $codigo .= "00"; //2 32..33 completar con 0
    $codigo .= str_pad(
      number_format(
        $v["tramite_excepcional"]->_get("monto"),2,"",""
      ),
      10,0,STR_PAD_LEFT
    ); //10 34..43 monto a descontar
    $codigo .= "            "; //12 44..55 blancos
    $codigo .= str_pad($v["sucursal"]->_get("descripcion"),15); //16 56..71 descripcion 
    return $codigo;
  }

  protected function detalle($v, $tipo){
    $c = $v["persona"]->_get("legajo", "Xx Yy") . " " 
    . $v["persona"]->_get("apellidos", "X") . ", ".$v["persona"]->_get("nombres", "Xx Yy") 
. " - " . $v["departamento_judicial"]->_get("codigo") . " " . $v["departamento_judicial"]->_get("nombre") . " - " . $v[$tipo]->_get("motivo");
    if($tipo == "afiliacion") $c .= " - " . $v["afiliacion"]->_get("codigo");
    return $c;
  }
  


}
