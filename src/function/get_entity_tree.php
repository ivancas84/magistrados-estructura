<?php

function get_entity_tree($entityName) {
  switch($entityName){
    case 'afiliacion': return [

      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
        'per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo', 'children'=>[]],
        'per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial', 'children'=>[]],
        'per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial', 'children'=>[]],
        'per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento', 'children'=>[]],]],    ];

    case 'importe_afiliacion': return [

      'afi' => ['field_id'=>'afiliacion', 'field_name'=>'afiliacion', 'entity_name'=>'afiliacion', 'children'=>[
        'afi_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
          'afi_per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
          'afi_per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo', 'children'=>[]],
          'afi_per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial', 'children'=>[]],
          'afi_per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial', 'children'=>[]],
          'afi_per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento', 'children'=>[]],]],]],
      'imp' => ['field_id'=>'importe', 'field_name'=>'importe', 'entity_name'=>'importe', 'children'=>[]],    ];

    case 'importe_tramite_excepcional': return [

      'te' => ['field_id'=>'tramite_excepcional', 'field_name'=>'tramite_excepcional', 'entity_name'=>'tramite_excepcional', 'children'=>[
        'te_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
          'te_per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
          'te_per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo', 'children'=>[]],
          'te_per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial', 'children'=>[]],
          'te_per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial', 'children'=>[]],
          'te_per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento', 'children'=>[]],]],]],
      'imp' => ['field_id'=>'importe', 'field_name'=>'importe', 'entity_name'=>'importe', 'children'=>[]],    ];

    case 'persona': return [

      'car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
      'org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo', 'children'=>[]],
      'dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial', 'children'=>[]],
      'dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial', 'children'=>[]],
      'td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento', 'children'=>[]],    ];

    case 'tramite_excepcional': return [

      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
        'per_org' => ['field_id'=>'organo', 'field_name'=>'organo', 'entity_name'=>'organo', 'children'=>[]],
        'per_dj' => ['field_id'=>'departamento_judicial', 'field_name'=>'departamento_judicial', 'entity_name'=>'departamento_judicial', 'children'=>[]],
        'per_dji' => ['field_id'=>'departamento_judicial_informado', 'field_name'=>'departamento_judicial_informado', 'entity_name'=>'departamento_judicial', 'children'=>[]],
        'per_td' => ['field_id'=>'tipo_documento', 'field_name'=>'tipo_documento', 'entity_name'=>'tipo_documento', 'children'=>[]],]],    ];

    default: return [];
  }
}
