<?php
require_once("class/model/Sql.php");

class _PersonaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('persona');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombres': return $t.".nombres";
      case $p.'apellidos': return $t.".apellidos";
      case $p.'legajo': return $t.".legajo";
      case $p.'numero_documento': return $t.".numero_documento";
      case $p.'telefono_laboral': return $t.".telefono_laboral";
      case $p.'telefono_particular': return $t.".telefono_particular";
      case $p.'fecha_nacimiento': return $t.".fecha_nacimiento";
      case $p.'email': return $t.".email";
      case $p.'creado': return $t.".creado";
      case $p.'eliminado': return $t.".eliminado";
      case $p.'cargo': return $t.".cargo";
      case $p.'organo': return $t.".organo";
      case $p.'departamento_judicial': return $t.".departamento_judicial";
      case $p.'departamento_judicial_informado': return $t.".departamento_judicial_informado";
      case $p.'tipo_documento': return $t.".tipo_documento";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_nombres': return "MIN({$t}.nombres)";
      case $p.'max_nombres': return "MAX({$t}.nombres)";
      case $p.'count_nombres': return "COUNT({$t}.nombres)";

      case $p.'min_apellidos': return "MIN({$t}.apellidos)";
      case $p.'max_apellidos': return "MAX({$t}.apellidos)";
      case $p.'count_apellidos': return "COUNT({$t}.apellidos)";

      case $p.'min_legajo': return "MIN({$t}.legajo)";
      case $p.'max_legajo': return "MAX({$t}.legajo)";
      case $p.'count_legajo': return "COUNT({$t}.legajo)";

      case $p.'min_numero_documento': return "MIN({$t}.numero_documento)";
      case $p.'max_numero_documento': return "MAX({$t}.numero_documento)";
      case $p.'count_numero_documento': return "COUNT({$t}.numero_documento)";

      case $p.'min_telefono_laboral': return "MIN({$t}.telefono_laboral)";
      case $p.'max_telefono_laboral': return "MAX({$t}.telefono_laboral)";
      case $p.'count_telefono_laboral': return "COUNT({$t}.telefono_laboral)";

      case $p.'min_telefono_particular': return "MIN({$t}.telefono_particular)";
      case $p.'max_telefono_particular': return "MAX({$t}.telefono_particular)";
      case $p.'count_telefono_particular': return "COUNT({$t}.telefono_particular)";

      case $p.'avg_fecha_nacimiento': return "AVG({$t}.fecha_nacimiento)";
      case $p.'min_fecha_nacimiento': return "MIN({$t}.fecha_nacimiento)";
      case $p.'max_fecha_nacimiento': return "MAX({$t}.fecha_nacimiento)";
      case $p.'count_fecha_nacimiento': return "COUNT({$t}.fecha_nacimiento)";

      case $p.'min_email': return "MIN({$t}.email)";
      case $p.'max_email': return "MAX({$t}.email)";
      case $p.'count_email': return "COUNT({$t}.email)";

      case $p.'avg_creado': return "AVG({$t}.creado)";
      case $p.'min_creado': return "MIN({$t}.creado)";
      case $p.'max_creado': return "MAX({$t}.creado)";
      case $p.'count_creado': return "COUNT({$t}.creado)";

      case $p.'avg_eliminado': return "AVG({$t}.eliminado)";
      case $p.'min_eliminado': return "MIN({$t}.eliminado)";
      case $p.'max_eliminado': return "MAX({$t}.eliminado)";
      case $p.'count_eliminado': return "COUNT({$t}.eliminado)";

      case $p.'min_cargo': return "MIN({$t}.cargo)";
      case $p.'max_cargo': return "MAX({$t}.cargo)";
      case $p.'count_cargo': return "COUNT({$t}.cargo)";

      case $p.'min_organo': return "MIN({$t}.organo)";
      case $p.'max_organo': return "MAX({$t}.organo)";
      case $p.'count_organo': return "COUNT({$t}.organo)";

      case $p.'min_departamento_judicial': return "MIN({$t}.departamento_judicial)";
      case $p.'max_departamento_judicial': return "MAX({$t}.departamento_judicial)";
      case $p.'count_departamento_judicial': return "COUNT({$t}.departamento_judicial)";

      case $p.'min_departamento_judicial_informado': return "MIN({$t}.departamento_judicial_informado)";
      case $p.'max_departamento_judicial_informado': return "MAX({$t}.departamento_judicial_informado)";
      case $p.'count_departamento_judicial_informado': return "COUNT({$t}.departamento_judicial_informado)";

      case $p.'min_tipo_documento': return "MIN({$t}.tipo_documento)";
      case $p.'max_tipo_documento': return "MAX({$t}.tipo_documento)";
      case $p.'count_tipo_documento': return "COUNT({$t}.tipo_documento)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('cargo', 'car')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('organo', 'org')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('departamento_judicial', 'dj')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('departamento_judicial', 'dji')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_documento', 'td')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingField($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingField($p.'legajo') . ' AS ' . $p.'legajo, ' . $this->_mappingField($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingField($p.'telefono_laboral') . ' AS ' . $p.'telefono_laboral, ' . $this->_mappingField($p.'telefono_particular') . ' AS ' . $p.'telefono_particular, ' . $this->_mappingField($p.'fecha_nacimiento') . ' AS ' . $p.'fecha_nacimiento, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'eliminado') . ' AS ' . $p.'eliminado, ' . $this->_mappingField($p.'cargo') . ' AS ' . $p.'cargo, ' . $this->_mappingField($p.'organo') . ' AS ' . $p.'organo, ' . $this->_mappingField($p.'departamento_judicial') . ' AS ' . $p.'departamento_judicial, ' . $this->_mappingField($p.'departamento_judicial_informado') . ' AS ' . $p.'departamento_judicial_informado, ' . $this->_mappingField($p.'tipo_documento') . ' AS ' . $p.'tipo_documento';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombres') . ', ' . $this->_mappingField($p.'apellidos') . ', ' . $this->_mappingField($p.'legajo') . ', ' . $this->_mappingField($p.'numero_documento') . ', ' . $this->_mappingField($p.'telefono_laboral') . ', ' . $this->_mappingField($p.'telefono_particular') . ', ' . $this->_mappingField($p.'fecha_nacimiento') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'eliminado') . ', ' . $this->_mappingField($p.'cargo') . ', ' . $this->_mappingField($p.'organo') . ', ' . $this->_mappingField($p.'departamento_judicial') . ', ' . $this->_mappingField($p.'departamento_judicial_informado') . ', ' . $this->_mappingField($p.'tipo_documento') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('cargo', 'car')->_fields() . ',
' . EntitySql::getInstanceRequire('organo', 'org')->_fields() . ',
' . EntitySql::getInstanceRequire('departamento_judicial', 'dj')->_fields() . ',
' . EntitySql::getInstanceRequire('departamento_judicial', 'dji')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_documento', 'td')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('cargo', 'car')->_join('cargo', 'pers', $render) . '
' . EntitySql::getInstanceRequire('organo', 'org')->_join('organo', 'pers', $render) . '
' . EntitySql::getInstanceRequire('departamento_judicial', 'dj')->_join('departamento_judicial', 'pers', $render) . '
' . EntitySql::getInstanceRequire('departamento_judicial', 'dji')->_join('departamento_judicial_informado', 'pers', $render) . '
' . EntitySql::getInstanceRequire('tipo_documento', 'td')->_join('tipo_documento', 'pers', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombres": return $this->format->conditionText($f, $value, $option);
      case "{$p}apellidos": return $this->format->conditionText($f, $value, $option);
      case "{$p}legajo": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero_documento": return $this->format->conditionText($f, $value, $option);
      case "{$p}telefono_laboral": return $this->format->conditionText($f, $value, $option);
      case "{$p}telefono_particular": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_nacimiento": return $this->format->conditionDate($f, $value, $option);
      case "{$p}email": return $this->format->conditionText($f, $value, $option);
      case "{$p}creado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}eliminado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}cargo": return $this->format->conditionText($f, $value, $option);
      case "{$p}organo": return $this->format->conditionText($f, $value, $option);
      case "{$p}departamento_judicial": return $this->format->conditionText($f, $value, $option);
      case "{$p}departamento_judicial_informado": return $this->format->conditionText($f, $value, $option);
      case "{$p}tipo_documento": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_nombres": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_nombres": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_nombres": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_apellidos": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_apellidos": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_apellidos": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_legajo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_legajo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_legajo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_numero_documento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_numero_documento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_numero_documento": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_telefono_laboral": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_telefono_laboral": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_telefono_laboral": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_telefono_particular": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_telefono_particular": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_telefono_particular": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_fecha_nacimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_fecha_nacimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_fecha_nacimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_fecha_nacimiento": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_email": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_email": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_email": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_creado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_eliminado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_cargo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_cargo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_cargo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_organo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_organo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_organo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_departamento_judicial": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_departamento_judicial": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_departamento_judicial": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_departamento_judicial_informado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_departamento_judicial_informado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_departamento_judicial_informado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_tipo_documento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_tipo_documento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_tipo_documento": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('organo','org')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','dj')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','dji')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_documento','td')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('organo','org')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','dj')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','dji')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_documento','td')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->string($row['id']);
    if(isset($row['nombres'])) $row_['nombres'] = $this->format->string($row['nombres']);
    if(isset($row['apellidos'])) $row_['apellidos'] = $this->format->string($row['apellidos']);
    if(isset($row['legajo'])) $row_['legajo'] = $this->format->string($row['legajo']);
    if(isset($row['numero_documento'])) $row_['numero_documento'] = $this->format->string($row['numero_documento']);
    if(isset($row['telefono_laboral'])) $row_['telefono_laboral'] = $this->format->string($row['telefono_laboral']);
    if(isset($row['telefono_particular'])) $row_['telefono_particular'] = $this->format->string($row['telefono_particular']);
    if(isset($row['fecha_nacimiento'])) $row_['fecha_nacimiento'] = $this->format->date($row['fecha_nacimiento']);
    if(isset($row['email'])) $row_['email'] = $this->format->string($row['email']);
    if(isset($row['creado'])) $row_['creado'] = $this->format->timestamp($row['creado']);
    if(isset($row['eliminado'])) $row_['eliminado'] = $this->format->timestamp($row['eliminado']);
    if(isset($row['cargo'])) $row_['cargo'] = $this->format->string($row['cargo']);
    if(isset($row['organo'])) $row_['organo'] = $this->format->string($row['organo']);
    if(isset($row['departamento_judicial'])) $row_['departamento_judicial'] = $this->format->string($row['departamento_judicial']);
    if(isset($row['departamento_judicial_informado'])) $row_['departamento_judicial_informado'] = $this->format->string($row['departamento_judicial_informado']);
    if(isset($row['tipo_documento'])) $row_['tipo_documento'] = $this->format->string($row['tipo_documento']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nombres"] = (is_null($row[$prefix . "nombres"])) ? null : (string)$row[$prefix . "nombres"];
    $row_["apellidos"] = (is_null($row[$prefix . "apellidos"])) ? null : (string)$row[$prefix . "apellidos"];
    $row_["legajo"] = (is_null($row[$prefix . "legajo"])) ? null : (string)$row[$prefix . "legajo"];
    $row_["numero_documento"] = (is_null($row[$prefix . "numero_documento"])) ? null : (string)$row[$prefix . "numero_documento"];
    $row_["telefono_laboral"] = (is_null($row[$prefix . "telefono_laboral"])) ? null : (string)$row[$prefix . "telefono_laboral"];
    $row_["telefono_particular"] = (is_null($row[$prefix . "telefono_particular"])) ? null : (string)$row[$prefix . "telefono_particular"];
    $row_["fecha_nacimiento"] = (is_null($row[$prefix . "fecha_nacimiento"])) ? null : (string)$row[$prefix . "fecha_nacimiento"];
    $row_["email"] = (is_null($row[$prefix . "email"])) ? null : (string)$row[$prefix . "email"];
    $row_["creado"] = (is_null($row[$prefix . "creado"])) ? null : (string)$row[$prefix . "creado"];
    $row_["eliminado"] = (is_null($row[$prefix . "eliminado"])) ? null : (string)$row[$prefix . "eliminado"];
    $row_["cargo"] = (is_null($row[$prefix . "cargo"])) ? null : (string)$row[$prefix . "cargo"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["organo"] = (is_null($row[$prefix . "organo"])) ? null : (string)$row[$prefix . "organo"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["departamento_judicial"] = (is_null($row[$prefix . "departamento_judicial"])) ? null : (string)$row[$prefix . "departamento_judicial"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["departamento_judicial_informado"] = (is_null($row[$prefix . "departamento_judicial_informado"])) ? null : (string)$row[$prefix . "departamento_judicial_informado"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["tipo_documento"] = (is_null($row[$prefix . "tipo_documento"])) ? null : (string)$row[$prefix . "tipo_documento"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
