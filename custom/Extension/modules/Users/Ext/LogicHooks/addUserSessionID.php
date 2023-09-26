<?php

$hook_array['after_login'][] = Array(
    99, 
    'Add Users session to check simultaneous logins', 
    'custom/modules/Users/user_session_id_storage.php', 
    'user_session_id_storage', 
    'addUserSessionID'
);
