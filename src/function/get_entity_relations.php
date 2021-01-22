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

    case 'importe_afiliacion': return [
      'afi' => 'afiliacion',
      'afi_per' => 'persona',
      'afi_per_car' => 'cargo',
      'afi_per_org' => 'organo',
      'afi_per_dj' => 'departamento_judicial',
      'afi_per_dji' => 'departamento_judicial',
      'afi_per_td' => 'tipo_documento',
    ];

    case 'importe_tramite_excepcional': return [
      'te' => 'tramite_excepcional',
      'te_per' => 'persona',
      'te_per_car' => 'cargo',
      'te_per_org' => 'organo',
      'te_per_dj' => 'departamento_judicial',
      'te_per_dji' => 'departamento_judicial',
      'te_per_td' => 'tipo_documento',
      'te_suc' => 'sucursal',
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
      'suc' => 'sucursal',
    ];

    default: return [];
  }
}
