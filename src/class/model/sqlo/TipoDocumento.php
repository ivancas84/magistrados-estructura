<?php

require_once("class/model/sqlo/_TipoDocumento.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class TipoDocumentoSqlo extends _TipoDocumentoSqlo {
  public $subtype = "select";

}
