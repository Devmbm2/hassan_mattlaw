<?php

$hook_array['before_save'][] = array(
    1,
    'Create Security Group Record Bean & save data into it',
    'custom/modules/AOW_WorkFlow/ht_security_groups_recordSave.php',
    'ht_security_groups_recordSave',
    'groupTeamSave'
);