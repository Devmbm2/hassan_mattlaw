<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(64, 'save_record', 'custom/modules/LIEN_Liens_LOPs/contact_owed_rollup_sum.php','owed_rollup_sum', 'owed_save_record'); 
$hook_array['before_delete'] = Array(); 
$hook_array['before_delete'][] = Array(65, 'delete_record', 'custom/modules/LIEN_Liens_LOPs/contact_owed_rollup_sum.php','owed_rollup_sum', 'owed_delete_record'); 
$hook_array['after_relationship_add'] = Array(); 
$hook_array['after_relationship_add'][] = Array(66, 'save_record', 'custom/modules/LIEN_Liens_LOPs/contact_owed_rollup_sum.php','owed_rollup_sum', 'owed_save_record'); 
$hook_array['before_relationship_delete'] = Array(); 
$hook_array['before_relationship_delete'][] = Array(67, 'save_record', 'custom/modules/LIEN_Liens_LOPs/contact_owed_rollup_sum.php','owed_rollup_sum', 'owed_delete_record'); 
$hook_array['after_ui_frame'] = Array(); 



?>