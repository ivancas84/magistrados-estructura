<?php
require_once("class/model/Render.php");

class AfiliacionPersist {

  public function main($data){    
    $persistLog = $this->container->getController("PersistLog");

    $values = $this->container->getValues("afiliacion")->_fromArray($data);
    if(!$values->_check()) throw new Exception($values->_getLogs()->toString());
        
    if (!empty($values->id())){ 
      $id = $persistLog->update("afiliacion", $values->_toArray());
    } else {
      $values->_setDefault();

      $afiliaciones = $this->consultarAfiliacionesNoModificadas($values);
      $this->verificarEstadoEnviado($afiliaciones);
      $this->actualizarAfiliacionesNoModificadas($afiliaciones);
      $id = $persistLog->insert("afiliacion", $values->_toArray());
    }

    $this->container->getDb()->multi_query_transaction_log($persistLog->getSql());
    
    return ["id" => $id, "detail" => $persistLog->getDetail()];
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
      
      $persistLog->update("afiliacion", $_afiliacion);
    }
  } 
}