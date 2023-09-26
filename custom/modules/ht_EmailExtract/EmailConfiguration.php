
<?php
class emailConfig{
    public function configuration($bean){
        global $db;
        $jsonData='{';
        foreach ($_POST['maping_fields'] as $index => $value){
            // ,
            $jsonData.='"'.$value.'"'.':'.'"'.$_POST['_emails_day'][$index].'"'.',';
            // $db->query('INSERT INTO `selectedfieldforextractedemail`(`id`, `SelectedField`, `SelectedFieldValue`) VALUES ("'.$bean->id.'","'.$value.'","'.$_POST['_emails_day'][$index].'")');
        }
        $jsonData = substr($jsonData, 0, -1);
        $jsonData.='}';
        $bean->fieldForJsonData=$jsonData;
    }

}
?>
