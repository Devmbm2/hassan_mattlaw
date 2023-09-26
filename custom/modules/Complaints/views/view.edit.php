<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2016 Salesagility Ltd.
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
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/
require_once('include/MVC/View/views/view.edit.php');
require_once('include/SugarTinyMCE.php');

class ComplaintsViewEdit extends ViewEdit {

    function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function ComplaintsViewEdit(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

    function display(){

	global $app_list_strings, $sugar_config, $db, $mod_strings, $current_user;
	if(!$current_user->isAdmin()) {
		echo "
			<script type='text/javascript'>
                                $( document ).ready(function() {
				       $('#assigned_user_name').attr('disabled',true);
				       $('#btn_assigned_user_name').attr('disabled',true);
				       $('#btn_clr_assigned_user_name').attr('disabled',true);
				       $('#mdp_estimated_complaint_value_c').attr('disabled',true);
                                       });
                        </script>
		";
	}
	if(empty($this->bean->fetched_row['id'])) {
                   $this->bean->assigned_user_id = "e4cd5835-f692-69de-3b3a-591598674c54";
                   $this->bean->assigned_user_name = "Matthew D. Powell";
                }
		/* print"<pre>";print_r($this->bean->field_name_map); */
		parent::display();
		// if($_REQUEST['return_module'] == 'Accounts' && !empty($_REQUEST['return_id'])){
			// echo "
				  // <script type='text/javascript'>
					// $( document ).ready(function() {
					  // $('#account_role').parent().parent().show();
					// });
				  // </script>";
		// }else{
			// echo "
				  // <script type='text/javascript'>
					// $( document ).ready(function() {
					  // $('#account_role').parent().parent().hide();
					// });
				  // </script>";
		// }
		
		// if($_REQUEST['return_module'] == 'Contacts' && !empty($_REQUEST['return_id'])){
			// echo "
				  // <script type='text/javascript'>
					// $( document ).ready(function() {
					  // $('#contact_role').parent().parent().show();
					// });
				  // </script>";
		// }else{
			// echo "
				  // <script type='text/javascript'>
					// $( document ).ready(function() {
					  // $('#contact_role').parent().parent().hide();
					// });
				  // </script>";
		// }
		// echo "<script type='text/javascript' src='include/javascript/sugarwidgets/SugarYUIWidgets.js'></script>";
		// echo "<script type='text/javascript' src='custom/modules/Complaints/js/edit.js'></script>";
	
    }
}
