<?php
require_once("class/model/entityOptions/Mapping.php");

class _AfiliacionMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function motivo() { return $this->_pt() . ".motivo"; }
  public function estado() { return $this->_pt() . ".estado"; }
  public function creado() { return $this->_pt() . ".creado"; }
  public function creadoDate() { return "CAST({$this->_pt()}.creado AS DATE)"; }
  public function creadoYm() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y-%m')"; }
  public function creadoY() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y')"; }
  public function enviado() { return $this->_pt() . ".enviado"; }
  public function enviadoDate() { return "CAST({$this->_pt()}.enviado AS DATE)"; }
  public function enviadoYm() { return "DATE_FORMAT({$this->_pt()}.enviado, '%Y-%m')"; }
  public function enviadoY() { return "DATE_FORMAT({$this->_pt()}.enviado, '%Y')"; }
  public function evaluado() { return $this->_pt() . ".evaluado"; }
  public function evaluadoDate() { return "CAST({$this->_pt()}.evaluado AS DATE)"; }
  public function evaluadoYm() { return "DATE_FORMAT({$this->_pt()}.evaluado, '%Y-%m')"; }
  public function evaluadoY() { return "DATE_FORMAT({$this->_pt()}.evaluado, '%Y')"; }
  public function modificado() { return $this->_pt() . ".modificado"; }
  public function modificadoDate() { return "CAST({$this->_pt()}.modificado AS DATE)"; }
  public function modificadoYm() { return "DATE_FORMAT({$this->_pt()}.modificado, '%Y-%m')"; }
  public function modificadoY() { return "DATE_FORMAT({$this->_pt()}.modificado, '%Y')"; }
  public function observaciones() { return $this->_pt() . ".observaciones"; }
  public function persona() { return $this->_pt() . ".persona"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minMotivo() { return "MIN({$this->_pt()}.motivo)"; }
  public function maxMotivo() { return "MAX({$this->_pt()}.motivo)"; }
  public function countMotivo() { return "COUNT({$this->_pt()}.motivo)"; }

  public function minEstado() { return "MIN({$this->_pt()}.estado)"; }
  public function maxEstado() { return "MAX({$this->_pt()}.estado)"; }
  public function countEstado() { return "COUNT({$this->_pt()}.estado)"; }

  public function avgCreado() { return "AVG({$this->_pt()}.creado)"; }
  public function minCreado() { return "MIN({$this->_pt()}.creado)"; }
  public function maxCreado() { return "MAX({$this->_pt()}.creado)"; }
  public function countCreado() { return "COUNT({$this->_pt()}.creado)"; }

  public function avgEnviado() { return "AVG({$this->_pt()}.enviado)"; }
  public function minEnviado() { return "MIN({$this->_pt()}.enviado)"; }
  public function maxEnviado() { return "MAX({$this->_pt()}.enviado)"; }
  public function countEnviado() { return "COUNT({$this->_pt()}.enviado)"; }

  public function avgEvaluado() { return "AVG({$this->_pt()}.evaluado)"; }
  public function minEvaluado() { return "MIN({$this->_pt()}.evaluado)"; }
  public function maxEvaluado() { return "MAX({$this->_pt()}.evaluado)"; }
  public function countEvaluado() { return "COUNT({$this->_pt()}.evaluado)"; }

  public function avgModificado() { return "AVG({$this->_pt()}.modificado)"; }
  public function minModificado() { return "MIN({$this->_pt()}.modificado)"; }
  public function maxModificado() { return "MAX({$this->_pt()}.modificado)"; }
  public function countModificado() { return "COUNT({$this->_pt()}.modificado)"; }

  public function minObservaciones() { return "MIN({$this->_pt()}.observaciones)"; }
  public function maxObservaciones() { return "MAX({$this->_pt()}.observaciones)"; }
  public function countObservaciones() { return "COUNT({$this->_pt()}.observaciones)"; }

  public function minPersona() { return "MIN({$this->_pt()}.persona)"; }
  public function maxPersona() { return "MAX({$this->_pt()}.persona)"; }
  public function countPersona() { return "COUNT({$this->_pt()}.persona)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
