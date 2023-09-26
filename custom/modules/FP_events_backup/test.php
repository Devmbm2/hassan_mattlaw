<?php
require_once('modules/Calendar/Calendar.php');
global $shared_user;
$cal = new Calendar();
$cal->init_shared();
print"<pre>";print_r($cal->shared_ids);