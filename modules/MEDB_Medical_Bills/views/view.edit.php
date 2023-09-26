<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
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
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once('include/MVC/View/views/view.edit.php');
class MEDB_Medical_BillsViewEdit extends ViewEdit{
	function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }

    public function display()
    {
	
        if (isset($this->bean->id)) {
            $this->ss->assign('FILE_OR_HIDDEN', 'hidden');
            if (empty($_REQUEST['isDuplicate']) || $_REQUEST['isDuplicate'] === 'false') {
                $this->ss->assign('DISABLED', 'disabled');
            }
        } else {
            $this->ss->assign('FILE_OR_HIDDEN', 'file');
        }
	
        parent::display();
			$formName = $this->ev->formName;
			if(empty($formName)){
				$formName = 'EditView';
			}
			
			echo "<script type='text/javascript'>
					$(document).ready(function() {
						var formName = '{$formName}';
						console.log('formName1');
						console.log(formName);
						$( '#'+ formName +' #type_c' ).change(function() {
							showhidemedFields(); //Call hide/show function
						});
						showhidemedFields();
					});

function showhidemedFields(){
	//hide fields
        var type = $('#'+formName+ ' #type_c').val();
        if(type == 'Medicaid')  {
           $('#'+formName +' #medicaid_date_c').parent().parent().parent().show();
           $('#'+formName +' #medicaid_id_number_c').parent().parent().show();
		   $('#'+formName+ ' #claim_number').parent().parent().hide();
			 $('#'+formName+ ' #adjuster_name').parent().parent().hide();
			  $('#'+formName+ ' #pip_paid').parent().parent().hide();
        }else{
			 $('#'+formName +' #medicaid_date_c').parent().parent().parent().hide();
			 $( '#'+formName +' #medicaid_id_number_c').parent().parent().hide();
			  $('#'+formName +' #medicaid_date_c').parent().parent().parent().hide();
			 $('#'+formName+ ' #medicare_date_c').parent().parent().parent().hide();
			 $('#'+formName+ ' #medicare_id_number_c').parent().parent().hide();
			
			 
		} 
		if(type == 'Medicare')  {
          $('#'+formName+ ' #medicare_date_c').parent().parent().parent().show();
          $('#'+formName+ ' #medicare_id_number_c').parent().parent().show();
		  $('#'+formName+ ' #medicare_type_c').parent().parent().show();
		   $('#'+formName+ ' #claim_number').parent().parent().hide();
			 $('#'+formName+ ' #adjuster_name').parent().parent().hide();
			 $('#'+formName+ ' #pip_paid').parent().parent().hide();
        }else{
			 $('#'+formName+ ' #medicare_date_c').parent().parent().parent().hide();
             $('#'+formName+ ' #medicare_id_number_c').parent().parent().hide();
			 $('#'+formName+ ' #medicare_type_c').parent().parent().hide();
			 
			 
		}
		
		if(type == 'PIP'){
			 var pip_type_show = ['reduction_approved_by', 'client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show, function( index, value ) {
				  $('#'+formName+' #'+value).parent().parent().hide();
				});
				$('div[data-label=\'LBL_DATE_PIP_EXHAUSTED\']').hide();
				$('#'+formName+ ' #claim_number').parent().parent().show();
				$('#'+formName+ ' #adjuster_name').parent().parent().show();
				$('#'+formName+ ' #total_charges').parent().parent().show();
			
		}else{
			 var pip_type_show = ['pip_paid','client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show, function( index, value ) {
				  $('#'+formName+ ' #'+value).parent().parent().show();
				});
				$('div[data-label=\'LBL_DATE_PIP_EXHAUSTED\']').show();
				$('#'+formName+ ' #claim_number').parent().parent().hide();
				$('#'+formName+ ' #adjuster_name').parent().parent().hide();
				$('#'+formName+ ' #total_charges').parent().parent().show();

				
		}
		$('#'+formName+ ' #medicare_id_number_c').parent().parent().hide();
		$('#'+formName+ ' #medicare_type_c').parent().parent().hide();
}		
					
				</script>
				
				";
			
    }
}
