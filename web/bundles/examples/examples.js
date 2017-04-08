'use script';

var examples = angular.module('examples',
    ['ngRoute', 'ngSanitize', 'ngFileUpload'],
    function($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    }
);
