<?php
	// Nota: Cuando se llama a esta función, solo deben de haber un id y el módulo debe de estar relacionado con Notas
	//       Esto se traduce en que la llamada solo se puede producir desde el DetailView, y que el módulo debe de estar dentro de la 	lista $app_list_strings['record_type_display_notes']
// ini_set('display_errors',1); 
// error_reporting(E_ALL); // STRICT DEVELOPMENT
	global $db;
	global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
	require_once('include/utils/sugar_file_utils.php');
	require_once('include/externalAPI/ExternalAPIFactory.php');
	require_once 'include/UploadStream.php';
	$bean = BeanFactory::getBean('DHA_PlantillasDocumentos');
	$doc_list = $bean->get_full_list();
	foreach($doc_list as $bean_plantilla){
		$template_download_location =  $bean_plantilla->get_file_name($bean_plantilla->id, $bean_plantilla->file_ext);
		$template_filename = $bean_plantilla->filename;
		$template_file_ext = strtolower($bean_plantilla->file_ext);
		try {
			$api = ExternalAPIFactory::loadAPI('Google',true);
		
			if (isset($api) && $api !== false) {
				$result = $api->uploadDoc(
					$bean_plantilla,
					$template_download_location,
					$bean_plantilla->filename,
					$bean_plantilla->file_mime_type,
					array(
						'Dev Test'
					)
				);
			} else {
				$result['success'] = false;
				// FIXME: Translate
				$GLOBALS['log']->fatal("Could not load the requested API (" . $bean_plantilla->doc_type . ")");
				$result['errorMessage'] = 'Could not find a proper API';
			}
		} catch (Exception $e) {
			$result['success'] = false;
			$result['errorMessage'] = $e->getMessage();
			$GLOBALS['log']->fatal("Caught exception: (" . $e->getMessage() . ") ");
		}
		if ($result['success']) {
			$bean_plantilla->doc_type = 'Google';
		}else{
			$bean_plantilla->doc_type = 'Sugar';
		}
		$bean_plantilla->save();
	}
?>