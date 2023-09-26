<?php

$sql = "SELECT neg_negotiations.id, neg_negotiations.multiple_assigned_users, neg_negotiations_cases_c.neg_negotiations_casescases_ida, cases.name, cases.assigned_user_id
		FROM neg_negotiations 
		LEFT JOIN neg_negotiations_cases_c ON(neg_negotiations.deleted = 0 AND neg_negotiations_cases_c.neg_negotiations_casesneg_negotiations_idb = neg_negotiations.id)
		LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = neg_negotiations_cases_c.neg_negotiations_casescases_ida)
		WHERE neg_negotiations.deleted = 0";

$result = $GLOBALS['db']->query($sql, true);

While($row = $GLOBALS['db']->fetchByAssoc($result)){
	$update = "UPDATE  neg_negotiations SET neg_negotiations.multiple_assigned_users = '^{$row['assigned_user_id']}^' WHERE neg_negotiations.id = '{$row['id']}'";
	$GLOBALS['db']->query($update, true);
}
echo 'done';