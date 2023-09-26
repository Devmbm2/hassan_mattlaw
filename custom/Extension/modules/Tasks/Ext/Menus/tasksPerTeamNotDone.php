<?php

if(ACLController::checkAccess('Tasks', 'list', true)) {
   // $module_menu[] = array(
   //     "index.php?module=AOR_Reports&action=tasksPerTeamNotDone",
   //     'Tasks Per Team that are Un Done',
	  //  "List"
   //  );
   $module_menu[] = array(
       "index.php?module=Tasks&action=index&return_module=Tasks&return_action=DetailView&clear_query=true&is_done=1",
       'Tasks Per Team that are Un Done',
      "List",
      "Tasks"
    );
	
}