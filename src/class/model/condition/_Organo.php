<?php
require_once("class/model/entityOptions/Condition.php");

class _OrganoCondition extends ConditionEntityOptions{

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

  public function descripcion($option, $value) { 
    $field = $this->mapping->descripcion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDescripcion($value);
    if(!$this->value->checkDescripcion()) throw new Exception("Valor incorrecto: Descripcion");
    return "({$field} {$option} {$this->value->sqlDescripcion()})";  
  }

  public function descripcionIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->descripcion(), $option, settypebool($value));
  }




}
