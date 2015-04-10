'use strict';

var loginCTRL = function($scope,toaster,loginFactory){
	$scope.login = function(){
		loginFactory.authUser($scope.user,function(data){
			if(data.status == 200){
				toaster.pop('success', "", "Access Granted");
			}else{
				toaster.pop('error', "", "Invalid Username/Password");
			}
		});
	}
}


polymedic.Controllers.controller('loginCTRL', ['$scope','toaster','loginFactory',loginCTRL]);