<?php
ob_clean();
if (!empty($_REQUEST['record'])){
         $case = BeanFactory::getBean('Cases', $_REQUEST['record']);
		 echo $case->type;die;
}