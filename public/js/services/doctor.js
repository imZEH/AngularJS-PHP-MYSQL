'use strict';

var DoctorFactory = function($http){
	var DoctorFactory = {};

	DoctorFactory.saveDoctor = function(data,cb){
		$http.post('php/classes/insertDoctor',data).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	DoctorFactory.updateDoctor = function(id, doctor,cb){
		$http.post('php/classes/updateDoctor', {d_id:id, doctor:doctor}).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	DoctorFactory.getSpecificDoctor = function(id,cb){
		$http.get('php/classes/doctor?d_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	DoctorFactory.getAllDoctor = function(cb){
		$http.get('php/classes/doctors').success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	DoctorFactory.deleteDoctor = function(id,cb){
		$http.delete('php/classes/deleteDoctor?d_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	return DoctorFactory;
}
polymedic.Services.factory('DoctorFactory',['$http' ,DoctorFactory]);

