<?php
 // created: 2017-09-12 13:27:33
$layout_defs["ht_phone_list"]["subpanel_setup"]['related_text_messages'] = array (
  'order' => 100,
  'module' => 'ht_sms',
  'subpanel_name' => 'ht_phone_list_subpanel_related_text_messages',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_RELATED_TEXT_MESSAGES',
  'get_subpanel_data' => 'function:getRelatedTexts',
  'generate_select' => true,             
  'get_distinct_data' => true,             
  'function_parameters' => array(
     'import_function_file' => 'custom/include/custom_utils.php', 
     'name' => $this->_focus->name, 
  ),
  'top_buttons' => 
  array (
  ),
);