<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _AfiliacionFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function motivo() { return $this->mapping->motivo() . " AS " . $this->_pf() . "motivo"; }
  public function estado() { return $this->mapping->estado() . " AS " . $this->_pf() . "estado"; }
  public function creado() { return $this->mapping->creado() . " AS " . $this->_pf() . "creado"; }
  public function creadoDate() { return $this->mapping->creadoDate() . " AS " . $this->_pf() . "creado_date"; }
  public function creadoYm() { return $this->mapping->creadoYm() . " AS " . $this->_pf() . "creado_ym"; }
  public function creadoY() { return $this->mapping->creadoY() . " AS " . $this->_pf() . "creado_y"; }
  public function enviado() { return $this->mapping->enviado() . " AS " . $this->_pf() . "enviado"; }
  public function enviadoDate() { return $this->mapping->enviadoDate() . " AS " . $this->_pf() . "enviado_date"; }
  public function enviadoYm() { return $this->mapping->enviadoYm() . " AS " . $this->_pf() . "enviado_ym"; }
  public function enviadoY() { return $this->mapping->enviadoY() . " AS " . $this->_pf() . "enviado_y"; }
  public function evaluado() { return $this->mapping->evaluado() . " AS " . $this->_pf() . "evaluado"; }
  public function evaluadoDate() { return $this->mapping->evaluadoDate() . " AS " . $this->_pf() . "evaluado_date"; }
  public function evaluadoYm() { return $this->mapping->evaluadoYm() . " AS " . $this->_pf() . "evaluado_ym"; }
  public function evaluadoY() { return $this->mapping->evaluadoY() . " AS " . $this->_pf() . "evaluado_y"; }
  public function modificado() { return $this->mapping->modificado() . " AS " . $this->_pf() . "modificado"; }
  public function modificadoDate() { return $this->mapping->modificadoDate() . " AS " . $this->_pf() . "modificado_date"; }
  public function modificadoYm() { return $this->mapping->modificadoYm() . " AS " . $this->_pf() . "modificado_ym"; }
  public function modificadoY() { return $this->mapping->modificadoY() . " AS " . $this->_pf() . "modificado_y"; }
  public function observaciones() { return $this->mapping->observaciones() . " AS " . $this->_pf() . "observaciones"; }
  public function persona() { return $this->mapping->persona() . " AS " . $this->_pf() . "persona"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minMotivo() { return $this->mapping->minMotivo() . " AS " . $this->_pf() . "min_motivo"; }
  public function maxMotivo() { return $this->mapping->maxMotivo() . " AS " . $this->_pf() . "max_motivo"; }
  public function countMotivo() { return $this->mapping->countMotivo() . " AS " . $this->_pf() . "count_motivo"; }

  public function minEstado() { return $this->mapping->minEstado() . " AS " . $this->_pf() . "min_estado"; }
  public function maxEstado() { return $this->mapping->maxEstado() . " AS " . $this->_pf() . "max_estado"; }
  public function countEstado() { return $this->mapping->countEstado() . " AS " . $this->_pf() . "count_estado"; }

  public function avgCreado() { return $this->mapping->avgCreado() . " AS " . $this->_pf() . "avg_creado"; }
  public function minCreado() { return $this->mapping->minCreado() . " AS " . $this->_pf() . "min_creado"; }
  public function maxCreado() { return $this->mapping->maxCreado() . " AS " . $this->_pf() . "max_creado"; }
  public function countCreado() { return $this->mapping->countCreado() . " AS " . $this->_pf() . "count_creado"; }

  public function avgEnviado() { return $this->mapping->avgEnviado() . " AS " . $this->_pf() . "avg_enviado"; }
  public function minEnviado() { return $this->mapping->minEnviado() . " AS " . $this->_pf() . "min_enviado"; }
  public function maxEnviado() { return $this->mapping->maxEnviado() . " AS " . $this->_pf() . "max_enviado"; }
  public function countEnviado() { return $this->mapping->countEnviado() . " AS " . $this->_pf() . "count_enviado"; }

  public function avgEvaluado() { return $this->mapping->avgEvaluado() . " AS " . $this->_pf() . "avg_evaluado"; }
  public function minEvaluado() { return $this->mapping->minEvaluado() . " AS " . $this->_pf() . "min_evaluado"; }
  public function maxEvaluado() { return $this->mapping->maxEvaluado() . " AS " . $this->_pf() . "max_evaluado"; }
  public function countEvaluado() { return $this->mapping->countEvaluado() . " AS " . $this->_pf() . "count_evaluado"; }

  public function avgModificado() { return $this->mapping->avgModificado() . " AS " . $this->_pf() . "avg_modificado"; }
  public function minModificado() { return $this->mapping->minModificado() . " AS " . $this->_pf() . "min_modificado"; }
  public function maxModificado() { return $this->mapping->maxModificado() . " AS " . $this->_pf() . "max_modificado"; }
  public function countModificado() { return $this->mapping->countModificado() . " AS " . $this->_pf() . "count_modificado"; }

  public function minObservaciones() { return $this->mapping->minObservaciones() . " AS " . $this->_pf() . "min_observaciones"; }
  public function maxObservaciones() { return $this->mapping->maxObservaciones() . " AS " . $this->_pf() . "max_observaciones"; }
  public function countObservaciones() { return $this->mapping->countObservaciones() . " AS " . $this->_pf() . "count_observaciones"; }

  public function minPersona() { return $this->mapping->minPersona() . " AS " . $this->_pf() . "min_persona"; }
  public function maxPersona() { return $this->mapping->maxPersona() . " AS " . $this->_pf() . "max_persona"; }
  public function countPersona() { return $this->mapping->countPersona() . " AS " . $this->_pf() . "count_persona"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
