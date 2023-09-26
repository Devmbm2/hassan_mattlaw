<?php
        if ( !empty($_REQUEST['uid']) ) {
            $recordIds = explode(',',$_REQUEST['uid']);
            foreach ( $recordIds as $recordId ) {
                $bean = SugarModule::get($_REQUEST['module'])->loadBean();
                $bean->retrieve($recordId);
                $bean->is_archived = 1;
                $bean->save();
                header('Location: index.php?module=Contacts&action=index&return_module=Contacts&return_action=DetailView');
            }
        }