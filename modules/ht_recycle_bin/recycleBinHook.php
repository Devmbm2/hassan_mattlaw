<?php
class recycleBinHook{
	function logRecycleBin($bean, $event, $arguments) {
		global $current_user, $timedate;
		$recycle_bin = new ht_recycle_bin();
		$recycle_bin->name = $bean->name;
		$recycle_bin->deleted_module = $bean->module_dir;
		$recycle_bin->deleted_record = $bean->id;
		$recycle_bin->date_entered = $timedate->nowDb();
		$recycle_bin->date_modified = $timedate->nowDb();
		$recycle_bin->assigned_user_id = $current_user->id;
		$recycle_bin->save(false);
	}
}



?>