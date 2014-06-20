'use strict';

angular.element(document).ready(function() {
    //Fixing facebook bug with redirect
    if (window.location.hash === '#_=_'){
        window.location.hash = '#!';
    }

    //Then init the app
    angular.bootstrap(document, ['lama']);

});

angular.module('lama', ['ui.router','restangular','lama.system','lama.auth','lama.users']);