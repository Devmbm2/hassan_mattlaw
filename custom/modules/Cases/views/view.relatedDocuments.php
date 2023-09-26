<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once 'modules/Cases/views/view.edit.php';
class CasesViewRelatedDocuments extends CasesViewEdit
{

    public function display()
    {
        global $db;
        $smarty = new Sugar_Smarty();
        $cases_record_value = $_REQUEST['record'];
        $document_records  = array();
        $i = 0;
        $sql = "SELECT A.id AS id1, B.id AS id2,A.document_name AS name1,B.document_name AS name2,A.category_id AS category_id1,
                 B.category_id AS category_id2,A.subcategory_id AS subcategory_id1,B.subcategory_id AS subcategory_id2,
                 A.soft_documents AS soft_documents1,B.soft_documents AS soft_documents2 FROM documents AS A,documents AS B
                 WHERE A.soft_documents = B.soft_documents AND A.id <> B.id GROUP BY A.soft_documents";
        $result = $db->query($sql, true);
        if($result->num_rows > 0) {
            while ($row = $db->fetchByAssoc($result)) {
                $document_id1 = $row['id1'];
                $document_id2 = $row['id2'];
                $sql1 =  "SELECT case_id FROM documents_cases WHERE document_id = '$document_id1'";
                $result1 = $db->query($sql1, true);
                if($result1->num_rows > 0) {
                    $row1 =  $db->fetchByAssoc($result1);
                    $case_id = $row1['case_id'];
                    if($cases_record_value == $case_id){

                        $soft_module_name = $row['subcategory_id1'];
                        if($soft_module_name == 'neg_negotiations'){
                            $doc_module = 'NEG_Negotiations';
                        }elseif($soft_module_name == 'disc_discovery'){
                            $doc_module = 'DISC_Discovery';
                        }elseif($soft_module_name == 'plea_pleadings'){
                            $doc_module = 'PLEA_Pleadings';
                        }
                        $soft_record_id   = $row['soft_documents1'];
                        $hard_document_id1 = $document_id1;
                        $hard_document_id2 = $document_id2;
                        $hard_document_name1 = $row['name1'];
                        $hard_document_name2 = $row['name2'];
                        $hard_category_id1   = $row['category_id1'];
                        $hard_category_id2   = $row['category_id2'];

                        $sql2 =  "SELECT id,document_name FROM {$soft_module_name} WHERE deleted = 0 AND id = '$soft_record_id'";
                        $result2 = $db->query($sql2, true);
                        if($result2->num_rows > 0) {
                            $row2 = $db->fetchByAssoc($result2);
                            $soft_record = $row2['id'];
                            $soft_name = $row2['document_name'];
                        }
                        $template_info_second = array('document_id1' => $hard_document_id1,'document_id2' => $hard_document_id2,
                         'document_name1' => $hard_document_name1,'document_name2' => $hard_document_name2,
                         'doc_module'=> $doc_module,'soft_record' => $soft_record,'soft_name' => $soft_name,
                           'hard_category_id1'=>$hard_category_id1,'hard_category_id2'=>$hard_category_id2);

                        $document_records[$i] = $template_info_second;
                        $i++;
                    }
                }
            }
        }
        $GLOBALS['log']->fatal(['true',$document_records]);
        $smarty->assign('document_records',$document_records);
        $related_documents = $smarty->fetch('custom/modules/Cases/tpls/relatedDocuments.tpl');
        echo $related_documents;
    }
}