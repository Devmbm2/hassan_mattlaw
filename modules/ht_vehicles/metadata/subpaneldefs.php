<?php
$layout_defs['ht_vehicles'] = array(
    // list of what Subpanels to show in the DetailView
    'subpanel_setup' => array(
		'ht_vehicles_contacts_driver' => array(
			'order' => 101,
			'module' => 'Contacts',
			'subpanel_name' => 'ForVehiclesDriver',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_CONTACTS_DRIVER_TITLE',
			'get_subpanel_data' => 'contacts',
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopButtonQuickCreate',
				),
				array (
				  'widget_class' => 'SubPanelTopSelectContactButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_contact_role'=>'Driver',
					),
				),
			),
		),
		'ht_vehicles_contacts_parent' => array(
			'order' => 102,
			'module' => 'Contacts',
			'subpanel_name' => 'ForVehiclesParent',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_CONTACTS_PARENT_TITLE',
			'get_subpanel_data' => 'contacts',
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopButtonQuickCreate',
				),
				array (
				  'widget_class' => 'SubPanelTopSelectContactButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_contact_role'=>'Parent',
					),
				),
			),
		),
		'ht_vehicles_owner' => array(
			'order' => 103,
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_OWNER_TITLE',
			'module' => 'Contacts',
			'subpanel_name' => 'ForVehiclesOwner',
            'type' => 'collection',
			'collection_list' => array(
                'contacts' => array(
                    'module' => 'Contacts',
                    'subpanel_name' => 'ForVehiclesOwner',
                    'get_subpanel_data' => 'contacts',
                ),
				'accounts' => array(
                    'module' => 'Accounts',
                    'subpanel_name' => 'ForVehiclesOwner',
                    'get_subpanel_data' => 'accounts',
                ),
			),
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'Owner',
					),
				),
				array (
				  'widget_class' => 'SubPanelTopSelectContactButton',
				  'mode' => 'MultiSelect',
				'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_contact_role'=>'Owner',
					),
				),
			),
		),
		'ht_vehicles_co_owner' => array(
			'order' => 103,
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_CO_OWNER_TITLE',
			'module' => 'Contacts',
			'subpanel_name' => 'ForVehiclesCOOwner',
            'type' => 'collection',
			'collection_list' => array(
                'contacts' => array(
                    'module' => 'Contacts',
                    'subpanel_name' => 'ForVehiclesCOOwner',
                    'get_subpanel_data' => 'contacts',
                ),
				'accounts' => array(
                    'module' => 'Accounts',
                    'subpanel_name' => 'ForVehiclesCOOwner',
                    'get_subpanel_data' => 'accounts',
                ),
			),
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'COOwner',
					),
				),
				array (
				  'widget_class' => 'SubPanelTopSelectContactButton',
				  'mode' => 'MultiSelect',
				'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_contact_role'=>'COOwner',
					),
				),
			),
		),
		'ht_vehicles_employer' => array(
			'order' => 103,
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_EMLOYER_TITLE',
			'module' => 'Contacts',
			'subpanel_name' => 'ForVehiclesEmployer',
            'type' => 'collection',
			'collection_list' => array(
                'contacts' => array(
                    'module' => 'Contacts',
                    'subpanel_name' => 'ForVehiclesEmployer',
                    'get_subpanel_data' => 'contacts',
                ),
				'accounts' => array(
                    'module' => 'Accounts',
                    'subpanel_name' => 'ForVehiclesEmployer',
                    'get_subpanel_data' => 'accounts',
                ),
			),
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'Employer',
					),
				),
				array (
				  'widget_class' => 'SubPanelTopSelectContactButton',
				  'mode' => 'MultiSelect',
				'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_contact_role'=>'Employer',
					),
				),
			),
		),
		'ht_vehicles_um_driver' => array(
			'order' => 104,
			'module' => 'Accounts',
			'subpanel_name' => 'ForUMDriver',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_UM_DRIVER_TITLE',
			'get_subpanel_data' => 'accounts',
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopButtonQuickCreate',
				),
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'UM-Driver',
					),
				),
			),
		),
		'ht_vehicles_um_owner' => array(
			'order' => 105,
			'module' => 'Accounts',
			'subpanel_name' => 'ForUMOwner',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_UM_OWNER_TITLE',
			'get_subpanel_data' => 'accounts',
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopButtonQuickCreate',
				),
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'UM-Owner',
					),
				),
			),
		),
		'ht_vehicles_um_employer' => array(
			'order' => 106,
			'module' => 'Accounts',
			'subpanel_name' => 'ForUMEmployer',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'title_key' => 'LBL_HT_VEHICLES_UM_EMPLOYER_TITLE',
			'get_subpanel_data' => 'accounts',
			'top_buttons' => array (
				array (
				  'widget_class' => 'SubPanelTopButtonQuickCreate',
				),
				array (
				  'widget_class' => 'SubPanelTopSelectAccountButton',
				  'mode' => 'MultiSelect',
				  'add_to_passthru_data'=>array (
						'REL_ATTRIBUTE_account_role'=>'UM-Employer',
					),
				),
			),
		),
		'get_contact_insurance' => array(
			// numeric order position of subpanel by default ( lowest number comes first )
			'order' => 20,
			'sort_by' => 'date_entered',
			'sort_order' => 'desc',
			'title_key' => 'Insurance',
			'subpanel_name' => 'ForVehiclesDriver',
			'module' => 'DEF_Client_Insurance',
			// Specify the custom function to call
			'get_subpanel_data' => 'function:get_contact_insurance',
			'top_buttons' => array (
				array (
					'widget_class' => 'SubPanelTopSelectDriverInsuranceButton',
				),
			),	
			// Set to true to indicate we are building a custom SQL query
			'generate_select' => true,             
			'function_parameters' => array(
				// File where the above function is defined at
				'import_function_file' => 'custom/include/custom_utils.php', 
			),
			
		),
	),
);