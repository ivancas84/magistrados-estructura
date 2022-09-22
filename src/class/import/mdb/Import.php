<?php

require_once("class/import/Import.php");


class MdbImport extends Import{

  public $dnis = [];
  function config(){
    $this->container->getEntity("persona")->identifier = ["legajo"];
  }

  public function identify(){
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      try{
        $element->identifyCheck("persona");
        if(!empty(trim($element->entities["persona"]->_get("numero_documento")))){
          if(in_array($element->entities["persona"]->_get("numero_documento"),$this->dnis)) throw new Exception("El DNI se encuentra duplicado");
          array_push($this->dnis, $element->entities["persona"]->_get("numero_documento"));
        }
      } catch (Exception $exception){
        $element->process = false;
        $element->logs->addLog("identify", "error", $exception->getMessage() . "(" . $element->index . ")");
      }
    }
  }

  public function query(){
    $this->queryEntity("persona");
  }

  public function process(){
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      try{
        $element->process("persona");
      } catch (Exception $exception){
        $element->process = false;
        $element->logs->addLog("process", "error", $exception->getMessage() . "(" . $element->index . ")" );
      }
    }
  }

  

}

