'use strict';

var DoctorCTRL = function($scope ,toaster, DoctorFactory, SpecificationFactory, BranchFactory){
	init();

	$scope.save = function(){
		if($scope.doctor.d_fname === undefined || $scope.doctor.d_lname === undefined || $scope.doctor.d_mname === undefined && $scope.doctor.sp_id === undefined || $scope.doctor.b_id === undefined){
			toaster.pop('error', "", "Some of the fields is empty.");
		}else{
			if($scope.doctor.d_id === undefined){
				DoctorFactory.saveDoctor($scope.doctor,function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}else{
				DoctorFactory.updateDoctor($scope.doctor.d_id,$scope.doctor, function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}
		}
	}

	$scope.get = function(id){
		DoctorFactory.getSpecificDoctor(id, function(data){
			$scope.doctor = data;
		});
	}

	$scope.delete = function(id){
		DoctorFactory.deleteDoctor(id,function(data){
			toaster.pop('success', "", data.msg);
			init();
		});
	}

	function init(){
		$scope.doctor = {};
		DoctorFactory.getAllDoctor(function(data){
			$scope.response = data;
		});

		SpecificationFactory.getAllSpecification(function(data){
			$scope.specifications = data;
		});

		BranchFactory.getAllBranch(function(data){
			$scope.branchs = data;
		});
	}
}

polymedic.Controllers.controller('DoctorCTRL', ['$scope','toaster','DoctorFactory','SpecificationFactory','BranchFactory',DoctorCTRL]);