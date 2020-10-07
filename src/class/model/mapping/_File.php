<?php
require_once("class/model/entityOptions/Mapping.php");

class _FileMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function name() { return $this->_pt() . ".name"; }
  public function type() { return $this->_pt() . ".type"; }
  public function content() { return $this->_pt() . ".content"; }
  public function size() { return $this->_pt() . ".size"; }
  public function created() { return $this->_pt() . ".created"; }
  public function createdDate() { return "CAST({$this->_pt()}.created AS DATE)"; }
  public function createdYm() { return "DATE_FORMAT({$this->_pt()}.created, '%Y-%m')"; }
  public function createdY() { return "DATE_FORMAT({$this->_pt()}.created, '%Y')"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minName() { return "MIN({$this->_pt()}.name)"; }
  public function maxName() { return "MAX({$this->_pt()}.name)"; }
  public function countName() { return "COUNT({$this->_pt()}.name)"; }

  public function minType() { return "MIN({$this->_pt()}.type)"; }
  public function maxType() { return "MAX({$this->_pt()}.type)"; }
  public function countType() { return "COUNT({$this->_pt()}.type)"; }

  public function minContent() { return "MIN({$this->_pt()}.content)"; }
  public function maxContent() { return "MAX({$this->_pt()}.content)"; }
  public function countContent() { return "COUNT({$this->_pt()}.content)"; }

  public function sumSize() { return "SUM({$this->_pt()}.size)"; }
  public function avgSize() { return "AVG({$this->_pt()}.size)"; }
  public function minSize() { return "MIN({$this->_pt()}.size)"; }
  public function maxSize() { return "MAX({$this->_pt()}.size)"; }
  public function countSize() { return "COUNT({$this->_pt()}.size)"; }

  public function avgCreated() { return "AVG({$this->_pt()}.created)"; }
  public function minCreated() { return "MIN({$this->_pt()}.created)"; }
  public function maxCreated() { return "MAX({$this->_pt()}.created)"; }
  public function countCreated() { return "COUNT({$this->_pt()}.created)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
