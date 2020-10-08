<?php
require_once("class/model/Rel.php");

class _AfiliacionRel extends EntityRel{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('persona', 'per')->_eval($field)) return $f;
    if($f = $this->container->getMapping('cargo', 'per_car')->_eval($field)) return $f;
    if($f = $this->container->getMapping('organo', 'per_org')->_eval($field)) return $f;
    if($f = $this->container->getMapping('departamento_judicial', 'per_dj')->_eval($field)) return $f;
    if($f = $this->container->getMapping('departamento_judicial', 'per_dji')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_documento', 'per_td')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('persona', 'per')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('cargo', 'per_car')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('organo', 'per_org')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('departamento_judicial', 'per_dj')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('departamento_judicial', 'per_dji')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_documento', 'per_td')->_toArray()) . ' 
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

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('cargo','per_car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('organo','per_org')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('departamento_judicial','per_dj')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('departamento_judicial','per_dji')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_documento','per_td')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('cargo','per_car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('organo','per_org')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('departamento_judicial','per_dj')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('departamento_judicial','per_dji')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_documento','per_td')->_eval($field, [$option, $value])) return $c;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_id'])) $row_["persona_"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_car_id'])) $row_["persona_"]["cargo_"] = $this->container->getValue('cargo', 'per_car')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_org_id'])) $row_["persona_"]["organo_"] = $this->container->getValue('organo', 'per_org')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dj_id'])) $row_["persona_"]["departamento_judicial_"] = $this->container->getValue('departamento_judicial', 'per_dj')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dji_id'])) $row_["persona_"]["departamento_judicial_informado_"] = $this->container->getValue('departamento_judicial', 'per_dji')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_td_id'])) $row_["persona_"]["tipo_documento_"] = $this->container->getValue('tipo_documento', 'per_td')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["afiliacion"] = $this->container->getValue("afiliacion")->_fromArray($row, "set");
    $row_["persona"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set");
    $row_["cargo"] = $this->container->getValue('cargo', 'per_car')->_fromArray($row, "set");
    $row_["organo"] = $this->container->getValue('organo', 'per_org')->_fromArray($row, "set");
    $row_["departamento_judicial"] = $this->container->getValue('departamento_judicial', 'per_dj')->_fromArray($row, "set");
    $row_["departamento_judicial_informado"] = $this->container->getValue('departamento_judicial', 'per_dji')->_fromArray($row, "set");
    $row_["tipo_documento"] = $this->container->getValue('tipo_documento', 'per_td')->_fromArray($row, "set");
    return $row_;
  }



}
