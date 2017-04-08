examples.controller('UserController', ['$scope', '$http', function($scope, $http) {
	console.log('UserController');

	$scope.create = function (user) {
		$http.post('/app.php?route=user_new', {user: user})
		.then(
				function (response) {
				console.log(response);
			},
				function (response) {
				console.log(response.status);
			}
		);
	}
}])