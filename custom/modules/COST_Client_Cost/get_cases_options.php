<?php

  global $db;
// for the search options in caes dropdown of the list view 
$sql = "SELECT cases.id, cases.name 
FROM cases 
WHERE cases.id IN (
  SELECT DISTINCT cost_client_cost_casescases_ida
  FROM cost_client_cost_cases_c
)";
$result = $db->query($sql);
if ($result->num_rows > 0) {
$rows = array();
while($row = $result->fetch_assoc()) {
$rows[] = $row;
}
$arr_for_options = json_encode($rows);
}

echo $arr_for_options;
die();
