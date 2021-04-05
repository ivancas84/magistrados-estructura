<?php

function get_entity_rel($entityName) {
  switch($entityName){
    case 'afiliacion': return [
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
  'per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial'],
  'per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento'],
    ];

    case 'importe_afiliacion': return [
  'afi' => ['field_id'=>'afiliacion', 'field_name'=>'afiliacion', 'entity_name'=>'afiliacion'],
  'afi_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'afi_per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'afi_per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'afi_per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
  'afi_per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial'],
  'afi_per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento'],
    ];

    case 'importe_tramite_excepcional': return [
  'te' => ['field_id'=>'tramite_excepcional', 'field_name'=>'tramite_excepcional', 'entity_name'=>'tramite_excepcional'],
  'te_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'te_per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'te_per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'te_per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
  'te_per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial'],
  'te_per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento'],
  'te_suc' => ['field_id'=>'sucursal', 'field_name'=>'sucursal', 'entity_name'=>'sucursal'],
    ];

    case 'persona': return [
  'car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
  'dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial'],
  'td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento'],
    ];

    case 'tramite_excepcional': return [
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
  'per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial'],
  'per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento'],
  'suc' => ['field_id'=>'sucursal', 'field_name'=>'sucursal', 'entity_name'=>'sucursal'],
    ];

    case 'viatico': return [
  'org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo'],
  'dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial'],
    ];

    default: return [];
  }
}
