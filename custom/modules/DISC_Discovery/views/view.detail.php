<?php
require_once('include/MVC/View/views/view.detail.php');
class DISC_DiscoveryViewDetail extends ViewDetail {
        function DISC_DiscoveryViewDetail(){
        parent::ViewDetail();
	}

   function display() {
        $time = time();
        echo "<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>";
        echo "<script src='modules/ht_formbuilder/js/sweetAlert.js'></script>";
        echo "<script src='custom/modules/DISC_Discovery/js/document_memo.js?v={$time}'></script>";
	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	if(bean['case_type_c'].includes('Companion') == false){
                $(\"[field='companion']\").parent().html('');
        }
        if(bean['case_type_c']!='Multiple_Claims_in_One'){
                $(\"[field='date_of_incident']\").parent().html('');
        }
	</script>";
       // <script type='text/javascript' src='custom/modules/DISC_Discovery/js/hide_fields.js'></script>";
         $ComparedTypes =array("Request_to_Produce","Request_for_Admissions","Interrogatories");
        $bean = BeanFactory::getBean("DISC_Discovery",$_REQUEST['record']);
            if($bean->type=='3rd_Non_Party_Requests' || in_array($bean->type, $ComparedTypes)){

            }else{
        foreach ($this->dv->defs['panels']['default'] as $key => $subarray) {
            foreach ($subarray as $subkey => $nested_array) {
                if (isset($nested_array["name"]) && $nested_array["name"] === "OneTwoFourthDropdownField") {
                    unset($this->dv->defs['panels']['default'][$key][$subkey]);
                }
            }
        }
    }
        parent::display();
	}
}
?>

