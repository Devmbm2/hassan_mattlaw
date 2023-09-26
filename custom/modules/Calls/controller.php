<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class CallsController extends SugarController
{

   public function action_checkContactExistsUnderCase()
    {
		$this->view = NULL;
		$sql = "SELECT * FROM `contacts_cases` WHERE case_id = '{$_REQUEST['parent_case_id']}' AND contact_id = '{$_REQUEST['related_id']}' LIMIT 1";
		/* echo $sql;die; */
		$result = $GLOBALS['db']->query($sql, true);
		/* print_r($result); */
		$check = false;
		if($result->num_rows < 1){
			$check = true;
		}
		echo $check;die;
		
    }
    public function action_getRelatedCallRecord(){
    	$field_mapping = array(
		'Client_Call_Type' => array('Client','Injured_Person'),
		'Attorney_Call_Type' => array('Attorney', 'Referral_Attorney', 'Referral_Non_Attorney', 'Defense_Attorney', 'Defense_Attorney2'),
		// 'Insurance_Adjuster_Call_Type' => 'Adjuster',
		'Judicial_Assistant' => 'Judge',
        'Vendor_Call_Type' => 'Vendor',
        'Court' => 'Clerk_of_Court',
        'Medical' => 'Doctor_Treating',
        'B_and_A_Witness_Call_Type' => 'Witness_B_A',
        'Expert_Witness_Call_Type' => array('Witness_Expert_for_Defendant', 'Witness_Expert_for_Plaintiff'),
        'Fact_Witness_Call_Type' => array('Witness_Fact_Defendant', 'Witness_Fact_Plaintiff'),
        'Insurance_Adjuster_Call_Type' => array('Insurance_Company', 'Insured_Person','Adjuster'),
	);
    	$caller_type = $_REQUEST['caller_type'];
    	$case_id = $_REQUEST['case_id'];
    	$result  = $field_mapping[$caller_type];
    	static $listvalues = null;
    if(!$listvalues){
        global $db;
        if(is_array($result))
        {
            $merge_results = array();
            $listvalues = array();
            $listvalues[''] = '';
            // $result_array = explode(',',$result);
            foreach($result as $result_array){
                if(!empty($case_id) && $case_id!=NULL){
            $query = "SELECT contact_id,contact_role FROM contacts_cases where contact_role = '{$result_array}' AND case_id = '{$case_id}' AND deleted = 0 order by contact_role asc ";
                }
                else{
                    $query = "SELECT contact_id,contact_role FROM contacts_cases where contact_role = '{$result_array}' AND deleted = 0 order by contact_role asc";
                    
                }
                $result = $db->query($query, false);
                    while (($row = $db->fetchByAssoc($result)) != null) {
                            $contact_bean = BeanFactory::getBean('Contacts',$row['contact_id']);
                            $contact_name = $contact_bean->salutation." ".$contact_bean->first_name." ".$contact_bean->last_name;
                            $listvalues[$row['contact_id']] = $contact_name;
                    }
            }
        }
        else{
            if(!empty($case_id) && $case_id!=NULL){
                $query = "SELECT contact_id,contact_role FROM contacts_cases where contact_role = '{$result}' AND case_id = '{$case_id}' AND deleted = 0 order by contact_role asc ";
                }
            else{
                $query = "SELECT contact_id,contact_role FROM contacts_cases where contact_role = '{$result}' AND deleted = 0 order by contact_role asc ";
            }
            $result = $db->query($query, false);
            $listvalues = array();
            $listvalues[''] = '';
            while (($row = $db->fetchByAssoc($result)) != null) {
                    $contact_bean = BeanFactory::getBean('Contacts',$row['contact_id']);
                    $contact_name = $contact_bean->salutation." ".$contact_bean->first_name." ".$contact_bean->last_name;
                $listvalues[$row['contact_id']] = $contact_name;
            }
        }
        
    }
    echo json_encode($listvalues);
    die();
    }

}
