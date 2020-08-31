<?php

require_once("class/model/values/_Persona.php");

class Persona extends _Persona {
  public function resetNombres() { 
    if(!Validation::is_empty($this->nombres)) 
      $this->nombres = strto(
        preg_replace('/\s\s+/', ' ', trim($this->nombres)),
        "Xx Yy"
      ); 
  }
  
  public function resetApellidos() { 
    if(!Validation::is_empty($this->apellidos)) 
      $this->apellidos = strto(
        preg_replace('/\s\s+/', ' ', trim($this->apellidos)), 
        "Xx Yy"
      ); 
  }
}
