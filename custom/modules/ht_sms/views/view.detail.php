<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class ht_smsViewDetail extends ViewDetail {
	function __construct(){
 		parent::__construct();
 	}

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function FP_eventsViewDetail(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }


	function display(){
		global $sugar_config;
		echo '<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="document_dialog" id="document_dialog" style="background-color:white;">
				</div>
			</div>';
		$from = '';
		if($this->bean->sent_received == 'Outgoing'){
			$from = $this->bean->to_number;
		}else if($this->bean->sent_received == 'Incoming'){
			$from = $this->bean->from_number;
		}
		$status = $this->bean->checkPhoneStatus($from);
		//echo $status;
		//print"<pre>";print_r($row);
		if(isset($status) && !empty($status)){
			if($status == 'Block' || $status == 'Block_OptOut'){
				$this->ss->assign("STATUS", 'Active');
				$this->ss->assign("LABEL", $GLOBALS['app_list_strings']['phone_status_dom']['Active']);
			}else if($status == 'Active' || $status == 'OptOut' || $status == 'Active_OptOut'){
				$this->ss->assign("STATUS", 'Block');
				$this->ss->assign("LABEL", $GLOBALS['app_list_strings']['phone_status_dom']['Block']);
			}
		}else{
			$this->ss->assign("STATUS", 'Block');
			$this->ss->assign("LABEL", $GLOBALS['app_list_strings']['phone_status_dom']['Block']);
		}
		parent::display();
		echo "<script type='text/javascript'>var bean = " . json_encode($this->bean->toArray()) ."</script>";
	}
}
?>
