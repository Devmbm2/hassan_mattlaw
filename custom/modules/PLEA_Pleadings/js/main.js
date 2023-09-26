$("input[name='uploadfile_file']").change(function(){
	var file = this.files[0];
  console.log("You are here Bro");
    var formData = new FormData();
    formData.append("pdf", file);
	// console.log(formData.getAll('pdf'));
    $.ajax({
      url: "index.php?module=PLEA_Pleadings&action=ReadFile",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response);
        // if(response!='empty'){
        //   var data=JSON.parse(response);

        // $("input[name='plea_pleadings_cases_name']").prop("value", data[0].caseName);
        // $("input[name='plea_pleadings_casescases_ida']").prop("value", data[0].caseID);

        // $("select[name='incoming_or_outgoing'] option").each(function(){
        //     if($(this).val()==data[1]) {
        //         $(this).prop("selected", true);
        //     }
        //   });
        // $("select[name='author_type'] option").each(function(){
        //       if($(this).val()==data[2]) {
        //           $(this).prop("selected", true);
        //       }
        // });
        // $("input[name='parent_name']").prop("value", data[3]);
        // $("select[name='subcategory_id'] option").each(function(){
        //   console.log(data);
        //     if($(this).val()==data[4]) {
        //         $(this).prop("selected", true);
        //     }
        //   });
        // }


        // pleadName();

      }
    });

});
