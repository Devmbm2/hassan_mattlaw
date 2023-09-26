<?php
class syncExistingData{	
	public function postInstall(){
		global $moduleList, $db;
		foreach($moduleList as $module){
			if($module =='ht_recycle_bin')continue;
			$bean = $this->getBeanObj($module);
			$beanType = $this->getBeanType($bean);
			$sql = "SELECT * FROM {$bean->table_name} WHERE deleted=1";
			$result = $db->query($sql);
			while($row = $db->fetchByAssoc($result)){
				$row['name'] = $this->getName($row, $beanType);
				$row['deleted_module'] = $bean->module_dir;
				$this->createRecycleBin($row);
			}
		}
	}
	private function createRecycleBin($data){
		global $current_user, $db;
		$new_id = create_guid();
		$sql = "INSERT INTO ht_recycle_bin(id,name,deleted_module,deleted_record,date_entered,date_modified,assigned_user_id) VALUES('{$new_id}','{$data['name']}','{$data['deleted_module']}','{$data['id']}','{$data['date_modified']}','{$data['date_modified']}','{$current_user->id}')";
		$db->query($sql, true);
	}
	private function getBeanObj($module_name){ 
		global $beanList, $beanFiles; 
		if(!isset($beanList[$module_name]))return false;
		$className = $beanList[$module_name]; 
		require_once($beanFiles[$className]);
		$focus = new $className(); 
		return $focus; 
	}
	private function getBeanType($focus){
		$type='';
		if($focus instanceof Person){
			$type = 'person';
		}
		else if ($focus instanceof Company){
			$type = 'company';
		}
		else if ($focus instanceof Sale){
			$type = 'sale';
		}
		else if ($focus instanceof Issue){
			$type = 'issue';
		}
		else if ($focus instanceof Basic){
			$type = 'basic';
		}
		else if ($focus instanceof File){
			$type = 'file';
		}
		return $type;
	}
	private function getName($row, $beanType){
		$name = '';
		if($beanType == 'person'){
			$name = $row['first_name'].' '.$row['last_name'];
		}
		else if($beanType == 'file'){
			$name = $row['document_name'];
		}
		else{
			$name = $row['name'];
		}
		return $name;
	}
}
?>