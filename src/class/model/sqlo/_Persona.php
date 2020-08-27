<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PersonaSqlo extends EntitySqlo {

  public $entityName = "persona";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "nombres, " ;
    $sql .= "apellidos, " ;
    $sql .= "legajo, " ;
    $sql .= "numero_documento, " ;
    $sql .= "telefono_laboral, " ;
    $sql .= "telefono_particular, " ;
    $sql .= "fecha_nacimiento, " ;
    $sql .= "email, " ;
    $sql .= "creado, " ;
    $sql .= "eliminado, " ;
    $sql .= "cargo, " ;
    $sql .= "organo, " ;
    $sql .= "departamento_judicial, " ;
    $sql .= "departamento_judicial_informado, " ;
    $sql .= "tipo_documento, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombres'] . ", " ;
    $sql .= $row['apellidos'] . ", " ;
    $sql .= $row['legajo'] . ", " ;
    $sql .= $row['numero_documento'] . ", " ;
    $sql .= $row['telefono_laboral'] . ", " ;
    $sql .= $row['telefono_particular'] . ", " ;
    $sql .= $row['fecha_nacimiento'] . ", " ;
    $sql .= $row['email'] . ", " ;
    $sql .= $row['creado'] . ", " ;
    $sql .= $row['eliminado'] . ", " ;
    $sql .= $row['cargo'] . ", " ;
    $sql .= $row['organo'] . ", " ;
    $sql .= $row['departamento_judicial'] . ", " ;
    $sql .= $row['departamento_judicial_informado'] . ", " ;
    $sql .= $row['tipo_documento'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['nombres'] )) $sql .= "nombres = " . $row['nombres'] . " ," ;
    if (isset($row['apellidos'] )) $sql .= "apellidos = " . $row['apellidos'] . " ," ;
    if (isset($row['legajo'] )) $sql .= "legajo = " . $row['legajo'] . " ," ;
    if (isset($row['numero_documento'] )) $sql .= "numero_documento = " . $row['numero_documento'] . " ," ;
    if (isset($row['telefono_laboral'] )) $sql .= "telefono_laboral = " . $row['telefono_laboral'] . " ," ;
    if (isset($row['telefono_particular'] )) $sql .= "telefono_particular = " . $row['telefono_particular'] . " ," ;
    if (isset($row['fecha_nacimiento'] )) $sql .= "fecha_nacimiento = " . $row['fecha_nacimiento'] . " ," ;
    if (isset($row['email'] )) $sql .= "email = " . $row['email'] . " ," ;
    if (isset($row['creado'] )) $sql .= "creado = " . $row['creado'] . " ," ;
    if (isset($row['eliminado'] )) $sql .= "eliminado = " . $row['eliminado'] . " ," ;
    if (isset($row['cargo'] )) $sql .= "cargo = " . $row['cargo'] . " ," ;
    if (isset($row['organo'] )) $sql .= "organo = " . $row['organo'] . " ," ;
    if (isset($row['departamento_judicial'] )) $sql .= "departamento_judicial = " . $row['departamento_judicial'] . " ," ;
    if (isset($row['departamento_judicial_informado'] )) $sql .= "departamento_judicial_informado = " . $row['departamento_judicial_informado'] . " ," ;
    if (isset($row['tipo_documento'] )) $sql .= "tipo_documento = " . $row['tipo_documento'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['car_id'])) $row_["cargo_"] = $this->container->getValues('cargo')->_fromArray($row, 'car_')->_toArray();
    if(!is_null($row['org_id'])) $row_["organo_"] = $this->container->getValues('organo')->_fromArray($row, 'org_')->_toArray();
    if(!is_null($row['dj_id'])) $row_["departamento_judicial_"] = $this->container->getValues('departamento_judicial')->_fromArray($row, 'dj_')->_toArray();
    if(!is_null($row['dji_id'])) $row_["departamento_judicial_informado_"] = $this->container->getValues('departamento_judicial')->_fromArray($row, 'dji_')->_toArray();
    if(!is_null($row['td_id'])) $row_["tipo_documento_"] = $this->container->getValues('tipo_documento')->_fromArray($row, 'td_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["persona"] = $this->container->getValues("persona")->_fromArray($row);
    $row_["cargo"] = $this->container->getValues('cargo')->_fromArray($row, 'car_');
    $row_["organo"] = $this->container->getValues('organo')->_fromArray($row, 'org_');
    $row_["departamento_judicial"] = $this->container->getValues('departamento_judicial')->_fromArray($row, 'dj_');
    $row_["departamento_judicial_informado"] = $this->container->getValues('departamento_judicial')->_fromArray($row, 'dji_');
    $row_["tipo_documento"] = $this->container->getValues('tipo_documento')->_fromArray($row, 'td_');
    return $row_;
  }



}
