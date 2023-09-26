<?php

require_once('include/MVC/View/views/view.list.php');

class MEDP_Medical_ProvidersViewList extends ViewList
{
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('name');
            //$_REQUEST['sortOrder'] = 'desc';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
}

