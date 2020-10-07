<?php
require_once("class/model/entityOptions/Mapping.php");

class _CargoMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function descripcion() { return $this->_pt() . ".descripcion"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minDescripcion() { return "MIN({$this->_pt()}.descripcion)"; }
  public function maxDescripcion() { return "MAX({$this->_pt()}.descripcion)"; }
  public function countDescripcion() { return "COUNT({$this->_pt()}.descripcion)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.descripcion)"; 
  }


}
