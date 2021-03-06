<?php
require_once("class/model/Sql.php");

class _AfiliacionSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'motivo': return $t.".motivo";
      case $p.'estado': return $t.".estado";
      case $p.'creado': return $t.".creado";
      case $p.'creado_date': return "CAST({$t}.creado AS DATE)";
      case $p.'creado_ym': return "DATE_FORMAT({$t}.creado, '%Y-%m')";
      case $p.'creado_y': return "DATE_FORMAT({$t}.creado, '%Y')";
      case $p.'enviado': return $t.".enviado";
      case $p.'enviado_date': return "CAST({$t}.enviado AS DATE)";
      case $p.'enviado_ym': return "DATE_FORMAT({$t}.enviado, '%Y-%m')";
      case $p.'enviado_y': return "DATE_FORMAT({$t}.enviado, '%Y')";
      case $p.'evaluado': return $t.".evaluado";
      case $p.'evaluado_date': return "CAST({$t}.evaluado AS DATE)";
      case $p.'evaluado_ym': return "DATE_FORMAT({$t}.evaluado, '%Y-%m')";
      case $p.'evaluado_y': return "DATE_FORMAT({$t}.evaluado, '%Y')";
      case $p.'modificado': return $t.".modificado";
      case $p.'modificado_date': return "CAST({$t}.modificado AS DATE)";
      case $p.'modificado_ym': return "DATE_FORMAT({$t}.modificado, '%Y-%m')";
      case $p.'modificado_y': return "DATE_FORMAT({$t}.modificado, '%Y')";
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
    if($f = $this->container->getSql('persona', 'per')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('cargo', 'per_car')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('organo', 'per_org')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('departamento_judicial', 'per_dj')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('departamento_judicial', 'per_dji')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('tipo_documento', 'per_td')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'motivo') . ' AS ' . $p.'motivo, ' . $this->_mappingField($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'enviado') . ' AS ' . $p.'enviado, ' . $this->_mappingField($p.'evaluado') . ' AS ' . $p.'evaluado, ' . $this->_mappingField($p.'modificado') . ' AS ' . $p.'modificado, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'motivo') . ', ' . $this->_mappingField($p.'estado') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'enviado') . ', ' . $this->_mappingField($p.'evaluado') . ', ' . $this->_mappingField($p.'modificado') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('persona', 'per')->_fields() . ',
' . $this->container->getSql('cargo', 'per_car')->_fields() . ',
' . $this->container->getSql('organo', 'per_org')->_fields() . ',
' . $this->container->getSql('departamento_judicial', 'per_dj')->_fields() . ',
' . $this->container->getSql('departamento_judicial', 'per_dji')->_fields() . ',
' . $this->container->getSql('tipo_documento', 'per_td')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('persona', 'per')->_join('persona', 'afil', $render) . '
' . $this->container->getSql('cargo', 'per_car')->_join('cargo', 'per', $render) . '
' . $this->container->getSql('organo', 'per_org')->_join('organo', 'per', $render) . '
' . $this->container->getSql('departamento_judicial', 'per_dj')->_join('departamento_judicial', 'per', $render) . '
' . $this->container->getSql('departamento_judicial', 'per_dji')->_join('departamento_judicial_informado', 'per', $render) . '
' . $this->container->getSql('tipo_documento', 'per_td')->_join('tipo_documento', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}motivo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}motivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}motivo"), $value, $option);

      case "{$p}estado": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}estado"), $value, $option);

      case "{$p}creado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}creado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}creado"), $value, $option);
      case "{$p}creado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}creado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}enviado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}enviado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}enviado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}enviado"), $value, $option);
      case "{$p}enviado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}enviado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}evaluado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}evaluado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}evaluado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}evaluado"), $value, $option);
      case "{$p}evaluado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}evaluado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}modificado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}modificado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}modificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}modificado"), $value, $option);
      case "{$p}modificado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}modificado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}observaciones": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}observaciones"), $value, $option);

      case "{$p}persona": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}persona"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_motivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_motivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_motivo"), $value, $option);

      case "{$p}min_motivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_motivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_motivo"), $value, $option);

      case "{$p}count_motivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_motivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_motivo"), $value, $option);


      case "{$p}max_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_estado"), $value, $option);

      case "{$p}min_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_estado"), $value, $option);

      case "{$p}count_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_estado"), $value, $option);


      case "{$p}avg_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_creado"), $value, $option);

      case "{$p}max_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_creado"), $value, $option);

      case "{$p}min_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_creado"), $value, $option);

      case "{$p}count_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_creado"), $value, $option);


      case "{$p}avg_enviado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_enviado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_enviado"), $value, $option);

      case "{$p}max_enviado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_enviado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_enviado"), $value, $option);

      case "{$p}min_enviado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_enviado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_enviado"), $value, $option);

      case "{$p}count_enviado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_enviado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_enviado"), $value, $option);


      case "{$p}avg_evaluado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_evaluado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_evaluado"), $value, $option);

      case "{$p}max_evaluado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_evaluado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_evaluado"), $value, $option);

      case "{$p}min_evaluado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_evaluado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_evaluado"), $value, $option);

      case "{$p}count_evaluado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_evaluado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_evaluado"), $value, $option);


      case "{$p}avg_modificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_modificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_modificado"), $value, $option);

      case "{$p}max_modificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_modificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_modificado"), $value, $option);

      case "{$p}min_modificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_modificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_modificado"), $value, $option);

      case "{$p}count_modificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_modificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_modificado"), $value, $option);


      case "{$p}max_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_observaciones"), $value, $option);

      case "{$p}min_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_observaciones"), $value, $option);

      case "{$p}count_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_observaciones"), $value, $option);


      case "{$p}max_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_persona"), $value, $option);

      case "{$p}min_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_persona"), $value, $option);

      case "{$p}count_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_persona"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','per_car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('organo','per_org')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','per_dj')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','per_dji')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_documento','per_td')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','per_car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('organo','per_org')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','per_dj')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','per_dji')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_documento','per_td')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('motivo', $row)) $row_['motivo'] = $this->format->string($row['motivo']);
    if(array_key_exists('estado', $row)) $row_['estado'] = $this->format->string($row['estado']);
    if(array_key_exists('creado', $row)) $row_['creado'] = $this->format->dateTime($row['creado'], "Y-m-d H:i:s");
    if(array_key_exists('enviado', $row)) $row_['enviado'] = $this->format->dateTime($row['enviado'], "Y-m-d H:i:s");
    if(array_key_exists('evaluado', $row)) $row_['evaluado'] = $this->format->dateTime($row['evaluado'], "Y-m-d H:i:s");
    if(array_key_exists('modificado', $row)) $row_['modificado'] = $this->format->dateTime($row['modificado'], "Y-m-d H:i:s");
    if(array_key_exists('observaciones', $row)) $row_['observaciones'] = $this->format->string($row['observaciones']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }


}
