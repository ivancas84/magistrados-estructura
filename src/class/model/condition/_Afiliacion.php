<?php
require_once("class/model/entityOptions/Condition.php");

class _AfiliacionCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->_exists($this->mapping->id(), $option, settypebool($value));
  }

  public function motivo($option, $value) { 
    $field = $this->mapping->motivo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setMotivo($value);
    if(!$this->value->checkMotivo()) throw new Exception("Valor incorrecto: Motivo");
    return "({$field} {$option} {$this->value->sqlMotivo()})";  
  }

  public function motivoIsSet($option, $value) { 
    return $this->_exists($this->mapping->motivo(), $option, settypebool($value));
  }

  public function estado($option, $value) { 
    $field = $this->mapping->estado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setEstado($value);
    if(!$this->value->checkEstado()) throw new Exception("Valor incorrecto: Estado");
    return "({$field} {$option} {$this->value->sqlEstado()})";  
  }

  public function estadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->estado(), $option, settypebool($value));
  }

  public function creado($option, $value) { 
    $field = $this->mapping->creado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado ");
    return "({$field} {$option} {$this->value->sqlCreado()})";  
  }

  public function creadoDate($option, $value) { 
    $field = $this->mapping->creadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Date");
    return "({$field} {$option} {$this->value->sqlCreadoDate()})";  
  }

  public function creadoYm($option, $value) { 
    $field = $this->mapping->creadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Ym");
    return "({$field} {$option} {$this->value->sqlCreadoYm()})";  
  }

  public function creadoY($option, $value) { 
    $field = $this->mapping->creadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setCreadoY($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Y");
    return "({$field} {$option} {$this->value->sqlCreadoY()})";  
  }

  public function creadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->creado(), $option, settypebool($value));
  }

  public function enviado($option, $value) { 
    $field = $this->mapping->enviado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEnviado($value);
    if(!$this->value->checkEnviado()) throw new Exception("Valor incorrecto: Enviado ");
    return "({$field} {$option} {$this->value->sqlEnviado()})";  
  }

  public function enviadoDate($option, $value) { 
    $field = $this->mapping->enviadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEnviado($value);
    if(!$this->value->checkEnviado()) throw new Exception("Valor incorrecto: Enviado Date");
    return "({$field} {$option} {$this->value->sqlEnviadoDate()})";  
  }

  public function enviadoYm($option, $value) { 
    $field = $this->mapping->enviadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEnviado($value);
    if(!$this->value->checkEnviado()) throw new Exception("Valor incorrecto: Enviado Ym");
    return "({$field} {$option} {$this->value->sqlEnviadoYm()})";  
  }

  public function enviadoY($option, $value) { 
    $field = $this->mapping->enviadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEnviadoY($value);
    if(!$this->value->checkEnviado()) throw new Exception("Valor incorrecto: Enviado Y");
    return "({$field} {$option} {$this->value->sqlEnviadoY()})";  
  }

  public function enviadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->enviado(), $option, settypebool($value));
  }

  public function evaluado($option, $value) { 
    $field = $this->mapping->evaluado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEvaluado($value);
    if(!$this->value->checkEvaluado()) throw new Exception("Valor incorrecto: Evaluado ");
    return "({$field} {$option} {$this->value->sqlEvaluado()})";  
  }

  public function evaluadoDate($option, $value) { 
    $field = $this->mapping->evaluadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEvaluado($value);
    if(!$this->value->checkEvaluado()) throw new Exception("Valor incorrecto: Evaluado Date");
    return "({$field} {$option} {$this->value->sqlEvaluadoDate()})";  
  }

  public function evaluadoYm($option, $value) { 
    $field = $this->mapping->evaluadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEvaluado($value);
    if(!$this->value->checkEvaluado()) throw new Exception("Valor incorrecto: Evaluado Ym");
    return "({$field} {$option} {$this->value->sqlEvaluadoYm()})";  
  }

  public function evaluadoY($option, $value) { 
    $field = $this->mapping->evaluadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEvaluadoY($value);
    if(!$this->value->checkEvaluado()) throw new Exception("Valor incorrecto: Evaluado Y");
    return "({$field} {$option} {$this->value->sqlEvaluadoY()})";  
  }

  public function evaluadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->evaluado(), $option, settypebool($value));
  }

  public function modificado($option, $value) { 
    $field = $this->mapping->modificado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setModificado($value);
    if(!$this->value->checkModificado()) throw new Exception("Valor incorrecto: Modificado ");
    return "({$field} {$option} {$this->value->sqlModificado()})";  
  }

  public function modificadoDate($option, $value) { 
    $field = $this->mapping->modificadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setModificado($value);
    if(!$this->value->checkModificado()) throw new Exception("Valor incorrecto: Modificado Date");
    return "({$field} {$option} {$this->value->sqlModificadoDate()})";  
  }

  public function modificadoYm($option, $value) { 
    $field = $this->mapping->modificadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setModificado($value);
    if(!$this->value->checkModificado()) throw new Exception("Valor incorrecto: Modificado Ym");
    return "({$field} {$option} {$this->value->sqlModificadoYm()})";  
  }

  public function modificadoY($option, $value) { 
    $field = $this->mapping->modificadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setModificadoY($value);
    if(!$this->value->checkModificado()) throw new Exception("Valor incorrecto: Modificado Y");
    return "({$field} {$option} {$this->value->sqlModificadoY()})";  
  }

  public function modificadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->modificado(), $option, settypebool($value));
  }

  public function observaciones($option, $value) { 
    $field = $this->mapping->observaciones();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setObservaciones($value);
    if(!$this->value->checkObservaciones()) throw new Exception("Valor incorrecto: Observaciones");
    return "({$field} {$option} {$this->value->sqlObservaciones()})";  
  }

  public function observacionesIsSet($option, $value) { 
    return $this->_exists($this->mapping->observaciones(), $option, settypebool($value));
  }

  public function persona($option, $value) { 
    $field = $this->mapping->persona();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setPersona($value);
    if(!$this->value->checkPersona()) throw new Exception("Valor incorrecto: Persona");
    return "({$field} {$option} {$this->value->sqlPersona()})";  
  }

  public function personaIsSet($option, $value) { 
    return $this->_exists($this->mapping->persona(), $option, settypebool($value));
  }




}
