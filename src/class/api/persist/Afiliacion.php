<?php

require_once("class/api/Persist.php");

class AfiliacionPersist extends Persist {
  public $entityName = "afiliacion";

  public function main(){
    $data = Filter::jsonPostRequired();
    if(empty($data)) return;

    $row_ = $this->container->getDb()->unique($this->entityName, $data);
    $values = $this->container->getValues($this->entityName)->_fromArray($data);
    if(!$values->_check()) throw new Exception($values->_getLogs()->toString());
        
    if (!empty($row_)){ 
      $values->setId($row_["id"]);
      $persist = $this->container->getSqlo($this->entityName)->update($values->_toArray());
    } else {
      $values->_setDefault();

      $afiliaciones = $this->consultarAfiliacionesNoModificadas($values);
      $this->verificarEstadoEnviado($afiliaciones);
      $this->actualizarAfiliacionesNoModificadas($afiliaciones);
      $persist = $this->container->getSqlo($this->entityName)->insert($values->_toArray());
    }

    $this->container->getDb()->multi_query_transaction_log($persist["sql"]);
    
    return $persist["id"];
  }

  public function consultarAfiliacionesNoModificadas(EntityValues $values){
    $render = new Render();
    $render->setCondition([
      ["persona","=",$values->persona()],
      ["modificado","=",false]
    ]);
    return $this->container->getDb()->all("afiliacion",$render);
  }

  public function verificarEstadoEnviado($afiliaciones){
    foreach($afiliaciones as $afiliacion){
      if($afiliacion["estado"] == "Enviado") throw new Exception("Existe una afiliación con estado enviado, no se puede registrar la nueva afiliación");
    }
  }

  public function actualizarAfiliacionesNoModificadas($afiliaciones){
    foreach($afiliaciones as $afiliacion){
      $_afiliacion = [
        "id" => $afiliacion["id"],
        "modificado" => new DateTime(),
      ];

      $persist = $this->container->getSqlo($this->entityName)->update($_afiliacion);
      $this->container->getDb()->multi_query_transaction_log($persist["sql"]);
    }
  }
}

