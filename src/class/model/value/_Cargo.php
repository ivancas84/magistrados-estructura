<?php
require_once("class/model/entityOptions/Value.php");

class _CargoValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultDescripcion() { if($this->descripcion === UNDEFINED) $this->setDescripcion(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyDescripcion() { if(!Validation::is_empty($this->descripcion)) return false; }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setDescripcion(string $p = null) { return $this->descripcion = $p; }  
  public function setDescripcion($p) { return $this->descripcion = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetDescripcion() { if(!Validation::is_empty($this->descripcion)) $this->descripcion = preg_replace('/\s\s+/', ' ', trim($this->descripcion)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkDescripcion() { 
      $this->_logs->resetLogs("descripcion");
      if(Validation::is_undefined($this->descripcion)) return null;
      $v = Validation::getInstanceValue($this->descripcion)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("descripcion", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlDescripcion() { return $this->sql->string($this->descripcion); }

  public function jsonId() { return $this->id; }
  public function jsonDescripcion() { return $this->descripcion; }



}
