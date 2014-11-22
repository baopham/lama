'use strict';

//Service for session status
angular.module('lama.users')
    .factory('Sessions', ['$http',
        function ($http) {
            return {
                isSessionedIn: function () {
                    $http.get('/api/v1/isSessionedIn');
                },
                isLoggedIn: function () {
                    $http.get('/api/v1/isLoggedIn');
                },
                hasAccess: function (permission) {
                    $http.get('/api/v1/hasAccess/' + permission);
                }
            };
        }
    ]);
