<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _AfiliacionSqlo extends EntitySqlo {

  public $entityName = "afiliacion";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "motivo, " ;
    $sql .= "estado, " ;
    $sql .= "creado, " ;
    $sql .= "enviado, " ;
    $sql .= "evaluado, " ;
    $sql .= "modificado, " ;
    $sql .= "observaciones, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['motivo'] . ", " ;
    $sql .= $row['estado'] . ", " ;
    $sql .= $row['creado'] . ", " ;
    $sql .= $row['enviado'] . ", " ;
    $sql .= $row['evaluado'] . ", " ;
    $sql .= $row['modificado'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['motivo'] )) $sql .= "motivo = " . $row['motivo'] . " ," ;
    if (isset($row['estado'] )) $sql .= "estado = " . $row['estado'] . " ," ;
    if (isset($row['creado'] )) $sql .= "creado = " . $row['creado'] . " ," ;
    if (isset($row['enviado'] )) $sql .= "enviado = " . $row['enviado'] . " ," ;
    if (isset($row['evaluado'] )) $sql .= "evaluado = " . $row['evaluado'] . " ," ;
    if (isset($row['modificado'] )) $sql .= "modificado = " . $row['modificado'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['per_id'])){
      $row_["persona_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_')->_toArray();
    }
    if(!is_null($row['per_car_id'])){
      $row_["persona_"]["cargo_"] = EntityValues::getInstanceRequire('cargo')->_fromArray($row, 'per_car_')->_toArray();
    }
    if(!is_null($row['per_org_id'])){
      $row_["persona_"]["organo_"] = EntityValues::getInstanceRequire('organo')->_fromArray($row, 'per_org_')->_toArray();
    }
    if(!is_null($row['per_dj_id'])){
      $row_["persona_"]["departamento_judicial_"] = EntityValues::getInstanceRequire('departamento_judicial')->_fromArray($row, 'per_dj_')->_toArray();
    }
    if(!is_null($row['per_dji_id'])){
      $row_["persona_"]["departamento_judicial_informado_"] = EntityValues::getInstanceRequire('departamento_judicial')->_fromArray($row, 'per_dji_')->_toArray();
    }
    if(!is_null($row['per_td_id'])){
      $row_["persona_"]["tipo_documento_"] = EntityValues::getInstanceRequire('tipo_documento')->_fromArray($row, 'per_td_')->_toArray();
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["afiliacion"] = EntityValues::getInstanceRequire("afiliacion", $row);
    $row_["persona"] = EntityValues::getInstanceRequire('persona', $row, 'per_');
    $row_["cargo"] = EntityValues::getInstanceRequire('cargo', $row, 'per_car_');
    $row_["organo"] = EntityValues::getInstanceRequire('organo', $row, 'per_org_');
    $row_["departamento_judicial"] = EntityValues::getInstanceRequire('departamento_judicial', $row, 'per_dj_');
    $row_["departamento_judicial_informado"] = EntityValues::getInstanceRequire('departamento_judicial', $row, 'per_dji_');
    $row_["tipo_documento"] = EntityValues::getInstanceRequire('tipo_documento', $row, 'per_td_');
    return $row_;
  }



}
