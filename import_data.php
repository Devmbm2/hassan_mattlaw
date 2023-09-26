<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
ini_set('max_execution_time', 50000); //300 seconds = 5 minutes
ini_set('memory_limit','2048M');
include ('include/MVC/preDispatch.php');
require_once('include/entryPoint.php');
require_once('include/MVC/SugarApplication.php');
global $db,$timedate;
/* print"<pre>";print_r($db);die; */
$module = $argv[1];
require_once "{$module}_mapping.php";
$csvFile = "{$module}.csv"; 
$csv = readCSV($csvFile);
getMissedDBFields($module_fields_mapping, $csv[0]);
$count = 0;
for($i=1;$i<sizeof($csv);$i++){
    if(!empty($csv[$i])){
		$first_name = $csv[$i][1];
		$last_name = $csv[$i][0];
         if(!empty($first_name) && !empty($last_name)){
			$count++;
            $record_id = checkDuplicate($first_name, $last_name, $module);
            $saved_record = createUpdateRecord($module_fields_mapping, $csv[0], $csv[$i], $record_id, $module);
        }
    }
}
echo $count;echo'<br>';
echo 'done!';

function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 10000);
    }
    fclose($file_handle);
    return $line_of_text;
}

function checkDuplicate($first_name, $last_name, $module){
    global $db;
	$table = strtolower($module);
	$first_name = format_text($first_name);
	$last_name = format_text($last_name);
    $sql = "SELECT id
				  FROM $table
				  WHERE  $table.first_name LIKE '%{$first_name}%' AND $table.last_name LIKE '%{$last_name}%'";
    $result = $db->query($sql, true);
	$row = $db->fetchByAssoc($result);
    return $row['id'];
} 

function createUpdateRecord($module_fields_mapping, $first_row, $data, $id='', $module){	
	global $db;
	$all_data = getDBFields($module_fields_mapping, $first_row, $data);
    if($id == '' || is_null($id)){
		$g_id = create_guid();
		$insert = makeQueryInsert($all_data['field_type'], $all_data['columns'], $all_data['values'], $module, $g_id);
		$result = $db->query($insert, true);
		if(!empty($data[12])){
			$bean = BeanFactory::getBean('Contacts', $g_id);			
			$bean->email1 = $data[12];			
			$bean->save();			
		}
		
		
    }else{
		$update = makeQueryUpdate($all_data['field_type'], $all_data['columns'], $all_data['values'], $module, $id);
		echo 'yes in query...';
		$result = $db->query($update, true);
		/* echo 'asd '.$update;
		print"<pre>";print_r($result);die; */
    } 
}

function getMissedDBFields($module_fields_mapping, $first_row){
	$all_data = array();
	$columns = array();
	$values = array();
	foreach($first_row as $val => $col) {
	  if($module_fields_mapping[$col]['name'] == '?'){
		echo $col;echo '<br>';
	  }	  
    }
}

function getDBFields($module_fields_mapping, $first_row, $data){
	$all_data = array();
	$columns = array();
	$values = array();
	foreach($first_row as $val => $col) {
		if($module_fields_mapping[$col]['name'] == '?' || $col == ''){
			continue;
		}
		$columns[] = $module_fields_mapping[$col]['name'];		  
		$values[] = $data[$val];
		if(isset($module_fields_mapping[$col]['type'])){
			$field_type[$module_fields_mapping[$col]['name']] = $module_fields_mapping[$col]['type'];		  				
		}		  
    }
	
	$all_data['columns'] = $columns;
	$all_data['values'] = $values;
	$all_data['field_type'] = $field_type;
	/* print"<pre>";print_r($all_data);die; */
	return $all_data;
}

function makeQueryInsert($field_type, $db_fields, $data, $module, $id) {
	/* die('httest'); */
	foreach($db_fields as $no => $field){
		if(isset($field_type[$field]) && !empty($field_type[$field])){
			$data[$no] = formatData($no, $data[$no], $field_type[$field]);
		}
		 
	}
	$fields = '';
	$db_values_query = '';
	$query_insert = '';
	$db_fields_query = implode(" , ", $db_fields);
	foreach($data as $val){
		if((!empty($val) && $val != '') || $val == '0'){
			$db_values_query .= "'" . $val . "',";
		}else{
			$db_values_query .= 'NULL,';
		}
	}
		$db_values_query = trim($db_values_query, ',');
	$table_name = strtolower($module);
	$query_insert = "INSERT INTO $table_name  (id, {$db_fields_query}) VALUES ('{$id}', {$db_values_query})";
	 echo $query_insert;
	 /* print"<pre>123";print_r($email);die; */
	/*$GLOBALS['log']->fatal('query_insert');
	$GLOBALS['log']->fatal($query_insert); */
	return $query_insert;
}

function makeQueryUpdate($field_type, $db_fields, $data, $module, $id) {
	foreach($db_fields as $no => $field){
		if(isset($field_type[$field]) && !empty($field_type[$field]) && !empty($data[$no])){
			$data[$no] = formatData($no, $data[$no], $field_type[$field]);
		} 
	}
	$i = 0;
	$len = count($db_fields);
	$comma = ',';
	$fields = '';
	$query_update = '';
	/* $id = $data[0];
	unset($data[0]);
	unset($db_fields[0]); */
	$table_name = strtolower($module);
	$query_update = "UPDATE $table_name 
	LEFT JOIN {$table_name}_cstm ON ({$table_name}_cstm.id_c = {$table_name}.id)
	SET ";

	/* print"<pre>";print_r($db_fields);die; */
	foreach($db_fields as $no => $field){
		if ($i == $len - 1) {
			$comma = '';
		}
		if((!empty($data[$no]) && $data[$no] != '') || $data[$no] == '0'){
			$value = "'" .$data[$no]. "'";
		}else{
			$value = 'NULL';
		}
		$query_update .= "$field = {$value}{$comma}";   
		$i++;		
	}
		$query_update .= ", {$table_name}_cstm.newsletter_c = '1' WHERE {$table_name}_cstm.id_c = '{$id}'";
		/* echo $query_update; */
	return $query_update;
}

function formatData($no, $value, $type){
	if($type == 'date'){
		if(!empty($date)){
			return format_date($value);
		}else{
			return;
		}
	}else if($type == 'text'){
		$text = format_text($value);
		return truncate($text, 99, '');
	}else if($type == 'currency'){
		if($value == ''){
			return 0;
		}else{
			return $value;			
		}
	}else if($type == 'int'){
		if(empty($value)){
			return 0;
		}else{
			return $value;			
		}
	}else if($type == 'phone'){
		if(empty($value)){
			return 0;
		}else{
			return format_phone_no($value);			
		}
	}else if($type == 'dropdown_clean'){
		if(empty($value)){
			return 0;
		}else{
			return dropdown_clean($value);			
		}
	}else{
		return $value;
	}
}
function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
function format_date($date){
	if(!empty($date)){
		$date=date_create($date);
		return date_format($date,"Y-m-d H:i:s"); 		
	}
}

function format_phone_no($text){
	$phone_no = preg_replace("/[^0-9-(-)]/", "", $text);
	return $phone_no;
}
function format_text($text){
	global $db;
	$text_format = clean_query($text);
	$text_format = addslashes($text_format);
	return $text_format; 
}

function clean_query($string) {
	$string =  trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($string))))));
    return $string; // Removes special chars.
}

function dropdown_clean($string) {
	$text = preg_replace('/[0-9-]+/', ' ', $string);
	$text = trim($text);
    return $text;  // Removes special chars.
}

function sanitize_data($line){
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $line); // attempt to translate similar characters
   $clean = preg_replace('/[^\w]/', ' ', $clean); // drop anything but ASCII
   return $clean;
}

function transliterateString($txt) {
    $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
}