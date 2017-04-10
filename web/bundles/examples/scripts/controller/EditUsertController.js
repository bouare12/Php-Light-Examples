/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 25/01/17
 * Time: 23:52
 */

examples.controller('EditUsertController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {

    $http.get('/app.php?route=user_edit&uniqueId=' + $routeParams.uniqueId)
        .then(
            function (response) {
                $scope.user = response.data.user;
                console.log($scope.user);
            },
            function (response) {
                console.log(response.status);
            }
        );

    $scope.update = function (user) {
        $http.post('/app.php?route=client_edit&uniqueId=' + $routeParams.uniqueId, {user: user})
            .then(
                function (response) {
                    console.log(response);
                },
                function (response) {
                    console.log(response.status);
                }
            );
    }
}]);