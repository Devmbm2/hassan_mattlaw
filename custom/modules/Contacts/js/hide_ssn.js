$(document).ready(function(){
    maskVal();
    $('#ssn_c').on('input','maskSSN();');
});
function maskVal() {
    var ssn = $('#ssn_c').val();
    var valMask = ssn.replace(/[0-9]/g, '*');
    $('#ssn_c').val(valMask);
    console.log(ssn);
}
function maskSSN() {
      //$('#ssn_c').keyup(function() {
        var ssn = $('#ssn_c').val();
        var val = ssn.replace(/\d/g, '*');
        var newVal = '';
        var sizes = [3, 2, 4];
        var maxSize = 10;

        for (var i in sizes) {
          if (val.length > sizes[i]) {
            newVal += val.substr(0, sizes[i]) + '-';
            val = val.substr(sizes[i]);
          } else {
            break;
          }
        }

        newVal += val;
        this.value = newVal;
     // });
}
