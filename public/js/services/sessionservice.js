'use strict';

var sessionFactory = function($http){

	var sessionFactory = {};

	sessionFactory.set = function(key,value){
		return sessionStorage.setItem(key,value.u_id);
	};

	sessionFactory.get = function(key){
		return sessionStorage.getItem(key);
	};

	sessionFactory.destroy = function(key){
		$http.post('php/auth/destroy_session.php');
		return sessionStorage.removeItem(key);
	}
	
	return sessionFactory;
}

polymedic.Services.factory('sessionFactory',['$http',sessionFactory]);