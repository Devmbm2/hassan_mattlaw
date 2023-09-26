   $(document).ready(function() {
      $("#countrycode_ht").attr("maxlength", 2);
                  $(document).on('keydown', '#countrycode_ht', function(e) {
         var a = e.key;

         if (a.length == 1) return /[0-9]|\+/.test(a);
         return true;
      })
  });
//   

