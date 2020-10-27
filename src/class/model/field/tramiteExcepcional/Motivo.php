<?php

require_once("class/model/field/tramiteExcepcional/_Motivo.php");

class FieldTramiteExcepcionalMotivo extends _FieldTramiteExcepcionalMotivo {

  public $default = "Alta";
  public $subtype ="select_text";
  public $selectValues = ["Alta", "Baja", "Pendiente"];


}
