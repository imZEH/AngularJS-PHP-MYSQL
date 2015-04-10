'use strict';

var SpecificationCTRL = function($scope ,toaster,SpecificationFactory){
	init();

	$scope.save = function(){
		if($scope.specification.sp_name === undefined){
			toaster.pop('error', "", "Specification Name is Required.");
		}else{
			if($scope.specification.sp_id === undefined){
				SpecificationFactory.saveSpecification($scope.specification,function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}else{
				SpecificationFactory.updateSpecification($scope.specification.sp_id,$scope.specification, function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}
		}
	}

	$scope.get = function(id){
		SpecificationFactory.getSpecificSpecification(id, function(data){
			$scope.specification = data;
		});
	}

	$scope.delete = function(id){
		SpecificationFactory.deleteSpecification(id,function(data){
			toaster.pop('success', "", data.msg);
			init();
		});
	}

	function init(){
		$scope.specification = {};
		SpecificationFactory.getAllSpecification(function(data){
			$scope.response = data;

		});
	}
}

polymedic.Controllers.controller('SpecificationCTRL', ['$scope','toaster','SpecificationFactory',SpecificationCTRL]);