<?PHP
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/UsersActivity/UsersActivity_sugar.php');
class UsersActivity extends UsersActivity_sugar {
	
	function UsersActivity(){	
		parent::UsersActivity_sugar();
	}
        
        public static function getModuleList()
        {
            global $beanList, $app_list_strings, $sugar_config;
        
            $modulesList = $app_list_strings['moduleList'];
            $excludedModules = explode(',',$sugar_config['pcua']['excludemodules']);
            foreach($modulesList as $mkey => $mvalue)
            {
                if(in_array($mkey,array('Audit','CampaignLog','CampaignTrackers','Releases','EmailMan','DynamicFields','EditCustomFields','Versions','vCals','CustomFields','SavedSearch','MergeRecords')))
                {
                    unset($modulesList[$mkey]);
                }
                if(!isset($beanList[$mkey])){
                    unset($modulesList[$mkey]);
                }
                if (in_array($mkey,$excludedModules)){
                    unset($modulesList[$mkey]);
                }
            }
            return $modulesList;
        }
        
        public static function getAllModuleList()
        {
            global $beanList, $app_list_strings, $sugar_config;
        
            $modulesList = $app_list_strings['moduleList'];
            foreach($modulesList as $mkey => $mvalue)
            {
                if(in_array($mkey,array('Audit','CampaignLog','CampaignTrackers','Releases','EmailMan','DynamicFields','EditCustomFields','Versions','vCals','CustomFields','SavedSearch','MergeRecords')))
                {
                    unset($modulesList[$mkey]);
                }
                if(!isset($beanList[$mkey])){
                    unset($modulesList[$mkey]);
                }
            }
            return $modulesList;
        }
        
        public static function checkExcludeTraking($ip,$userid,$action,$module)
        {
            global $sugar_config;
            $exclude = false;
            if ($ip != '')
            {
                if (isset($sugar_config['pcua']['excludeip']) && $sugar_config['pcua']['excludeip'] != '' )
                {
                    $ipArray = explode(',',$sugar_config['pcua']['excludeip']);
                    if (in_array($ip,$ipArray)){
                        $exclude = true;
                    }
                }
            }
            if ($userid != '')
            {
                if (isset($sugar_config['pcua']['excludeusers']) && $sugar_config['pcua']['excludeusers'] != '' )
                {
                    $ids = explode(',',$sugar_config['pcua']['excludeusers']);
                    if (in_array($userid,$ids)){
                        $exclude = true;
                    }
                }
            }
            if ($action != '')
            {
                if (isset($sugar_config['pcua']['excludeactions']) && $sugar_config['pcua']['excludeactions'] != '' )
                {
                    $ids = explode(',',$sugar_config['pcua']['excludeactions']);
                    if (in_array($action,$ids)){
                        $exclude = true;
                    }
                }
            }
            if ($module != '')
            {
               
                if(in_array($module,array('UsersActivity','Audit','CampaignLog','CampaignTrackers','Releases','EmailMan','DynamicFields','EditCustomFields','Versions','vCals','CustomFields','SavedSearch','MergeRecords')))
                {
                    $exclude = true;
                }
                elseif (isset($sugar_config['pcua']['excludemodules']) && $sugar_config['pcua']['excludemodules'] != '' )
                {
                    $ids = explode(',',$sugar_config['pcua']['excludemodules']);
                    if (in_array($module,$ids)){
                        $exclude = true;
                    }
                }
            }            
            return $exclude;
        }
	
}
?>