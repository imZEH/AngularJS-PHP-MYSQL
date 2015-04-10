'use strict';

var loginCTRL = function($scope,$toaster,loginFactory){
	$scope.login = function(){
		console.log($scope.user);

		loginFactory.authUser($scope.user,function(data){
			console.log(data);
		});
	}
}


polymedic.Controllers.controller('loginCTRL', ['$scope','toaster','loginFactory',loginCTRL]);