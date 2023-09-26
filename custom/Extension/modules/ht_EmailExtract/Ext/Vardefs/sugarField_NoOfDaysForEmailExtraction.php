<?php

$dictionary['ht_EmailExtract']['fields']['NoOfDaysForEmailExtraction'] =
          array(
                'name' => 'NoOfDaysForEmailExtraction',
                'vname' => 'LBL_NOOFDAYSFOREMAILEXTRACTION',
                'type' => 'enum',
                'dbType' => 'varchar',
                'len' => '255',
                'options' =>'dom_only_sync_days',
                'reportable'=>true,

         );

