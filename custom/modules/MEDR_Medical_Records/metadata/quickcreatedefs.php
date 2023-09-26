<?php
$module_name = 'MEDR_Medical_Records';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'document_name',
          1 => 
          array (
            'name' => 'contact_name',
            'label' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status_id',
            'label' => 'LBL_DOC_STATUS',
          ),
          1 => 
          array (
            'name' => 'med_summary_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MED_SUMMARY_STATUS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'medical_provider',
            'studio' => 'visible',
            'label' => 'LBL_MEDICAL_PROVIDER',
          ),
          1 => 
          array (
            'name' => 'name_of_doctor',
            'label' => 'LBL_NAME_OF_DOCTOR',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'range_of_records_requested_c',
            'studio' => 'visible',
            'label' => 'LBL_RANGE_OF_RECORDS_REQUESTED',
          ),
          1 => 
          array (
            'name' => 'uploadfile',
            'customCode' => '{if $fields.id.value!=""}
            				{assign var="type" value="hidden"}
            		 		{else}
            		 		{assign var="type" value="file"}
            		  		{/if}
            		  		<input name="uploadfile" type = {$type} size="30" maxlength="" onchange="setvalue(this);" value="{$fields.filename.value}">{$fields.filename.value}',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_range_start',
            'label' => 'LBL_DATE_RANGE_START',
          ),
          1 => 
          array (
            'name' => 'date_range_end',
            'label' => 'LBL_DATE_RANGE_END',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'displayParams' => 
            array (
              'rows' => 10,
              'cols' => 120,
            ),
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'how_many_pages_c',
            'label' => 'LBL_HOW_MANY_PAGES',
          ),
          1 => 
          array (
            'name' => 'record_req_problems_c',
            'studio' => 'visible',
            'label' => 'LBL_RECORD_REQ_PROBLEMS',
          ),
        ),
      ),
    ),
  ),
);
