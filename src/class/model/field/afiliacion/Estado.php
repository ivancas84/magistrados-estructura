<?php

require_once("class/model/field/afiliacion/_Estado.php");

class FieldAfiliacionEstado extends _FieldAfiliacionEstado {

  public $subtype ="select_text";
  public $selectValues = ["Creado", "Enviado", "Aprobado", "Rechazado"];

}
