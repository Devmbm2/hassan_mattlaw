<?php

require_once('include/MVC/View/views/view.list.php');

class BugsViewList extends ViewList
{
    public function preDisplay()
    {
        parent::preDisplay();
        echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }

}


 
