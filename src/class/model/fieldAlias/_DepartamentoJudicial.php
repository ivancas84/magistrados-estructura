<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DepartamentoJudicialFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function codigo() { return $this->mapping->codigo() . " AS " . $this->_pf() . "codigo"; }
  public function nombre() { return $this->mapping->nombre() . " AS " . $this->_pf() . "nombre"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minCodigo() { return $this->mapping->minCodigo() . " AS " . $this->_pf() . "min_codigo"; }
  public function maxCodigo() { return $this->mapping->maxCodigo() . " AS " . $this->_pf() . "max_codigo"; }
  public function countCodigo() { return $this->mapping->countCodigo() . " AS " . $this->_pf() . "count_codigo"; }

  public function minNombre() { return $this->mapping->minNombre() . " AS " . $this->_pf() . "min_nombre"; }
  public function maxNombre() { return $this->mapping->maxNombre() . " AS " . $this->_pf() . "max_nombre"; }
  public function countNombre() { return $this->mapping->countNombre() . " AS " . $this->_pf() . "count_nombre"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
