<?php

class SMS_Class {

    function SMS_Func($event, $arguments) {

        //echo $_REQUEST['module'];
        $mapping = array(
            'modules' =>
            array("Calendar", "AOR_Reports", "ModuleBuilder",  "MergeRecords",  "Timesheets", "AOW_WorkFlow", "Emails", "DHA_PlantillasDocumentos", "Home"),
            'actions' =>
            array("view_GanttChart", "EmailUIAjax", "getEditFieldHTML", "getValidationRules", "QuickEdit", "DynamicAction", "modulelistmenu", "favorites", "wizard", "SaveActivity", "getFromFields"),
        );

        if ((!in_array($_REQUEST['action'], $mapping['actions'])) && (!in_array($_REQUEST['module'], $mapping['modules'])) && empty($_REQUEST['to_pdf']) && empty($_REQUEST['to_csv']) && empty($_REQUEST['sugar_body_only'])) {
			$ce_load_js = '<script type="text/javascript" language="javascript" src="modules/SMS_Configuration/SMS_Configuration.js?v='.time().'"></script><script type="text/javascript" language="javascript" src="modules/SMS_Configuration/MMS_File_Upload.js?v='.time().'"></script><link rel="stylesheet" href="modules/SMS_Configuration/style.css">';
            echo $ce_load_js;
        }
    }

}
