'use strict';

var loginFactory = function($http,$location,sessionFactory){

	var loginFactory = {};

	loginFactory.authUser = function(data,cb){
		var $promise = $http.post('php/auth/login.php', data).success(function(data){
			cb(data);
		}).error(function(err){
			cb(data);
		});

		$promise.then(function(msg){
			console.log(msg);
			var uid=msg.data;
			if(uid){
				sessionFactory.set('uid',uid);
				$location.path('/home');
			}	       
			else  {
				$location.path('/');
			}				   
		});
	};

	loginFactory.logout = function(cb){
		sessionFactory.destroy('uid');
		$location.path('/');
	};

	loginFactory.islogged = function(cb){
		var $checkSessionServer=$http.post('php/auth/check_session.php');
		return $checkSessionServer;
	};

	return loginFactory;
}

polymedic.Services.factory('loginFactory',['$http', '$location', 'sessionFactory',loginFactory]);