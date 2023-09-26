<?php
$module_name = 'MEDB_Medical_Bills';
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
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
        1 => 
        array (
          0 => 
          array (
            'name' => 'medb_medical_bills_contacts_name',
            'label' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
          ),
          1 => 
          array (
            'name' => 'status_id',
            'studio' => 'visible',
            'label' => 'LBL_DOC_STATUS',
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
            'name' => 'lop_lien',
            'label' => 'LBL_LOP_LIEN',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'total_charges',
            'label' => 'LBL_TOTAL_CHARGES',
          ),
          1 => 
          array (
            'name' => 'balance',
            'label' => 'LBL_BALANCE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'copy_charges',
            'label' => 'LBL_COPY_CHARGES',
          ),
          1 => 
          array (
            'name' => 'amount_jury_sees',
            'label' => 'LBL_AMOUNT_JURY_SEES',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'pip_paid',
            'label' => 'LBL_PIP_PAID',
          ),
          1 => 
          array (
            'name' => 'medicare_paid',
            'label' => 'LBL_MEDICARE_PAID',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'medicaid_paid',
            'label' => 'LBL_MEDICAID_PAID',
          ),
          1 => 
          array (
            'name' => 'adjustments',
            'label' => 'LBL_ADJUSTMENTS',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'health_insurance_paid',
            'label' => 'LBL_HEALTH_INSURANCE_PAID',
          ),
          1 => 
          array (
            'name' => 'client_paid',
            'label' => 'LBL_CLIENT_PAID',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'reduction_amount',
            'label' => 'LBL_REDUCTION_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'reduction_approved_by',
            'label' => 'LBL_REDUCTION_APPROVED_BY',
          ),
        ),
        9 => 
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
    ),
  ),
);
?>
