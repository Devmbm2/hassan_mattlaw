// function initOrgType(){
//     showhideBaseOrgType();
//     changeOrgType(); //Call onchange function
//     changeExpType() //Call onchange function
//     $('#Accounts0emailAddressOptOutFlag0').parents('.email-address-option:first').hide();
//     $('#Accounts0emailAddressInvalidFlag0').parents('.email-address-option:first').hide();
// }
// function showhideBaseOrgType(){
//         orgtype = document.getElementById('account_type').value;
//        var expertTypeElement = document.getElementById('expert_type_c');
//       var exptype;
//       if (expertTypeElement !== null && typeof expertTypeElement !== 'undefined') {
//          exptype = expertTypeElement.value;
//       } else {
//          exptype = ''; 
//       }
// 	//Show/Hide Orders Sub Type
//         if(orgtype == "Medical_Provider" || exptype == "Medical")  {
//            $('#medicine_type_c').parent().parent().show();
//         }
//         else {
//           $('#medicine_type_c').parent().parent().hide();
//         }
// 	//Show/Hide Notice Type
// 	if(orgtype == "Expert_Witness")  {
// 	   $('#expert_type_c').parent().parent().show();
// 	}
// 	else {
// 	   $('#expert_type_c').parent().parent().hide();
// 	   $('#medicine_type_c').parent().parent().hide();
// 	}
// 	if(orgtype == "Court_Clerk")  {
// 	   $('#country').parent().parent().show();
// 	   $('#nickname_c').parent().parent().hide();
// 	   $('#ownership').parent().parent().show();
// 	}
// 	else {
// 	   $('#country').parent().parent().hide();
// 	   $('#nickname_c').parent().parent().show();
// 	   $('#ownership').parent().parent().hide();
// 	}
// }

// function changeOrgType(){
//      document.getElementById("account_type").onchange = function() {
//         showhideBaseOrgType(); //Call hide/show function
//     }
// }
// function changeExpType(){
//      document.getElementById("expert_type_c").onchange = function() {
//         showhideBaseOrgType(); //Call hide/show function
//     }
// }
// $(document).ready(function() {
//         initOrgType();
// })
