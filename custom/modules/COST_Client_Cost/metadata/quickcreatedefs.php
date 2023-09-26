<?php
$module_name = 'COST_Client_Cost';
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
        'LBL_QUICKCREATE_PANEL1' => 
        array (
          'newTab' => false,
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
            'name' => 'cost_client_cost_cases_name',
            'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
          ),
          1 => 
          array (
            'name' => 'number_of_ways_to_split',
            'studio' => 'visible',
            'label' => 'LBL_NUMBER_OF_WAYS_TO_SPLIT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
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
        2 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
          1 => 
          array (
            'name' => 'total_amount',
            'label' => 'LBL_TOTAL_AMOUNT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'invoice_number',
            'label' => 'LBL_INVOICE_NUMBER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'other_status_type_explain',
            'comment' => 'Full text of the note',
            'studio' => 'visible',
            'label' => 'LBL_OTHER_STATUS_TYPE_EXPLAIN',
          ),
          1 => '',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'paid_date',
            'label' => 'LBL_PAID_DATE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'check_number',
            'label' => 'LBL_CHECK_NUMBER',
          ),
        ),
        7 => 
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
      ),
      'lbl_quickcreate_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'recovery_of_costs',
            'studio' => 'visible',
            'label' => 'LBL_RECOVERY_OF_COSTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'lost_unreimbursed_costs',
            'label' => 'LBL_LOST_UNREIMBURSED_COSTS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'lost_money',
            'label' => 'LBL_LOST_MONEY',
          ),
          1 => 
          array (
            'name' => 'lost_money_date',
            'label' => 'LBL_LOST_MONEY_DATE',
          ),
        ),
      ),
    ),
  ),
);
