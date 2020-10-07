<?php
require_once("class/model/entityOptions/Value.php");

class _DepartamentoJudicialValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $codigo = UNDEFINED;
  protected $nombre = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultCodigo() { if($this->codigo === UNDEFINED) $this->setCodigo(null); }
  public function setDefaultNombre() { if($this->nombre === UNDEFINED) $this->setNombre(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyCodigo() { if(!Validation::is_empty($this->codigo)) return false; }
  public function isEmptyNombre() { if(!Validation::is_empty($this->nombre)) return false; }

  public function id() { return $this->id; }
  public function codigo($format = null) { return Format::convertCase($this->codigo, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setCodigo(string $p = null) { return $this->codigo = $p; }  
  public function setCodigo($p) { return $this->codigo = (is_null($p)) ? null : (string)$p; }

  public function _setNombre(string $p = null) { return $this->nombre = $p; }  
  public function setNombre($p) { return $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetCodigo() { if(!Validation::is_empty($this->codigo)) $this->codigo = preg_replace('/\s\s+/', ' ', trim($this->codigo)); }
  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkCodigo() { 
      $this->_logs->resetLogs("codigo");
      if(Validation::is_undefined($this->codigo)) return null;
      $v = Validation::getInstanceValue($this->codigo)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("codigo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNombre() { 
      $this->_logs->resetLogs("nombre");
      if(Validation::is_undefined($this->nombre)) return null;
      $v = Validation::getInstanceValue($this->nombre)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlCodigo() { return $this->sql->string($this->codigo); }
  public function sqlNombre() { return $this->sql->string($this->nombre); }

  public function jsonId() { return $this->id; }
  public function jsonCodigo() { return $this->codigo; }
  public function jsonNombre() { return $this->nombre; }



}
