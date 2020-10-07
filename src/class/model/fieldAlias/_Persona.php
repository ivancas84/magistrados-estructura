<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _PersonaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function nombres() { return $this->mapping->nombres() . " AS " . $this->_pf() . "nombres"; }
  public function apellidos() { return $this->mapping->apellidos() . " AS " . $this->_pf() . "apellidos"; }
  public function legajo() { return $this->mapping->legajo() . " AS " . $this->_pf() . "legajo"; }
  public function numeroDocumento() { return $this->mapping->numeroDocumento() . " AS " . $this->_pf() . "numero_documento"; }
  public function telefonoLaboral() { return $this->mapping->telefonoLaboral() . " AS " . $this->_pf() . "telefono_laboral"; }
  public function telefonoParticular() { return $this->mapping->telefonoParticular() . " AS " . $this->_pf() . "telefono_particular"; }
  public function fechaNacimiento() { return $this->mapping->fechaNacimiento() . " AS " . $this->_pf() . "fecha_nacimiento"; }
  public function email() { return $this->mapping->email() . " AS " . $this->_pf() . "email"; }
  public function creado() { return $this->mapping->creado() . " AS " . $this->_pf() . "creado"; }
  public function creadoDate() { return $this->mapping->creadoDate() . " AS " . $this->_pf() . "creado_date"; }
  public function creadoYm() { return $this->mapping->creadoYm() . " AS " . $this->_pf() . "creado_ym"; }
  public function creadoY() { return $this->mapping->creadoY() . " AS " . $this->_pf() . "creado_y"; }
  public function eliminado() { return $this->mapping->eliminado() . " AS " . $this->_pf() . "eliminado"; }
  public function eliminadoDate() { return $this->mapping->eliminadoDate() . " AS " . $this->_pf() . "eliminado_date"; }
  public function eliminadoYm() { return $this->mapping->eliminadoYm() . " AS " . $this->_pf() . "eliminado_ym"; }
  public function eliminadoY() { return $this->mapping->eliminadoY() . " AS " . $this->_pf() . "eliminado_y"; }
  public function cargo() { return $this->mapping->cargo() . " AS " . $this->_pf() . "cargo"; }
  public function organo() { return $this->mapping->organo() . " AS " . $this->_pf() . "organo"; }
  public function departamentoJudicial() { return $this->mapping->departamentoJudicial() . " AS " . $this->_pf() . "departamento_judicial"; }
  public function departamentoJudicialInformado() { return $this->mapping->departamentoJudicialInformado() . " AS " . $this->_pf() . "departamento_judicial_informado"; }
  public function tipoDocumento() { return $this->mapping->tipoDocumento() . " AS " . $this->_pf() . "tipo_documento"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minNombres() { return $this->mapping->minNombres() . " AS " . $this->_pf() . "min_nombres"; }
  public function maxNombres() { return $this->mapping->maxNombres() . " AS " . $this->_pf() . "max_nombres"; }
  public function countNombres() { return $this->mapping->countNombres() . " AS " . $this->_pf() . "count_nombres"; }

  public function minApellidos() { return $this->mapping->minApellidos() . " AS " . $this->_pf() . "min_apellidos"; }
  public function maxApellidos() { return $this->mapping->maxApellidos() . " AS " . $this->_pf() . "max_apellidos"; }
  public function countApellidos() { return $this->mapping->countApellidos() . " AS " . $this->_pf() . "count_apellidos"; }

  public function minLegajo() { return $this->mapping->minLegajo() . " AS " . $this->_pf() . "min_legajo"; }
  public function maxLegajo() { return $this->mapping->maxLegajo() . " AS " . $this->_pf() . "max_legajo"; }
  public function countLegajo() { return $this->mapping->countLegajo() . " AS " . $this->_pf() . "count_legajo"; }

  public function minNumeroDocumento() { return $this->mapping->minNumeroDocumento() . " AS " . $this->_pf() . "min_numero_documento"; }
  public function maxNumeroDocumento() { return $this->mapping->maxNumeroDocumento() . " AS " . $this->_pf() . "max_numero_documento"; }
  public function countNumeroDocumento() { return $this->mapping->countNumeroDocumento() . " AS " . $this->_pf() . "count_numero_documento"; }

  public function minTelefonoLaboral() { return $this->mapping->minTelefonoLaboral() . " AS " . $this->_pf() . "min_telefono_laboral"; }
  public function maxTelefonoLaboral() { return $this->mapping->maxTelefonoLaboral() . " AS " . $this->_pf() . "max_telefono_laboral"; }
  public function countTelefonoLaboral() { return $this->mapping->countTelefonoLaboral() . " AS " . $this->_pf() . "count_telefono_laboral"; }

  public function minTelefonoParticular() { return $this->mapping->minTelefonoParticular() . " AS " . $this->_pf() . "min_telefono_particular"; }
  public function maxTelefonoParticular() { return $this->mapping->maxTelefonoParticular() . " AS " . $this->_pf() . "max_telefono_particular"; }
  public function countTelefonoParticular() { return $this->mapping->countTelefonoParticular() . " AS " . $this->_pf() . "count_telefono_particular"; }

  public function avgFechaNacimiento() { return $this->mapping->avgFechaNacimiento() . " AS " . $this->_pf() . "avg_fecha_nacimiento"; }
  public function minFechaNacimiento() { return $this->mapping->minFechaNacimiento() . " AS " . $this->_pf() . "min_fecha_nacimiento"; }
  public function maxFechaNacimiento() { return $this->mapping->maxFechaNacimiento() . " AS " . $this->_pf() . "max_fecha_nacimiento"; }
  public function countFechaNacimiento() { return $this->mapping->countFechaNacimiento() . " AS " . $this->_pf() . "count_fecha_nacimiento"; }

  public function minEmail() { return $this->mapping->minEmail() . " AS " . $this->_pf() . "min_email"; }
  public function maxEmail() { return $this->mapping->maxEmail() . " AS " . $this->_pf() . "max_email"; }
  public function countEmail() { return $this->mapping->countEmail() . " AS " . $this->_pf() . "count_email"; }

  public function avgCreado() { return $this->mapping->avgCreado() . " AS " . $this->_pf() . "avg_creado"; }
  public function minCreado() { return $this->mapping->minCreado() . " AS " . $this->_pf() . "min_creado"; }
  public function maxCreado() { return $this->mapping->maxCreado() . " AS " . $this->_pf() . "max_creado"; }
  public function countCreado() { return $this->mapping->countCreado() . " AS " . $this->_pf() . "count_creado"; }

  public function avgEliminado() { return $this->mapping->avgEliminado() . " AS " . $this->_pf() . "avg_eliminado"; }
  public function minEliminado() { return $this->mapping->minEliminado() . " AS " . $this->_pf() . "min_eliminado"; }
  public function maxEliminado() { return $this->mapping->maxEliminado() . " AS " . $this->_pf() . "max_eliminado"; }
  public function countEliminado() { return $this->mapping->countEliminado() . " AS " . $this->_pf() . "count_eliminado"; }

  public function minCargo() { return $this->mapping->minCargo() . " AS " . $this->_pf() . "min_cargo"; }
  public function maxCargo() { return $this->mapping->maxCargo() . " AS " . $this->_pf() . "max_cargo"; }
  public function countCargo() { return $this->mapping->countCargo() . " AS " . $this->_pf() . "count_cargo"; }

  public function minOrgano() { return $this->mapping->minOrgano() . " AS " . $this->_pf() . "min_organo"; }
  public function maxOrgano() { return $this->mapping->maxOrgano() . " AS " . $this->_pf() . "max_organo"; }
  public function countOrgano() { return $this->mapping->countOrgano() . " AS " . $this->_pf() . "count_organo"; }

  public function minDepartamentoJudicial() { return $this->mapping->minDepartamentoJudicial() . " AS " . $this->_pf() . "min_departamento_judicial"; }
  public function maxDepartamentoJudicial() { return $this->mapping->maxDepartamentoJudicial() . " AS " . $this->_pf() . "max_departamento_judicial"; }
  public function countDepartamentoJudicial() { return $this->mapping->countDepartamentoJudicial() . " AS " . $this->_pf() . "count_departamento_judicial"; }

  public function minDepartamentoJudicialInformado() { return $this->mapping->minDepartamentoJudicialInformado() . " AS " . $this->_pf() . "min_departamento_judicial_informado"; }
  public function maxDepartamentoJudicialInformado() { return $this->mapping->maxDepartamentoJudicialInformado() . " AS " . $this->_pf() . "max_departamento_judicial_informado"; }
  public function countDepartamentoJudicialInformado() { return $this->mapping->countDepartamentoJudicialInformado() . " AS " . $this->_pf() . "count_departamento_judicial_informado"; }

  public function minTipoDocumento() { return $this->mapping->minTipoDocumento() . " AS " . $this->_pf() . "min_tipo_documento"; }
  public function maxTipoDocumento() { return $this->mapping->maxTipoDocumento() . " AS " . $this->_pf() . "max_tipo_documento"; }
  public function countTipoDocumento() { return $this->mapping->countTipoDocumento() . " AS " . $this->_pf() . "count_tipo_documento"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
