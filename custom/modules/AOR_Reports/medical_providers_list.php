<?php
$header = '<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
	<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><b>Select Medical Providers and Generate Medical Records in the System</b></span></td>
</tr>

</tbody>
</table>';

$stream_html = $header;
$stream_html .='<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
$stream_html .='<script type="text/javascript" src="custom/include/javascript/loadingoverlay.min.js"></script>';
$stream_html .='<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
$stream_html .='<script type="text/javascript" src="custom/modules/AOR_Reports/generate_records.js"></script>';
$stream_html .= '<div><label for="medical_providers" >List Of Medical Providers</label><br>';
$stream_html .='<select  style="width:50%;" name="medical_providers" id="medical_providers" multiple >';
	$sql = "SELECT accounts.id, accounts.name
			FROM `accounts`
			WHERE accounts.deleted = 0 ";
	$result = $GLOBALS['db']->query($sql, true);
	while($row = $GLOBALS['db']->fetchByAssoc($result)){
		$stream_html .='<option value='. $row['id'] .'>'. $row['name'] .'</option>';		
	}
	
	$stream_html .='</select><br>';

	$stream_html .='<input type="button" id = "generate_record" value="Generate Records" onclick="generate_records(\''.$_REQUEST['related_module'].'\');">';
	$stream_html .='</div>';
	$stream_html .='<script>
					$( document ).ready(function() {
						$("#medical_providers").multiselect({
							columns: 1,
							placeholder: "Select Medical Providers",
							search: true,
							selectAll: true
						});
						$(".ms-options-wrap").css("width", "50%");
						$(".ms-options").css("width", "50%");
					});
					</script>';

echo $stream_html;die;