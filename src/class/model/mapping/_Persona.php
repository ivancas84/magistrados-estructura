<?php
require_once("class/model/entityOptions/Mapping.php");

class _PersonaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function nombres() { return $this->_pt() . ".nombres"; }
  public function apellidos() { return $this->_pt() . ".apellidos"; }
  public function legajo() { return $this->_pt() . ".legajo"; }
  public function numeroDocumento() { return $this->_pt() . ".numero_documento"; }
  public function telefonoLaboral() { return $this->_pt() . ".telefono_laboral"; }
  public function telefonoParticular() { return $this->_pt() . ".telefono_particular"; }
  public function fechaNacimiento() { return $this->_pt() . ".fecha_nacimiento"; }
  public function email() { return $this->_pt() . ".email"; }
  public function creado() { return $this->_pt() . ".creado"; }
  public function creadoDate() { return "CAST({$this->_pt()}.creado AS DATE)"; }
  public function creadoYm() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y-%m')"; }
  public function creadoY() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y')"; }
  public function eliminado() { return $this->_pt() . ".eliminado"; }
  public function eliminadoDate() { return "CAST({$this->_pt()}.eliminado AS DATE)"; }
  public function eliminadoYm() { return "DATE_FORMAT({$this->_pt()}.eliminado, '%Y-%m')"; }
  public function eliminadoY() { return "DATE_FORMAT({$this->_pt()}.eliminado, '%Y')"; }
  public function cargo() { return $this->_pt() . ".cargo"; }
  public function organo() { return $this->_pt() . ".organo"; }
  public function departamentoJudicial() { return $this->_pt() . ".departamento_judicial"; }
  public function departamentoJudicialInformado() { return $this->_pt() . ".departamento_judicial_informado"; }
  public function tipoDocumento() { return $this->_pt() . ".tipo_documento"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNombres() { return "MIN({$this->_pt()}.nombres)"; }
  public function maxNombres() { return "MAX({$this->_pt()}.nombres)"; }
  public function countNombres() { return "COUNT({$this->_pt()}.nombres)"; }

  public function minApellidos() { return "MIN({$this->_pt()}.apellidos)"; }
  public function maxApellidos() { return "MAX({$this->_pt()}.apellidos)"; }
  public function countApellidos() { return "COUNT({$this->_pt()}.apellidos)"; }

  public function minLegajo() { return "MIN({$this->_pt()}.legajo)"; }
  public function maxLegajo() { return "MAX({$this->_pt()}.legajo)"; }
  public function countLegajo() { return "COUNT({$this->_pt()}.legajo)"; }

  public function minNumeroDocumento() { return "MIN({$this->_pt()}.numero_documento)"; }
  public function maxNumeroDocumento() { return "MAX({$this->_pt()}.numero_documento)"; }
  public function countNumeroDocumento() { return "COUNT({$this->_pt()}.numero_documento)"; }

  public function minTelefonoLaboral() { return "MIN({$this->_pt()}.telefono_laboral)"; }
  public function maxTelefonoLaboral() { return "MAX({$this->_pt()}.telefono_laboral)"; }
  public function countTelefonoLaboral() { return "COUNT({$this->_pt()}.telefono_laboral)"; }

  public function minTelefonoParticular() { return "MIN({$this->_pt()}.telefono_particular)"; }
  public function maxTelefonoParticular() { return "MAX({$this->_pt()}.telefono_particular)"; }
  public function countTelefonoParticular() { return "COUNT({$this->_pt()}.telefono_particular)"; }

  public function avgFechaNacimiento() { return "AVG({$this->_pt()}.fecha_nacimiento)"; }
  public function minFechaNacimiento() { return "MIN({$this->_pt()}.fecha_nacimiento)"; }
  public function maxFechaNacimiento() { return "MAX({$this->_pt()}.fecha_nacimiento)"; }
  public function countFechaNacimiento() { return "COUNT({$this->_pt()}.fecha_nacimiento)"; }

  public function minEmail() { return "MIN({$this->_pt()}.email)"; }
  public function maxEmail() { return "MAX({$this->_pt()}.email)"; }
  public function countEmail() { return "COUNT({$this->_pt()}.email)"; }

  public function avgCreado() { return "AVG({$this->_pt()}.creado)"; }
  public function minCreado() { return "MIN({$this->_pt()}.creado)"; }
  public function maxCreado() { return "MAX({$this->_pt()}.creado)"; }
  public function countCreado() { return "COUNT({$this->_pt()}.creado)"; }

  public function avgEliminado() { return "AVG({$this->_pt()}.eliminado)"; }
  public function minEliminado() { return "MIN({$this->_pt()}.eliminado)"; }
  public function maxEliminado() { return "MAX({$this->_pt()}.eliminado)"; }
  public function countEliminado() { return "COUNT({$this->_pt()}.eliminado)"; }

  public function minCargo() { return "MIN({$this->_pt()}.cargo)"; }
  public function maxCargo() { return "MAX({$this->_pt()}.cargo)"; }
  public function countCargo() { return "COUNT({$this->_pt()}.cargo)"; }

  public function minOrgano() { return "MIN({$this->_pt()}.organo)"; }
  public function maxOrgano() { return "MAX({$this->_pt()}.organo)"; }
  public function countOrgano() { return "COUNT({$this->_pt()}.organo)"; }

  public function minDepartamentoJudicial() { return "MIN({$this->_pt()}.departamento_judicial)"; }
  public function maxDepartamentoJudicial() { return "MAX({$this->_pt()}.departamento_judicial)"; }
  public function countDepartamentoJudicial() { return "COUNT({$this->_pt()}.departamento_judicial)"; }

  public function minDepartamentoJudicialInformado() { return "MIN({$this->_pt()}.departamento_judicial_informado)"; }
  public function maxDepartamentoJudicialInformado() { return "MAX({$this->_pt()}.departamento_judicial_informado)"; }
  public function countDepartamentoJudicialInformado() { return "COUNT({$this->_pt()}.departamento_judicial_informado)"; }

  public function minTipoDocumento() { return "MIN({$this->_pt()}.tipo_documento)"; }
  public function maxTipoDocumento() { return "MAX({$this->_pt()}.tipo_documento)"; }
  public function countTipoDocumento() { return "COUNT({$this->_pt()}.tipo_documento)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.nombres, 
{$this->_pt()}.apellidos, 
{$this->_pt()}.legajo)"; 
  }


}
