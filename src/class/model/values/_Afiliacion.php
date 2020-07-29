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
    $this->setId(DEFAULT_VALUE);
    $this->setMotivo(DEFAULT_VALUE);
    $this->setEstado(DEFAULT_VALUE);
    $this->setCreado(DEFAULT_VALUE);
    $this->setEnviado(DEFAULT_VALUE);
    $this->setEvaluado(DEFAULT_VALUE);
    $this->setModificado(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
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
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->motivo !== UNDEFINED) $row["motivo"] = $this->motivo();
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado();
    if($this->creado !== UNDEFINED) $row["creado"] = $this->creado("Y-m-d H:i:s");
    if($this->enviado !== UNDEFINED) $row["enviado"] = $this->enviado("Y-m-d H:i:s");
    if($this->evaluado !== UNDEFINED) $row["evaluado"] = $this->evaluado("Y-m-d H:i:s");
    if($this->modificado !== UNDEFINED) $row["modificado"] = $this->modificado("Y-m-d H:i:s");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setMotivo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkMotivo($p); 
    if($check) $this->motivo = $p;
    return $check;
  }

  public function setEstado($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkEstado($p); 
    if($check) $this->estado = $p;
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

  public function _setEnviado(DateTime $p = null) {
      $check = $this->checkEnviado($p); 
      if($check) $this->enviado = $p;  
      return $check;
  }

  public function setEnviado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkEnviado($p); 
    if($check) $this->enviado = $p;  
    return $check;
  }

  public function _setEvaluado(DateTime $p = null) {
      $check = $this->checkEvaluado($p); 
      if($check) $this->evaluado = $p;  
      return $check;
  }

  public function setEvaluado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkEvaluado($p); 
    if($check) $this->evaluado = $p;  
    return $check;
  }

  public function _setModificado(DateTime $p = null) {
      $check = $this->checkModificado($p); 
      if($check) $this->modificado = $p;  
      return $check;
  }

  public function setModificado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkModificado($p); 
    if($check) $this->modificado = $p;  
    return $check;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkObservaciones($p); 
    if($check) $this->observaciones = $p;
    return $check;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPersona($p); 
    if($check) $this->persona = $p;
    return $check;
  }

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



}
