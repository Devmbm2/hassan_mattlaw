<?php
ob_clean();
if(isset($_REQUEST['related_medical_providers']) && !empty($_REQUEST['related_medical_providers']) && $_REQUEST['related_medical_providers'] != 'null'){
	$_REQUEST['related_medical_providers'] = explode(',', $_REQUEST['related_medical_providers']);
	/* print"<pre>";print_r($_REQUEST['related_medical_providers']);die; */
	if($_REQUEST['related_module'] == 'MEDR_Medical_Records'){
		foreach($_REQUEST['related_medical_providers'] as $id){
			$related_medical_providers = BeanFactory::getBean('Accounts', $id);
			$insert = array('document_name' => $related_medical_providers->name, 'status_id' => 'Requested', 'account_id_c' => $related_medical_providers->id);
			$insert_cstm = array('range_of_records_requested_c' => 'Date_of_Incident_Only');
			$table = strtolower($_REQUEST['related_module']);
			$table_cstm = strtolower($_REQUEST['related_module']).'_cstm';
			$query_insert = "INSERT INTO $table (id,date_entered, date_modified, ".implode(",", array_keys($insert)).") VALUES(UUID(),NOW(),NOW(),'".implode("','", array_values($insert))."')";
			$query_insert_cstm = "INSERT INTO $table_cstm (id_c,".implode(",", array_keys($insert_cstm)).") VALUES(UUID(),'".implode("','", array_values($insert_cstm))."')";
			/* echo $query_insert;die; */
			$GLOBALS['db']->query($query_insert, true);
			$GLOBALS['db']->query($query_insert_cstm, true);
		}	
	}else if($_REQUEST['related_module'] == 'MREQ_MEDB_Requests'){
		$related_medical_providers = BeanFactory::getBean('Accounts', $id);
		$insert = array('document_name' => $related_medical_providers->name, 'status_id' => 'Requested');
		/* $insert_cstm = array('range_of_records_requested_c' => 'Date_of_Incident_Only'); */
		$table = strtolower($_REQUEST['related_module']);
		$table_cstm = strtolower($_REQUEST['related_module']).'_cstm';
		$query_insert = "INSERT INTO $table (id,date_entered, date_modified, ".implode(",", array_keys($insert)).") VALUES(UUID(),NOW(),NOW(),'".implode("','", array_values($insert))."')";
		/* $query_insert_cstm = "INSERT INTO $table_cstm (id_c,".implode(",", array_keys($insert_cstm)).") VALUES(UUID(),'".implode("','", array_values($insert_cstm))."')"; */
		/* echo $query_insert;die; */
		$GLOBALS['db']->query($query_insert, true);
		/* $GLOBALS['db']->query($query_insert_cstm, true); */
	}

}
echo 'done';die;