<?php
require_once("class/model/Sql.php");

class _AfiliacionSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('afiliacion');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'motivo': return $t.".motivo";
      case $p.'estado': return $t.".estado";
      case $p.'creado': return $t.".creado";
      case $p.'enviado': return $t.".enviado";
      case $p.'evaluado': return $t.".evaluado";
      case $p.'modificado': return $t.".modificado";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_motivo': return "MIN({$t}.motivo)";
      case $p.'max_motivo': return "MAX({$t}.motivo)";
      case $p.'count_motivo': return "COUNT({$t}.motivo)";

      case $p.'min_estado': return "MIN({$t}.estado)";
      case $p.'max_estado': return "MAX({$t}.estado)";
      case $p.'count_estado': return "COUNT({$t}.estado)";

      case $p.'avg_creado': return "AVG({$t}.creado)";
      case $p.'min_creado': return "MIN({$t}.creado)";
      case $p.'max_creado': return "MAX({$t}.creado)";
      case $p.'count_creado': return "COUNT({$t}.creado)";

      case $p.'avg_enviado': return "AVG({$t}.enviado)";
      case $p.'min_enviado': return "MIN({$t}.enviado)";
      case $p.'max_enviado': return "MAX({$t}.enviado)";
      case $p.'count_enviado': return "COUNT({$t}.enviado)";

      case $p.'avg_evaluado': return "AVG({$t}.evaluado)";
      case $p.'min_evaluado': return "MIN({$t}.evaluado)";
      case $p.'max_evaluado': return "MAX({$t}.evaluado)";
      case $p.'count_evaluado': return "COUNT({$t}.evaluado)";

      case $p.'avg_modificado': return "AVG({$t}.modificado)";
      case $p.'min_modificado': return "MIN({$t}.modificado)";
      case $p.'max_modificado': return "MAX({$t}.modificado)";
      case $p.'count_modificado': return "COUNT({$t}.modificado)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'per')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('cargo', 'per_car')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('organo', 'per_org')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('departamento_judicial', 'per_dj')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('departamento_judicial', 'per_dji')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_documento', 'per_td')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'motivo') . ' AS ' . $p.'motivo, ' . $this->_mappingField($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'enviado') . ' AS ' . $p.'enviado, ' . $this->_mappingField($p.'evaluado') . ' AS ' . $p.'evaluado, ' . $this->_mappingField($p.'modificado') . ' AS ' . $p.'modificado, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'motivo') . ', ' . $this->_mappingField($p.'estado') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'enviado') . ', ' . $this->_mappingField($p.'evaluado') . ', ' . $this->_mappingField($p.'modificado') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . ',
' . EntitySql::getInstanceRequire('cargo', 'per_car')->_fields() . ',
' . EntitySql::getInstanceRequire('organo', 'per_org')->_fields() . ',
' . EntitySql::getInstanceRequire('departamento_judicial', 'per_dj')->_fields() . ',
' . EntitySql::getInstanceRequire('departamento_judicial', 'per_dji')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_documento', 'per_td')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'afil', $render) . '
' . EntitySql::getInstanceRequire('cargo', 'per_car')->_join('cargo', 'per', $render) . '
' . EntitySql::getInstanceRequire('organo', 'per_org')->_join('organo', 'per', $render) . '
' . EntitySql::getInstanceRequire('departamento_judicial', 'per_dj')->_join('departamento_judicial', 'per', $render) . '
' . EntitySql::getInstanceRequire('departamento_judicial', 'per_dji')->_join('departamento_judicial_informado', 'per', $render) . '
' . EntitySql::getInstanceRequire('tipo_documento', 'per_td')->_join('tipo_documento', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}motivo": return $this->format->conditionText($f, $value, $option);
      case "{$p}estado": return $this->format->conditionText($f, $value, $option);
      case "{$p}creado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}enviado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}evaluado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}modificado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}persona": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_motivo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_motivo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_motivo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_estado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_estado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_estado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_creado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_enviado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_enviado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_enviado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_enviado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_evaluado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_evaluado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_evaluado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_evaluado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_modificado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_modificado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_modificado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_modificado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_observaciones": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_persona": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','per_car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('organo','per_org')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','per_dj')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','per_dji')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_documento','per_td')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','per_car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('organo','per_org')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','per_dj')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('departamento_judicial','per_dji')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_documento','per_td')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('motivo', $row)) $row_['motivo'] = $this->format->string($row['motivo']);
    if(array_key_exists('estado', $row)) $row_['estado'] = $this->format->string($row['estado']);
    if(array_key_exists('creado', $row)) $row_['creado'] = $this->format->timestamp($row['creado']);
    if(array_key_exists('enviado', $row)) $row_['enviado'] = $this->format->timestamp($row['enviado']);
    if(array_key_exists('evaluado', $row)) $row_['evaluado'] = $this->format->timestamp($row['evaluado']);
    if(array_key_exists('modificado', $row)) $row_['modificado'] = $this->format->timestamp($row['modificado']);
    if(array_key_exists('observaciones', $row)) $row_['observaciones'] = $this->format->string($row['observaciones']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["motivo"] = (is_null($row[$prefix . "motivo"])) ? null : (string)$row[$prefix . "motivo"];
    $row_["estado"] = (is_null($row[$prefix . "estado"])) ? null : (string)$row[$prefix . "estado"];
    $row_["creado"] = (is_null($row[$prefix . "creado"])) ? null : (string)$row[$prefix . "creado"];
    $row_["enviado"] = (is_null($row[$prefix . "enviado"])) ? null : (string)$row[$prefix . "enviado"];
    $row_["evaluado"] = (is_null($row[$prefix . "evaluado"])) ? null : (string)$row[$prefix . "evaluado"];
    $row_["modificado"] = (is_null($row[$prefix . "modificado"])) ? null : (string)$row[$prefix . "modificado"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
