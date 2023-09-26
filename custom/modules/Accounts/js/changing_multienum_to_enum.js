
$(document).ready(function () {
  var items = [
        "C++",
        "Java",
        "Python",
        "C#",
        "DSA",
        "STL",
        "Self Placed",
        "Android",
        "Kotlin",
        "GeeksforGeeks",
        "GFG",
    ];
    // jQuery inbuild function
    $("#name_advanced").on('focusout', function(){
    	console.log("test");
        source: items // list of items.
    });
	$("#account_type_basic").parent().parent().find('label').remove();

	$("#account_type_basic").multiselect({
		columns: 1,
		placeholder: "Select  Type",
		search: true,
		selectAll: false,
		// limitCount: 1
	});
	$(".ms-options-wrap").css("width", "60%");
$(".ms-options").css("width", "60%");
$(".ms-options-wrap > button").css("padding", "8px 20px 8px 5px");
$(".ms-options-wrap > button").css("border", "none");
$(".ms-options-wrap > button").css("border-radius", "4px");
$(".ms-options-wrap > button").css("margin-top", "5px");
	$('.ms-options > ul > li').click(function () {
		$('.ms-options > ul > li.selected').removeClass("selected");
		var $parent = $(this).parent();
		$parent.addClass("selected");
		var $value = $(this).find("input").val();
		$("#account_type_basic").val($value);
	})
	$('#search_form_clear').click(function () {
		$("#account_type_basic").multiselect("reload");
		$('.ms-options > ul > li.selected').removeClass("selected");
$(".ms-options-wrap").css("width", "60%");
$(".ms-options").css("width", "60%");
$(".ms-options-wrap > button").css("padding", "8px 20px 8px 5px");
$(".ms-options-wrap > button").css("border", "none");
$(".ms-options-wrap > button").css("border-radius", "4px");
$(".ms-options-wrap > button").css("margin-top", "5px");
	})
	$("#name_basic").attr("placeholder", "Search with Organization name");
	$("#address_city_basic").attr("placeholder", "Search with City");
	$("#name_basic").parent().parent().find('label').remove();
$("#address_city_basic").parent().parent().find('label').remove();
})