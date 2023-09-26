<?php

$hook_array['before_logout'][] = Array(
    99, 
    'Tracking User logout informaiton', 
    'custom/modules/Users/user_logic_hooks.php', 
    'user_logic_hooks', 
    'trackLogout'
);
