<?php
require_once("class/model/entityOptions/Condition.php");

class _FileCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->id(), $option, settypebool($value));
  }

  public function name($option, $value) { 
    $field = $this->mapping->name();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setName($value);
    if(!$this->value->checkName()) throw new Exception("Valor incorrecto: Name");
    return "({$field} {$option} {$this->value->sqlName()})";  
  }

  public function nameIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->name(), $option, settypebool($value));
  }

  public function type($option, $value) { 
    $field = $this->mapping->type();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setType($value);
    if(!$this->value->checkType()) throw new Exception("Valor incorrecto: Type");
    return "({$field} {$option} {$this->value->sqlType()})";  
  }

  public function typeIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->type(), $option, settypebool($value));
  }

  public function content($option, $value) { 
    $field = $this->mapping->content();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setContent($value);
    if(!$this->value->checkContent()) throw new Exception("Valor incorrecto: Content");
    return "({$field} {$option} {$this->value->sqlContent()})";  
  }

  public function contentIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->content(), $option, settypebool($value));
  }

  public function size($option, $value) { 
    $field = $this->mapping->size();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setSize($value);
    if(!$this->value->checkSize()) throw new Exception("Valor incorrecto: Size ");
    return "({$field} {$option} {$this->value->sqlSize()})";  
  }

    public function sizeIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->size(), $option, settypebool($value));
  }

  public function created($option, $value) { 
    $field = $this->mapping->created();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreated($value);
    if(!$this->value->checkCreated()) throw new Exception("Valor incorrecto: Created ");
    return "({$field} {$option} {$this->value->sqlCreated()})";  
  }

  public function createdDate($option, $value) { 
    $field = $this->mapping->createdDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreated($value);
    if(!$this->value->checkCreated()) throw new Exception("Valor incorrecto: Created Date");
    return "({$field} {$option} {$this->value->sqlCreatedDate()})";  
  }

  public function createdYm($option, $value) { 
    $field = $this->mapping->createdYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreated($value);
    if(!$this->value->checkCreated()) throw new Exception("Valor incorrecto: Created Ym");
    return "({$field} {$option} {$this->value->sqlCreatedYm()})";  
  }

  public function createdY($option, $value) { 
    $field = $this->mapping->createdY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreatedY($value);
    if(!$this->value->checkCreated()) throw new Exception("Valor incorrecto: Created Y");
    return "({$field} {$option} {$this->value->sqlCreatedY()})";  
  }

  public function createdIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->created(), $option, settypebool($value));
  }




}
