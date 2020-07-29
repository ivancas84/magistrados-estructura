<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PersonaSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('persona');
    $this->sql = EntitySql::getInstanceRequire('persona');
  }

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
    $row_ = $this->sql->_json($row);
    if(!is_null($row['car_id'])){
      $json = EntitySql::getInstanceRequire('cargo', 'car')->_json($row);
      $row_["cargo_"] = $json;
    }
    if(!is_null($row['org_id'])){
      $json = EntitySql::getInstanceRequire('organo', 'org')->_json($row);
      $row_["organo_"] = $json;
    }
    if(!is_null($row['dj_id'])){
      $json = EntitySql::getInstanceRequire('departamento_judicial', 'dj')->_json($row);
      $row_["departamento_judicial_"] = $json;
    }
    if(!is_null($row['dji_id'])){
      $json = EntitySql::getInstanceRequire('departamento_judicial', 'dji')->_json($row);
      $row_["departamento_judicial_informado_"] = $json;
    }
    if(!is_null($row['td_id'])){
      $json = EntitySql::getInstanceRequire('tipo_documento', 'td')->_json($row);
      $row_["tipo_documento_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["persona"] = EntityValues::getInstanceRequire("persona", $row);
    $row_["cargo"] = EntityValues::getInstanceRequire('cargo', $row, 'car_');
    $row_["organo"] = EntityValues::getInstanceRequire('organo', $row, 'org_');
    $row_["departamento_judicial"] = EntityValues::getInstanceRequire('departamento_judicial', $row, 'dj_');
    $row_["departamento_judicial_informado"] = EntityValues::getInstanceRequire('departamento_judicial', $row, 'dji_');
    $row_["tipo_documento"] = EntityValues::getInstanceRequire('tipo_documento', $row, 'td_');
    return $row_;
  }



}
