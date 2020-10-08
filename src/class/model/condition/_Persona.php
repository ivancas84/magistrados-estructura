<?php
require_once("class/model/entityOptions/Condition.php");

class _PersonaCondition extends ConditionEntityOptions{

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

  public function nombres($option, $value) { 
    $field = $this->mapping->nombres();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNombres($value);
    if(!$this->value->checkNombres()) throw new Exception("Valor incorrecto: Nombres");
    return "({$field} {$option} {$this->value->sqlNombres()})";  
  }

  public function nombresIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->nombres(), $option, settypebool($value));
  }

  public function apellidos($option, $value) { 
    $field = $this->mapping->apellidos();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setApellidos($value);
    if(!$this->value->checkApellidos()) throw new Exception("Valor incorrecto: Apellidos");
    return "({$field} {$option} {$this->value->sqlApellidos()})";  
  }

  public function apellidosIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->apellidos(), $option, settypebool($value));
  }

  public function legajo($option, $value) { 
    $field = $this->mapping->legajo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setLegajo($value);
    if(!$this->value->checkLegajo()) throw new Exception("Valor incorrecto: Legajo");
    return "({$field} {$option} {$this->value->sqlLegajo()})";  
  }

  public function legajoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->legajo(), $option, settypebool($value));
  }

  public function numeroDocumento($option, $value) { 
    $field = $this->mapping->numeroDocumento();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNumeroDocumento($value);
    if(!$this->value->checkNumeroDocumento()) throw new Exception("Valor incorrecto: Numero Documento");
    return "({$field} {$option} {$this->value->sqlNumeroDocumento()})";  
  }

  public function numeroDocumentoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->numeroDocumento(), $option, settypebool($value));
  }

  public function telefonoLaboral($option, $value) { 
    $field = $this->mapping->telefonoLaboral();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setTelefonoLaboral($value);
    if(!$this->value->checkTelefonoLaboral()) throw new Exception("Valor incorrecto: Telefono Laboral");
    return "({$field} {$option} {$this->value->sqlTelefonoLaboral()})";  
  }

  public function telefonoLaboralIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->telefonoLaboral(), $option, settypebool($value));
  }

  public function telefonoParticular($option, $value) { 
    $field = $this->mapping->telefonoParticular();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setTelefonoParticular($value);
    if(!$this->value->checkTelefonoParticular()) throw new Exception("Valor incorrecto: Telefono Particular");
    return "({$field} {$option} {$this->value->sqlTelefonoParticular()})";  
  }

  public function telefonoParticularIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->telefonoParticular(), $option, settypebool($value));
  }

  public function fechaNacimiento($option, $value) { 
    $field = $this->mapping->fechaNacimiento();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimiento($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento ");
    return "({$field} {$option} {$this->value->sqlFechaNacimiento()})";  
  }

  public function fechaNacimientoYm($option, $value) { 
    $field = $this->mapping->fechaNacimientoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimiento($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento Ym");
    return "({$field} {$option} {$this->value->sqlFechaNacimientoYm()})";  
  }

  public function fechaNacimientoY($option, $value) { 
    $field = $this->mapping->fechaNacimientoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimientoY($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento Y");
    return "({$field} {$option} {$this->value->sqlFechaNacimientoY()})";  
  }

  public function fechaNacimientoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->fechaNacimiento(), $option, settypebool($value));
  }

  public function email($option, $value) { 
    $field = $this->mapping->email();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setEmail($value);
    if(!$this->value->checkEmail()) throw new Exception("Valor incorrecto: Email");
    return "({$field} {$option} {$this->value->sqlEmail()})";  
  }

  public function emailIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->email(), $option, settypebool($value));
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
    return $this->sql->exists($this->mapping->creado(), $option, settypebool($value));
  }

  public function eliminado($option, $value) { 
    $field = $this->mapping->eliminado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado ");
    return "({$field} {$option} {$this->value->sqlEliminado()})";  
  }

  public function eliminadoDate($option, $value) { 
    $field = $this->mapping->eliminadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Date");
    return "({$field} {$option} {$this->value->sqlEliminadoDate()})";  
  }

  public function eliminadoYm($option, $value) { 
    $field = $this->mapping->eliminadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Ym");
    return "({$field} {$option} {$this->value->sqlEliminadoYm()})";  
  }

  public function eliminadoY($option, $value) { 
    $field = $this->mapping->eliminadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminadoY($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Y");
    return "({$field} {$option} {$this->value->sqlEliminadoY()})";  
  }

  public function eliminadoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->eliminado(), $option, settypebool($value));
  }

  public function cargo($option, $value) { 
    $field = $this->mapping->cargo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setCargo($value);
    if(!$this->value->checkCargo()) throw new Exception("Valor incorrecto: Cargo");
    return "({$field} {$option} {$this->value->sqlCargo()})";  
  }

  public function cargoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->cargo(), $option, settypebool($value));
  }

  public function organo($option, $value) { 
    $field = $this->mapping->organo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setOrgano($value);
    if(!$this->value->checkOrgano()) throw new Exception("Valor incorrecto: Organo");
    return "({$field} {$option} {$this->value->sqlOrgano()})";  
  }

  public function organoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->organo(), $option, settypebool($value));
  }

  public function departamentoJudicial($option, $value) { 
    $field = $this->mapping->departamentoJudicial();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDepartamentoJudicial($value);
    if(!$this->value->checkDepartamentoJudicial()) throw new Exception("Valor incorrecto: Departamento Judicial");
    return "({$field} {$option} {$this->value->sqlDepartamentoJudicial()})";  
  }

  public function departamentoJudicialIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->departamentoJudicial(), $option, settypebool($value));
  }

  public function departamentoJudicialInformado($option, $value) { 
    $field = $this->mapping->departamentoJudicialInformado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDepartamentoJudicialInformado($value);
    if(!$this->value->checkDepartamentoJudicialInformado()) throw new Exception("Valor incorrecto: Departamento Judicial Informado");
    return "({$field} {$option} {$this->value->sqlDepartamentoJudicialInformado()})";  
  }

  public function departamentoJudicialInformadoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->departamentoJudicialInformado(), $option, settypebool($value));
  }

  public function tipoDocumento($option, $value) { 
    $field = $this->mapping->tipoDocumento();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setTipoDocumento($value);
    if(!$this->value->checkTipoDocumento()) throw new Exception("Valor incorrecto: Tipo Documento");
    return "({$field} {$option} {$this->value->sqlTipoDocumento()})";  
  }

  public function tipoDocumentoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->tipoDocumento(), $option, settypebool($value));
  }




}
