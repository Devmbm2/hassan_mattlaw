<?php
$hook_version = 1; 
$hook_array = Array(); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'from addr', 'modules/ht_email_lists/ht_email_listsHook.php', 'ht_email_listsHook', 'getFromAddr');