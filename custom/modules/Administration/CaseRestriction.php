<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

global $db, $app_list_strings;
$smarty = new Sugar_Smarty();
$modules = array(
'' => 'Select module',
'Case' => 'Cases',
'Contact' => 'Contacts',
'Organization' => 'Organizations',
);
$casesdata = array();
$contactsdata = array();
$accountsdata = array();
$usersdata = array();
$cases = "Select id, name FROM cases WHERE deleted = 0 AND cases.status != 'Closed' AND cases.status != 'Adiosed'";
$casesresult = $db->query($cases);
while($casesrow = $db->fetchByAssoc($casesresult))
{
	$casesdata[$casesrow['id']] = $casesrow['name'];
}
$contacts = "Select id, salutation, first_name, last_name FROM contacts WHERE deleted = 0";
$contactsresult = $db->query($contacts);
while($contactsrow = $db->fetchByAssoc($contactsresult))
{
    $name = $contactsrow['salutation']." ".$contactsrow['first_name']." ".$contactsrow['last_name'];
    if($name){
        $contactsdata[$contactsrow['id']] = $name;
    }
    
}
$accounts = "Select id, name FROM accounts WHERE deleted = 0";
$accountsresult = $db->query($accounts);
while($accountsrow = $db->fetchByAssoc($accountsresult))
{
        $accountsdata[$accountsrow['id']] = $accountsrow['name'];
    
}
$users = "Select id, user_name FROM users WHERE deleted = 0 AND status = 'Active'";
$usersresult = $db->query($users);
while($usersrow = $db->fetchByAssoc($usersresult))
{
	$usersdata[$usersrow['id']] = $usersrow['user_name'];
}
$sql = "Select cases_cstm.id_c, cases_cstm.restricted_user_c FROM cases_cstm where cases_cstm.restricted_user_c IS NOT NULL";
            $result = $db->query($sql);
            // $user_arr = array();
            while($row = $db->fetchByAssoc($result)){
            	$caseBean = BeanFactory::getBean("Cases",$row['id_c']);
            	if($row['restricted_user_c'] != ''){
            		$arr = explode(",",$row['restricted_user_c']);
            	 foreach($arr as $user_id){
            	 	$userBean = BeanFactory::getBean("Users",$user_id);
            	 	$user_arr[] = array("username"=>$userBean->user_name,"casename" => $caseBean->name, "userid" => $userBean->id, "caseid" => $caseBean->id);

            	 }
            	}
            	
				    

            }
$sql2 = "Select contacts_cstm.id_c, contacts_cstm.restricted_user_c FROM contacts_cstm where contacts_cstm.restricted_user_c IS NOT NULL";
            $result2 = $db->query($sql2);
            // $user_arr = array();
            while($row2 = $db->fetchByAssoc($result2)){
                $contactBean = BeanFactory::getBean("Contacts",$row2['id_c']);
                if($row2['restricted_user_c'] != ''){
                    $arr2 = explode(",",$row2['restricted_user_c']);
                 foreach($arr2 as $user_id){
                    $userBean = BeanFactory::getBean("Users",$user_id);
                    $user_arr2[] = array("username"=>$userBean->user_name,"contactname" => $contactBean->salutation." ".$contactBean->first_name." ".$contactBean->last_name, "userid" => $userBean->id, "contactid" => $contactBean->id);

                 }
                }
                
                    

            }
            $sql3 = "Select accounts_cstm.id_c, accounts_cstm.restricted_user_c FROM accounts_cstm where accounts_cstm.restricted_user_c IS NOT NULL";
            $result3 = $db->query($sql3);
            // $user_arr = array();
            while($row3 = $db->fetchByAssoc($result3)){
                $accountBean = BeanFactory::getBean("Accounts",$row3['id_c']);
                if($row3['restricted_user_c'] != ''){
                    $arr3 = explode(",",$row3['restricted_user_c']);
                 foreach($arr3 as $user_id){
                    $userBean = BeanFactory::getBean("Users",$user_id);
                    $user_arr3[] = array("username"=>$userBean->user_name,"accountname" => $accountBean->name, "userid" => $userBean->id, "accountid" => $accountBean->id);

                 }
                }
                
                    

            }            
        //     print_r($user_arr);
				    // die();
// print_r("<pre>");
// print_r($usersdata);
$smarty->assign("modulesList", $modules);
$smarty->assign("CasesList", $casesdata);
$smarty->assign("ContactsList", $contactsdata);
$smarty->assign("AccountsList", $accountsdata);
$smarty->assign("UsersList", $usersdata);
$smarty->assign("RestrictedList", $user_arr);
$smarty->assign("RestrictedListContacts", $user_arr2);
$smarty->assign("RestrictedListAccounts", $user_arr3);
$smarty->display('custom/modules/Administration/CaseRestriction.tpl');
echo $smarty;