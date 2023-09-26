<?php
 require_once 'custom/include/docReader.php';
 require_once 'vendor/autoload.php';
 use Smalot\PdfParser\Parser;
	global $sugar_config , $db;
    $server = '{imap.gmail.com:993/imap/ssl}INBOX';
    $username = $sugar_config['email_address'];
    $password = $sugar_config['email_password'];
    $connection = imap_open($server, $username, $password);
    if (!$connection) {
        die('Connection failed: ' . imap_last_error());
    }
    $processedEmails = [];
    $messages = imap_search($connection, 'ALL');
    if ($messages === false) {
        die('Failed to fetch emails: ' . imap_last_error());
    }  
    foreach ($messages as $message) {
        $structure = imap_fetchstructure($connection, $message);
        $uid = imap_uid($connection, $message);
        $query_1= "SELECT * FROM `plea_pleadings` WHERE email_uid=$uid";
        $result1=$db->query($query_1);
        if ($result1->num_rows == 0) {
        $parts = $structure->parts;
        $attachment_count = 0;
        foreach ($parts as $part) {
            $parameters = $part->parameters;
            foreach ($parameters as $parameter) {
                $name = $parameter->attribute;
                $value = $parameter->value;
                $value = str_replace(' ', '_', $value);
                $value = preg_replace("/[^A-Za-z0-9\-_.]/", '', $value);
                if ($name == 'NAME' && strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'pdf'  ||
                strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'doc'	||
                strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'docx') {
                    $attachment_count++;
                    $data = imap_fetchbody($connection, $message, 2);   
                    if ($part->encoding == 3) {
                        $data = base64_decode($data);
                    } elseif ($part->encoding == 4) {
                        $data = quoted_printable_decode($data);
                    }
                    $filePath = 'upload/' . $value;          
                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION); 
                        if ($fileExtension === 'pdf') {
                            $file_ext= "pdf";
                            $file_mine_type= "application/pdf";
                            $pdfParser = new Parser();
                                try {
                                    $pdf = $pdfParser->parseContent($data);
                                    $text = $pdf->getText();
                                   // echo $text; 
                                } catch (Exception $e) {
                                    echo 'Error: ' . $e->getMessage();
                                }
                        }
                         elseif ($fileExtension === 'docx' || $fileExtension === 'doc') 
                        {   
                            $file_ext= "docx";
                            $file_mine_type= "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                        $docObj = new DocxConversion($filePath);
                            $docObj = new DocxConversion($filePath);
                             $text = $docObj->convertToText();
                        } 
                        else {
                            echo 'Unsupported file format';
                        }  
                        $caseNumber="";
                        $pattern = '/Case\s+No\.:\s+([\d-]+)\s*-\s*([A-Z]+)\s*-\s*([\d-]+)/i';
                        if (preg_match($pattern, $text, $matches)) {
                            $caseNumber = $matches[1] . '-' . $matches[2] . '-' . $matches[3];

                           // echo "Case No.: " . $caseNumber;
                        } else {
                           // echo "Case number not found.";
                        }   
                        $caseNumber2="";
                        $pattern = '/CASEồO\.: (\d+\s*-\s*\w+\s*-\s*\d+)/';
                        if (preg_match($pattern, $text, $matches)) {
                            $caseNumber2 = $matches[1];
                            $caseNumber2 = str_replace(' ', '', $caseNumber2);
                           // echo "Case Number2: ".$caseNumber2;
                        } else {
                           // echo "Case number2 not found ";
                        }

                        $startPos = strpos($text, '____/') + strlen('____/');
                        $substring = substr($text, $startPos, 100);
                         // echo $substring; 
                          $type="";
                          if(strpos($substring, 'plaintiff') !== false){
                              $type="Plaintiff";
                          }
                          else if(strpos($substring, 'defendant') !== false){
                              $type="Defendant";
                          }
                          else if(strpos($substring, 'court') !== false){
                            $type="Court";
                          }
                          else {
                            $type="Other";
                          }
                                $subtype="";
                            if(strpos($substring, 'answer') !== false){
                                $subtype="Answer";
                            }
                            else if(strpos($substring, 'complaint') !== false){
                                $subtype="Complaint";
                            }
                            else if(strpos($substring, 'exhibits') !== false){
                                $subtype="Exhibits";
                            }
                            else if(strpos($substring, 'hearing') !== false){
                                $subtype="Hearing_Notice";
                            }
                            else if(strpos($substring, 'motion') !== false){
                                $subtype="Motion";
                            }
                            else if(strpos($substring, 'notice of') !== false){
                                $subtype="Notice";
                            }
                            else if(strpos($substring, 'request') !== false){
                                $subtype="Subpoenas_Service";
                            }
                            else if(strpos($substring, 'stipulation') !== false){
                                $subtype="Stipulation";
                            }
                            else if(strpos($substring, 'subpoena') !== false){
                                $subtype="Subpoena";
                            }
                            else if(strpos($substring, 'stipulation') !== false){
                                $subtype="Stipulation";
                            }
                            else if(strpos($substring, 'sum') !== false){
                                $subtype="sum";
                            }
                            else if(strpos($substring, 'verdict') !== false){
                                $subtype="Verdict";
                            }
                            else if(strpos($substring, 'witness') !== false){
                                $subtype="Witness_List";
                            }else 
                            {
                                $subtype="";
                            }                      
                            $sql1 =  "SELECT cases.id FROM cases WHERE deleted = 0 AND case_number=20"  ;
                        $result1 = $db->query($sql1, true);
                        while ($row1 = $db->fetchByAssoc($result1)) {
                            $case_id = $row1['id'];
                           // echo $case_id ; echo "working upto here" ;
                        }	
                     $caseBean= BeanFactory::getbean('Cases' , $case_id);                            
                 if ($caseNumber !== "" || $caseNumber2 !== "") {
                    if ($attachment_count == 1) {   
                           $filePath = 'upload/' . $value;
                           file_put_contents($filePath, $data);
                          //  echo 'Attachment saved: ' . $value . '<br>';
                            $documentBean = BeanFactory::newBean('PLEA_Pleadings');
                            $documentBean->document_name = $value;
                            $documentBean->filename = $value;
                            $documentBean->file_ext = $file_ext;
                            $documentBean->file_mine_type = $file_mine_type;
                            $documentBean->description = 'Attachment from Gmail';
                            $documentBean->doc_url = $filePath;
                            $documentBean->incoming_or_outgoing = "Incoming";
                            $documentBean->author_type = $type;
                            $documentBean->subcategory_id = $subtype;
                            $documentBean->email_documents = 1;
                            $documentBean->email_uid = $uid;
                            $documentBean->save();
                            $document_id = $documentBean->id;
                          //  echo " before saving relation document";
                        //echo "<pre>"; 	print_r($documentBean); echo "</pre>"; 
                            $documentBean->load_relationship('plea_pleadings_cases');	
                            $casesID=$documentBean->plea_pleadings_cases->add($caseBean);
                          //  echo " after saving relation document";
                        } else {
                            $notebean = BeanFactory::newBean('Notes');
                            $notebean->name = $value;
                            $notebean->filename = $value;
                            $notebean->file_ext = $file_ext;
                            $notebean->file_mine_type = $file_mine_type;
                            $notebean->document_id = $document_id;
                            $notebean->save();
                            $filePath = 'upload/' . $notebean->id.'-'.$value;
                            file_put_contents($filePath, $data);
                            
                        }   
                    }
                }
            }
        }
     }
    }   
    imap_close($connection);