<?php

$hook_array['process_record'][] = Array(
    99, 
    'Show green on when user is logged in otherwise red.', 
    'modules/ht_login_tracker/ht_login_tracker_hooks.php', 
    'ht_login_tracker_hooks', 
    'showLoginStatusHook'
);
