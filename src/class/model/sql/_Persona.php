<?php
require_once("class/model/Sql.php");

class _PersonaSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('cargo', 'car')->_eval($field)) return $f;
    if($f = $this->container->getMapping('organo', 'org')->_eval($field)) return $f;
    if($f = $this->container->getMapping('departamento_judicial', 'dj')->_eval($field)) return $f;
    if($f = $this->container->getMapping('departamento_judicial', 'dji')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_documento', 'td')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('cargo', 'car')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('organo', 'org')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('departamento_judicial', 'dj')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('departamento_judicial', 'dji')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_documento', 'td')->_toArray()) . ' 
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

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('cargo','car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('organo','org')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('departamento_judicial','dj')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('departamento_judicial','dji')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_documento','td')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('cargo','car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('organo','org')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('departamento_judicial','dj')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('departamento_judicial','dji')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_documento','td')->_eval($field, [$option, $value])) return $c;
  }



}
