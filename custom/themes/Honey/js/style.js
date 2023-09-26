$(document).ready(function(){
	function check_session_id()
{
  $.ajax({
    url: 'index.php?module=Users&action=check_login',
    type: 'POST',
    // contentType: 'application/x-www-form-urlencoded',
    dataType: 'text',
    data: 'sugar_body_only=true',           
    async: true,      
    success : function (result){
      var decode = JSON.parse(result);
      var output = decode.output;
      if(output == 'logout'){
        window.location.href = 'index.php?module=Users&action=Login&loginErrorMessage=LBL_SESSION_EXPIRED_LOCATION';
      }
      else{
        // console.log("Login success");
      }
    }
  });
}

// setInterval(function(){
//     // check_session_id();
// }, 10000);
SortLang();
})
function SortLang() {
    $(".all .dropdown-menu").attr("id", "topnavsort");
    var list = $("#topnavsort"),
    listItems = Array.prototype.slice.call(list.find("li"));
listItems.sort(function(a, b) {
    a = $("a", a).text(), b = $("a", b).text();
    return a < b ? -1 : a > b ? 1 : 0;
});
listItems.forEach(function(val) {
    list.append($(val).remove());
});
}