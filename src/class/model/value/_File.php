<?php
require_once("class/model/entityOptions/Value.php");

class _FileValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $name = UNDEFINED;
  protected $type = UNDEFINED;
  protected $content = UNDEFINED;
  protected $size = UNDEFINED;
  protected $created = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultName() { if($this->name === UNDEFINED) $this->setName(null); }
  public function setDefaultType() { if($this->type === UNDEFINED) $this->setType(null); }
  public function setDefaultContent() { if($this->content === UNDEFINED) $this->setContent(null); }
  public function setDefaultSize() { if($this->size === UNDEFINED) $this->setSize(null); }
  public function setDefaultCreated() { if($this->created === UNDEFINED) $this->setCreated(date('c')); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyName() { if(!Validation::is_empty($this->name)) return false; }
  public function isEmptyType() { if(!Validation::is_empty($this->type)) return false; }
  public function isEmptyContent() { if(!Validation::is_empty($this->content)) return false; }
  public function isEmptySize() { if(!Validation::is_empty($this->size)) return false; }
  public function isEmptyCreated() { if(!Validation::is_empty($this->created)) return false; }

  public function id() { return $this->id; }
  public function name($format = null) { return Format::convertCase($this->name, $format); }
  public function type($format = null) { return Format::convertCase($this->type, $format); }
  public function content($format = null) { return Format::convertCase($this->content, $format); }
  public function size() { return $this->size; }
  public function created($format = null) { return Format::date($this->created, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setName(string $p = null) { return $this->name = $p; }  
  public function setName($p) { return $this->name = (is_null($p)) ? null : (string)$p; }

  public function _setType(string $p = null) { return $this->type = $p; }  
  public function setType($p) { return $this->type = (is_null($p)) ? null : (string)$p; }

  public function _setContent(string $p = null) { return $this->content = $p; }  
  public function setContent($p) { return $this->content = (is_null($p)) ? null : (string)$p; }

  public function _setSize(integer $p = null) { return $this->size = $p; }    
  public function setSize($p) { return $this->size = (is_null($p)) ? null : intval($p); }

  public function _setCreated(DateTime $p = null) { return $this->created = $p; }  

  public function setCreated($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->created = $p;
  }

  public function setCreatedY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->created = $p;
  }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetName() { if(!Validation::is_empty($this->name)) $this->name = preg_replace('/\s\s+/', ' ', trim($this->name)); }
  public function resetType() { if(!Validation::is_empty($this->type)) $this->type = preg_replace('/\s\s+/', ' ', trim($this->type)); }
  public function resetContent() { if(!Validation::is_empty($this->content)) $this->content = preg_replace('/\s\s+/', ' ', trim($this->content)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkName() { 
      $this->_logs->resetLogs("name");
      if(Validation::is_undefined($this->name)) return null;
      $v = Validation::getInstanceValue($this->name)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("name", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkType() { 
      $this->_logs->resetLogs("type");
      if(Validation::is_undefined($this->type)) return null;
      $v = Validation::getInstanceValue($this->type)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("type", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkContent() { 
      $this->_logs->resetLogs("content");
      if(Validation::is_undefined($this->content)) return null;
      $v = Validation::getInstanceValue($this->content)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("content", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkSize() { 
      $this->_logs->resetLogs("size");
      if(Validation::is_undefined($this->size)) return null;
      $v = Validation::getInstanceValue($this->size)->required();
      foreach($v->getErrors() as $error){ $this->_logs->addLog("size", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCreated() { 
      $this->_logs->resetLogs("created");
      if(Validation::is_undefined($this->created)) return null;
      $v = Validation::getInstanceValue($this->created)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("created", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlName() { return $this->sql->string($this->name); }
  public function sqlType() { return $this->sql->string($this->type); }
  public function sqlContent() { return $this->sql->string($this->content); }
  public function sqlSize() { return $this->sql->Number($this->size); }
  public function sqlCreated() { return $this->sql->dateTime($this->created, "Y-m-d H:i:s"); }
  public function sqlCreatedDate() { return $this->sql->dateTime($this->created, "Y-m-d"); }
  public function sqlCreatedYm() { return $this->sql->dateTime($this->created, "Y-m"); }
  public function sqlCreatedY() { return $this->sql->dateTime($this->created, "Y"); }

  public function jsonId() { return $this->id; }
  public function jsonName() { return $this->name; }
  public function jsonType() { return $this->type; }
  public function jsonContent() { return $this->content; }
  public function jsonSize() { return $this->size; }
  public function jsonCreated() { return $this->created('c'); }



}
