<?php
class PLEA_PleadingsController extends SugarController{
	function __construct(){
		parent::__construct();
	}
	function action_get_related_case_lawyer() {
		ob_clean();
		$fetched_record = array();
		$case_id = $_REQUEST['case_id'];
		if(!empty($case_id)){
			$case = BeanFactory::getBean('Cases', $case_id);
			if(!empty($case->default_assistant_lawyer_name || $case->default_assistant_lawyer_id || $case->assigned_user_name || $case->assigned_user_id)){
				$fetched_record[] = ["default_assistant_lawyer_name" =>$case->default_assistant_lawyer_name,"default_assistant_lawyer_id" =>$case->default_assistant_lawyer_id,"assigned_user_name" =>$case->assigned_user_name,
                            "assigned_user_id" =>$case->assigned_user_id];
				echo json_encode($fetched_record);die();
			}else{
				echo '';die;
			}
		}else{
			echo '';die;
		}

	}
	function action_removeAttachment() {
    global $db;
    $note_id = $_REQUEST['note_id'];
    if(isset($note_id)){
                $sql = "UPDATE notes
                        SET deleted=1, date_modified = NOW()
                        WHERE notes.id='{$note_id}'";
                $db->query($sql, true);

            }

    }

    function action_ReadFile(){
        // echo "HelloWorld";die();
        global $db;
        require_once 'vendor/autoload.php';
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($_FILES['pdf']['name']);
        $text = $pdf->getText();
        $lines = explode("\n", $text);
        $subject="";
        $fields=array();
        $text=preg_replace('/\s+/', '', $text);
        preg_match('/\d{2}-\w{2}-\d{6}/', $text, $matches);
        pre($matches);
        // $pleadings = BeanFactory::getBean('PLEA_Pleadings')
        //                         ->retrieve_by_string_fields(
        //                         array('signed_document_file'=>$matches[0])
        //                         );
        if(!empty($pleadings)){
        // $result=$db->query('SELECT cases.* FROM `plea_pleadings_cases_c` inner join `cases` on plea_pleadings_cases_c.plea_pleadings_casesplea_pleadings_idb="'.$pleadings->id.'" AND plea_pleadings_cases_c.plea_pleadings_casescases_ida=cases.id');
        // $row = $db->fetchByAssoc($result);
        // print_r($result);
        // $fields[]=['caseID'=>$row['id'],'caseName'=>$row['name']];
        // $fields[]=$pleadings->incoming_or_outgoing;
        // $fields[]=$pleadings->author_type;
        // $fields[]=$pleadings->parent_name;

        foreach ($lines as $key=>$line) {
                $line=preg_replace('/\s+/', '', $line);
                if (strpos(strtolower($line), "geicogeneralinsurancecompany") !== false && strpos(strtolower(preg_replace('/\s+/', '', $lines[$key+1])), "defendant")!== false) {
                    $i=1;
                    while(true){
                        $i++;
                        if(strpos(strtolower(preg_replace('/\s+/', '',$lines[$key+$i])), "thiscause")!== false){
                            break;
                        }
                        $subject.=$lines[$key+$i];
                    }
            }
        }
            $selectedKeyword="";
            global $app_list_strings;
            $pleadingSubTypeItems = $app_list_strings['subcategory_id_list'];
            foreach($pleadingSubTypeItems as $key=>$value){
                if(strpos(strtolower(preg_replace('/\s+/', '',$subject)), strtolower($key))!== false){
                    $selectedKeyword=$key;
                    break;
                }
            }
                array_push($fields,$selectedKeyword);
                echo json_encode($fields);
            }else{
                echo 'empty';
            }
        die();
        }

     function action_ReadFile2(){
        // echo "Hello World";die();
        // $pleadings = BeanFactory::getBean('PLEA_Pleadings','a9ccb205-5d76-b276-a880-63ea246e6894');
        // $nonDbFieldValue = $pleadings->getFieldValue('parent_name');
        include('custom/modules/PLEA_Pleadings/name_concat.php');
        $obj=new name_concat();
        $bean = BeanFactory::getBean('PLEA_Pleadings')
                                ->retrieve_by_string_fields(
                                array('signed_document_file'=>"19-CA-011850")
                                );
    // print_r($bean);die();
        print_r($obj->plea_name_concat($bean));die();
    }
}
