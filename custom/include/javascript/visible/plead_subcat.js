$(document).ready(function() {
	console.log('asdadasdasdasdasd');
function initPleadSubCat(){
    showhideBaseSubCat();
    changeBaseSubCat(); //Call onchange function
    showhideBaseNotTyp();
    pleadName();
    $('#incoming_or_outgoing').attr('onchange','pleadName();');
     $('#category_id').attr('onchange','pleadName();');
     var fields_to_change = ['notice_type','orders_sub_type','name_of_motion','complaint_answer_type','witness_list_type_c','exhibit_type_c','stipulation_type_c','sum_subp_type_c'];
     $.each(fields_to_change, function( index, value ){
                $('#'+value).attr('onchange','pleadName();');
     });

}
function showhideBaseSubCat(){
	console.log('yes');
        var subcat = $('#subcategory_id').val();
	//Show/Hide Orders Sub Type
        if(subcat == "Order")  {
           $('#orders_sub_type').closest('.edit-view-row-item').show();
        }
        else {
           $('#orders_sub_type').closest('.edit-view-row-item').hide();
        }
	//Show/Hide Notice Type
	if(subcat == "Notice")  {
           $('div[data-label="LBL_NOTICE_TYPE"]').show();
           $('div[field="notice_type"]').show();
		   $('#amount').parent().parent().show();
		   $('#sent_received').parent().parent().show();
        }
        else {
           $('div[data-label="LBL_NOTICE_TYPE"]').hide();
           $('div[field="notice_type"]').hide();
		   $('#amount').parent().parent().hide();
		   $('#sent_received').parent().parent().hide();
        }
	//Show/hide Name of Motion
	if(subcat == "Motion")  {
           $('div[data-label="LBL_NAME_OF_MOTION"]').show();
           $('div[field="name_of_motion"]').show();
	   $('div[data-label="LBL_SENT_RECEIVED"]').show();
           $('div[field="sent_received"]').show();
        }
        else {
           $('div[data-label="LBL_NAME_OF_MOTION"]').hide();
           $('div[field="name_of_motion"]').hide();
	   $('div[data-label="LBL_SENT_RECEIVED"]').hide();
           $('div[field="sent_received"]').hide();
        }
	//Show/Hide Hearing Type
	if(subcat == "Hearing_Notice")  {
           $('div[data-label="LBL_HEARING_TYPE"]').show();
           $('div[field="hearing_type"]').show();
        }
        else {
           $('div[data-label="LBL_HEARING_TYPE"]').hide();
           $('div[field="hearing_type"]').hide();
        }
	//Show/Hide Complaint Answer Type
	if(subcat == "Complaint" || subcat == "Answer")  {
           $('div[data-label="LBL_COMPLAINT_ANSWER_TYPE"]').show();
           $('div[field="complaint_answer_type"]').show();
        }
        else {
	   $('div[data-label="LBL_COMPLAINT_ANSWER_TYPE"]').hide();
           $('div[field="complaint_answer_type"]').hide();
        }
}

function changeBaseSubCat(){
     document.getElementById("subcategory_id").onchange = function() {
        showhideBaseSubCat(); //Call hide/show function
	pleadNanme();
    }
}

function pleadName() {
     var i_o = $('#incoming_or_outgoing').val();
     var type_pleading = $('#category_id').val();
     var pleading_subtype = $('#subcategory_id').val();
     var subtype = $('#subcategory_id option:selected').text();
     var lastname = $('#lastname_c').val();
     var nickname = $('#nickname_c').val();
     var map_field;
     var pleadingName;
     if (i_o  == "Incoming"){
        initial = "D's";
     } else if (i_o == "Outgoing"){
        initial = "P's";
     }
     if (type_pleading == "Pleading"){
        var map_fields = {Notice: "notice_type", Order: "orders_sub_type",Hearing_Notice: "notice_type",Motion: "name_of_motion",Complaint:"complaint_answer_type",Answer:"complaint_answer_type",Witness_List: "witness_list_type_c",Exhibits: "exhibit_type_c",Stipulation: "stipulation_type_c",Subpoenas_Service: "sum_subp_type_c",sum: "sum_subp_type_c"};
        $.each(map_fields,function(i,v) {
           if(i = pleading_subtype){
              map_field = $('#'+map_fields[i]+' option:selected').text();
              return false;
           } else {
              map_field = '';
           }
        });
        var arr1 = ['Witness_List', 'Exhibits', 'sum', 'Subpoena'];
        var arr2 = ['Subpoenas_Service', 'Verdict'];
        var pleadingName = '';
        if ($.inArray(pleading_subtype,arr1) != -1){
           pleadingName = initial+' '+map_field+' '+subtype+' '+lastname+' '+nickname;
        } else if ($.inArray(pleading_subtype,arr2) != -1){
           pleadingName = subtype;
        } else {
           pleadingName = initial+' '+map_field+' '+subtype;
        }
      //  });
     }
     $('#EditView'+ ' #document_name').val(pleadingName);
}

initPleadSubCat();
});
