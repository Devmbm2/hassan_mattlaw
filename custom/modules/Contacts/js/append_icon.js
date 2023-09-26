$(document).ready(function(){
 
   $("[field='country_code_phone'] :first-child:first-child").remove()
  
 
      div = document.createElement('div');
      div.id='cesms';

   $("[field='country_code_phone'] ").prepend(div)
   a = document.createElement('a');
   a.setAttribute('href', 'https://familyeducation.voippbxsite.net/App?OPTION=WebPhoneApp');
    var imges = document.createElement("img");
    
    imges.style.width="25px";
    imges.style.height="25px";
    base_url = document.location.origin 
 imges.src=base_url+"/themes/Honey/images/webphone.svg" ;
    a.append(imges)
 
    base_url = document.location.origin 
   div.append(a)
//   
});