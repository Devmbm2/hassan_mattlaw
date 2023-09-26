<?php

$dictionary['ht_EmailExtract']['fields']['CheckDuplicate_C'] =
          array(
                'name' => 'CheckDuplicate_C',
                'vname' => 'LBL_CHECKDUPLICATE_C',
                'type' => 'enum',
                'dbType' => 'varchar',
                'len' => '255',
                'options' =>array('body'=>'Body',
                                    'subject'=>'Subject',
                                    'sender_name'=>'Sender Name',
                                    'sender_email'=>'Sender Email',
                                    'date'=>'Date',
                                    ),
                'reportable'=>true,
                'source' => 'custom_fields'

         );

