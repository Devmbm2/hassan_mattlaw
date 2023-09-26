$(document).ready(function() {
function initContChildren(){
    showhideNameAge();
    changeChildren(); //Call onchange function
    $('#Contacts0emailAddressOptOutFlag0').parents('.email-address-option:first').hide();
    $('#Contacts0emailAddressInvalidFlag0').parents('.email-address-option:first').hide();
}
function showhideNameAge(){
        children = $('input[name=children_c]:checked').val();
        if(children == "Yes")
        {
           $('#about_children_c').parent().parent().show();
        }
        else {
			$('#about_children_c').parent().parent().hide();
        }
}

function changeChildren(){
     $("input[name=children_c]").click(function() {
        showhideNameAge(); //Call hide/show function
    });
}
initContChildren();
});
