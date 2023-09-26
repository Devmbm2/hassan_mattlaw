<?php
require_once('include/MVC/View/views/view.list.php');

class ht_email_listsViewList extends ViewList
{
	public function preDisplay() {
        parent::preDisplay();
		$this->lv->export = false;
        $this->lv->delete = false;
        $this->lv->mailMerge = false;
        $this->lv->mergeduplicates = false;
        $this->lv->showMassupdateFields = false;
		$this->lv->actionsMenuExtraItems[] = $this->resendEmail();
    }
	function listViewProcess(){
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if(!$this->headers)
            return;
				$field='exclude_email_list_basic[]';
				echo '<script type="text/javascript">
               var j = document.getElementsByName("' . $field . '");
               if(j.length > 0)
                  j[0].setAttribute("style","width: 470px !important"); 
              var k = document.getElementsByName("from_addr_basic[]");
               if(k.length > 0)
                  k[0].setAttribute("style","width: 300px !important");
            </script>';  				
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
			if(isset($_REQUEST['exclude_email_list_basic'])){
				$this->where = str_replace("emails.name in","emails.name not in",$this->where);
			}
			if(isset($_REQUEST['from_addr_basic'])){
				$this->where = str_replace("from_addr in (","emails.id IN (SELECT email_id FROM emails_text where from_addr in (",$this->where.')');
			}
			echo '
			<script type="text/javascript" src="modules/ht_email_lists/select2-4.0.3/dist/js/select2.full.js"></script>
			<script type="text/javascript">
				document.getElementsByName("exclude_email_list_basic[]")[0].setAttribute("class", "js-example-basic-multiple");
					$(".js-example-basic-multiple").select2();
					document.getElementsByName("from_addr_basic[]")[0].setAttribute("class", "js-example-basic-multiple");
					$(".js-example-basic-multiple").select2();
			</script>
			<link href="modules/ht_email_lists/select2-4.0.3/dist/css/select2.min.css" type="text/css" rel="stylesheet" />	
			';
			//print"<pre>"; print_r($this->where);die;
            $this->lv->ss->assign("SEARCH",true);
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
	protected function resendEmail(){
        global $app_strings;    
        return '<a class="" style="width: 150px;" href="#" onmouseover=\'hiliteItem(this,"yes");\' 
        onmouseout=\'unhiliteItem(this);\' 
        onclick="sugarListView.get_checks();send_offers(document.MassUpdate.uid.value, true);
        if(sugarListView.get_checks_count() &lt; 1) {
            alert(\''.$app_strings['LBL_LISTVIEW_NO_SELECTED'].'\');
            return false;
        }">Resend</a>';
    }
}
