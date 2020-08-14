<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _DepartamentoJudicial extends EntityValues {
  protected $id = UNDEFINED;
  protected $codigo = UNDEFINED;
  protected $nombre = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->codigo == UNDEFINED) $this->setCodigo(null);
    if($this->nombre == UNDEFINED) $this->setNombre(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."codigo"])) $this->setCodigo($row[$p."codigo"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->codigo !== UNDEFINED) $row[$p."codigo"] = $this->codigo();
    if($this->nombre !== UNDEFINED) $row[$p."nombre"] = $this->nombre();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->codigo)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function codigo($format = null) { return Format::convertCase($this->codigo, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setCodigo($p) { $this->codigo = (is_null($p)) ? null : (string)$p; }
  public function setNombre($p) { $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function resetCodigo() { if(!Validation::is_empty($this->codigo)) $this->codigo = preg_replace('/\s\s+/', ' ', trim($this->codigo)); }
  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCodigo($value) { 
    $this->_logs->resetLogs("codigo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("codigo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkNombre($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkCodigo($this->codigo);
    $this->checkNombre($this->nombre);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetCodigo();
    $this->resetNombre();
    return $this;
  }



}
