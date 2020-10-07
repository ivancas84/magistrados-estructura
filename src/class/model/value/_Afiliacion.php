<?php
require_once("class/model/entityOptions/Value.php");

class _AfiliacionValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $motivo = UNDEFINED;
  protected $estado = UNDEFINED;
  protected $creado = UNDEFINED;
  protected $enviado = UNDEFINED;
  protected $evaluado = UNDEFINED;
  protected $modificado = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $persona = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultMotivo() { if($this->motivo === UNDEFINED) $this->setMotivo('Alta'); }
  public function setDefaultEstado() { if($this->estado === UNDEFINED) $this->setEstado('Creado'); }
  public function setDefaultCreado() { if($this->creado === UNDEFINED) $this->setCreado(date('c')); }
  public function setDefaultEnviado() { if($this->enviado === UNDEFINED) $this->setEnviado(null); }
  public function setDefaultEvaluado() { if($this->evaluado === UNDEFINED) $this->setEvaluado(null); }
  public function setDefaultModificado() { if($this->modificado === UNDEFINED) $this->setModificado(null); }
  public function setDefaultObservaciones() { if($this->observaciones === UNDEFINED) $this->setObservaciones(null); }
  public function setDefaultPersona() { if($this->persona === UNDEFINED) $this->setPersona(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyMotivo() { if(!Validation::is_empty($this->motivo)) return false; }
  public function isEmptyEstado() { if(!Validation::is_empty($this->estado)) return false; }
  public function isEmptyCreado() { if(!Validation::is_empty($this->creado)) return false; }
  public function isEmptyEnviado() { if(!Validation::is_empty($this->enviado)) return false; }
  public function isEmptyEvaluado() { if(!Validation::is_empty($this->evaluado)) return false; }
  public function isEmptyModificado() { if(!Validation::is_empty($this->modificado)) return false; }
  public function isEmptyObservaciones() { if(!Validation::is_empty($this->observaciones)) return false; }
  public function isEmptyPersona() { if(!Validation::is_empty($this->persona)) return false; }

  public function id() { return $this->id; }
  public function motivo($format = null) { return Format::convertCase($this->motivo, $format); }
  public function estado($format = null) { return Format::convertCase($this->estado, $format); }
  public function creado($format = null) { return Format::date($this->creado, $format); }
  public function enviado($format = null) { return Format::date($this->enviado, $format); }
  public function evaluado($format = null) { return Format::date($this->evaluado, $format); }
  public function modificado($format = null) { return Format::date($this->modificado, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setMotivo(string $p = null) { return $this->motivo = $p; }  
  public function setMotivo($p) { return $this->motivo = (is_null($p)) ? null : (string)$p; }

  public function _setEstado(string $p = null) { return $this->estado = $p; }  
  public function setEstado($p) { return $this->estado = (is_null($p)) ? null : (string)$p; }

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

  public function _setEnviado(DateTime $p = null) { return $this->enviado = $p; }  

  public function setEnviado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->enviado = $p;
  }

  public function setEnviadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->enviado = $p;
  }

  public function _setEvaluado(DateTime $p = null) { return $this->evaluado = $p; }  

  public function setEvaluado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->evaluado = $p;
  }

  public function setEvaluadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->evaluado = $p;
  }

  public function _setModificado(DateTime $p = null) { return $this->modificado = $p; }  

  public function setModificado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->modificado = $p;
  }

  public function setModificadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->modificado = $p;
  }

  public function _setObservaciones(string $p = null) { return $this->observaciones = $p; }  
  public function setObservaciones($p) { return $this->observaciones = (is_null($p)) ? null : (string)$p; }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetMotivo() { if(!Validation::is_empty($this->motivo)) $this->motivo = preg_replace('/\s\s+/', ' ', trim($this->motivo)); }
  public function resetEstado() { if(!Validation::is_empty($this->estado)) $this->estado = preg_replace('/\s\s+/', ' ', trim($this->estado)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }
  public function resetPersona() { if(!Validation::is_empty($this->persona)) $this->persona = preg_replace('/\s\s+/', ' ', trim($this->persona)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkMotivo() { 
      $this->_logs->resetLogs("motivo");
      if(Validation::is_undefined($this->motivo)) return null;
      $v = Validation::getInstanceValue($this->motivo)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("motivo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEstado() { 
      $this->_logs->resetLogs("estado");
      if(Validation::is_undefined($this->estado)) return null;
      $v = Validation::getInstanceValue($this->estado)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("estado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCreado() { 
      $this->_logs->resetLogs("creado");
      if(Validation::is_undefined($this->creado)) return null;
      $v = Validation::getInstanceValue($this->creado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEnviado() { 
      $this->_logs->resetLogs("enviado");
      if(Validation::is_undefined($this->enviado)) return null;
      $v = Validation::getInstanceValue($this->enviado)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("enviado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEvaluado() { 
      $this->_logs->resetLogs("evaluado");
      if(Validation::is_undefined($this->evaluado)) return null;
      $v = Validation::getInstanceValue($this->evaluado)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("evaluado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkModificado() { 
      $this->_logs->resetLogs("modificado");
      if(Validation::is_undefined($this->modificado)) return null;
      $v = Validation::getInstanceValue($this->modificado)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("modificado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkObservaciones() { 
      $this->_logs->resetLogs("observaciones");
      if(Validation::is_undefined($this->observaciones)) return null;
      $v = Validation::getInstanceValue($this->observaciones)->max(65535);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("observaciones", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPersona() { 
      $this->_logs->resetLogs("persona");
      if(Validation::is_undefined($this->persona)) return null;
      $v = Validation::getInstanceValue($this->persona)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlMotivo() { return $this->sql->string($this->motivo); }
  public function sqlEstado() { return $this->sql->string($this->estado); }
  public function sqlCreado() { return $this->sql->dateTime($this->creado, "Y-m-d H:i:s"); }
  public function sqlCreadoDate() { return $this->sql->dateTime($this->creado, "Y-m-d"); }
  public function sqlCreadoYm() { return $this->sql->dateTime($this->creado, "Y-m"); }
  public function sqlCreadoY() { return $this->sql->dateTime($this->creado, "Y"); }
  public function sqlEnviado() { return $this->sql->dateTime($this->enviado, "Y-m-d H:i:s"); }
  public function sqlEnviadoDate() { return $this->sql->dateTime($this->enviado, "Y-m-d"); }
  public function sqlEnviadoYm() { return $this->sql->dateTime($this->enviado, "Y-m"); }
  public function sqlEnviadoY() { return $this->sql->dateTime($this->enviado, "Y"); }
  public function sqlEvaluado() { return $this->sql->dateTime($this->evaluado, "Y-m-d H:i:s"); }
  public function sqlEvaluadoDate() { return $this->sql->dateTime($this->evaluado, "Y-m-d"); }
  public function sqlEvaluadoYm() { return $this->sql->dateTime($this->evaluado, "Y-m"); }
  public function sqlEvaluadoY() { return $this->sql->dateTime($this->evaluado, "Y"); }
  public function sqlModificado() { return $this->sql->dateTime($this->modificado, "Y-m-d H:i:s"); }
  public function sqlModificadoDate() { return $this->sql->dateTime($this->modificado, "Y-m-d"); }
  public function sqlModificadoYm() { return $this->sql->dateTime($this->modificado, "Y-m"); }
  public function sqlModificadoY() { return $this->sql->dateTime($this->modificado, "Y"); }
  public function sqlObservaciones() { return $this->sql->string($this->observaciones); }
  public function sqlPersona() { return $this->sql->string($this->persona); }

  public function jsonId() { return $this->id; }
  public function jsonMotivo() { return $this->motivo; }
  public function jsonEstado() { return $this->estado; }
  public function jsonCreado() { return $this->creado('c'); }
  public function jsonEnviado() { return $this->enviado('c'); }
  public function jsonEvaluado() { return $this->evaluado('c'); }
  public function jsonModificado() { return $this->modificado('c'); }
  public function jsonObservaciones() { return $this->observaciones; }
  public function jsonPersona() { return $this->persona; }



}
