'use strict';

examples.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'web/bundles/examples/templates/default.html',
            controller: 'DefaultController'
        })
        .when('/user/new', {
            templateUrl: 'web/bundles/examples/templates/new-user.html',
            controller: 'UserController'
        })
        // .otherwise({
        //     redirectTo: '/error/404'
        // });
    ;
});
