<?php

require_once("class/model/entityOptions/Value.php");

class PersonaValue extends ValueEntityOptions {
  public function resetNombres() { 
      $this->value["nombres"] = strto(
        preg_replace('/\s\s+/', ' ', trim($this->value["nombres"])),
        "Xx Yy"
      ); 

  }
  
  public function resetApellidos() { 
    
    $this->value["apellidos"] = strto(
        preg_replace('/\s\s+/', ' ', trim($this->value["apellidos"])), 
        "Xx Yy"
      );
  }
}
