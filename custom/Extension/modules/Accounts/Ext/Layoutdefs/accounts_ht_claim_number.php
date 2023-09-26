<?php
$layout_defs["Accounts"]["subpanel_setup"]['accounts_ht_claim_number'] = array (
  'order' => 1002,
  'module' => 'ht_Claim_Number',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNTS_HT_CLAIM_NUMBER_HT',
  'get_subpanel_data' => 'accounts_ht_claim_number',
  'top_buttons' => array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 =>
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
    2 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);

$layout_defs["Accounts"]["subpanel_setup"]['accounts_ht_claim_number']['searchdefs'] =
array (
    'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);
?>
