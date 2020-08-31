<?php

require_once("class/tools/Filter.php");

class AfiliacionPersistApi {

  public function main(){    
    if(empty($data = Filter::jsonPostRequired())) return;

    $persist = $this->container->getController("AfiliacionPersist")->main($data);
    return ["id"=>$persist["id"], "detail"=>$persist["detail"]];
  }

}

