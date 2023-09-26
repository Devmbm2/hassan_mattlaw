<?php
global $db;
$query="SELECT *
FROM fp_events
WHERE gsync_id IS NOT NULL
AND gsync_id != ''
AND NOT EXISTS (
  SELECT *
  FROM cases_fp_events_1_c
  WHERE cases_fp_events_1_c.cases_fp_events_1fp_events_idb = fp_events.id
) AND fp_events.deleted=0";
$result=$db->query($query);

if($result->num_rows>0){
      $selectCases="SELECT * FROM cases WHERE deleted='0' && status != 'Closed'";
      $AllCases=$db->query($selectCases);
      $htmlSelect="<select name='SelectedCases[]'>
      <option value=''></option>
      ";
      while($case=$db->fetchRow($AllCases)){
          $htmlSelect.='<option value="'.$case['id'].'">'.$case['name'].'</option>';
          }
          $htmlSelect.="</select>";
      $html="
      <style>
      table {
          border-collapse: collapse; /* This makes the borders between cells collapse into a single border */
        }

        td,th {
          padding: 5px; /* Adds 10 pixels of padding to each cell */
        }
        
        #EventsTable tr td input{
          width: 200px;
        }
      </style>
      <form action='javascript:void(0);' id='AssignForm' method='POST'>
      <table class='table table-bordered' id='EventsTable' style='width:100%; margin-top:10px;'>
      <thead class='thread-bordered'>
        <tr>
        <th>Events</th>
        <th>cases</th>
        </tr>
      </thead>
      ";
      while($res=$db->fetchRow($result)){
        //data-id=".$res['id']."
          $html.="<tr><td ><input type='hidden' readonly name='NameOfEvents[]' value='".$res['id']."'>".$res['name']."</td><td style='text-align:center;'>".$htmlSelect."</td></tr>";
      }
      $html.="</table></form>";

      echo $html;
}else{
  echo "noRecordFound";
}

die();
?>
