<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

/*********************************************************************************

 * Description:  Defines the English language pack for the base application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('include/Dashlets/DashletGenericChart.php');

class UsersActivityByModuleDashlet extends DashletGenericChart { 
    public $pcua_modules = array();
    public $pcua_ids     = array();
    public $pcua_date_start;
    public $pcua_date_end;
    
    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'UsersActivity';
    
    /**
     * @see DashletGenericChart::__construct()
     */    
    public function __construct($id, array $options = null)
    {
        global $timedate;
        if(empty($options['pcua_date_start']))
            $options['pcua_date_start'] = $timedate->asDbDate($timedate->getNow()->modify("-6 months"));   
        if(empty($options['pcua_date_end']))
            $options['pcua_date_end'] =  $timedate->nowDbDate(); 
        
        require('modules/UsersActivity/Dashlets/UsersActivityByModuleDashlet/UsersActivityByModuleDashlet.data.php');
        $this->_searchFields = $dashletData['UsersActivityByModuleDashlet']['searchFields'];
        
        parent::__construct($id,$options);
    }
    
    /**
     * @see DashletGenericChart::displayOptions()
     */
    public function displayOptions()
    {
        global $app_list_strings;
        
        require('modules/UsersActivity/Dashlets/UsersActivityByModuleDashlet/UsersActivityByModuleDashlet.data.php');
        $this->_searchFields = $dashletData['UsersActivityByModuleDashlet']['searchFields'];
        
        $selected_datax = array();
        if (!empty($this->pcua_modules) && sizeof($this->pcua_modules) > 0)
            foreach ($this->pcua_modules as $key)
                $selected_datax[] = $key;
        else
            $selected_datax = array_keys(UsersActivity::getModuleList());
        
        $this->_searchFields['pcua_modules']['options'] = array_filter(UsersActivity::getModuleList());
        $this->_searchFields['pcua_modules']['input_name0'] = $selected_datax;  
                
        if (!isset($this->pcua_ids) || count($this->pcua_ids) == 0)
            $this->_searchFields['pcua_ids']['input_name0'] = array_keys(get_user_array(false));
        
        return parent::displayOptions();
    }

    /**
     * @see DashletGenericChart::display()
     */
    public function display() 
    {
    	global $timedate;
        require("modules/Charts/chartdefs.php");
        $chartDef = array(	
            'type' => 'code',
            'id' => 'Chart_users_activities',
            'label' => "LBL_MODULE_TITLE",
            'chartUnits' => '',
            'chartType' => 'horizontal group by chart',
            'groupBy' => array( 'module_name', 'name' ),
            'base_url'=> 
                    array( 	
                        'module' => 'UsersActivity',
                                    'action' => 'index',
                                    'query' => 'true',
                                    'searchFormTab' => 'advanced_search',
                             ),
            'url_params' => array( 'module_name', 'name', 'date_entered'),				
        );
		
        require_once('include/SugarCharts/SugarChartFactory.php');
        $sugarChart = SugarChartFactory::getInstance();
        $sugarChart->is_currency = false;   
       
        $subtitle = translate('LBL_MODULE_TITLE', 'UsersActivity');
        $sugarChart->setProperties('', $subtitle, $chartDef['chartType']);
        $sugarChart->base_url = $chartDef['base_url'];
        $sugarChart->group_by = $chartDef['groupBy'];
        
        $sugarChart->url_params = array();
        if ( count($this->pcua_ids) > 0 && count($this->pcua_ids) != count(array_keys(get_user_array(false))) ){
            $sugarChart->url_params['assigned_user_id'] = array_values($this->pcua_ids);
        }
        if (!empty($this->pcua_date_start) && !empty($this->pcua_date_end))
        {
            $sugarChart->url_params['date_entered_advanced_range_choice'] = 'between';
            $sugarChart->url_params['start_range_date_entered_advanced'] = $timedate->to_display_date($this->pcua_date_start, false);
            $sugarChart->url_params['end_range_date_entered_advanced'] = $timedate->to_display_date($this->pcua_date_end, false);
        }
        elseif (!empty($this->pcua_date_start))
        {
            $sugarChart->url_params['date_entered_advanced_range_choice'] = 'greater_than';
            $sugarChart->url_params['range_date_entered_advanced'] = $timedate->to_display_date($this->pcua_date_start, false);
        }
        elseif (!empty($this->pcua_date_end))
        {
            $sugarChart->url_params['date_entered_advanced_range_choice'] = 'less_than';
            $sugarChart->url_params['range_date_entered_advanced'] = $timedate->to_display_date($this->pcua_date_end, false);
        }
        
        
        $sugarChart->getData($this->constuctQuery());
        $xmlFile = $sugarChart->getXMLFileName($this->id);
        $sugarChart->saveXMLFile($xmlFile, $sugarChart->generateXML());
	
        return $this->getTitle('<div align="center"></div>') . 
            '<div align="center">' . $sugarChart->display($this->id, $xmlFile, '100%', '480', false) . '</div>'. $this->processAutoRefresh();
	}
    
    /**
     * @see DashletGenericChart::constructQuery()
     */
    protected function constuctQuery()
    {
        $query = "SELECT module_name,name,count(*) as total FROM usersactivity ";
	$query .= " WHERE usersactivity.deleted=0 ";
	if ( count($this->pcua_ids) > 0 )
            $query .= "AND usersactivity.assigned_user_id IN ('".implode("','",$this->pcua_ids)."') ";
        if ( count($this->pcua_modules) > 0 )
            $query .= "AND usersactivity.module_name IN ('".implode("','",$this->pcua_modules)."') ";
	else
            $query .= "AND usersactivity.module_name IN ('".implode("','",array_keys(UsersActivity::getModuleList()))."') ";
        
        $query .= " AND usersactivity.date_entered >= ". db_convert("'".$this->pcua_date_start."'",'date').
                  " AND usersactivity.date_entered <= ".db_convert("'".$this->pcua_date_end."'",'date');
        
        $query .= " GROUP BY name,module_name ORDER BY module_name,name";
		
        return $query;
	}
}