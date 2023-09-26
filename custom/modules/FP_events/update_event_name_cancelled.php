<?php
global $db;

$sql = "UPDATE fp_events
		LEFT JOIN fp_events_cstm ON (fp_events.deleted = 0 AND fp_events.id = fp_events_cstm.id_c)
		SET fp_events_cstm.cancelled_reset_c = 'Cancelled'
		WHERE fp_events.id = '{$_REQUEST['record_id']}'";
		$db->query($sql);