<?php
$viewdefs ['Contacts'] = 
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
            'customCode' => '<input type="button" onclick="show_medical_summary_by_medical_provider();" target="_blank" value="Medical Record Summary" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="show_related_running_bills_report(\'{$fields.id.value}\');" target="_blank" value="MEDB Total Charges" />',
          ),
          5 => 
          array (
            'customCode' => '<input type="button" onclick="related_running_bills_list_for_medical_bill_summary_report(\'{$fields.id.value}\');" target="_blank" value="Medical Bill Summary" />',
          ),
          'AOP_CREATE' => 
          array (
            'customCode' => '{if !$fields.joomla_account_id.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'createPortalUser\';" value="{$MOD.LBL_CREATE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_CREATE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_CREATE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'createPortalUser\';',
                'name' => 'buttonCreatePortalUser',
                'id' => 'createPortalUser_button',
              ),
              'template' => '{if !$fields.joomla_account_id.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          'AOP_DISABLE' => 
          array (
            'customCode' => '{if $fields.joomla_account_id.value && !$fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'disablePortalUser\';" value="{$MOD.LBL_DISABLE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_DISABLE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_DISABLE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'disablePortalUser\';',
                'name' => 'buttonDisablePortalUser',
                'id' => 'disablePortalUser_button',
              ),
              'template' => '{if $fields.joomla_account_id.value && !$fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          'AOP_ENABLE' => 
          array (
            'customCode' => '{if $fields.joomla_account_id.value && $fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'enablePortalUser\';" value="{$MOD.LBL_ENABLE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_ENABLE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_ENABLE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'enablePortalUser\';',
                'name' => 'buttonENablePortalUser',
                'id' => 'enablePortalUser_button',
              ),
              'template' => '{if $fields.joomla_account_id.value && $fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          6 => 
          array (
            'customCode' => '<input type="button" onclick="show_related_module_files_zip_menu();" target="_blank" value="Download Related Module Files AS Zip" />',
          ),
        ),
        'footerTpl' => 'custom/modules/Contacts/tpls/DetailViewFooter.tpl',
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
          'file' => 'custom/include/javascript/visible/cont_children.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_everarre.js',
        ),
        2 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_marital.js',
        ),
        3 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_probwork.js',
        ),
        4 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_pastwork.js',
        ),
        5 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_salutation.js',
        ),
        6 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_suffix.js',
        ),
        7 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_servmili.js',
        ),
        8 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_type.js',
        ),
        9 => 
        array (
          'file' => 'custom/modules/Contacts/js/append_icon.js',
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
        'LBL_PANEL_ADVANCED' => 
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
        'LBL_DETAILVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_contact_information' => 
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
            'name' => 'middle_name',
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
            'name' => 'suffix',
            'studio' => 'visible',
            'label' => 'LBL_SUFFIX',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'dear_c',
            'label' => 'LBL_DEAR',
          ),
          1 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'federal_tax_id_c',
            'label' => 'LBL_FEDERAL_TAX_ID',
          ),
          1 => 
          array (
            'name' => 'expert_type_c',
            'studio' => 'visible',
            'label' => 'LBL_EXPERT_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
          1 => 
          array (
            'name' => 'ssn_c',
            'label' => 'LBL_SSN',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNT_NAME',
          ),
          1 => 
          array (
            'name' => 'gender',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'occupation_c',
            'label' => 'LBL_OCCUPATION',
          ),
          1 => 
          array (
            'name' => 'doctor_type_c',
            'studio' => 'visible',
            'label' => 'LBL_DOCTOR_TYPE',
          ),
        ),
        8 => 
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
        9 => 
        array (
          0 => 
          array (
            'name' => 'phone_mobile',
            'label' => 'LBL_MOBILE_PHONE',
          ),
          1 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
          ),
          2 => 
          array (
            'name' => 'country_code_phone',
            'comment' => 'Phone With Country Code',
            'label' => 'LBL_COUNTRY_CODE_PHONE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'phone_work',
            'label' => 'LBL_OFFICE_PHONE',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'label' => 'LBL_FAX_PHONE',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'assistant',
            'comment' => 'Name of the assistant of the contact',
            'label' => 'LBL_ASSISTANT',
          ),
          1 => 
          array (
            'name' => 'assistant_phone',
            'comment' => 'Phone number of the assistant of the contact',
            'label' => 'LBL_ASSISTANT_PHONE',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'judge_web_page_c',
            'label' => 'LBL_JUDGE_WEB_PAGE',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'felony_convictions_c',
            'studio' => 'visible',
            'label' => 'LBL_FELONY_CONVICTIONS',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'county_of_convictions_c',
            'label' => 'LBL_COUNTY_OF_CONVICTIONS',
          ),
          1 => 
          array (
            'name' => 'years_of_convictions_c',
            'label' => 'LBL_YEARS_OF_CONVICTIONS',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'pre_existing_conditions_c',
            'studio' => 'visible',
            'label' => 'LBL_PRE_EXISTING_CONDITIONS',
          ),
        ),
        16 => 
        array (
          0 => 'assigned_user_name',
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'age_c',
            'label' => 'LBL_AGE',
          ),
          1 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'marital_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MARITAL_STATUS',
          ),
          1 => 
          array (
            'name' => 'spouse_name_c',
            'label' => 'LBL_SPOUSE_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'birthday_card_c',
            'label' => 'LBL_BIRTHDAY_CARD',
          ),
          1 => 
          array (
            'name' => 'newsletter_c',
            'label' => 'LBL_NEWSLETTER',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'total_lops_liens_c',
            'label' => 'LBL_TOTAL_LOPS_LIENS',
          ),
          1 => 
          array (
            'name' => 'total_medical_bills_c',
            'label' => 'LBL_TOTAL_MEDICAL_BILLS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'lead_source',
            'comment' => 'How did the contact come about',
            'label' => 'LBL_LEAD_SOURCE',
          ),
          1 => 
          array (
            'name' => 'race_c',
            'studio' => 'visible',
            'label' => 'LBL_RACE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'drivers_license1_c',
            'label' => 'LBL_DRIVERS_LICENSE1',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'license_susp_revoked_c',
            'studio' => 'visible',
            'label' => 'LBL_LICENSE_SUSP_REVOKED',
          ),
          1 => 
          array (
            'name' => 'work_injury_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'work_injury_status_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY_STATUS',
          ),
          1 => 
          array (
            'name' => 'work_injury_details_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY_DETAILS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'health_problems_c',
            'studio' => 'visible',
            'label' => 'LBL_HEALTH_PROBLEMS',
          ),
          1 => 
          array (
            'name' => 'avg_annual_income_c',
            'label' => 'LBL_AVG_ANNUAL_INCOME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'military_c',
            'studio' => 'visible',
            'label' => 'LBL_MILITARY',
          ),
          1 => 
          array (
            'name' => 'honorably_discharged_c',
            'studio' => 'visible',
            'label' => 'LBL_HONORABLY_DISCHARGED',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'arrested_c',
            'studio' => 'visible',
            'label' => 'LBL_ARRESTED',
          ),
          1 => 
          array (
            'name' => 'arrest_details_c',
            'studio' => 'visible',
            'label' => 'LBL_ARREST_DETAILS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'filed_taxes_c',
            'studio' => 'visible',
            'label' => 'LBL_FILED_TAXES',
          ),
          1 => 
          array (
            'name' => 'children_c',
            'studio' => 'visible',
            'label' => 'LBL_CHILDREN',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'about_children_c',
            'studio' => 'visible',
            'label' => 'LBL_ABOUT_CHILDREN',
          ),
          1 => 
          array (
            'name' => 'close_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_CLOSE_CONTACT',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'social_skills_c',
            'studio' => 'visible',
            'label' => 'LBL_SOCIAL_SKILLS',
          ),
          1 => 
          array (
            'name' => 'personality_rating_c',
            'studio' => 'visible',
            'label' => 'LBL_PERSONALITY_RATING',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'language_skills_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SKILLS',
          ),
          1 => 
          array (
            'name' => 'financial_status_c',
            'studio' => 'visible',
            'label' => 'LBL_FINANCIAL_STATUS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'clients_relationships_c',
            'studio' => 'visible',
            'label' => 'LBL_CLIENTS_RELATIONSHIPS',
          ),
          1 => 
          array (
            'name' => 'appearance_dress_c',
            'studio' => 'visible',
            'label' => 'LBL_APPEARANCE_DRESS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'overall_jury_appeal_c',
            'studio' => 'visible',
            'label' => 'LBL_OVERALL_JURY_APPEAL',
          ),
          1 => 
          array (
            'name' => 'highest_level_of_education_c',
            'studio' => 'visible',
            'label' => 'LBL_HIGHEST_LEVEL_OF_EDUCATION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'observations_about_client_c',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVATIONS_ABOUT_CLIENT',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
      ),
      'lbl_detailview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fee_schedule_c',
            'label' => 'LBL_FEE_SCHEDULE',
          ),
          1 => 
          array (
            'name' => 'financial_c',
            'label' => 'LBL_FINANCIAL',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'discovery_c',
            'studio' => 'visible',
            'label' => 'LBL_DISCOVERY',
          ),
          1 => 
          array (
            'name' => 'transcript_c',
            'label' => 'LBL_TRANSCRIPT',
          ),
        ),
      ),
      'lbl_detailview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'get_do_not_text',
            'label' => 'LBL_GET_DO_NOT_TEXT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sms_body',
            'label' => 'LBL_DETAILVIEW_PANEL4',
            'customCode' => '<div id = "sms_body"></div>',
          ),
        ),
      ),
    ),
  ),
);
