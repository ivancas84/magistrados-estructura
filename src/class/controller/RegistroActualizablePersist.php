<?php
require_once("class/model/Render.php");
require_once("class/tools/Validation.php");

class RegistroActualizablePersist {

  public $entityName;
  public $container;

  public function main($data){    
    $value = $this->container->getValue($this->entityName)->_fromArray($data, "set");

    if(!Validation::is_empty($value->_get("id"))){
      $value->_call("reset")->_call("check");
      if($value->logs->isError()) throw new Exception($value->logs->toString());
      $sql = $this->container->getSqlo($this->entityName)->update($value->_toArray("sql"));
      $detail = [];
    } else {
      $value->_call("setDefault");
      $value->_set("id",uniqid()); //id habitualmente esta en null y no se asigna al definir valores por defecto
      $value->_call("reset")->_call("check");
      if($value->logs->isError()) throw new Exception($value->logs->toString());
      $actualizacion = $this->actualizar($value);    
      $sql = $actualizacion["sql"] . $this->container->getSqlo($this->entityName)->insert($value->_toArray("sql"));
      $detail = $actualizacion["detail"];      
    }

    array_push($detail, $this->entityName.$value->_get("id"));
    $this->container->getDb()->multi_query_transaction_log($sql);
    return ["id" => $value->_get("id"), "detail" => $detail];
  }


  public function actualizar($value){    
    $registros = $this->consultarNoModificadas($value->_get("persona"));
    $this->verificarEstadoEnviado($registros);
    return $this->actualizarNoModificadas($registros);
  }

  public function consultarNoModificadas($idPersona){
    $render = new Render();
    $render->setCondition([
      ["persona","=",$idPersona],
      ["modificado","=",false]
    ]);
    return $this->container->getDb()->all($this->entityName,$render);
  }

  public function verificarEstadoEnviado($registros){
    foreach($registros as $registro){
      if($registro["estado"] == "Enviado") throw new Exception("Existe un registro con estado enviado, no se puede registrar la nueva registro");
    }
  }

  public function actualizarNoModificadas($registros){
    $sql = "";
    $detail = [];
    foreach($registros as $registro){
      $value = $this->container->getValue($this->entityName);
      $value->_fastSet("id",$registro["id"]);
      $value->_fastSet("modificado",new DateTime());
      $sql .= $this->container->getSqlo($this->entityName)->update($value->_toArray("sql"));
      array_push($detail, $this->entityName.$registro["id"]);
    }
    return ["sql" => $sql, "detail" => $detail];
  } 
}