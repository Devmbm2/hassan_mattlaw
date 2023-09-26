<?php

require_once('include/MVC/View/views/view.list.php');

class MEDR_Medical_RecordsViewList extends ViewList
{
    public function listViewPrepare()
    {
        //if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = 'date_modified';
            $_REQUEST['sortOrder'] = 'desc';
        //}
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
	
	
	public function preDisplay()
    {
        parent::preDisplay();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemPrintMulti();
    }
	protected function buildMyMenuItem()
    {
        global $app_strings;
    
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'MEDR_Medical_Records', 'index.php?entryPoint=download_attachment_multi','Please select at least 1 record to proceed.')">Export Attachments</a>
EOHTML;
    }
	protected function buildMyMenuItemPrintMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'MEDR_Medical_Records', 'index.php?entryPoint=download_attachment_multi&merge=true','Please select at least 1 record to proceed.')">Print Attachments</a>
EOHTML;
    }
}
