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
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->motivo == UNDEFINED) $this->setMotivo(null);
    if($this->estado == UNDEFINED) $this->setEstado(null);
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
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."motivo"])) $this->setMotivo($row[$p."motivo"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."creado"])) $this->setCreado($row[$p."creado"]);
    if(isset($row[$p."enviado"])) $this->setEnviado($row[$p."enviado"]);
    if(isset($row[$p."evaluado"])) $this->setEvaluado($row[$p."evaluado"]);
    if(isset($row[$p."modificado"])) $this->setModificado($row[$p."modificado"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
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

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }

  public function setMotivo($p) { $this->motivo = (is_null($p)) ? null : (string)$p; }

  public function setEstado($p) { $this->estado = (is_null($p)) ? null : (string)$p; }

  public function _setCreado(DateTime $p = null) { $this->creado = $p; }

  public function setCreado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->creado = $p;  
  }

  public function _setEnviado(DateTime $p = null) { $this->enviado = $p; }

  public function setEnviado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->enviado = $p;  
  }

  public function _setEvaluado(DateTime $p = null) { $this->evaluado = $p; }

  public function setEvaluado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->evaluado = $p;  
  }

  public function _setModificado(DateTime $p = null) { $this->modificado = $p; }

  public function setModificado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->modificado = $p;  
  }

  public function setObservaciones($p) { $this->observaciones = (is_null($p)) ? null : (string)$p; }

  public function setPersona($p) { $this->persona = (is_null($p)) ? null : (string)$p; }

  public function checkId($value) { 
      return true; 
  }

  public function checkMotivo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("motivo", $v);
  }

  public function checkEstado($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("estado", $v);
  }

  public function checkCreado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("creado", $v);
  }

  public function checkEnviado($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("enviado", $v);
  }

  public function checkEvaluado($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("evaluado", $v);
  }

  public function checkModificado($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("modificado", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("persona", $v);
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



}