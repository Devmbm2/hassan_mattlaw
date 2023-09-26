$(document).ready(function() {
let leadsource = $("#lead_source").val();
let casetype = $("#case_type_c").val();
// alert(casetype);
        if(leadsource == 'Website_Form' && casetype === '')
        {
              $("div[field = 'website_form_casetype']").parent().show();  
        }
        else
        {
              $("div[field = 'website_form_casetype']").parent().hide();  
        }
  });