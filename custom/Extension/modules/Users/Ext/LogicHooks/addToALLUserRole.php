<?php

$hook_array['after_save'][] = Array(
    99, 
    'Add Users to Login Track Role', 
    'custom/modules/Users/user_logic_hooks.php', 
    'user_logic_hooks', 
    'addToALLUserRole'
);
