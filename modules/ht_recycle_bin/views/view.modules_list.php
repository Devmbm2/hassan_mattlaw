<?php
class ht_recycle_binViewModules_list extends SugarView
{
 	public function display(){
		global $app_list_strings, $mod_strings;
		$module_exempt = array('Home', 'Calendar', 'ht_recycle_bin', 'Emails', 'Administration', 'Connectors', 'AOP_Case_Events', 'AOP_Case_Updates', 'AOS_Contracts', 'SNIP', 'AOD_IndexEvent', 'AOS_Line_Item_Groups', 'iFrames', 'AOW_Conditions', 'AOW_Actions', 'AOW_WorkFlow', 'AOW_Actions', 'UpgradeWizard', 'Sync', 'AOBH_BusinessHours', 'AOK_Knowledge_Base_Categories', 'SugarFeed', 'SugarFavorites', 'Calls_Reschedule', 'CampaignLog', 'EAPM', 'AOD_Index', 'AOS_Invoices', 'jjwg_Address_Cache', 'FAQ', 'Activities', 'ContractTypes', 'Currencies', 'DocumentRevisions', 'EmailAddresses', 'EmailMarketing', 'Sugar_Favorites', 'InboundEmail', 'Library', 'Newsletters', 'OAuthKeys', 'OAuthTokens', 'OutboundEmailAccounts', 'AOW_Processed', 'Trackers', 'TrackerSessions', 'TrackerQueries', 'TrackerPerfs', 'TimePeriods', 'TemplateSectionLine', 'TemplateEditor', 'TaxRates', 'AOR_Fields', 'AOR_Conditions', 'Releases', 'Feeds');
		$module_option_list = "";
		$flipped = array_flip($app_list_strings['moduleList']);
		ksort($flipped);
		$app_list_strings['moduleList'] = array_flip($flipped);
		$module_option_list = "<option value=''>&lt;&lt;Select Module&gt;&gt;</option>";
		foreach($app_list_strings['moduleList'] as $module=>$label){
			if(!in_array($module, $module_exempt)){
				$module_option_list .= "<option value='{$module}'>{$label}</option>";
			}
		}
		$this->ss->assign("MODULES_OPTIONS", $module_option_list);
		$this->ss->display('modules/ht_recycle_bin/tpls/modules_list.tpl');
    }
}

?>
