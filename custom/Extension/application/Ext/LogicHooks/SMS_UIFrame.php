<?php

if (!isset($hook_array) || !is_array($hook_array))
{
    $hook_array = array();
}
if (!isset($hook_array['after_ui_frame']) || !is_array($hook_array['after_ui_frame']))
{
    $hook_array['after_ui_frame'] = array();
}

// $hook_array['after_ui_frame'][] = Array(100, 'SMS Connector', 'modules/SMS_Configuration/SMS_UIFrame.php', 'SMS_Class', 'SMS_Func');
