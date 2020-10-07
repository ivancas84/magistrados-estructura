<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _CargoFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function descripcion() { return $this->mapping->descripcion() . " AS " . $this->_pf() . "descripcion"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minDescripcion() { return $this->mapping->minDescripcion() . " AS " . $this->_pf() . "min_descripcion"; }
  public function maxDescripcion() { return $this->mapping->maxDescripcion() . " AS " . $this->_pf() . "max_descripcion"; }
  public function countDescripcion() { return $this->mapping->countDescripcion() . " AS " . $this->_pf() . "count_descripcion"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
