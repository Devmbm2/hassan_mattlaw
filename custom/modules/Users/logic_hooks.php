<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_login'] = Array(); 
$hook_array['after_login'][] = Array(1, 'SugarFeed old feed entry remover', 'modules/SugarFeed/SugarFeedFlush.php','SugarFeedFlush', 'flushStaleEntries'); 
$hook_array['after_login'][] = Array(1, 'Pre-saved searches', 'custom/modules/Users/DefaultSearches.php','DefaultSearches', 'addSavedSearch'); 
$hook_array['after_login'][] = Array(100, 'after_login', 'custom/modules/Users/UsersActivityUsersLogicHooks.php','UsersActivityUsersLogicHooks', 'after_login');
$hook_array['after_ui_frame'] = Array(); 
$hook_array['before_logout'] = Array(); 
$hook_array['before_logout'][] = Array(100, 'before_logout', 'custom/modules/Users/UsersActivityUsersLogicHooks.php','UsersActivityUsersLogicHooks', 'before_logout'); 



?>