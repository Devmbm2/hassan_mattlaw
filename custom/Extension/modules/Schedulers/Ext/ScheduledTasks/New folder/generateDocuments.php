<?php
$job_strings[] = 'generateDocuments';
function generateDocuments()
{
	global $db;
	//7 Day Let Go To Doc Watch Your DVD Gaps In Treatment
	$template_id = '3b2b7325-c721-2302-e92c-5a57bc713d77';
	
	$_REQUEST['plantilladocumento_id'] = $template_id;
	$_REQUEST['moduloplantilladocumento'] = 'Cases';
	$_REQUEST['module'] = 'DHA_PlantillasDocumentos';
	$_REQUEST['action'] = 'htgeneratedocument';
	$_REQUEST['mode'] = 'selected';
	$_REQUEST['AttachGeneratedDocumentToRecord'] = 1;
	$_REQUEST['from_view'] = 'customselection';
	// $_REQUEST['related_selected'] = 'customselection';
	$_REQUEST['FROM_MODULE'] = 'Cases';
	$_REQUEST['from_scheduler'] = 1;
	
	$sql = "SELECT
			*
		FROM
			`cases` c
		WHERE
			c.deleted = 0
		AND DATE(c.date_entered) = DATE(DATE_SUB(NOW(), INTERVAL 7 DAY))
		AND c. STATUS NOT IN (
			'Adiosed',
			'Closed',
			'Pending_Signed_Closing',
			'Pending_Reductions',
			'Pending_Adios',
			'Referred_Out',
			'Appeal_Pending',
			'Lit_8'
		)
		AND c.id NOT IN (
			SELECT
				parent_id
			FROM
				ht_docs_auto_generated ag
			INNER JOIN documents d ON (
				d.id = ag.generated_doc_id
				AND d.deleted = 0
			)
			WHERE
				ag.deleted = 0
			AND ag.template_id = '{$template_id}'
		)
	";
	// $case_id = 'e5cf1e33-a433-bacf-12a9-5d10d1e29e1f';
	$result = $db->query($sql);
	while ($row = $db->fetchByAssoc($result)) {
		$_REQUEST['uid'] = $row['id'];
		$document_id = generateDocumentFromRequest();
		$insert_sql = "INSERT INTO `ht_docs_auto_generated` (`id`, `parent_id`, `parent_type`, `generated_doc_id`, `template_id`, `date_modified`) VALUES (UUID(), '{$row['id']}', '{$_REQUEST['FROM_MODULE']}', '{$document_id}','{$template_id}', NOW())";
		$db->query($insert_sql);
	}
	
}

function generateDocumentFromRequest(){
	
	$bean = SugarModule::get($_REQUEST['moduloplantilladocumento'])->loadBean();
      
	if(!$bean->ACLAccess('detail')){
		ACLController::displayNoAccess(true);
		sugar_cleanup(true);
	}

	set_time_limit(0);
	$GLOBALS['db']->setQueryLimit(0);

	require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
	require_once('include/utils.php');
	$massDoc = new MassGenerateDocument();      
	$massDoc->setSugarBean($bean);
	$return_data = $massDoc->hthandleMassGenerateDocument();
	$GD = new Generate_Document($return_data[0], $return_data[1], $return_data[2]);
	if(!empty($_REQUEST['enPDF']) && $_REQUEST['enPDF'] == 'true')
		$GD->enPDF = $_REQUEST['enPDF'];
	$GD->CargarPlantilla ();
	if(isset($_REQUEST['related_selected']) && !is_array($_REQUEST['related_selected'])){
		$_REQUEST['related_selected'] = explode(',', $_REQUEST['related_selected']);
	}
	$related_selected = $_REQUEST['related_selected'];
	
	
	$GD->ObtenerDatos ($related_selected);
	$selection_array = array();
	$relation_labels = array();
	if(!isset($_REQUEST['from_view']) || $_REQUEST['from_view'] == ''){
		foreach($GD->relaciones AS $relation) {
			$data_array = $GD->datos;
			foreach($data_array AS $index => $data) {
				$related_records = $data[$relation];
				if(isset($related_records) && sizeof($related_records) > 0){
					foreach($related_records AS $r_record) {
						$selection_array[$index]['name'] = $data['name'];
						$selection_array[$index]['relation'][$relation]['data'][$r_record['id']] = $r_record['name'];
						$label = $bean->field_defs[$relation]['vname'];
						$label = translate($label, $return_data[0]);
						$selection_array[$index]['relation'][$relation]['label'] = 	$label;
					}
				}
			}
		}
	}
	if(isset($selection_array) && sizeof($selection_array) > 0 ){
		$_REQUEST['SELECTION_ARRAY'] = json_encode($selection_array);
		$_REQUEST['FROM_MODULE'] = $return_data[0];
		$this->view = 'customselection';
		$GLOBALS['view'] = $this->view;
		
	}else{
		require_once("modules/DHA_PlantillasDocumentos/Generate_Document.php");
	
		if (isset($_REQUEST['AttachToEmailGeneratedDocument']) && $_REQUEST['AttachToEmailGeneratedDocument']) {
			GenerateDocumentAndAttachToEmail ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
		} else if (isset($_REQUEST['AttachGeneratedDocumentToRecord']) && $_REQUEST['AttachGeneratedDocumentToRecord']) {
			return GenerateDocumentAndAttachToRecord ($GD,$return_data[0], $return_data[1], $return_data[2]);
		} else if (isset($_REQUEST['AttachToNoteGeneratedDocument']) && $_REQUEST['AttachToNoteGeneratedDocument']) {
			GenerateDocumentAndAttachToNote ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
		} else {
			$GD->GenerarInforme();
		}
	}
}
