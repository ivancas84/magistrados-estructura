<?php

function get_public_scope() {
  return [
    'afiliacion' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'cargo' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'departamento_judicial' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'file' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'organo' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'persona' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'tipo_documento' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
    'tramite_excepcional' => ['advanced','all','count','delete','further_error','get_all','ids','unique','unique_id'],
  ];
}
