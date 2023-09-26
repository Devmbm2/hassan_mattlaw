$(document).ready(function() {
	defenseAttorney1('contact_id4_c', 'defense_attorney_phone_c');
	defenseAttorney2('contact_id5_c', 'defense_attorney_2_phone_c');
	adjuster('contact_id_c', 'adjuster_phone_c');
});


function defenseAttorney1(field1, phoneField){
	YAHOO.util.Event.addListener(
	field1,
	"change",
	  function() {
		$("#btn_defense_attorney_c").attr(
		  "onclick",
		  );
		   getRelatedAttrorneyPhone(field1, phoneField);
	  }
	);
	getRelatedAttrorneyPhone(field1, phoneField);
}
function defenseAttorney2(field1, phoneField){
	YAHOO.util.Event.addListener(
	field1,
	"change",
	  function() {
		$("#btn_defense_attorney_2_c").attr(
		  "onclick",
		  );
		   getRelatedAttrorneyPhone(field1, phoneField);
	  }
	);
	getRelatedAttrorneyPhone(field1, phoneField);
}
function adjuster(field1, phoneField){
	YAHOO.util.Event.addListener(
	field1,
	"change",
	  function() {
		$("#btn_adjuster").attr(
		  "onclick",
		  );
		  console.log('2');
		   getRelatedAttrorneyPhone(field1, phoneField);
	  }
	);
	getRelatedAttrorneyPhone(field1, phoneField);
}
function getRelatedAttrorneyPhone(field1, phoneField){
	var related_id = $("#"+field1).val();
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=DEF_Client_Insurance&action=getContactPhone&related_id='+related_id,
			async: false,
			success: function(response){
				$('#'+phoneField).val(response);
			}
		});
	}
	/* if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	} */
}