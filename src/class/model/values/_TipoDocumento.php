<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _TipoDocumento extends EntityValues {
  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->descripcion == UNDEFINED) $this->setDescripcion(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->descripcion !== UNDEFINED) $row[$p."descripcion"] = $this->descripcion();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->descripcion)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }

  public function setDescripcion($p) { $this->descripcion = (is_null($p)) ? null : (string)$p; }

  public function checkId($value) { 
      return true; 
  }

  public function checkDescripcion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("descripcion", $v);
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkDescripcion($this->descripcion);
    return !$this->_getLogs()->isError();
  }



}
