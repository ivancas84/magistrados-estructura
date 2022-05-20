<?php
require_once("class/model/Render.php");
require_once("class/tools/Validation.php");

class RegistroActualizablePersistSql {

  public $entityName;
  public $container;

  public $noModificadas = []; //afiliaciones no modificadas (se consultan para el caso de que)

  public function main($data){    
    $this->registro = $this->container->getValue($this->entityName)->_fromArray($data, "set");

    if(!Validation::is_empty($this->registro->_get("id"))){
      /**
       * Las actualizaciones sobre una registro no efectuan ningun cambio 
       * adicional
       */
      $this->registro->_call("reset")->_call("check");
      if($this->registro->logs->isError()) throw new Exception($this->registro->logs->toString());
      $sql = $this->container->getSqlo($this->entityName)->update($this->registro->_toArray("sql"));
      $detail = [];
    } else {
      /**
       * Para las inserciones de nuevos registros se busca aquellos registros 
       * existentes que posean el mismo codigo
       */
      $this->registro->_call("setDefault");
      $this->registro->_set("id",uniqid()); //id habitualmente esta en null y no se asigna al definir valores por defecto
      $this->registro->_call("reset")->_call("check");
      if($this->registro->logs->isError()) throw new Exception($this->registro->logs->toString());
      $actualizacion = $this->actualizar($this->registro);    
      $sql = $actualizacion["sql"] . $this->container->getSqlo($this->entityName)->insert($this->registro->_toArray("sql"));
      $detail = $actualizacion["detail"];      
    }

    array_push($detail, $this->entityName.$this->registro->_get("id"));
    return ["id" => $this->registro->_get("id"), "detail" => $detail, "sql"=> $sql];
  }


  public function actualizar(){    
    $registros = $this->noModificada_();
    $this->checkEstadoEnviado($registros);
    return $this->updateNoModificada_($registros);
  }

  public function noModificada_(){
    /**
     * Afiliacion no modificadas. (estado != modificado).
     * Se busca solamente las del mismo codigo, entendiendo que una persona
     * puede tener al mismo tiempo varias afiliaciones con diferente codigo.
     * Que una persona tenga varias afiliaciones con el mismo codigo es una si-
     * tuacion que no deberia suceder, pero por error humano sucede.
     */
    $render = new Render();
    $render->setCondition([
      ["persona","=",$this->registro->_get("persona")],
      ["modificado","=",false],
    ]);
    $render->addCondition(["codigo","=",$this->registro->_get("codigo")]);
    return $this->container->getDb()->all($this->entityName,$render);
  }

  public function checkEstadoEnviado($registros){
    foreach($registros as $registro){
      if($registro["estado"] == "Enviado") throw new Exception("Existe un registro con estado enviado, no se puede cargar el nuevo registro");
    }
  }

  public function updateNoModificada_($registros){
    $sql = "";
    $detail = [];
    foreach($registros as $registro){
      $reg = $this->container->getValue($this->entityName);
      $reg->_fastSet("id",$registro["id"]);
      $reg->_fastSet("modificado",new DateTime());
      $sql .= $this->container->getSqlo($this->entityName)->update($reg->_toArray("sql"));
      array_push($detail, $this->entityName.$registro["id"]);
    }
    return ["sql" => $sql, "detail" => $detail];
  } 
}