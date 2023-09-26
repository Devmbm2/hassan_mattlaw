var app = angular.module('suite_angular_app', []);
    app.controller('suite_angular_controller', function($scope, $http){
        $scope.showCasesList = false;
        $scope.CasesDetails = function () {
            $scope.showCasesList = true;
            var formData = new FormData();
            formData.append('sugar_body_only',true );

            xhr = new XMLHttpRequest();
            xhr.open( 'POST', 'index.php?module=Cases&action=index&response=json', true );
            xhr.onreadystatechange = function ( response ) {
                if (xhr.readyState === 4) {
                    console.log(xhr.responseText);
                    $scope.data = JSON.parse(xhr.responseText);
                    $("#pagecontent").children(":not([mdialog])").remove();
                    $scope.$apply();
                }
            };
            xhr.send( formData );

        }
    }).directive('mdialog', function() {
        return {
            templateUrl: 'themes/SuiteP/angular/views/cases-list.txt'
        };
    });




// $http({
//     method: "POST",
//     url: "index.php?module=Accounts&action=index&response=json",
//     data: formData
// }).then(function mySuccess(response) {
//     $scope.data = response.data;
// }, function myError(response) {
//     $scope.data = response.data;
// });