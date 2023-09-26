<?php

require_once('include/MVC/View/views/view.list.php');

class MREQ_MEDB_RequestsViewList extends ViewList
{

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_entered');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
    public function listViewProcess()
    {
        if($_GET['CheckWhichListViewShouldLoad']=='true'){
            $name=$this->lv->displayColumns['DOCUMENT_NAME'];
            $documentReceived=$this->lv->displayColumns['RECEIVEDDATE_C'];
            $documentRequested=$this->lv->displayColumns['DATE_ENTERED'];
            $StatusId=$this->lv->displayColumns['STATUS_ID'];
            unset($this->lv->displayColumns);
            $this->lv->displayColumns['DOCUMENT_NAME']=$name;
            $this->lv->displayColumns['DATE_ENTERED']=$documentRequested;
            $this->lv->displayColumns['RECEIVEDDATE_C']=$documentReceived;
            $this->lv->displayColumns['STATUS_ID']=$StatusId;
        }
        else{
             unset($this->lv->displayColumns['RECEIVEDDATE_C']);
        }
           
            $this->lv->setup($this->seed,'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            echo $this->lv->display();

    }

}


 
