/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 24/01/17
 * Time: 20:53
 */

examples.controller('ListUserController', ['$scope', '$http', function ($scope, $http) {
    console.log('ListUserController');

    $http.get('/app.php?route=user_list')
        .then(
            function (response) {
                $scope.user = response.data.user;
                console.log($scope.user);
            },
            function (response) {
                console.log(response.status);
            }
        );
}]);