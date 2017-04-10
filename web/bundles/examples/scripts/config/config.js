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
         .when('/user/list/', {
            templateUrl: 'web/bundles/examples/templates/list.html',
            controller: 'ListUserController'
        })
         .when('/user/edit/', {
            templateUrl: 'web/bundles/examples/templates/edit.html',
            controller: 'EditUsertController.js'
        })
        // .otherwise({
        //     redirectTo: '/error/404'
        // });
    ;
});
