<?php
require_once("class/model/Sql.php");

class _PersonaSql extends EntitySql{

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
      case $p.'creado_date': return "CAST({$t}.creado AS DATE)";
      case $p.'creado_ym': return "DATE_FORMAT({$t}.creado, '%Y-%m')";
      case $p.'creado_y': return "DATE_FORMAT({$t}.creado, '%Y')";
      case $p.'eliminado': return $t.".eliminado";
      case $p.'eliminado_date': return "CAST({$t}.eliminado AS DATE)";
      case $p.'eliminado_ym': return "DATE_FORMAT({$t}.eliminado, '%Y-%m')";
      case $p.'eliminado_y': return "DATE_FORMAT({$t}.eliminado, '%Y')";
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

      case $p.'_label': return "CONCAT_WS(' ', {$t}.nombres, {$t}.apellidos, {$t}.legajo)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('cargo', 'car')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('organo', 'org')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('departamento_judicial', 'dj')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('departamento_judicial', 'dji')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('tipo_documento', 'td')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingField($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingField($p.'legajo') . ' AS ' . $p.'legajo, ' . $this->_mappingField($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingField($p.'telefono_laboral') . ' AS ' . $p.'telefono_laboral, ' . $this->_mappingField($p.'telefono_particular') . ' AS ' . $p.'telefono_particular, ' . $this->_mappingField($p.'fecha_nacimiento') . ' AS ' . $p.'fecha_nacimiento, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'eliminado') . ' AS ' . $p.'eliminado, ' . $this->_mappingField($p.'cargo') . ' AS ' . $p.'cargo, ' . $this->_mappingField($p.'organo') . ' AS ' . $p.'organo, ' . $this->_mappingField($p.'departamento_judicial') . ' AS ' . $p.'departamento_judicial, ' . $this->_mappingField($p.'departamento_judicial_informado') . ' AS ' . $p.'departamento_judicial_informado, ' . $this->_mappingField($p.'tipo_documento') . ' AS ' . $p.'tipo_documento';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombres') . ', ' . $this->_mappingField($p.'apellidos') . ', ' . $this->_mappingField($p.'legajo') . ', ' . $this->_mappingField($p.'numero_documento') . ', ' . $this->_mappingField($p.'telefono_laboral') . ', ' . $this->_mappingField($p.'telefono_particular') . ', ' . $this->_mappingField($p.'fecha_nacimiento') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'eliminado') . ', ' . $this->_mappingField($p.'cargo') . ', ' . $this->_mappingField($p.'organo') . ', ' . $this->_mappingField($p.'departamento_judicial') . ', ' . $this->_mappingField($p.'departamento_judicial_informado') . ', ' . $this->_mappingField($p.'tipo_documento') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('cargo', 'car')->_fields() . ',
' . $this->container->getSql('organo', 'org')->_fields() . ',
' . $this->container->getSql('departamento_judicial', 'dj')->_fields() . ',
' . $this->container->getSql('departamento_judicial', 'dji')->_fields() . ',
' . $this->container->getSql('tipo_documento', 'td')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('cargo', 'car')->_join('cargo', 'pers', $render) . '
' . $this->container->getSql('organo', 'org')->_join('organo', 'pers', $render) . '
' . $this->container->getSql('departamento_judicial', 'dj')->_join('departamento_judicial', 'pers', $render) . '
' . $this->container->getSql('departamento_judicial', 'dji')->_join('departamento_judicial_informado', 'pers', $render) . '
' . $this->container->getSql('tipo_documento', 'td')->_join('tipo_documento', 'pers', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}nombres": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombres"), $value, $option);

      case "{$p}apellidos": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}apellidos"), $value, $option);

      case "{$p}legajo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}legajo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}legajo"), $value, $option);

      case "{$p}numero_documento": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero_documento"), $value, $option);

      case "{$p}telefono_laboral": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}telefono_laboral_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}telefono_laboral"), $value, $option);

      case "{$p}telefono_particular": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}telefono_particular_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}telefono_particular"), $value, $option);

      case "{$p}fecha_nacimiento": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fecha_nacimiento"), $value, $option);

      case "{$p}email": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}email"), $value, $option);

      case "{$p}creado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}creado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}creado"), $value, $option);
      case "{$p}creado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}creado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}eliminado": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}eliminado_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}eliminado"), $value, $option);
      case "{$p}eliminado_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}eliminado_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");

      case "{$p}cargo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}cargo"), $value, $option);

      case "{$p}organo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}organo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}organo"), $value, $option);

      case "{$p}departamento_judicial": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}departamento_judicial_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}departamento_judicial"), $value, $option);

      case "{$p}departamento_judicial_informado": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}departamento_judicial_informado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}departamento_judicial_informado"), $value, $option);

      case "{$p}tipo_documento": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}tipo_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}tipo_documento"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombres"), $value, $option);

      case "{$p}min_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombres"), $value, $option);

      case "{$p}count_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombres"), $value, $option);


      case "{$p}max_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_apellidos"), $value, $option);

      case "{$p}min_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_apellidos"), $value, $option);

      case "{$p}count_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_apellidos"), $value, $option);


      case "{$p}max_legajo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_legajo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_legajo"), $value, $option);

      case "{$p}min_legajo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_legajo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_legajo"), $value, $option);

      case "{$p}count_legajo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_legajo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_legajo"), $value, $option);


      case "{$p}max_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_numero_documento"), $value, $option);

      case "{$p}min_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_numero_documento"), $value, $option);

      case "{$p}count_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_numero_documento"), $value, $option);


      case "{$p}max_telefono_laboral": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_telefono_laboral_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_telefono_laboral"), $value, $option);

      case "{$p}min_telefono_laboral": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_telefono_laboral_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_telefono_laboral"), $value, $option);

      case "{$p}count_telefono_laboral": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_telefono_laboral_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_telefono_laboral"), $value, $option);


      case "{$p}max_telefono_particular": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_telefono_particular_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_telefono_particular"), $value, $option);

      case "{$p}min_telefono_particular": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_telefono_particular_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_telefono_particular"), $value, $option);

      case "{$p}count_telefono_particular": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_telefono_particular_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_telefono_particular"), $value, $option);


      case "{$p}avg_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fecha_nacimiento"), $value, $option);

      case "{$p}max_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fecha_nacimiento"), $value, $option);

      case "{$p}min_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fecha_nacimiento"), $value, $option);

      case "{$p}count_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fecha_nacimiento"), $value, $option);


      case "{$p}max_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_email"), $value, $option);

      case "{$p}min_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_email"), $value, $option);

      case "{$p}count_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_email"), $value, $option);


      case "{$p}avg_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_creado"), $value, $option);

      case "{$p}max_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_creado"), $value, $option);

      case "{$p}min_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_creado"), $value, $option);

      case "{$p}count_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_creado"), $value, $option);


      case "{$p}avg_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_eliminado"), $value, $option);

      case "{$p}max_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_eliminado"), $value, $option);

      case "{$p}min_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_eliminado"), $value, $option);

      case "{$p}count_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_eliminado"), $value, $option);


      case "{$p}max_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_cargo"), $value, $option);

      case "{$p}min_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_cargo"), $value, $option);

      case "{$p}count_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_cargo"), $value, $option);


      case "{$p}max_organo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_organo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_organo"), $value, $option);

      case "{$p}min_organo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_organo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_organo"), $value, $option);

      case "{$p}count_organo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_organo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_organo"), $value, $option);


      case "{$p}max_departamento_judicial": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_departamento_judicial_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_departamento_judicial"), $value, $option);

      case "{$p}min_departamento_judicial": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_departamento_judicial_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_departamento_judicial"), $value, $option);

      case "{$p}count_departamento_judicial": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_departamento_judicial_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_departamento_judicial"), $value, $option);


      case "{$p}max_departamento_judicial_informado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_departamento_judicial_informado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_departamento_judicial_informado"), $value, $option);

      case "{$p}min_departamento_judicial_informado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_departamento_judicial_informado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_departamento_judicial_informado"), $value, $option);

      case "{$p}count_departamento_judicial_informado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_departamento_judicial_informado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_departamento_judicial_informado"), $value, $option);


      case "{$p}max_tipo_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_tipo_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_tipo_documento"), $value, $option);

      case "{$p}min_tipo_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_tipo_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_tipo_documento"), $value, $option);

      case "{$p}count_tipo_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_tipo_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_tipo_documento"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('organo','org')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','dj')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','dji')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_documento','td')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('organo','org')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','dj')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('departamento_judicial','dji')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_documento','td')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('nombres', $row)) $row_['nombres'] = $this->format->string($row['nombres']);
    if(array_key_exists('apellidos', $row)) $row_['apellidos'] = $this->format->string($row['apellidos']);
    if(array_key_exists('legajo', $row)) $row_['legajo'] = $this->format->string($row['legajo']);
    if(array_key_exists('numero_documento', $row)) $row_['numero_documento'] = $this->format->string($row['numero_documento']);
    if(array_key_exists('telefono_laboral', $row)) $row_['telefono_laboral'] = $this->format->string($row['telefono_laboral']);
    if(array_key_exists('telefono_particular', $row)) $row_['telefono_particular'] = $this->format->string($row['telefono_particular']);
    if(array_key_exists('fecha_nacimiento', $row)) $row_['fecha_nacimiento'] = $this->format->dateTime($row['fecha_nacimiento'], "Y-m-d");
    if(array_key_exists('email', $row)) $row_['email'] = $this->format->string($row['email']);
    if(array_key_exists('creado', $row)) $row_['creado'] = $this->format->dateTime($row['creado'], "Y-m-d H:i:s");
    if(array_key_exists('eliminado', $row)) $row_['eliminado'] = $this->format->dateTime($row['eliminado'], "Y-m-d H:i:s");
    if(array_key_exists('cargo', $row)) $row_['cargo'] = $this->format->string($row['cargo']);
    if(array_key_exists('organo', $row)) $row_['organo'] = $this->format->string($row['organo']);
    if(array_key_exists('departamento_judicial', $row)) $row_['departamento_judicial'] = $this->format->string($row['departamento_judicial']);
    if(array_key_exists('departamento_judicial_informado', $row)) $row_['departamento_judicial_informado'] = $this->format->string($row['departamento_judicial_informado']);
    if(array_key_exists('tipo_documento', $row)) $row_['tipo_documento'] = $this->format->string($row['tipo_documento']);

    return $row_;
  }


}
