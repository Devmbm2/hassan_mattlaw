<?php
require_once('include/MVC/View/views/view.detail.php');
class PLEA_PleadingsViewDetail extends ViewDetail {

public function __construct()
 	{

 		parent::__construct();
 	}
function display(){

   /*      echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	if(bean['subcategory_id']!='Order'){
                $(\"[field='orders_sub_type']\").parent().html('');
        }
        if(bean['subcategory_id']!='Notice'){
                $(\"[field='notice_type']\").parent().html('');
        }
        if(bean['subcategory_id']!='Motion'){
                $(\"[field='name_of_motion']\").parent().html('');
                $(\"[field='sent_received']\").parent().html('');
        }
        if(bean['subcategory_id']!='Hearing_Notice'){
                $(\"[field='hearing_type']\").parent().html('');
        }
        if(bean['subcategory_id']!='Complain' && bean['subcategory_id']!='Answer'){
                $(\"[field='complain_answer_type']\").parent().html('');
        }
        if(bean['notice_type']!='Filing'){
                $(\"[field='filing_sub_type']\").parent().html('');
        }
        if(bean['notice_type']!='Serving'){
                $(\"[field='amount']\").parent().html('');
                $(\"[field='ent_received']\").parent().html('');
        }
        if(bean['hearing_type']!='Motion'){
                $(\"[field='sent_received']\").parent().html('');
        }
        if(bean['category_id']!='Pleading'){
                $(\"[field='subcategory_id']\").parent().html('');
        }
	</script>"; */
        //<script type='text/javascript' src='custom/modules/PLEA_Pleadings/js/hide_fields.js'></script>";
        parent::display();
		global $app_list_strings;
		if($this->bean->outgoing_document){
			echo "<script type='text/javascript'>
					$('#hd_reviewed_by_name').parent().parent().show();
				  </script>
				  ";
		}else{
			echo "<script type='text/javascript'>
					$('#hd_reviewed_by_name').parent().parent().hide();
				  </script>
				  ";
		}
		$time = time();
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo "
		<script type='text/javascript'>
				var display_hide_fields = '';
				 display_hide_fields = ".json_encode($app_list_strings['pleading_show_hide_fields']).";
		</script>
		<script type='text/javascript' src='custom/include/javascript/visible/ht_fields_show_hide_detail.js?v={$time}'></script>
		<script type='text/javascript' src='custom/include/javascript/visible/plead_noticetype.js?v={$time}'></script>
		<script type='text/javascript' src='custom/include/javascript/visible/plead_casetype.js?v={$time}'></script>
		<script type='text/javascript' src='custom/modules/PLEA_Pleadings/js/edit.js?v={$time}'></script>
		";
}

}
?>
