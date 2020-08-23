<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _File extends EntityValues {
  protected $id = UNDEFINED;
  protected $name = UNDEFINED;
  protected $type = UNDEFINED;
  protected $content = UNDEFINED;
  protected $size = UNDEFINED;
  protected $created = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->name == UNDEFINED) $this->setName(null);
    if($this->type == UNDEFINED) $this->setType(null);
    if($this->content == UNDEFINED) $this->setContent(null);
    if($this->size == UNDEFINED) $this->setSize(null);
    if($this->created == UNDEFINED) $this->setCreated(date('c'));
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."name"])) $this->setName($row[$p."name"]);
    if(isset($row[$p."type"])) $this->setType($row[$p."type"]);
    if(isset($row[$p."content"])) $this->setContent($row[$p."content"]);
    if(isset($row[$p."size"])) $this->setSize($row[$p."size"]);
    if(isset($row[$p."created"])) $this->setCreated($row[$p."created"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->name !== UNDEFINED) $row[$p."name"] = $this->name();
    if($this->type !== UNDEFINED) $row[$p."type"] = $this->type();
    if($this->content !== UNDEFINED) $row[$p."content"] = $this->content();
    if($this->size !== UNDEFINED) $row[$p."size"] = $this->size();
    if($this->created !== UNDEFINED) $row[$p."created"] = $this->created("c");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->name)) return false;
    if(!Validation::is_empty($this->type)) return false;
    if(!Validation::is_empty($this->content)) return false;
    if(!Validation::is_empty($this->size)) return false;
    if(!Validation::is_empty($this->created)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function name($format = null) { return Format::convertCase($this->name, $format); }
  public function type($format = null) { return Format::convertCase($this->type, $format); }
  public function content($format = null) { return Format::convertCase($this->content, $format); }
  public function size() { return $this->size; }
  public function created($format = null) { return Format::date($this->created, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setName($p) { $this->name = (is_null($p)) ? null : (string)$p; }
  public function setType($p) { $this->type = (is_null($p)) ? null : (string)$p; }
  public function setContent($p) { $this->content = (is_null($p)) ? null : (string)$p; }
  public function setSize($p) { $this->size = (is_null($p)) ? null : intval($p); }
  public function _setCreated(DateTime $p = null) { $this->created = $p; }

  public function setCreated($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->created = $p;  
  }


  public function resetName() { if(!Validation::is_empty($this->name)) $this->name = preg_replace('/\s\s+/', ' ', trim($this->name)); }
  public function resetType() { if(!Validation::is_empty($this->type)) $this->type = preg_replace('/\s\s+/', ' ', trim($this->type)); }
  public function resetContent() { if(!Validation::is_empty($this->content)) $this->content = preg_replace('/\s\s+/', ' ', trim($this->content)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkName($value) { 
    $this->_logs->resetLogs("name");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("name", "error", $error); }
    return $v->isSuccess();
  }

  public function checkType($value) { 
    $this->_logs->resetLogs("type");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("type", "error", $error); }
    return $v->isSuccess();
  }

  public function checkContent($value) { 
    $this->_logs->resetLogs("content");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("content", "error", $error); }
    return $v->isSuccess();
  }

  public function checkSize($value) { 
    $this->_logs->resetLogs("size");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("size", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCreated($value) { 
    $this->_logs->resetLogs("created");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("created", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkName($this->name);
    $this->checkType($this->type);
    $this->checkContent($this->content);
    $this->checkSize($this->size);
    $this->checkCreated($this->created);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetName();
    $this->resetType();
    $this->resetContent();
    return $this;
  }



}
