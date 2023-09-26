$(document).ready(function(){
        show_hide_ContactFields();
});

function show_hide_ContactFields(){
	/*if(bean['salutation']!='Honorable'){
		$("[field='judge_web_page_c']").parent().html('');
	}
	if(bean['marital_status_c']!='Married' && bean['marital_status_c']!='Separated' && bean['marital_status_c']!='Life_Partner'){
		$("[field='spouse_name_c']").parent().html('');
	}
	if((bean['salutation']!='Dr.' && bean['salutation']!='Prof.' && bean['salutation']!='Honorable') || (bean['salutation']=='Sr.' || bean['salutation']=='Jr.' || bean['salutation']=='III' || bean['salutation']=='IV')){
		$("[field='assistant']").parent().html('');
		$("[field='assistant_phone']").parent().html('');
	}
	if(bean['work_injury_status_c']!='Yes'){
		$("[field='work_injury_details_c']").parent().html('');
	}
	if(bean['type_c']!='Doctor'){
		$("[field='doctor_type_c']").parent().html('');
	}
	if(bean['work_injury_c']!='Yes'){
		$("[field='work_injury_status_c']").parent().html('');
	}
	if(bean['military_c']!='Yes'){
		$("[field='honorably_discharged_c']").parent().html('');
	}
	if(bean['arrested_c']!='Yes'){
		$("[field='arrest_details_c']").parent().html('');
	}
	if(bean['children_c']!='Yes'){
		$("[field='about_childrenc']").parent().html('');
	}*/
	var hideFields = ['felony_convictions_c', 'pre_existing_conditions_c', 'judge_web_page_c', 'federal_tax_id_c', 'expert_type_c', 'county_of_convictions_c', 'years_of_convictions_c'];
        $.each(hideFields, function( index, value ){
                $('#'+value).closest('.detail-view-row-item').hide();
        });

        $('a#tab4').closest('li').hide();	
	var type = $('#type_c').val();
	if (type == 'Claims_Adjuster'){
	   $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
	} else {
	   $('a#tab2').closest('li').show();
           $('a#tab3').closest('li').show();
	}
	if (type == 'Client'){
	   $('#account_id').closest('.detail-view-row-item').hide();
        
           var fc = $('input[name=felony_convictions_c]:checked').val();
        //console.log(fc);
           if (fc == "Yes"){
              $('#county_of_convictions_c').closest('.detail-view-row-item').show();
              $('#years_of_convictions_c').closest('.detail-view-row-item').show();
           }
        }
	if (type == 'Defendant'){
           $('#email1_span').closest('.detail-view-row-item').hide();
           $('#marital_status_c').closest('.detail-view-row-item').hide();
           $('#birthday_card_c').closest('.detail-view-row-item').hide();
           $('#newsletter_c').closest('.detail-view-row-item').hide();
           $('#observations_about_client_c').closest('.detail-view-row-item').hide();
	}
	if (type == 'Doctor'){
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
        }
	if (type == 'Expert_Witness'){
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
           $('a#tab4').closest('li').show();
           $('#federal_tax_id_c').closest('.detail-view-row-item').show();
           $('#expert_type_c').closest('.detail-view-row-item').show();
        }
	if (type == 'Insured' || type == 'Lawyer' || type == 'Lien_Holder' || type == 'Vendor' || type == 'Witness_BandA' || type == 'Witness_Fact'){
           $('a#tab1').closest('li').hide();
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
        }
	if (type == 'Investigator'){
           $('a#tab1').closest('li').hide();
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
           $('#federal_tax_id_c').closest('.detail-view-row-item').show();
        }
	if (type == 'Judge'){
           $('a#tab1').closest('li').hide();
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
           $('#occupation_c').closest('.detail-view-row-item').hide();
           $('#account_name').closest('.detail-view-row-item').hide();
           $('#birthday_card_c').closest('.detail-view-row-item').hide();
           $('#newsletter_c').closest('.detail-view-row-item').hide();
        }
	if (type == 'Investigator'){
           $('a#tab1').closest('li').hide();
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
           $('#federal_tax_id_c').closest('.detail-view-row-item').show();
        }
	if (type == 'Police'){
           $('a#tab1').closest('li').hide();
           $('a#tab2').closest('li').hide();
           $('a#tab3').closest('li').hide();
           $('#suffix').closest('.detail-view-row-item').show();
        }
}
