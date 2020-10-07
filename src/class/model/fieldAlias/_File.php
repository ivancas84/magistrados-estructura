<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _FileFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function name() { return $this->mapping->name() . " AS " . $this->_pf() . "name"; }
  public function type() { return $this->mapping->type() . " AS " . $this->_pf() . "type"; }
  public function content() { return $this->mapping->content() . " AS " . $this->_pf() . "content"; }
  public function size() { return $this->mapping->size() . " AS " . $this->_pf() . "size"; }
  public function created() { return $this->mapping->created() . " AS " . $this->_pf() . "created"; }
  public function createdDate() { return $this->mapping->createdDate() . " AS " . $this->_pf() . "created_date"; }
  public function createdYm() { return $this->mapping->createdYm() . " AS " . $this->_pf() . "created_ym"; }
  public function createdY() { return $this->mapping->createdY() . " AS " . $this->_pf() . "created_y"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minName() { return $this->mapping->minName() . " AS " . $this->_pf() . "min_name"; }
  public function maxName() { return $this->mapping->maxName() . " AS " . $this->_pf() . "max_name"; }
  public function countName() { return $this->mapping->countName() . " AS " . $this->_pf() . "count_name"; }

  public function minType() { return $this->mapping->minType() . " AS " . $this->_pf() . "min_type"; }
  public function maxType() { return $this->mapping->maxType() . " AS " . $this->_pf() . "max_type"; }
  public function countType() { return $this->mapping->countType() . " AS " . $this->_pf() . "count_type"; }

  public function minContent() { return $this->mapping->minContent() . " AS " . $this->_pf() . "min_content"; }
  public function maxContent() { return $this->mapping->maxContent() . " AS " . $this->_pf() . "max_content"; }
  public function countContent() { return $this->mapping->countContent() . " AS " . $this->_pf() . "count_content"; }

  public function sumSize() { return $this->mapping->sumSize() . " AS " . $this->_pf() . "sum_size"; }
  public function avgSize() { return $this->mapping->avgSize() . " AS " . $this->_pf() . "avg_size"; }
  public function minSize() { return $this->mapping->minSize() . " AS " . $this->_pf() . "min_size"; }
  public function maxSize() { return $this->mapping->maxSize() . " AS " . $this->_pf() . "max_size"; }
  public function countSize() { return $this->mapping->countSize() . " AS " . $this->_pf() . "count_size"; }

  public function avgCreated() { return $this->mapping->avgCreated() . " AS " . $this->_pf() . "avg_created"; }
  public function minCreated() { return $this->mapping->minCreated() . " AS " . $this->_pf() . "min_created"; }
  public function maxCreated() { return $this->mapping->maxCreated() . " AS " . $this->_pf() . "max_created"; }
  public function countCreated() { return $this->mapping->countCreated() . " AS " . $this->_pf() . "count_created"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
