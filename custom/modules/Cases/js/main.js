
$( document ).ready(function() {
     let json ='';
     let flag = 0;
     $("ul.nav-tabs > li >a#tab5").on("click",function(){
      if(!flag)
      {
           json = $("#tab-content-8 .detail-view-row-item #questioner").text();
           flag = 1;
      }
     
          
         $("#tab-content-8 .detail-view-row-item").html("");
     
          var html = renderForm(json);
          
          $("#tab-content-8 .detail-view-row-item").html(html)
     });
 });













	  


	  
