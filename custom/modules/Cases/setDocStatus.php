<?php
$bean = BeanFactory::getBean('Documents',$_REQUEST['selected_doc']);
$bean->sentoutstatus_c = 'Progress';
if(empty($bean->datesentout_c) || $bean->datesentout_c == Null){
	$bean->datesentout_c = date('Y-m-d');
$bean->save();
echo "success";
}
else{
	echo "Failed";
}

die();

?>