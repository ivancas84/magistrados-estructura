<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _FileSqlo extends EntitySqlo {

  public $entityName = "file";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "name, " ;
    $sql .= "type, " ;
    $sql .= "content, " ;
    $sql .= "size, " ;
    $sql .= "created, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['name'] . ", " ;
    $sql .= $row['type'] . ", " ;
    $sql .= $row['content'] . ", " ;
    $sql .= $row['size'] . ", " ;
    $sql .= $row['created'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['name'] )) $sql .= "name = " . $row['name'] . " ," ;
    if (isset($row['type'] )) $sql .= "type = " . $row['type'] . " ," ;
    if (isset($row['content'] )) $sql .= "content = " . $row['content'] . " ," ;
    if (isset($row['size'] )) $sql .= "size = " . $row['size'] . " ," ;
    if (isset($row['created'] )) $sql .= "created = " . $row['created'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
