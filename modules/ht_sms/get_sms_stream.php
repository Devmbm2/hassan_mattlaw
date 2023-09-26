<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
	$record_id = $_REQUEST['record_id'];
	$module = $_REQUEST['record_module'];
	echo getStreamHtml($record_id, $module);
function getStreamHtml($record_id, $module){
	$bean = BeanFactory::getBean($module, $record_id);
	if(!empty($bean) && $bean->id){
		$related_module_query = '';
		if($module == 'Contacts' || $module == 'Leads'){
			$related_module_query = " AND (from_number = '{$bean->phone_mobile}' OR  to_number = '{$bean->phone_mobile}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";
		}else if($module == 'Accounts'){
			$related_module_query = " AND (from_number = '{$bean->phone_office}' OR to_number = '{$bean->phone_office}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";
		}else if($module == 'ht_sms'){
			if($bean->sent_received == 'Outgoing'){
				$related_module_query = " AND (from_number = '{$bean->to_number}' OR to_number = '{$bean->to_number}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";				
			}else if($bean->sent_received == 'Incoming'){
				$related_module_query = " AND (from_number = '{$bean->from_number}' OR to_number = '{$bean->from_number}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";					
			}
		}
		$query = "SELECT * FROM ht_sms WHERE deleted = 0 {$related_module_query }  ORDER BY date_entered ASC";
		/* echo $query;die; */
		$result = $GLOBALS['db']->query($query, true);
		$stream_html = '';
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$heading = '';
			$display_image = '';
			$description = nl2br(html_entity_decode($row['description']));
			if(isset($row['filename']) && !empty($row['filename'])){
				$uploadfile = "upload/{$row['id']}";
				$imageData = base64_encode(file_get_contents($uploadfile));
				$src = 'data: '.mime_content_type($uploadfile).';base64,'.$imageData;
				$display_image = '<br><img style="width:150px;height:150px;" src="' . $src . '">';
			}
			
			if($row['sent_received'] == 'Outgoing'){
				$userBean = BeanFactory::getBean('Users', $row['assigned_user_id']);
				$css_class = 'right';
				$heading = $userBean->name .' | ';
			}else{
				$heading = $bean->name .' | ';
				$css_class = 'left';
			}
			$heading .= $row['date_entered'].' | '.$GLOBALS['app_list_strings']['delivery_status_dom'][$row['message_status']];
			$stream_html .='<div class="comments '.$css_class.'_comment" id="'.$row['id'].'_row">
			<h5>'.$heading.'</h5>
			'.$description.''.$display_image.'
			</div>';
			
			
		}
		


$stream_html .= '<style>
						.form button[type="submit"] {
							 float: left !important;
						}

						.cases_line_comment {
						   border-top: 1px solid #8c8b8b;
						   
						}
						.commentsection {
							display: block;
							   margin: 10px ;
								min-height: 30px;
								height: auto;
								text-align: left;
								width:100%;
						}
						.comments {
						background-image: -webkit-gradient(
							linear,
							left bottom,
							left top,
							color-stop(0.25, rgb(210,244,254)),
							color-stop(1, rgb(149,194,253))
						);
							border: solid 1px rgba(0, 0, 0, 0.5);
							border-radius: 10px;
							box-shadow: inset 0 5px 5px rgba(255, 255, 255, 0.4), 0 1px 3px rgba(0, 0, 0, 0.2);
							box-sizing: border-box;
							clear: both;
							float: left;
							margin-bottom: 10px;
							padding: 8px 15px;
							position: relative;
							text-shadow: 0 1px 1px rgba(255, 255, 255, 0.7);
							width: auto;
							word-wrap: break-word;
							width: 50%;
						}


						.right_comment {
							float: right;
							margin-left: 10%;
						}
						.left_comment {
							background-image: -webkit-gradient(
								linear,
								left bottom,
								left top,
								color-stop(0.25, rgb(233,233,235)),
								color-stop(1, rgb(233,233,235))
							);
							margin-right: 10%;
						}</style>';

		return $stream_html;
	}
}
   
