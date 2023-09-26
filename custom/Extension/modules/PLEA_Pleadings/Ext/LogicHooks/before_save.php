<?php

$hook_array['before_save'][] = array(
    1,
    'QC process remarks populate',
    'custom/modules/PLEA_Pleadings/LogicHooks/PleadingBeforeSave.php',
    'PleadingBeforeSave',
    'QCProcessReview'
);
$hook_array['before_save'][] = array(
    2,
    'Mark done when assistant pass the document',
    'custom/modules/PLEA_Pleadings/LogicHooks/PleadingBeforeSave.php',
    'PleadingBeforeSave',
    'MarkDone'
);
$hook_array['before_save'][] = array(
    3, 
    'Update number of days on change of Pleading type', 
    'custom/modules/PLEA_Pleadings/LogicHooks/PleadingBeforeSave.php',
    'PleadingBeforeSave',
    'update_no_of_days'
);