<?php
$viewdefs ['Leads'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="prospect_id" value="{if isset($smarty.request.prospect_id)}{$smarty.request.prospect_id}{else}{$bean->prospect_id}{/if}">',
          1 => '<input type="hidden" name="account_id" value="{if isset($smarty.request.account_id)}{$smarty.request.account_id}{else}{$bean->account_id}{/if}">',
          2 => '<input type="hidden" name="contact_id" value="{if isset($smarty.request.contact_id)}{$smarty.request.contact_id}{else}{$bean->contact_id}{/if}">',
          3 => '<input type="hidden" name="opportunity_id" value="{if isset($smarty.request.opportunity_id)}{$smarty.request.opportunity_id}{else}{$bean->opportunity_id}{/if}">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="if(!limitation_warning()) return false;var _form = document.getElementById(\'EditView\'); _form.action.value=\'Save\'; if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',
          ),
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/lead_source.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/lead_status.js',
        ),
      ),
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
      'javascript' => '<script type="text/javascript" language="Javascript">function copyAddressRight(form)  {ldelim} form.alt_address_street.value = form.primary_address_street.value;form.alt_address_city.value = form.primary_address_city.value;form.alt_address_state.value = form.primary_address_state.value;form.alt_address_postalcode.value = form.primary_address_postalcode.value;form.alt_address_country.value = form.primary_address_country.value;return true; {rdelim} function copyAddressLeft(form)  {ldelim} form.primary_address_street.value =form.alt_address_street.value;form.primary_address_city.value = form.alt_address_city.value;form.primary_address_state.value = form.alt_address_state.value;form.primary_address_postalcode.value =form.alt_address_postalcode.value;form.primary_address_country.value = form.alt_address_country.value;return true; {rdelim} </script>',
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
      ),
      'syncDetailEditViews' => false,
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
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'middle_name_c',
            'label' => 'LBL_MIDDLE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 'last_name',
          1 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'leadrank_c',
            'label' => 'LBL_LEADRANK_C',
          ),
          1 => 
          array (
            'name' => 'gender',
            'label' => 'LBL_GENDER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'label' => 'LBL_STATUS',
            'displayParam' => 
            array (
              'javascript' => 'load = initStatus();',
            ),
          ),
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
            'name' => 'county_of_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_INCIDENT',
          ),
          1 => 'lead_source',
        ),
        11 => 
        array (
          0 => 'phone_mobile',
          1 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
          ),
        ),
        12 => 
        array (
          0 => 'phone_work',
          1 => 'email1',
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
            'displayParam' => 
            array (
              'javascript' => 'load = initSource();',
            ),
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        14 => 
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
        15 => 
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
        16 => 
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
        17 => 
        array (
          0 => 
          array (
            'name' => 'test_html_form_c',
            'studio' => 'visible',
            'label' => 'LBL_TEST_HTML_FORM',
          ),
          1 => 
          array (
            'name' => 'form_iframe_c',
            'label' => 'LBL_FORM_IFRAME',
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
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
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
    ),
  ),
);
