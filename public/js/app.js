'use strict';

var polymedic = polymedic || {};

polymedic.Controllers = angular.module('polymedic.controllers', []);
polymedic.Services = angular.module('polymedic.services', []);

var config = function($routeProvider){
	$routeProvider
        .when('/', {
            templateUrl: './public/views/login.html',
            controller: 'loginCTRL'
        })
        .when('/home',{
        	templateUrl: './public/views/home.html',
            controller: 'homeCTRL'
        })
        .when('/specfication',{
        	templateUrl: './public/views/specfication.html',
            controller: 'SpecificationCTRL'
        })
        .when('/branch', {
        	templateUrl: './public/views/branch.html',
            controller: 'branchCTRL'
        })
        .when('/doctors',{
        	templateUrl: './public/views/doctors.html',
            controller: 'DoctorCTRL'
        })
        .otherwise({
            redirectTo: '/home'
        });
}

angular
    .module('polymedic', ['toaster','ngSanitize','ngRoute', 'polymedic.controllers', 'polymedic.services'])
    .config(config)
    .run(function($rootScope, $location, loginFactory){
        var routespermission=['/home'];  //route that require login
        $rootScope.$on('$routeChangeStart', function(){
            if( routespermission.indexOf($location.path()) !=-1)
            {
                var connected=loginFactory.islogged();
                connected.then(function(msg){
                    if(!msg.data) $location.path('/');
                });
            }
        });
    });
