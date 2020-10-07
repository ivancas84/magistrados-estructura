<?php
require_once("class/model/entityOptions/Mapping.php");

class _DepartamentoJudicialMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function codigo() { return $this->_pt() . ".codigo"; }
  public function nombre() { return $this->_pt() . ".nombre"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minCodigo() { return "MIN({$this->_pt()}.codigo)"; }
  public function maxCodigo() { return "MAX({$this->_pt()}.codigo)"; }
  public function countCodigo() { return "COUNT({$this->_pt()}.codigo)"; }

  public function minNombre() { return "MIN({$this->_pt()}.nombre)"; }
  public function maxNombre() { return "MAX({$this->_pt()}.nombre)"; }
  public function countNombre() { return "COUNT({$this->_pt()}.nombre)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.codigo, 
{$this->_pt()}.nombre)"; 
  }


}
