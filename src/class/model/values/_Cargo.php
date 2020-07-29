<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Cargo extends EntityValues {
  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setDescripcion(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->descripcion)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setDescripcion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDescripcion($p); 
    if($check) $this->descripcion = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkDescripcion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("descripcion", $v);
  }



}
