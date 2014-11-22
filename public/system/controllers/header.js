'use strict';

angular.module('lama.system')
    .controller('HeaderController', ['$scope',
        function ($scope) {
          $scope.isCollapsed = true;
        }
    ]);
