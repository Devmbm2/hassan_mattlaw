$(document).ready(function() {
	initClientInjured();
	$( "#injured_person_c, #client_c" ).change(function() {
		showhideRepCap();
	});
   $(".edit-view-row .label").css('white-space','inherit');
});

function initClientInjured(){
    showhideRepCap();
    changeInjuredBtn(); //Call onchange function
    changeInjuredBtnClr(); //Call onchange function
    changeBtn();
    changeBtnClr();
}
function showhideRepCap(){
        var client = $('#client_c').val();
        var injured = $('#injured_person_c').val();
        if(client == injured)
        {
           $('#representation_capacity_c').closest('.edit-view-row-item').hide();
        }
        else {
           $('#representation_capacity_c').closest('.edit-view-row-item').show();
        }
}

function changeInjuredBtn(){
     $("#btn_injured_person_c").focus(function() {
        showhideRepCap(); //Call hide/show function
    });
}
function changeInjuredBtnClr(){
     $("#btn_clr_injured_person_c").focus(function() {
        showhideRepCap(); //Call hide/show function
    });
}
function changeBtn(){
     $("#btn_client_c").focus(function() {
        showhideRepCap(); //Call hide/show function
    });
}
function changeBtnClr(){
     $("#btn_clr_client_c").focus(function() {
        showhideRepCap(); //Call hide/show function
    });
}
