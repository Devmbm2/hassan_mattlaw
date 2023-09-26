<?php

$stream_html = '
	<form method="POST" action="select_cancelled_reset_submit.php">
		<p><strong>Please Select Your Function For Events:</strong></p><br>
		<input type="radio" name="select_cancelled_reset_c" value="mark_cancell_duplicate"> Mark Current Event as "Cancelled" & Duplicate it to Input the New Date<br>
		<input type="radio" name="select_cancelled_reset_c" value="mark_cancell_close"> Mark Current Event as Cancelled & Close the Window<br><br>
		<input type="button" id = "save" value="Save" onclick="SendSelectedOptionResetCancell();">
	</form>
';
echo $stream_html;die;
