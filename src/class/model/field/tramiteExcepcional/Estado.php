<?php

require_once("class/model/field/tramiteExcepcional/_Estado.php");

class FieldTramiteExcepcionalEstado extends _FieldTramiteExcepcionalEstado {

  public $default = "Creado";
  public $subtype ="select_text";
  public $selectValues = ["Creado", "Enviado", "Aprobado", "Rechazado"];

}
