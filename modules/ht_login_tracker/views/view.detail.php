<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2010 SugarCRM Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 */

require_once('include/MVC/View/views/view.detail.php');

class ht_login_trackerViewDetail extends ViewDetail{

    public function preDisplay(){
		$this->bean->browser_information=$this->__json2table($this->bean->browser_information, 'browser_information');
		$this->bean->server_information=$this->__json2table($this->bean->server_information, 'server_information');
		echo "<script src='//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js' />";
		parent::preDisplay();
    }
	public function display(){
		
		parent::display();
		echo '<script>
		$(document).ready(function(){
			$("[field=server_information]").parent().children(":first-child").hide();
			$("[field=browser_information]").parent().children(":first-child").hide();
			$("[field=latitude_longitude]").parent().children(":first-child").hide();
		});
		</script>';
		
	}
	private function __json2table($str, $table_id){
		$information=json_decode(base64_decode($str));
		
		$ret="<table id='{$table_id}_tbl' class='table table-striped table-bordered' >
				<thead>
					<tr style='cursor:pointer'><th>Parameter</th><th>Value</th></tr>
				</thead>
				<tbody>";
		foreach($information as $k=>$v){
			$ret.="<tr><td>{$k}</td><td>{$v}</td></tr>";
		}
		$ret.="</tbody></table>
		<script>$(document).ready( function(){ $('#{$table_id}_tbl').DataTable({'paging': false});});</script>";
		return (empty($information))?'':$ret;
	}

}
