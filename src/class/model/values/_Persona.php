<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Persona extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombres = UNDEFINED;
  protected $apellidos = UNDEFINED;
  protected $legajo = UNDEFINED;
  protected $numeroDocumento = UNDEFINED;
  protected $telefonoLaboral = UNDEFINED;
  protected $telefonoParticular = UNDEFINED;
  protected $fechaNacimiento = UNDEFINED;
  protected $email = UNDEFINED;
  protected $creado = UNDEFINED;
  protected $eliminado = UNDEFINED;
  protected $cargo = UNDEFINED;
  protected $organo = UNDEFINED;
  protected $departamentoJudicial = UNDEFINED;
  protected $departamentoJudicialInformado = UNDEFINED;
  protected $tipoDocumento = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombres(DEFAULT_VALUE);
    $this->setApellidos(DEFAULT_VALUE);
    $this->setLegajo(DEFAULT_VALUE);
    $this->setNumeroDocumento(DEFAULT_VALUE);
    $this->setTelefonoLaboral(DEFAULT_VALUE);
    $this->setTelefonoParticular(DEFAULT_VALUE);
    $this->setFechaNacimiento(DEFAULT_VALUE);
    $this->setEmail(DEFAULT_VALUE);
    $this->setCreado(DEFAULT_VALUE);
    $this->setEliminado(DEFAULT_VALUE);
    $this->setCargo(DEFAULT_VALUE);
    $this->setOrgano(DEFAULT_VALUE);
    $this->setDepartamentoJudicial(DEFAULT_VALUE);
    $this->setDepartamentoJudicialInformado(DEFAULT_VALUE);
    $this->setTipoDocumento(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."legajo"])) $this->setLegajo($row[$p."legajo"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."telefono_laboral"])) $this->setTelefonoLaboral($row[$p."telefono_laboral"]);
    if(isset($row[$p."telefono_particular"])) $this->setTelefonoParticular($row[$p."telefono_particular"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimiento($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."creado"])) $this->setCreado($row[$p."creado"]);
    if(isset($row[$p."eliminado"])) $this->setEliminado($row[$p."eliminado"]);
    if(isset($row[$p."cargo"])) $this->setCargo($row[$p."cargo"]);
    if(isset($row[$p."organo"])) $this->setOrgano($row[$p."organo"]);
    if(isset($row[$p."departamento_judicial"])) $this->setDepartamentoJudicial($row[$p."departamento_judicial"]);
    if(isset($row[$p."departamento_judicial_informado"])) $this->setDepartamentoJudicialInformado($row[$p."departamento_judicial_informado"]);
    if(isset($row[$p."tipo_documento"])) $this->setTipoDocumento($row[$p."tipo_documento"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nombres !== UNDEFINED) $row["nombres"] = $this->nombres();
    if($this->apellidos !== UNDEFINED) $row["apellidos"] = $this->apellidos();
    if($this->legajo !== UNDEFINED) $row["legajo"] = $this->legajo();
    if($this->numeroDocumento !== UNDEFINED) $row["numero_documento"] = $this->numeroDocumento();
    if($this->telefonoLaboral !== UNDEFINED) $row["telefono_laboral"] = $this->telefonoLaboral();
    if($this->telefonoParticular !== UNDEFINED) $row["telefono_particular"] = $this->telefonoParticular();
    if($this->fechaNacimiento !== UNDEFINED) $row["fecha_nacimiento"] = $this->fechaNacimiento("Y-m-d");
    if($this->email !== UNDEFINED) $row["email"] = $this->email();
    if($this->creado !== UNDEFINED) $row["creado"] = $this->creado("Y-m-d H:i:s");
    if($this->eliminado !== UNDEFINED) $row["eliminado"] = $this->eliminado("Y-m-d H:i:s");
    if($this->cargo !== UNDEFINED) $row["cargo"] = $this->cargo();
    if($this->organo !== UNDEFINED) $row["organo"] = $this->organo();
    if($this->departamentoJudicial !== UNDEFINED) $row["departamento_judicial"] = $this->departamentoJudicial();
    if($this->departamentoJudicialInformado !== UNDEFINED) $row["departamento_judicial_informado"] = $this->departamentoJudicialInformado();
    if($this->tipoDocumento !== UNDEFINED) $row["tipo_documento"] = $this->tipoDocumento();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nombres)) return false;
    if(!Validation::is_empty($this->apellidos)) return false;
    if(!Validation::is_empty($this->legajo)) return false;
    if(!Validation::is_empty($this->numeroDocumento)) return false;
    if(!Validation::is_empty($this->telefonoLaboral)) return false;
    if(!Validation::is_empty($this->telefonoParticular)) return false;
    if(!Validation::is_empty($this->fechaNacimiento)) return false;
    if(!Validation::is_empty($this->email)) return false;
    if(!Validation::is_empty($this->creado)) return false;
    if(!Validation::is_empty($this->eliminado)) return false;
    if(!Validation::is_empty($this->cargo)) return false;
    if(!Validation::is_empty($this->organo)) return false;
    if(!Validation::is_empty($this->departamentoJudicial)) return false;
    if(!Validation::is_empty($this->departamentoJudicialInformado)) return false;
    if(!Validation::is_empty($this->tipoDocumento)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nombres($format = null) { return Format::convertCase($this->nombres, $format); }
  public function apellidos($format = null) { return Format::convertCase($this->apellidos, $format); }
  public function legajo($format = null) { return Format::convertCase($this->legajo, $format); }
  public function numeroDocumento($format = null) { return Format::convertCase($this->numeroDocumento, $format); }
  public function telefonoLaboral($format = null) { return Format::convertCase($this->telefonoLaboral, $format); }
  public function telefonoParticular($format = null) { return Format::convertCase($this->telefonoParticular, $format); }
  public function fechaNacimiento($format = null) { return Format::date($this->fechaNacimiento, $format); }
  public function email($format = null) { return Format::convertCase($this->email, $format); }
  public function creado($format = null) { return Format::date($this->creado, $format); }
  public function eliminado($format = null) { return Format::date($this->eliminado, $format); }
  public function cargo($format = null) { return Format::convertCase($this->cargo, $format); }
  public function organo($format = null) { return Format::convertCase($this->organo, $format); }
  public function departamentoJudicial($format = null) { return Format::convertCase($this->departamentoJudicial, $format); }
  public function departamentoJudicialInformado($format = null) { return Format::convertCase($this->departamentoJudicialInformado, $format); }
  public function tipoDocumento($format = null) { return Format::convertCase($this->tipoDocumento, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setNombres($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNombres($p); 
    if($check) $this->nombres = $p;
    return $check;
  }

  public function setApellidos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkApellidos($p); 
    if($check) $this->apellidos = $p;
    return $check;
  }

  public function setLegajo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkLegajo($p); 
    if($check) $this->legajo = $p;
    return $check;
  }

  public function setNumeroDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNumeroDocumento($p); 
    if($check) $this->numeroDocumento = $p;
    return $check;
  }

  public function setTelefonoLaboral($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTelefonoLaboral($p); 
    if($check) $this->telefonoLaboral = $p;
    return $check;
  }

  public function setTelefonoParticular($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTelefonoParticular($p); 
    if($check) $this->telefonoParticular = $p;
    return $check;
  }

  public function _setFechaNacimiento(DateTime $p = null) {
      $check = $this->checkFechaNacimiento($p); 
      if($check) $this->fechaNacimiento = $p;  
      return $check;      
  }

  public function setFechaNacimiento($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaNacimiento($p); 
    if($check) $this->fechaNacimiento = $p;  
    return $check;
  }

  public function setEmail($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkEmail($p); 
    if($check) $this->email = $p;
    return $check;
  }

  public function _setCreado(DateTime $p = null) {
      $check = $this->checkCreado($p); 
      if($check) $this->creado = $p;  
      return $check;
  }

  public function setCreado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkCreado($p); 
    if($check) $this->creado = $p;  
    return $check;
  }

  public function _setEliminado(DateTime $p = null) {
      $check = $this->checkEliminado($p); 
      if($check) $this->eliminado = $p;  
      return $check;
  }

  public function setEliminado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkEliminado($p); 
    if($check) $this->eliminado = $p;  
    return $check;
  }

  public function setCargo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCargo($p); 
    if($check) $this->cargo = $p;
    return $check;
  }

  public function setOrgano($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkOrgano($p); 
    if($check) $this->organo = $p;
    return $check;
  }

  public function setDepartamentoJudicial($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDepartamentoJudicial($p); 
    if($check) $this->departamentoJudicial = $p;
    return $check;
  }

  public function setDepartamentoJudicialInformado($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDepartamentoJudicialInformado($p); 
    if($check) $this->departamentoJudicialInformado = $p;
    return $check;
  }

  public function setTipoDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTipoDocumento($p); 
    if($check) $this->tipoDocumento = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNombres($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("nombres", $v);
  }

  public function checkApellidos($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("apellidos", $v);
  }

  public function checkLegajo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("legajo", $v);
  }

  public function checkNumeroDocumento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero_documento", $v);
  }

  public function checkTelefonoLaboral($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("telefono_laboral", $v);
  }

  public function checkTelefonoParticular($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("telefono_particular", $v);
  }

  public function checkFechaNacimiento($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_nacimiento", $v);
  }

  public function checkEmail($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("email", $v);
  }

  public function checkCreado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("creado", $v);
  }

  public function checkEliminado($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("eliminado", $v);
  }

  public function checkCargo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("cargo", $v);
  }

  public function checkOrgano($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("organo", $v);
  }

  public function checkDepartamentoJudicial($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("departamento_judicial", $v);
  }

  public function checkDepartamentoJudicialInformado($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("departamento_judicial_informado", $v);
  }

  public function checkTipoDocumento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("tipo_documento", $v);
  }



}
