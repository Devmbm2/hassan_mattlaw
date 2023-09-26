 <?php
ob_clean();

$stream = "<style>
	.col-lg-6 {
	  width: 42% !important; 
	}
	</style>
 <form id = 'test' method='post' action='index.php?module=FP_events&action=getSelectedDates'>
    <div class='container' style='max-width: 860px;'>
		<div class='container_box'>
			<div class='row'>
				<div class='col-lg-6'>
					<div id='inputFormRow'>
						<div class='input-group mb-3'>
							<strong>Start Date:</strong> 
							<input class = 'required_check' type='date' name='start_date[0][]'  placeholder='Enter title' autocomplete='off' style = 'max-width: 40%;min-width: 40%;' required>
							<select name='start_date[0][]' class='datetimecombo_time required_check' size='1' id='date_start_hours' tabindex='0' required><option></option><option value='00'>00</option><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option>
							</select>&nbsp;:
							&nbsp;<select name='start_date[0][]' class='datetimecombo_time required_check' size='1' id='date_start_minutes' tabindex='0' required>
							<option></option>
							<option value='00'>00</option>
							<option value='05'>05</option>
							<option value='15'>15</option>
							<option value='30'>30</option>
							<option value='45'>45</option>
							</select>
						</div>
					</div>
				</div>  
				<div class='col-lg-6'>
					<div id='inputFormRow'>
						<div class='input-group mb-3'>
							<strong>End Date:</strong> 
							<input class = 'required_check' type='date' name='end_date[0][]' class='' placeholder='Enter title' autocomplete='off' style = 'max-width: 40%;min-width: 40%;' required>
							<select name='end_date[0][]' class='datetimecombo_time required_check' size='1' id='date_start_hours' tabindex='0' required><option></option><option value='00'>00</option><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option>
							</select>&nbsp;:
							&nbsp;<select name='end_date[0][]' class='datetimecombo_time required_check' size='1' id='date_start_minutes' tabindex='0' required>
							<option></option>
							<option value='00'>00</option>
							<option value='05'>05</option>
							<option value='15'>15</option>
							<option value='30'>30</option>
							<option value='45'>45</option>
							</select>
						</div>
					</div>
				</div>
					<div class='input-group-append'>
						<button id='removeRow' type='button' class='btn btn-danger'>Remove</button>
					</div>
			</div>
		</div>
		<button id='addRow' type='button' class='btn btn-info'>Add Row</button><br>
	</div>
	<input style = 'margin-left: 10px;' class='button' type = 'button' id = 'save_dates' value = 'Save'>
	<input style = 'margin-left: 10px;' class='button' onclick='$(\".container-close\").click();' type = 'button' id = 'cancel_dates' value = 'Cancel'>
 </form>";
echo $stream;die;   