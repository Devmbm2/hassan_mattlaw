<?php
 $job_strings[] = 'remainingTimeCheck';
 function remainingTimeCheck(){
    $sql="Select disc_discovery.*,disc_discovery_cstm.* from disc_discovery inner join disc_discovery_cstm on disc_discovery.id=disc_discovery_cstm.id_c where disc_discovery.deleted=0";
    $result=$GLOBALS['db']->query($sql);
    $datetime1 = date_create(date('Y-m-d'));
    while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
        if($record['day_counter_c']!=NULL OR $record['day_counter_c']!=""){
            $datetime2 = date_create(date("Y-m-d",strtotime($record['date_served'])));
            $interval = date_diff($datetime1, $datetime2);
            $GLOBALS['db']->query("UPDATE disc_discovery
            INNER JOIN
            disc_discovery_cstm
            ON disc_discovery.id = disc_discovery_cstm.id_c
            SET disc_discovery_cstm.number_of_day_c =".($record['day_counter_c']-$interval->days)." where disc_discovery.id='".$record['id']."'");
        }
    }
  return true;
}
