<?php

$hook_array['before_save'][] = array(
    1,
    'QC process remarks populate',
    'custom/modules/DISC_Discovery/LogicHooks/DiscoveryBeforeSave.php',
    'DiscoveryBeforeSave',
    'QCProcessReview'
);
$hook_array['before_save'][] = array(
    2,
    'Mark done when assistant pass the document',
    'custom/modules/DISC_Discovery/LogicHooks/DiscoveryBeforeSave.php',
    'DiscoveryBeforeSave',
    'MarkDone'
);
$hook_array['before_save'][] = array(
    3, 
    'Update number of days on change of discovery type', 
    'custom/modules/DISC_Discovery/LogicHooks/DiscoveryBeforeSave.php',
    'DiscoveryBeforeSave',
    'update_no_of_days'
);