<?php
class CustomAccountsController extends SugarController
{
	public function action_livesearch()
	{
		global $db;

		$searchText = $_REQUEST['searcheditem'];
        $query="";
        foreach($_SESSION['keysOfFP_eventsListViewTable'] as $keys2=>$values2){
            $query.=$values2.",";
        }
		$sql = "SELECT id,deleted,".substr_replace($query ,"",-1)." FROM accounts  WHERE (name LIKE  '%$searchText%'
	 			OR nickname_c LIKE '%$searchText%' OR account_type LIKE  '%$searchText%'  OR phone_office LIKE  '%$searchText%' OR billing_address_city LIKE  '%$searchText%') AND deleted =0
				order by account_type asc LIMIT 200";
		$result = $db->query($sql);
		$fetched_record=array();
		$fetchedsingle_record="";
		if ($result->num_rows > 0) {
            while($record = $GLOBALS["db"]->fetchByAssoc($result)){
                    foreach ($record as $keys=>$values) {
                            $fetchedsingle_record .= ('"'.$keys.'"'.':'.'"'.$values.'"').",";
                    }
                    $fetched_record[]="{".substr_replace($fetchedsingle_record ,"",-1)."}";
                    $fetchedsingle_record="";
                }
			$output = array(
				"data"       =>  $fetched_record
			   );
		    echo json_encode($output);
			die();
		} else {
            echo json_encode(array('data'=>''));
			die();
		}
	}
}


