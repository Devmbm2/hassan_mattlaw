
$(document).ready(function(){
var no_of_split = $('#number_of_ways_to_split').val();
var div_get = document.querySelector('div[field="companion"]');
if(no_of_split >= 1)
{
	div_get.style.display="block";
	div_get.parentNode.style.display = "block";
 }
else
{
	div_get.style.display="none";
	div_get.parentNode.style.display = "none";	
}

});

