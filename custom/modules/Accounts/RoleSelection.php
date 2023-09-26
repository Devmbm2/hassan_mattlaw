<?php
ob_clean();
require_once('custom/modules/Contacts/ContactCaseRelationship.php');
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $sugar_version, $sugar_config;

$focus = new ContactCaseRelationship();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}



// Prepopulate either side of the relationship if passed in.
safe_map('case_name', $focus);
safe_map('case_id', $focus);
safe_map('contact_name', $focus);
safe_map('contact_id', $focus);
safe_map('account_role', $focus);
$ACCOUNT_ROLE_OPTIONS = get_select_options_with_id($app_list_strings['relationship_to_case_list'], $focus->account_role);
$html = '
	<table>
	<tr>
	<td scope="row"><slot>Account Role</slot></td>
	<td ><slot><select name="account_role" id="account_role">'.$ACCOUNT_ROLE_OPTIONS.'</select></slot></td>
	<td scope="row"><slot>&nbsp;</slot></td>
	<td ><slot>&nbsp;</slot></td>
	</tr>
	<tr>
	<input type="button" id = "save_role" value="Save" onclick="send_back_role_selection(\''.$_REQUEST['record'].'\' , \''.$_REQUEST['module'].'\');" style="float:right;">
	</tr>
	</table>';
	
echo $html;die;