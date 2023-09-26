<?php

$hook_array['after_ui_frame'][] = Array(
    99, 
    'Tracking User Session logout informaiton', 
    'custom/modules/Users/user_session_logout_hook.php', 
    'user_session_logout_hook', 
    'trackSessionLogout'
);
