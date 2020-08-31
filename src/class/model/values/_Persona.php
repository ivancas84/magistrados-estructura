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
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->nombres == UNDEFINED) $this->setNombres(null);
    if($this->apellidos == UNDEFINED) $this->setApellidos(null);
    if($this->legajo == UNDEFINED) $this->setLegajo(null);
    if($this->numeroDocumento == UNDEFINED) $this->setNumeroDocumento(null);
    if($this->telefonoLaboral == UNDEFINED) $this->setTelefonoLaboral(null);
    if($this->telefonoParticular == UNDEFINED) $this->setTelefonoParticular(null);
    if($this->fechaNacimiento == UNDEFINED) $this->setFechaNacimiento(null);
    if($this->email == UNDEFINED) $this->setEmail(null);
    if($this->creado == UNDEFINED) $this->setCreado(date('c'));
    if($this->eliminado == UNDEFINED) $this->setEliminado(null);
    if($this->cargo == UNDEFINED) $this->setCargo(null);
    if($this->organo == UNDEFINED) $this->setOrgano(null);
    if($this->departamentoJudicial == UNDEFINED) $this->setDepartamentoJudicial(null);
    if($this->departamentoJudicialInformado == UNDEFINED) $this->setDepartamentoJudicialInformado(null);
    if($this->tipoDocumento == UNDEFINED) $this->setTipoDocumento(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
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
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->nombres !== UNDEFINED) $row[$p."nombres"] = $this->nombres();
    if($this->apellidos !== UNDEFINED) $row[$p."apellidos"] = $this->apellidos();
    if($this->legajo !== UNDEFINED) $row[$p."legajo"] = $this->legajo();
    if($this->numeroDocumento !== UNDEFINED) $row[$p."numero_documento"] = $this->numeroDocumento();
    if($this->telefonoLaboral !== UNDEFINED) $row[$p."telefono_laboral"] = $this->telefonoLaboral();
    if($this->telefonoParticular !== UNDEFINED) $row[$p."telefono_particular"] = $this->telefonoParticular();
    if($this->fechaNacimiento !== UNDEFINED) $row[$p."fecha_nacimiento"] = $this->fechaNacimiento("c");
    if($this->email !== UNDEFINED) $row[$p."email"] = $this->email();
    if($this->creado !== UNDEFINED) $row[$p."creado"] = $this->creado("c");
    if($this->eliminado !== UNDEFINED) $row[$p."eliminado"] = $this->eliminado("c");
    if($this->cargo !== UNDEFINED) $row[$p."cargo"] = $this->cargo();
    if($this->organo !== UNDEFINED) $row[$p."organo"] = $this->organo();
    if($this->departamentoJudicial !== UNDEFINED) $row[$p."departamento_judicial"] = $this->departamentoJudicial();
    if($this->departamentoJudicialInformado !== UNDEFINED) $row[$p."departamento_judicial_informado"] = $this->departamentoJudicialInformado();
    if($this->tipoDocumento !== UNDEFINED) $row[$p."tipo_documento"] = $this->tipoDocumento();
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

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNombres(string $p = null) { return $this->nombres = $p; }  
  public function setNombres($p) { return $this->nombres = (is_null($p)) ? null : (string)$p; }

  public function _setApellidos(string $p = null) { return $this->apellidos = $p; }  
  public function setApellidos($p) { return $this->apellidos = (is_null($p)) ? null : (string)$p; }

  public function _setLegajo(string $p = null) { return $this->legajo = $p; }  
  public function setLegajo($p) { return $this->legajo = (is_null($p)) ? null : (string)$p; }

  public function _setNumeroDocumento(string $p = null) { return $this->numeroDocumento = $p; }  
  public function setNumeroDocumento($p) { return $this->numeroDocumento = (is_null($p)) ? null : (string)$p; }

  public function _setTelefonoLaboral(string $p = null) { return $this->telefonoLaboral = $p; }  
  public function setTelefonoLaboral($p) { return $this->telefonoLaboral = (is_null($p)) ? null : (string)$p; }

  public function _setTelefonoParticular(string $p = null) { return $this->telefonoParticular = $p; }  
  public function setTelefonoParticular($p) { return $this->telefonoParticular = (is_null($p)) ? null : (string)$p; }

  public function _setFechaNacimiento(DateTime $p = null) { return $this->fechaNacimiento = $p; }
  public function setFechaNacimiento($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) {
      $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    return $this->fechaNacimiento = $p;
  }

  public function _setEmail(string $p = null) { return $this->email = $p; }  
  public function setEmail($p) { return $this->email = (is_null($p)) ? null : (string)$p; }

  public function _setCreado(DateTime $p = null) { return $this->creado = $p; }  
  public function setCreado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->creado = $p;
  }

  public function _setEliminado(DateTime $p = null) { return $this->eliminado = $p; }  
  public function setEliminado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->eliminado = $p;
  }

  public function _setCargo(string $p = null) { return $this->cargo = $p; }  
  public function setCargo($p) { return $this->cargo = (is_null($p)) ? null : (string)$p; }

  public function _setOrgano(string $p = null) { return $this->organo = $p; }  
  public function setOrgano($p) { return $this->organo = (is_null($p)) ? null : (string)$p; }

  public function _setDepartamentoJudicial(string $p = null) { return $this->departamentoJudicial = $p; }  
  public function setDepartamentoJudicial($p) { return $this->departamentoJudicial = (is_null($p)) ? null : (string)$p; }

  public function _setDepartamentoJudicialInformado(string $p = null) { return $this->departamentoJudicialInformado = $p; }  
  public function setDepartamentoJudicialInformado($p) { return $this->departamentoJudicialInformado = (is_null($p)) ? null : (string)$p; }

  public function _setTipoDocumento(string $p = null) { return $this->tipoDocumento = $p; }  
  public function setTipoDocumento($p) { return $this->tipoDocumento = (is_null($p)) ? null : (string)$p; }


  public function resetNombres() { if(!Validation::is_empty($this->nombres)) $this->nombres = preg_replace('/\s\s+/', ' ', trim($this->nombres)); }
  public function resetApellidos() { if(!Validation::is_empty($this->apellidos)) $this->apellidos = preg_replace('/\s\s+/', ' ', trim($this->apellidos)); }
  public function resetLegajo() { if(!Validation::is_empty($this->legajo)) $this->legajo = preg_replace('/\s\s+/', ' ', trim($this->legajo)); }
  public function resetNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) $this->numeroDocumento = preg_replace('/\s\s+/', ' ', trim($this->numeroDocumento)); }
  public function resetTelefonoLaboral() { if(!Validation::is_empty($this->telefonoLaboral)) $this->telefonoLaboral = preg_replace('/\s\s+/', ' ', trim($this->telefonoLaboral)); }
  public function resetTelefonoParticular() { if(!Validation::is_empty($this->telefonoParticular)) $this->telefonoParticular = preg_replace('/\s\s+/', ' ', trim($this->telefonoParticular)); }
  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNombres($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkApellidos($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkLegajo($value) { 
    $this->_logs->resetLogs("legajo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("legajo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkNumeroDocumento($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTelefonoLaboral($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTelefonoParticular($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkFechaNacimiento($value) { 
    $this->_logs->resetLogs("fecha_nacimiento");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_nacimiento", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEmail($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCreado($value) { 
    $this->_logs->resetLogs("creado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEliminado($value) { 
    $this->_logs->resetLogs("eliminado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("eliminado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCargo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkOrgano($value) { 
    $this->_logs->resetLogs("organo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("organo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDepartamentoJudicial($value) { 
    $this->_logs->resetLogs("departamento_judicial");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("departamento_judicial", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDepartamentoJudicialInformado($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTipoDocumento($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNombres($this->nombres);
    $this->checkApellidos($this->apellidos);
    $this->checkLegajo($this->legajo);
    $this->checkNumeroDocumento($this->numeroDocumento);
    $this->checkTelefonoLaboral($this->telefonoLaboral);
    $this->checkTelefonoParticular($this->telefonoParticular);
    $this->checkFechaNacimiento($this->fechaNacimiento);
    $this->checkEmail($this->email);
    $this->checkCreado($this->creado);
    $this->checkEliminado($this->eliminado);
    $this->checkCargo($this->cargo);
    $this->checkOrgano($this->organo);
    $this->checkDepartamentoJudicial($this->departamentoJudicial);
    $this->checkDepartamentoJudicialInformado($this->departamentoJudicialInformado);
    $this->checkTipoDocumento($this->tipoDocumento);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNombres();
    $this->resetApellidos();
    $this->resetLegajo();
    $this->resetNumeroDocumento();
    $this->resetTelefonoLaboral();
    $this->resetTelefonoParticular();
    $this->resetEmail();
    return $this;
  }



}
