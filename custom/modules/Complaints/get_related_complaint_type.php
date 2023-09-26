<?php
ob_clean();
if (!empty($_REQUEST['record'])){
         $complaint = BeanFactory::getBean('Complaints', $_REQUEST['record']);
		 echo $complaint->type;die;
}