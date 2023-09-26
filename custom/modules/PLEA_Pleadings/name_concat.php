<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class name_concat{

		function plea_name_concat($bean, $event, $arguments){
			//if ($bean->fetched_row == false) {
				$pleading_sub_type_field = $GLOBALS['app_list_strings']['pleading_show_hide_fields'][$bean->subcategory_id][0];
				if(isset($bean->field_defs[$pleading_sub_type_field]['options']) && !empty($bean->field_defs[$pleading_sub_type_field]['options'])){
					$pleading_sub_type_field = $GLOBALS['app_list_strings'][$bean->field_defs[$pleading_sub_type_field]['options']][$bean->$pleading_sub_type_field];
				}else{
					$pleading_sub_type_field = $bean->$pleading_sub_type_field;
				}
				$label = $GLOBALS['app_list_strings']['subcategory_id_list'][$bean->subcategory_id];
				if($bean->incoming_or_outgoing == 'Incoming'){
					$bean->document_name = $this->make_name($bean, 'D’s', $pleading_sub_type_field, $label, $bean->subcategory_id);
			$GLOBALS['log']->fatal($pleading_sub_type_field);
				}else if($bean->incoming_or_outgoing == 'Outgoing'){
					$bean->document_name = $this->make_name($bean, 'P’s', $pleading_sub_type_field, $label, $bean->subcategory_id);
				}
			//}
		}
		
		function make_name($bean, $initial, $pleading_sub_type_field, $label, $pleading_sub_type_value){
			if(in_array($pleading_sub_type_value, array('Witness_List', 'Exhibits', 'sum', 'Subpoena'))){
				$human_defendant = BeanFactory::getBean('Contacts', $bean->contact_id_c);
				$defendant_organization = BeanFactory::getBean('Accounts', $bean->account_id_c);
				return $initial. ' '. $pleading_sub_type_field. ' '. $label . ' : '. $human_defendant->last_name . ' , ' .$defendant_organization->nickname_c;
			}else if(in_array($pleading_sub_type_value, array('Subpoenas_Service', 'Verdict'))){
				return $label;			
			}else{
				return $initial. ' '. $label. ' '. $pleading_sub_type_field;	 				
			}
		}

	}

