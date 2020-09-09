<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Afiliacion extends EntityValues {
  protected $id = UNDEFINED;
  protected $motivo = UNDEFINED;
  protected $estado = UNDEFINED;
  protected $creado = UNDEFINED;
  protected $enviado = UNDEFINED;
  protected $evaluado = UNDEFINED;
  protected $modificado = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->motivo == UNDEFINED) $this->setMotivo('Alta');
    if($this->estado == UNDEFINED) $this->setEstado('Creado');
    if($this->creado == UNDEFINED) $this->setCreado(date('c'));
    if($this->enviado == UNDEFINED) $this->setEnviado(null);
    if($this->evaluado == UNDEFINED) $this->setEvaluado(null);
    if($this->modificado == UNDEFINED) $this->setModificado(null);
    if($this->observaciones == UNDEFINED) $this->setObservaciones(null);
    if($this->persona == UNDEFINED) $this->setPersona(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(key_exists($p."id", $row)) $this->setId($row[$p."id"]);
    if(key_exists($p."motivo", $row)) $this->setMotivo($row[$p."motivo"]);
    if(key_exists($p."estado", $row)) $this->setEstado($row[$p."estado"]);
    if(key_exists($p."creado", $row)) $this->setCreado($row[$p."creado"]);
    if(key_exists($p."enviado", $row)) $this->setEnviado($row[$p."enviado"]);
    if(key_exists($p."evaluado", $row)) $this->setEvaluado($row[$p."evaluado"]);
    if(key_exists($p."modificado", $row)) $this->setModificado($row[$p."modificado"]);
    if(key_exists($p."observaciones", $row)) $this->setObservaciones($row[$p."observaciones"]);
    if(key_exists($p."persona", $row)) $this->setPersona($row[$p."persona"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->motivo !== UNDEFINED) $row[$p."motivo"] = $this->motivo();
    if($this->estado !== UNDEFINED) $row[$p."estado"] = $this->estado();
    if($this->creado !== UNDEFINED) $row[$p."creado"] = $this->creado("c");
    if($this->enviado !== UNDEFINED) $row[$p."enviado"] = $this->enviado("c");
    if($this->evaluado !== UNDEFINED) $row[$p."evaluado"] = $this->evaluado("c");
    if($this->modificado !== UNDEFINED) $row[$p."modificado"] = $this->modificado("c");
    if($this->observaciones !== UNDEFINED) $row[$p."observaciones"] = $this->observaciones();
    if($this->persona !== UNDEFINED) $row[$p."persona"] = $this->persona();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->motivo)) return false;
    if(!Validation::is_empty($this->estado)) return false;
    if(!Validation::is_empty($this->creado)) return false;
    if(!Validation::is_empty($this->enviado)) return false;
    if(!Validation::is_empty($this->evaluado)) return false;
    if(!Validation::is_empty($this->modificado)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

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

  public function _setEnviado(DateTime $p = null) { return $this->enviado = $p; }  
  public function setEnviado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->enviado = $p;
  }

  public function _setEvaluado(DateTime $p = null) { return $this->evaluado = $p; }  
  public function setEvaluado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->evaluado = $p;
  }

  public function _setModificado(DateTime $p = null) { return $this->modificado = $p; }  
  public function setModificado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->modificado = $p;
  }

  public function _setObservaciones(string $p = null) { return $this->observaciones = $p; }  
  public function setObservaciones($p) { return $this->observaciones = (is_null($p)) ? null : (string)$p; }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }


  public function resetMotivo() { if(!Validation::is_empty($this->motivo)) $this->motivo = preg_replace('/\s\s+/', ' ', trim($this->motivo)); }
  public function resetEstado() { if(!Validation::is_empty($this->estado)) $this->estado = preg_replace('/\s\s+/', ' ', trim($this->estado)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkMotivo($value) { 
    $this->_logs->resetLogs("motivo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("motivo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEstado($value) { 
    $this->_logs->resetLogs("estado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("estado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCreado($value) { 
    $this->_logs->resetLogs("creado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEnviado($value) { 
    $this->_logs->resetLogs("enviado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("enviado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEvaluado($value) { 
    $this->_logs->resetLogs("evaluado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("evaluado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkModificado($value) { 
    $this->_logs->resetLogs("modificado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("modificado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkObservaciones($value) { 
    $this->_logs->resetLogs("observaciones");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(65535);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("observaciones", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPersona($value) { 
    $this->_logs->resetLogs("persona");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkMotivo($this->motivo);
    $this->checkEstado($this->estado);
    $this->checkCreado($this->creado);
    $this->checkEnviado($this->enviado);
    $this->checkEvaluado($this->evaluado);
    $this->checkModificado($this->modificado);
    $this->checkObservaciones($this->observaciones);
    $this->checkPersona($this->persona);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetMotivo();
    $this->resetEstado();
    $this->resetObservaciones();
    return $this;
  }



}
