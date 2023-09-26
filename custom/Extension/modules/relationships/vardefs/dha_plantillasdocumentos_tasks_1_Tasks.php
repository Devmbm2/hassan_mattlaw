<?php
// created: 2017-10-26 12:38:34
$dictionary["Task"]["fields"]["dha_plantillasdocumentos_tasks_1"] = array (
  'name' => 'dha_plantillasdocumentos_tasks_1',
  'type' => 'link',
  'relationship' => 'dha_plantillasdocumentos_tasks_1',
  'source' => 'non-db',
  'module' => 'DHA_PlantillasDocumentos',
  'bean_name' => 'DHA_PlantillasDocumentos',
  'vname' => 'LBL_DHA_PLANTILLASDOCUMENTOS_TASKS_1_FROM_DHA_PLANTILLASDOCUMENTOS_TITLE',
  'id_name' => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
);
$dictionary["Task"]["fields"]["dha_plantillasdocumentos_tasks_1_name"] = array (
  'name' => 'dha_plantillasdocumentos_tasks_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DHA_PLANTILLASDOCUMENTOS_TASKS_1_FROM_DHA_PLANTILLASDOCUMENTOS_TITLE',
  'save' => true,
  'id_name' => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
  'link' => 'dha_plantillasdocumentos_tasks_1',
  'table' => 'dha_plantillasdocumentos',
  'module' => 'DHA_PlantillasDocumentos',
  'rname' => 'document_name',
);
$dictionary["Task"]["fields"]["dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida"] = array (
  'name' => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
  'type' => 'link',
  'relationship' => 'dha_plantillasdocumentos_tasks_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DHA_PLANTILLASDOCUMENTOS_TASKS_1_FROM_TASKS_TITLE',
);
