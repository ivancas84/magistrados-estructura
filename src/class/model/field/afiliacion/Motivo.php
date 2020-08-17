<?php

require_once("class/model/field/afiliacion/_Motivo.php");

class FieldAfiliacionMotivo extends _FieldAfiliacionMotivo {

  public $subtype ="select_text";
  public $selectValues = ["Alta", "Baja", "Pendiente"];


}
