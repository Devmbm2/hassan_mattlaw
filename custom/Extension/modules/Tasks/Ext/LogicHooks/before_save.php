<?php

$hook_array['before_save'][] = array(
    1,
    'OnSave Run Scheduler',
    'custom/modules/Tasks/onSaveRunTaskScheduler.php',
    'onSaveRunTaskScheduler',
    'QueueJob'
);
