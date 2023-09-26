<?php

require_once('include/MVC/View/views/view.list.php');

class MTS_Medical_Treatment_SummaryViewList extends ViewList
{
	public function preDisplay(){
        parent::preDisplay();
		$this->lv = new ListViewSmarty();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportCsv();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportExcel();
		
    }

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('treatment_date');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
	public function buildMyMenuItemExportCsv()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='export_csv';
				document.MassUpdate.submit();">Generate CSV</a>
				
EOHTML;
	}	
	public function buildMyMenuItemExportExcel()
    {
        global $app_strings;

		return <<<EOHTML
			<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='export_excel';
				document.MassUpdate.submit();">Generate Excel</a>
				
			EOHTML;
	}
	
}


 
