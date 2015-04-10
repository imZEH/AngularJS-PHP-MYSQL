'use strict';

var SpecificationFactory = function($http){
	var SpecificationFactory = {};

	SpecificationFactory.saveSpecification = function(data,cb){
		$http.post('php/classes/insertSpecification',data).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	SpecificationFactory.updateSpecification = function(id, Specification,cb){
		$http.post('php/classes/updateSpecification', {sp_id:id, specification:Specification}).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	SpecificationFactory.getSpecificSpecification = function(id,cb){
		$http.get('php/classes/specification?sp_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	SpecificationFactory.getAllSpecification = function(cb){
		$http.get('php/classes/Specifications').success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	SpecificationFactory.deleteSpecification = function(id,cb){
		$http.delete('php/classes/deleteSpecification?sp_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	return SpecificationFactory;
}

polymedic.Services.factory('SpecificationFactory',['$http' ,SpecificationFactory]);

