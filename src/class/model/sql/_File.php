<?php
require_once("class/model/Sql.php");

class _FileSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'name': return $t.".name";
      case $p.'type': return $t.".type";
      case $p.'content': return $t.".content";
      case $p.'size': return $t.".size";
      case $p.'created': return $t.".created";
      case $p.'created_date': return "CAST({$t}.created AS DATE)";
      case $p.'created_ym': return "DATE_FORMAT({$t}.created, '%Y-%m')";
      case $p.'created_y': return "DATE_FORMAT({$t}.created, '%Y')";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_name': return "MIN({$t}.name)";
      case $p.'max_name': return "MAX({$t}.name)";
      case $p.'count_name': return "COUNT({$t}.name)";

      case $p.'min_type': return "MIN({$t}.type)";
      case $p.'max_type': return "MAX({$t}.type)";
      case $p.'count_type': return "COUNT({$t}.type)";

      case $p.'min_content': return "MIN({$t}.content)";
      case $p.'max_content': return "MAX({$t}.content)";
      case $p.'count_content': return "COUNT({$t}.content)";

      case $p.'sum_size': return "SUM({$t}.size)";
      case $p.'avg_size': return "AVG({$t}.size)";
      case $p.'min_size': return "MIN({$t}.size)";
      case $p.'max_size': return "MAX({$t}.size)";
      case $p.'count_size': return "COUNT({$t}.size)";

      case $p.'avg_created': return "AVG({$t}.created)";
      case $p.'min_created': return "MIN({$t}.created)";
      case $p.'max_created': return "MAX({$t}.created)";
      case $p.'count_created': return "COUNT({$t}.created)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'name') . ' AS ' . $p.'name, ' . $this->_mappingField($p.'type') . ' AS ' . $p.'type, ' . $this->_mappingField($p.'content') . ' AS ' . $p.'content, ' . $this->_mappingField($p.'size') . ' AS ' . $p.'size, ' . $this->_mappingField($p.'created') . ' AS ' . $p.'created';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'name') . ', ' . $this->_mappingField($p.'type') . ', ' . $this->_mappingField($p.'content') . ', ' . $this->_mappingField($p.'size') . ', ' . $this->_mappingField($p.'created') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}name": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}name_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}name"), $value, $option);

      case "{$p}type": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}type_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}type"), $value, $option);

      case "{$p}content": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}content_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}content"), $value, $option);

      case "{$p}size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}size"), $value, $option);

      case "{$p}created": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d H:i:s");
      case "{$p}created_date": return $this->format->conditionDateTime($this->_mappingField($field), $value, $option, "Y-m-d");
      case "{$p}created_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}created"), $value, $option);
      case "{$p}created_ym": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y-m");
      case "{$p}created_y": return $this->format->conditionDateTimeAux($this->_mappingField($field), $value, $option, "Y");


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_name": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_name_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_name"), $value, $option);

      case "{$p}min_name": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_name_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_name"), $value, $option);

      case "{$p}count_name": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_name_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_name"), $value, $option);


      case "{$p}max_type": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_type_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_type"), $value, $option);

      case "{$p}min_type": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_type_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_type"), $value, $option);

      case "{$p}count_type": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_type_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_type"), $value, $option);


      case "{$p}max_content": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_content_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_content"), $value, $option);

      case "{$p}min_content": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_content_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_content"), $value, $option);

      case "{$p}count_content": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_content_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_content"), $value, $option);


      case "{$p}sum_size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}sum_size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sum_size"), $value, $option);

      case "{$p}avg_size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_size"), $value, $option);

      case "{$p}max_size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_size"), $value, $option);

      case "{$p}min_size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_size"), $value, $option);

      case "{$p}count_size": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_size_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_size"), $value, $option);


      case "{$p}avg_created": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_created_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_created"), $value, $option);

      case "{$p}max_created": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_created_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_created"), $value, $option);

      case "{$p}min_created": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_created_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_created"), $value, $option);

      case "{$p}count_created": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_created_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_created"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('name', $row)) $row_['name'] = $this->format->string($row['name']);
    if(array_key_exists('type', $row)) $row_['type'] = $this->format->string($row['type']);
    if(array_key_exists('content', $row)) $row_['content'] = $this->format->string($row['content']);
    if(array_key_exists('size', $row)) $row_['size'] = $this->format->numeric($row['size']);
    if(array_key_exists('created', $row)) $row_['created'] = $this->format->dateTime($row['created'], "Y-m-d H:i:s");

    return $row_;
  }


}
