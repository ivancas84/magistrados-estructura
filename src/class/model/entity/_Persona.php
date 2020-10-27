<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
  public $nf = ['nombres', 'apellidos', 'legajo', 'numero_documento', 'telefono_laboral', 'telefono_particular', 'fecha_nacimiento', 'email', 'creado', 'eliminado'];
  public $mu = ['cargo', 'organo', 'departamento_judicial', 'departamento_judicial_informado', 'tipo_documento'];
  public $_u = [];
  public $notNull = ['id', 'legajo', 'creado', 'organo', 'departamento_judicial'];
  public $unique = ['id', 'legajo', 'numero_documento'];


}
