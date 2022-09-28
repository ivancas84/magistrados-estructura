<?php

require_once("class/import/Element.php");
require_once("function/settypebool.php");


class MdbImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $m = settypebool($row["magistrado"]);
    $f = settypebool($row["funcionario"]);

    if($m && !$f) $row["cargo"] = "1";
    elseif(!$m && $f) $row["cargo"] = "2";

    switch($row["tipo_documento"]){
      case "DNI": $row["tipo_documento"] = "1"; break;
      case "LC": $row["tipo_documento"] = "2"; break;
      case "LE": $row["tipo_documento"] = "3"; break;
      default: $row["tipo_documento"] = null;
    }
    $this->setEntity($row, "persona");
    $this->entities["persona"]->_set("identifier", $this->entities["persona"]->_get("legajo"));
  }

  public function compare($name, $includeNull = false, $ignoreFields = []){
    /**
     * @param $name Identificador de la entidad
     */

    if($name == "persona"){  
      $existent = $this->getExistentValue($name);
      if(!nombres_parecidos($this->entities["persona"]->_get("nombre"), $existent->_get("nombre"), 5)) throw new Exception("No coincide nombre de persona con existente NUEVO: " . $this->entities["persona"]->_get("nombre") . " - EXISTENTE: " . $existent->_get("nombre"));
      if(!empty($this->entities["persona"]->_get("tribunal")) && !empty($existent->_get("tribunal")) && !nombres_parecidos($this->entities["persona"]->_get("tribunal"), $existent->_get("tribunal"))) throw new Exception("No coincide tribunal con existente NUEVO: " . $this->entities["persona"]->_get("tribunal") . " - EXISTENTE: " . $existent->_get("tribunal") );
      if(!empty($this->entities["persona"]->_get("telefono_laboral")) && !empty($existent->_get("telefono_laboral")) && (substr($this->entities["persona"]->_get("telefono_laboral"), -4) != substr($existent->_get("telefono_laboral"), -4))) throw new Exception("No coincide telefono laboral con existente NUEVO: " . $this->entities["persona"]->_get("telefono_laboral") . " - EXISTENTE: " . $existent->_get("telefono_laboral") );
      if(!empty($this->entities["persona"]->_get("telefono_particular")) && !empty($existent->_get("telefono_particular")) && (substr($this->entities["persona"]->_get("telefono_particular"), -4) != substr($existent->_get("telefono_particular"), -4))) throw new Exception("No coincide telefono particular con existente NUEVO: " . $this->entities["persona"]->_get("telefono_laboral") . " - EXISTENTE: " . $existent->_get("telefono_laboral") );

      return parent::compare($name, $includeNull,["nombres","apellidos","tribunal","telefono_laboral","telefono_particular"]);
    } else {
      return parent::compare($name, $includeNull);

    }
  }

  public function update($name){
    if($name == "persona"){  
      $entityName = $this->import->getEntityName($name);
      $row = $this->entities[$name]->_toArray("sql");
      unset($row["apellidos"]);
      $this->sql .= $this->container->getSqlo($entityName)->update($row);
      $this->logs->addLog($name,"info","Registro existente, se actualizara campos");
      return $this->entities[$name]->_get("id");
    } 

    return parent::update($name);
  } 

 

  
}