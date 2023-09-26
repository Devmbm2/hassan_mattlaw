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
          3 => 'FIND_DUPLICATES',
          4 => 
          array (
            'customCode' => '<input type="submit" class="button" title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" onclick="this.form.return_module.value=\'Contacts\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Contacts\';" name="Manage Subscriptions" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}"/>',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
              'htmlOptions' => 
              array (
                'class' => 'button',
                'id' => 'manage_subscriptions_button',
                'title' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
                'onclick' => 'this.form.return_module.value=\'Contacts\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Contacts\';',
                'name' => 'Manage Subscriptions',
              ),
            ),
          ),
          'AOS_GENLET' => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_PRINT_AS_PDF}">',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Leads/Lead.js',
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
            'name' => 'suffix_c',
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
            'name' => 'phone_mobile',
            'label' => 'LBL_MOBILE_PHONE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'doctor_type_c',
            'studio' => 'visible',
            'label' => 'LBL_DOCTOR_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'occupation_c',
            'label' => 'LBL_OCCUPATION',
          ),
          1 => 
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNT_NAME',
          ),
        ),
        5 => 
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
          1 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        6 => 
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
        7 => 
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
        8 => 
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
        9 => 
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
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'gender_c',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
          1 => 
          array (
            'name' => 'age_c',
            'label' => 'LBL_AGE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
          1 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
        2 => 
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
        3 => 
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
            'name' => 'ssn_c',
            'label' => 'LBL_SSN',
          ),
          1 => 
          array (
            'name' => 'drivers_license_c',
            'label' => 'LBL_DRIVERS_LICENSE',
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
      ),
    ),
  ),
);
$viewdefs['Contacts']['DetailView']['templateMeta'] = array (
  'form' => 
  array (
    'buttons' => 
    array (
      0 => 'EDIT',
      1 => 'DUPLICATE',
      2 => 'DELETE',
      3 => 'FIND_DUPLICATES',
      4 => 
      array (
        'customCode' => '<input type="submit" class="button" title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" onclick="this.form.return_module.value=\'Contacts\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Contacts\';" name="Manage Subscriptions" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}"/>',
        'sugar_html' => 
        array (
          'type' => 'submit',
          'value' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
          'htmlOptions' => 
          array (
            'class' => 'button',
            'id' => 'manage_subscriptions_button',
            'title' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
            'onclick' => 'this.form.return_module.value=\'Contacts\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Contacts\';',
            'name' => 'Manage Subscriptions',
          ),
        ),
      ),
      'AOS_GENLET' => 
      array (
        'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_PRINT_AS_PDF}">',
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
  'includes' => 
  array (
    0 => 
    array (
      'file' => 'modules/Leads/Lead.js',
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
    'LBL_PANEL_ASSIGNMENT' => 
    array (
      'newTab' => true,
      'panelDefault' => 'expanded',
    ),
  ),
);
?>
