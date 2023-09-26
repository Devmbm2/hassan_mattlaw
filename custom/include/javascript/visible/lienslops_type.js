$(document).ready(function() {
function initLienLopType(){
    showhideLienLopFields();
    changeLienLopType(); //Call onchange function
}
function showhideLienLopFields(){
        lientype = document.getElementById('type').value;
        if(lientype == "Medicaid")
        {
           $('div[data-label="LBL_MEDICAID_ID_NUMBER"]').show();
           $('div[field="medicaid_id_number"]').show();
	   $('div[data-label="LBL_MEDICAID_DATE"]').show();
           $('div[field="medicaid_date"]').show();
        }
        else {
	   $('div[data-label="LBL_MEDICAID_ID_NUMBER"]').hide();
           $('div[field="medicaid_id_number"]').hide();
           $('div[data-label="LBL_MEDICAID_DATE"]').hide();
           $('div[field="medicaid_date"]').hide();
        }
	if(lientype == "Medicare")
        {
           $('div[data-label="LBL_MEDICARE_ID_NUMBER"]').show();
           $('div[field="medicare_id_number"]').show();
           $('div[data-label="LBL_MEDICARE_DATE"]').show();
           $('div[field="medicare_date"]').show();
           $('div[data-label="LBL_MEDICARE_TYPE"]').show();
           $('div[field="medicare_type"]').show();
        }
        else {
           $('div[data-label="LBL_MEDICARE_ID_NUMBER"]').hide();
           $('div[field="medicare_id_number"]').hide();
           $('div[data-label="LBL_MEDICARE_DATE"]').hide();
           $('div[field="medicare_date"]').hide();
           $('div[data-label="LBL_MEDICARE_TYPE"]').hide();
           $('div[field="medicare_type"]').hide();
        }
}

function changeLienLopType(){
     document.getElementById("type").onchange = function() {
        showhideLienLopFields(); //Call hide/show function
    }
}
initLienLopType();
});
