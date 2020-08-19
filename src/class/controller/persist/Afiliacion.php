<?php

require_once("class/controller/Persist.php");

class AfiliacionPersist extends Persist {
  public $entityName = "afiliacion";



  public function main($data){
    if(empty($data)) return;

    $ma = Ma::open();
    $row_ = $ma->unique($this->entityName, $data);
    $values = EntityValues::getInstanceRequire($this->entityName)->_fromArray($data);
    if(!$values->_check()) throw new Exception($values->_getLogs()->toString());
        
    if (!empty($row_)){ 
      $values->setId($row_["id"]);
      $id = $this->update($this->entityName, $values->_toArray());
    } else {
      $values->setId(uniqid());
      $values->_setDefault();

      $afiliaciones = $this->consultarAfiliacionesNoModificadas($values);
      $this->verificarEstadoEnviado($afiliaciones);
      $this->actualizarAfiliacionesNoModificadas($afiliaciones);
      $id = $this->insert($this->entityName, $values->_toArray());
    }

    $ma->multi_query_transaction($this->getSql());
    
    return $id;
  }

  public function consultarAfiliacionesNoModificadas(EntityValues $values){
    $render = new Render();
    $render->setCondition([
      ["persona","=",$values->persona()],
      ["modificado","=",false]
    ]);
    return Ma::open()->all("afiliacion",$render);
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
      $this->update("afiliacion",$_afiliacion);
    }
  }
}

