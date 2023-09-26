<?php


              global $db;
    // for the search options in payee dropdown of the list view 
    $sql = "SELECT accounts.id, accounts.name 
    FROM accounts 
    WHERE accounts.id IN (
      SELECT DISTINCT account_id_c
      FROM cost_client_cost)";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
    $rows[] = $row;
    }
    $arr_for_options_p = json_encode($rows);
    }
    echo $arr_for_options_p;
    die();
