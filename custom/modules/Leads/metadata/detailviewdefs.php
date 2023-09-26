<?php
$viewdefs ['Leads'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}<input title="{$MOD.LBL_CONVERTLEAD_TITLE}" accessKey="{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}" type="button" class="button" onClick="document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'" name="convert" value="{$MOD.LBL_CONVERTLEAD}">{/if}',
            'sugar_html' => 
            array (
              'type' => 'button',
              'value' => '{$MOD.LBL_CONVERTLEAD}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_CONVERTLEAD_TITLE}',
                'accessKey' => '{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}',
                'class' => 'button',
                'onClick' => 'document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'',
                'name' => 'convert',
                'id' => 'convert_lead_button',
              ),
              'template' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}[CONTENT]{/if}',
            ),
          ),
          4 => 'FIND_DUPLICATES',
        ),
        'headerTpl' => 'modules/Leads/tpls/DetailViewHeader.tpl',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Leads/Lead.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Leads/js/hide_website_casetype.js',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL5' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'LBL_CONTACT_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'comment' => 'First name of the contact',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'middle_name_c',
            'label' => 'LBL_MIDDLE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'last_name',
            'comment' => 'Last name of the contact',
            'label' => 'LBL_LAST_NAME',
          ),
          1 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
        ),
        2 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'gender',
            'label' => 'LBL_GENDER',
          ),
        ),
        3 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'ssn_c',
            'label' => 'LBL_SSN',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'reason_for_lost_lead_c',
            'studio' => 'visible',
            'label' => 'LBL_REASON_FOR_LOST_LEAD',
          ),
          1 => 
          array (
            'name' => 'converted',
            'comment' => 'Has Lead been converted to a Contact (and other Sugar objects)',
            'label' => 'LBL_CONVERTED',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'case_description_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'website_form_casetype',
            'customCode' => '{$fields.case_type_c.value}',
            'label' => 'LBL_WEBSITE_CASE_TYPE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'liability_description_c',
            'studio' => 'visible',
            'label' => 'LBL_LIABILITY_DESCRIPTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'damages_description_c',
            'studio' => 'visible',
            'label' => 'LBL_DAMAGES_DESCRIPTION',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'case_type_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_TYPE',
          ),
          1 => 
          array (
            'name' => 'date_of_incident_c',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'minor_incapacitated_name_c',
            'label' => 'LBL_MINOR_INCAPACITATED_NAME',
          ),
          1 => 
          array (
            'name' => 'representative_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATIVE_CAPACITY',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'statute_of_limitations_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'county_of_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_INCIDENT',
          ),
          1 => 'lead_source',
        ),
        12 => 
        array (
          0 => 'phone_mobile',
          1 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
          ),
        ),
        13 => 
        array (
          0 => 'phone_work',
          1 => 'email1',
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'referral_attorney_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_ATTORNEY',
          ),
          1 => 
          array (
            'name' => 'referral_person_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_PERSON',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'liability_c',
            'studio' => 'visible',
            'label' => 'LBL_LIABILITY',
          ),
          1 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'damages_c',
            'studio' => 'visible',
            'label' => 'LBL_DAMAGES',
          ),
          1 => 
          array (
            'name' => 'insurance_or_collectability_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_OR_COLLECTABILITY',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'modified_by_name',
            'label' => 'LBL_MODIFIED_NAME',
          ),
        ),
        19 => 
        array (
          0 => 
          array (
            'name' => 'description_html',
            'comment' => '',
            'label' => 'LBL_DESCRIPTION_HTML',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'label' => 'LBL_PRIMARY_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
            ),
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'deceased_plaintiff_has_spous_c',
            'studio' => 'visible',
            'label' => 'LBL_DECEASED_PLAINTIFF_HAS_SPOUS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'surviving_spouse_and_childre_c',
            'studio' => 'visible',
            'label' => 'LBL_SURVIVING_SPOUSE_AND_CHILDRE',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fall_down_damages_c',
            'studio' => 'visible',
            'label' => 'LBL_FALL_DOWN_DAMAGES',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'date_of_plaintiff_death_c',
            'label' => 'LBL_DATE_OF_PLAINTIFF_DEATH',
          ),
        ),
      ),
      'lbl_detailview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'get_do_not_text',
            'label' => 'LBL_GET_DO_NOT_TEXT',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sms_body',
            'label' => 'LBL_SMS_BODY',
            'customCode' => '<div id = "sms_body"></div>',
          ),
        ),
      ),
    ),
  ),
);
