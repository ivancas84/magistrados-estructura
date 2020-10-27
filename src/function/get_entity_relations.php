<?php

function get_entity_relations($entityName) {
  switch($entityName){
    case 'afiliacion': return [
      'per' => 'persona',
      'per_car' => 'cargo',
      'per_org' => 'organo',
      'per_dj' => 'departamento_judicial',
      'per_dji' => 'departamento_judicial',
      'per_td' => 'tipo_documento',
    ];

    case 'persona': return [
      'car' => 'cargo',
      'org' => 'organo',
      'dj' => 'departamento_judicial',
      'dji' => 'departamento_judicial',
      'td' => 'tipo_documento',
    ];

    case 'tramite_excepcional': return [
      'per' => 'persona',
      'per_car' => 'cargo',
      'per_org' => 'organo',
      'per_dj' => 'departamento_judicial',
      'per_dji' => 'departamento_judicial',
      'per_td' => 'tipo_documento',
    ];

    default: return [];
  }
}
