<?php

$hook_array['after_login'][] = Array(
    99, 
    'Tracking User login informaiton', 
    'custom/modules/Users/user_logic_hooks.php', 
    'user_logic_hooks', 
    'trackLogin'
);
