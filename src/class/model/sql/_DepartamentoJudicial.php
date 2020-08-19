<?php
require_once("class/model/Sql.php");

class _DepartamentoJudicialSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('departamento_judicial');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'codigo': return $t.".codigo";
      case $p.'nombre': return $t.".nombre";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_codigo': return "MIN({$t}.codigo)";
      case $p.'max_codigo': return "MAX({$t}.codigo)";
      case $p.'count_codigo': return "COUNT({$t}.codigo)";

      case $p.'min_nombre': return "MIN({$t}.nombre)";
      case $p.'max_nombre': return "MAX({$t}.nombre)";
      case $p.'count_nombre': return "COUNT({$t}.nombre)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.codigo, {$t}.nombre)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'codigo') . ' AS ' . $p.'codigo, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'codigo') . ', ' . $this->_mappingField($p.'nombre') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}codigo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}codigo"), $value, $option);

      case "{$p}nombre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombre"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_codigo"), $value, $option);

      case "{$p}min_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_codigo"), $value, $option);

      case "{$p}count_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_codigo"), $value, $option);


      case "{$p}max_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombre"), $value, $option);

      case "{$p}min_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombre"), $value, $option);

      case "{$p}count_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombre"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('codigo', $row)) $row_['codigo'] = $this->format->string($row['codigo']);
    if(array_key_exists('nombre', $row)) $row_['nombre'] = $this->format->string($row['nombre']);

    return $row_;
  }


}
