// ======Append Document type in Dropdown========
/*$(document).ready(function() {
        $('#soft_documents_c').parent().parent().hide();
});

$("select#hard_or_soft_doc").change(function(){
    let case_id = $('input[name="parent_id"]').val();
    if(case_id == null){
        let doc_case_id = $('#case_id').val();
        case_id = doc_case_id;
    };
    let subcategory_id = $('#subcategory_id').val();
    let document_type = $(this).children("option:selected").val();
    if(subcategory_id == 'plea_pleadings' || subcategory_id == 'neg_negotiations' || subcategory_id == 'disc_discovery' ) {
       if (document_type == 'Hard_Documents') {
           if(case_id != null){
               $('#soft_documents_c').parent().parent().show();
           }
           $('#soft_documents_c').empty();
           $.ajax({
               url: 'index.php?module=Documents&action=getSoftDocs',
               type: "POST",
               data: {
                   module_name: subcategory_id,
                   case_id: case_id,
               },
               success: function (response) {
                   if (response) {
                       let doc_records = JSON.parse(response);
                       $("#soft_documents_c").append(new Option('Choose Soft Document', 'soft_document'));
                       $.each(doc_records, function (index, value) {
                           $("#soft_documents_c").append(new Option(value.document_name, value.id));
                       });
                   }
               }
           });
       }else {
           $('#soft_documents_c').parent().parent().hide();
           $('#soft_documents_c').empty();
           $("#soft_documents_c").append(new Option('Choose Soft Document', 'soft_document'));
       }
   }
});*/
$("#claim_number").parent().parent().hide();
$("#adjuster").parent().parent().hide();
$("#insurance_type_c").on("change",function(){
  //console.log($("#insurance_id").val()=="");
  if($("#insurance_id").val()==""){
    return false;
  }
  function claim_number(response) {
    // console.log(response.responseText);
    $("#claim_number").parent().parent().show();
    if(response.responseText==""){
      $("#claim_number").parent().parent().hide();
      $("#adjuster").parent().parent().hide();
    }
    if ($(response.responseText).attr("data-claimnumber") !== undefined) {
      $("#adjuster").parent().parent().show();
      $("#adjuster").html(response.responseText);
      $("#claim_number").html("<option value='"+$("#adjuster").find(":selected").data("claimnumber")+"'>"+$("#adjuster").find(":selected").data("claimnumber")+"</option>");
    } else {
      $("#adjuster").html("");
      $("#adjuster").parent().parent().hide();
      $("#claim_number").html(response.responseText);
    }
    
    }
    http_fetch_async(
    'index.php?module=Documents&action=claim_number',
    claim_number,
    'myRequest', 'InsurnaceID='+$("#insurance_id").val()+'&InsuranceType='+$(this).val()+'&sugar_body_only=true');
});

$("#adjuster").on("change", function(){
  $("#claim_number").html("<option value='"+$("#adjuster").find(":selected").data("claimnumber")+"'>"+$("#adjuster").find(":selected").data("claimnumber")+"</options>");
});
