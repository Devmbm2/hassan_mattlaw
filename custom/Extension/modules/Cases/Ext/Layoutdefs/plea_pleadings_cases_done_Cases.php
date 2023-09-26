<?php

$layout_defs["Cases"]["subpanel_setup"]['plea_pleadings_cases_done'] = array (
  'sort_oder' => 'desc',
  'sort_by' => 'date_filed_c',
  'module' => 'PLEA_Pleadings',
  'subpanel_name' => 'Case_subpanel_plea_pleadings_cases_done',
  'sort_order' => 'DESC',
  'title_key' => 'LBL_PLEA_PLEADINGS_CASES_DONE_FROM_PLEA_PLEADINGS_TITLE',
  'get_subpanel_data' => 'plea_pleadings_cases',
  'top_buttons' => array (
    0 =>array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
),
  ),
);

$layout_defs["Cases"]["subpanel_setup"]['plea_pleadings_cases_done']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);