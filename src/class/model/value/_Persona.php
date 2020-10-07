<?php
require_once("class/model/entityOptions/Value.php");

class _PersonaValue extends ValueEntityOptions{

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

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNombres() { if($this->nombres === UNDEFINED) $this->setNombres(null); }
  public function setDefaultApellidos() { if($this->apellidos === UNDEFINED) $this->setApellidos(null); }
  public function setDefaultLegajo() { if($this->legajo === UNDEFINED) $this->setLegajo(null); }
  public function setDefaultNumeroDocumento() { if($this->numeroDocumento === UNDEFINED) $this->setNumeroDocumento(null); }
  public function setDefaultTelefonoLaboral() { if($this->telefonoLaboral === UNDEFINED) $this->setTelefonoLaboral(null); }
  public function setDefaultTelefonoParticular() { if($this->telefonoParticular === UNDEFINED) $this->setTelefonoParticular(null); }
  public function setDefaultFechaNacimiento() { if($this->fechaNacimiento === UNDEFINED) $this->setFechaNacimiento(null); }
  public function setDefaultEmail() { if($this->email === UNDEFINED) $this->setEmail(null); }
  public function setDefaultCreado() { if($this->creado === UNDEFINED) $this->setCreado(date('c')); }
  public function setDefaultEliminado() { if($this->eliminado === UNDEFINED) $this->setEliminado(null); }
  public function setDefaultCargo() { if($this->cargo === UNDEFINED) $this->setCargo(null); }
  public function setDefaultOrgano() { if($this->organo === UNDEFINED) $this->setOrgano(null); }
  public function setDefaultDepartamentoJudicial() { if($this->departamentoJudicial === UNDEFINED) $this->setDepartamentoJudicial(null); }
  public function setDefaultDepartamentoJudicialInformado() { if($this->departamentoJudicialInformado === UNDEFINED) $this->setDepartamentoJudicialInformado(null); }
  public function setDefaultTipoDocumento() { if($this->tipoDocumento === UNDEFINED) $this->setTipoDocumento(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNombres() { if(!Validation::is_empty($this->nombres)) return false; }
  public function isEmptyApellidos() { if(!Validation::is_empty($this->apellidos)) return false; }
  public function isEmptyLegajo() { if(!Validation::is_empty($this->legajo)) return false; }
  public function isEmptyNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) return false; }
  public function isEmptyTelefonoLaboral() { if(!Validation::is_empty($this->telefonoLaboral)) return false; }
  public function isEmptyTelefonoParticular() { if(!Validation::is_empty($this->telefonoParticular)) return false; }
  public function isEmptyFechaNacimiento() { if(!Validation::is_empty($this->fechaNacimiento)) return false; }
  public function isEmptyEmail() { if(!Validation::is_empty($this->email)) return false; }
  public function isEmptyCreado() { if(!Validation::is_empty($this->creado)) return false; }
  public function isEmptyEliminado() { if(!Validation::is_empty($this->eliminado)) return false; }
  public function isEmptyCargo() { if(!Validation::is_empty($this->cargo)) return false; }
  public function isEmptyOrgano() { if(!Validation::is_empty($this->organo)) return false; }
  public function isEmptyDepartamentoJudicial() { if(!Validation::is_empty($this->departamentoJudicial)) return false; }
  public function isEmptyDepartamentoJudicialInformado() { if(!Validation::is_empty($this->departamentoJudicialInformado)) return false; }
  public function isEmptyTipoDocumento() { if(!Validation::is_empty($this->tipoDocumento)) return false; }

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
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaNacimiento = $p;
  }

  public function setFechaNacimientoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
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

  public function setCreadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->creado = $p;
  }

  public function _setEliminado(DateTime $p = null) { return $this->eliminado = $p; }  

  public function setEliminado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->eliminado = $p;
  }

  public function setEliminadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
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

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetNombres() { if(!Validation::is_empty($this->nombres)) $this->nombres = preg_replace('/\s\s+/', ' ', trim($this->nombres)); }
  public function resetApellidos() { if(!Validation::is_empty($this->apellidos)) $this->apellidos = preg_replace('/\s\s+/', ' ', trim($this->apellidos)); }
  public function resetLegajo() { if(!Validation::is_empty($this->legajo)) $this->legajo = preg_replace('/\s\s+/', ' ', trim($this->legajo)); }
  public function resetNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) $this->numeroDocumento = preg_replace('/\s\s+/', ' ', trim($this->numeroDocumento)); }
  public function resetTelefonoLaboral() { if(!Validation::is_empty($this->telefonoLaboral)) $this->telefonoLaboral = preg_replace('/\s\s+/', ' ', trim($this->telefonoLaboral)); }
  public function resetTelefonoParticular() { if(!Validation::is_empty($this->telefonoParticular)) $this->telefonoParticular = preg_replace('/\s\s+/', ' ', trim($this->telefonoParticular)); }
  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }
  public function resetCargo() { if(!Validation::is_empty($this->cargo)) $this->cargo = preg_replace('/\s\s+/', ' ', trim($this->cargo)); }
  public function resetOrgano() { if(!Validation::is_empty($this->organo)) $this->organo = preg_replace('/\s\s+/', ' ', trim($this->organo)); }
  public function resetDepartamentoJudicial() { if(!Validation::is_empty($this->departamentoJudicial)) $this->departamentoJudicial = preg_replace('/\s\s+/', ' ', trim($this->departamentoJudicial)); }
  public function resetDepartamentoJudicialInformado() { if(!Validation::is_empty($this->departamentoJudicialInformado)) $this->departamentoJudicialInformado = preg_replace('/\s\s+/', ' ', trim($this->departamentoJudicialInformado)); }
  public function resetTipoDocumento() { if(!Validation::is_empty($this->tipoDocumento)) $this->tipoDocumento = preg_replace('/\s\s+/', ' ', trim($this->tipoDocumento)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNombres() { 
      $this->_logs->resetLogs("nombres");
      if(Validation::is_undefined($this->nombres)) return null;
      $v = Validation::getInstanceValue($this->nombres)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("nombres", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkApellidos() { 
      $this->_logs->resetLogs("apellidos");
      if(Validation::is_undefined($this->apellidos)) return null;
      $v = Validation::getInstanceValue($this->apellidos)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("apellidos", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkLegajo() { 
      $this->_logs->resetLogs("legajo");
      if(Validation::is_undefined($this->legajo)) return null;
      $v = Validation::getInstanceValue($this->legajo)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("legajo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNumeroDocumento() { 
      $this->_logs->resetLogs("numero_documento");
      if(Validation::is_undefined($this->numeroDocumento)) return null;
      $v = Validation::getInstanceValue($this->numeroDocumento)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero_documento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTelefonoLaboral() { 
      $this->_logs->resetLogs("telefono_laboral");
      if(Validation::is_undefined($this->telefonoLaboral)) return null;
      $v = Validation::getInstanceValue($this->telefonoLaboral)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("telefono_laboral", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTelefonoParticular() { 
      $this->_logs->resetLogs("telefono_particular");
      if(Validation::is_undefined($this->telefonoParticular)) return null;
      $v = Validation::getInstanceValue($this->telefonoParticular)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("telefono_particular", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkFechaNacimiento() { 
      $this->_logs->resetLogs("fecha_nacimiento");
      if(Validation::is_undefined($this->fechaNacimiento)) return null;
      $v = Validation::getInstanceValue($this->fechaNacimiento)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_nacimiento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEmail() { 
      $this->_logs->resetLogs("email");
      if(Validation::is_undefined($this->email)) return null;
      $v = Validation::getInstanceValue($this->email)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("email", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCreado() { 
      $this->_logs->resetLogs("creado");
      if(Validation::is_undefined($this->creado)) return null;
      $v = Validation::getInstanceValue($this->creado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEliminado() { 
      $this->_logs->resetLogs("eliminado");
      if(Validation::is_undefined($this->eliminado)) return null;
      $v = Validation::getInstanceValue($this->eliminado)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("eliminado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCargo() { 
      $this->_logs->resetLogs("cargo");
      if(Validation::is_undefined($this->cargo)) return null;
      $v = Validation::getInstanceValue($this->cargo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("cargo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkOrgano() { 
      $this->_logs->resetLogs("organo");
      if(Validation::is_undefined($this->organo)) return null;
      $v = Validation::getInstanceValue($this->organo)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("organo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDepartamentoJudicial() { 
      $this->_logs->resetLogs("departamento_judicial");
      if(Validation::is_undefined($this->departamentoJudicial)) return null;
      $v = Validation::getInstanceValue($this->departamentoJudicial)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("departamento_judicial", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDepartamentoJudicialInformado() { 
      $this->_logs->resetLogs("departamento_judicial_informado");
      if(Validation::is_undefined($this->departamentoJudicialInformado)) return null;
      $v = Validation::getInstanceValue($this->departamentoJudicialInformado)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("departamento_judicial_informado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTipoDocumento() { 
      $this->_logs->resetLogs("tipo_documento");
      if(Validation::is_undefined($this->tipoDocumento)) return null;
      $v = Validation::getInstanceValue($this->tipoDocumento)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("tipo_documento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlNombres() { return $this->sql->string($this->nombres); }
  public function sqlApellidos() { return $this->sql->string($this->apellidos); }
  public function sqlLegajo() { return $this->sql->string($this->legajo); }
  public function sqlNumeroDocumento() { return $this->sql->string($this->numeroDocumento); }
  public function sqlTelefonoLaboral() { return $this->sql->string($this->telefonoLaboral); }
  public function sqlTelefonoParticular() { return $this->sql->string($this->telefonoParticular); }
  public function sqlFechaNacimiento() { return $this->sql->dateTime($this->fechaNacimiento, "Y-m-d"); }
  public function sqlFechaNacimientoYm() { return $this->sql->dateTime($this->fechaNacimiento, "Y-m"); }
  public function sqlFechaNacimientoY() { return $this->sql->dateTime($this->fechaNacimiento, "Y"); }
  public function sqlEmail() { return $this->sql->string($this->email); }
  public function sqlCreado() { return $this->sql->dateTime($this->creado, "Y-m-d H:i:s"); }
  public function sqlCreadoDate() { return $this->sql->dateTime($this->creado, "Y-m-d"); }
  public function sqlCreadoYm() { return $this->sql->dateTime($this->creado, "Y-m"); }
  public function sqlCreadoY() { return $this->sql->dateTime($this->creado, "Y"); }
  public function sqlEliminado() { return $this->sql->dateTime($this->eliminado, "Y-m-d H:i:s"); }
  public function sqlEliminadoDate() { return $this->sql->dateTime($this->eliminado, "Y-m-d"); }
  public function sqlEliminadoYm() { return $this->sql->dateTime($this->eliminado, "Y-m"); }
  public function sqlEliminadoY() { return $this->sql->dateTime($this->eliminado, "Y"); }
  public function sqlCargo() { return $this->sql->string($this->cargo); }
  public function sqlOrgano() { return $this->sql->string($this->organo); }
  public function sqlDepartamentoJudicial() { return $this->sql->string($this->departamentoJudicial); }
  public function sqlDepartamentoJudicialInformado() { return $this->sql->string($this->departamentoJudicialInformado); }
  public function sqlTipoDocumento() { return $this->sql->string($this->tipoDocumento); }

  public function jsonId() { return $this->id; }
  public function jsonNombres() { return $this->nombres; }
  public function jsonApellidos() { return $this->apellidos; }
  public function jsonLegajo() { return $this->legajo; }
  public function jsonNumeroDocumento() { return $this->numeroDocumento; }
  public function jsonTelefonoLaboral() { return $this->telefonoLaboral; }
  public function jsonTelefonoParticular() { return $this->telefonoParticular; }
  public function jsonFechaNacimiento() { return $this->fechaNacimiento('c'); }
  public function jsonEmail() { return $this->email; }
  public function jsonCreado() { return $this->creado('c'); }
  public function jsonEliminado() { return $this->eliminado('c'); }
  public function jsonCargo() { return $this->cargo; }
  public function jsonOrgano() { return $this->organo; }
  public function jsonDepartamentoJudicial() { return $this->departamentoJudicial; }
  public function jsonDepartamentoJudicialInformado() { return $this->departamentoJudicialInformado; }
  public function jsonTipoDocumento() { return $this->tipoDocumento; }



}
