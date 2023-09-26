<?php
require_once('modules/ht_recycle_bin/syncExistingData.php');
class ht_recycle_binController extends SugarController
{
	public function action_undelete(){
		global $db;
		$recycle_module = BeanFactory::newBean($_SESSION['recycle_module']);
		$table_name = $recycle_module->table_name;
		if($_REQUEST['select_entire_list']){
			$sql = "SELECT id FROM {$table_name} WHERE deleted=1";
			$result = $db->query($sql);
			while($row = $db->fetchByAssoc($result)){
				$all_ids[] =$row['id'];
			}
				$sql="UPDATE {$table_name} SET deleted=0 WHERE id IN ('". implode("','", $all_ids) ."')";
				$db->query($sql, true);
				foreach($all_ids as $id){
					$bean = BeanFactory::getBean($_SESSION['recycle_module'], $id);
					$linked_fields = $bean->get_linked_fields();
					foreach ($linked_fields as $name => $value) {
						if ($bean->load_relationship($name)) {
							$related_records = $bean->$name->getBeans(array('deleted'=>1));
							$related_records_ids = array_keys($related_records);
							/* print"<pre>";print_r($related_records_ids); */
							$bean->$name->add($related_records_ids);
							/* echo $name;echo '<br>'; */
						} else {
							die("error loading relationship $name");
						}
					}
				}
				
				if(isset($_REQUEST['view']) && !empty($_REQUEST['view'])){
					SugarApplication::redirect("index.php?module={$_SESSION['recycle_module']}&action=DetailView&record={$_REQUEST['uid']}");				
				}else{
					SugarApplication::redirect("index.php?module=ht_recycle_bin&action=index&selected_module={$_SESSION['recycle_module']}");				
				}
		
		}else{
			
			if ( !empty($_REQUEST['uid']) ) {
				$sql="UPDATE {$table_name} SET deleted=0 WHERE id IN ('". str_replace(',',"','",$_REQUEST['uid']) ."')";
				$db->query($sql, true);
				if(isset($_REQUEST['view']) && !empty($_REQUEST['view'])){
					$bean = BeanFactory::getBean($_SESSION['recycle_module'], $_REQUEST['uid']);
						$linked_fields = $bean->get_linked_fields();
						foreach ($linked_fields as $name => $value) {
							if ($bean->load_relationship($name)) {
								$related_records = $bean->$name->getBeans(array('deleted'=>1));
								$related_records_ids = array_keys($related_records);
								/* print"<pre>";print_r($related_records_ids); */
								$bean->$name->add($related_records_ids);
								/* echo $name;echo '<br>'; */
							} else {
								die("error loading relationship $name");
							}
						}
					
				}else{
						foreach($_REQUEST['mass'] as $id){
							$bean = BeanFactory::getBean($_SESSION['recycle_module'], $id);
							$linked_fields = $bean->get_linked_fields();
							foreach ($linked_fields as $name => $value) {
								if ($bean->load_relationship($name)) {
									$related_records = $bean->$name->getBeans(array('deleted'=>1));
									$related_records_ids = array_keys($related_records);
									/* print"<pre>";print_r($related_records_ids); */
									$bean->$name->add($related_records_ids);
									/* echo $name;echo '<br>'; */
								} else {
									die("error loading relationship $name");
								}
							}
						
						} 
					
				}
				
				
				if(isset($_REQUEST['view']) && !empty($_REQUEST['view'])){
					SugarApplication::redirect("index.php?module={$_SESSION['recycle_module']}&action=DetailView&record={$_REQUEST['uid']}");				
				}else{
					SugarApplication::redirect("index.php?module=ht_recycle_bin&action=index&selected_module={$_SESSION['recycle_module']}");				
				}
			}
		}
		
	}
	public function action_delete_permanent(){
		global $db;
		$recycle_module = BeanFactory::newBean($_SESSION['recycle_module']);
		$table_name = $recycle_module->table_name;
		if($_REQUEST['select_entire_list']){
			$sql = "SELECT id FROM {$table_name} WHERE deleted=1";
			$result = $db->query($sql);
			while($row = $db->fetchByAssoc($result)){
				$all_ids[] =$row['id'];
				
			}
				$sql="DELETE FROM {$table_name} WHERE id IN ('". implode("','", $all_ids) ."')";
				$db->query($sql, true);
				SugarApplication::redirect("index.php?module=ht_recycle_bin&action=index&selected_module={$_SESSION['recycle_module']}");
		
		}else{
			if ( !empty($_REQUEST['uid']) ) {
				$sql="DELETE FROM {$table_name} WHERE id IN ('". str_replace(',',"','",$_REQUEST['uid']) ."')";
				$GLOBALS['log']->fatal('$sql');
				$GLOBALS['log']->fatal($sql);
				$db->query($sql, true);
				SugarApplication::redirect("index.php?module=ht_recycle_bin&action=index&selected_module={$_SESSION['recycle_module']}");
			}
		}
		
	}
	public function action_modules_list()
    {
		global $current_user;
		require_once('modules/ht_recycle_bin/license/OutfittersLicense.php');
		$validate_license = OutfittersLicense::isValid('ht_recycle_bin');
		if($validate_license !== true) {
			if(is_admin($current_user)) {
				SugarApplication::appendErrorMessage('Recycle Bin License Addon is no longer active due to the following reason: '.$validate_license.' Users will have limited to no access until the issue has been addressed.');
			}
			echo 'Recycle Bin License Addon is no longer active. Please renew your subscription or check your license configuration';
		}
		else{
			$this->view = 'modules_list';
		}
    }
}
?>