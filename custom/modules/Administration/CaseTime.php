<?php
global $db, $app_list_strings;
$smarty = new Sugar_Smarty();
$casesdata = array();
// $usersdata = array();
$cases = "Select id, name FROM cases WHERE deleted = 0 AND cases.status != 'Closed' AND cases.status != 'Adiosed'";
$casesresult = $db->query($cases);
$casesdata[''] = 'Please Select Case';
while($casesrow = $db->fetchByAssoc($casesresult))
{
	$casesdata[$casesrow['id']] = $casesrow['name'];
}
$smarty->assign("CasesList", $casesdata);
$smarty->display('custom/modules/Administration/tpls/CaseTime.tpl');
echo $smarty;
?>