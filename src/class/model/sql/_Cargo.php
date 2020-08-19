<?php
require_once("class/model/Sql.php");

class _CargoSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('cargo');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'descripcion': return $t.".descripcion";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_descripcion': return "MIN({$t}.descripcion)";
      case $p.'max_descripcion': return "MAX({$t}.descripcion)";
      case $p.'count_descripcion': return "COUNT({$t}.descripcion)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.descripcion)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'descripcion') . ' AS ' . $p.'descripcion';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'descripcion') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}descripcion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}descripcion"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_descripcion"), $value, $option);

      case "{$p}min_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_descripcion"), $value, $option);

      case "{$p}count_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_descripcion"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('descripcion', $row)) $row_['descripcion'] = $this->format->string($row['descripcion']);

    return $row_;
  }


}
