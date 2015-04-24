'use strict';
var homeCTRL = function($scope,$filter,DoctorFactory,SpecificationFactory,BranchFactory,loginFactory){
	init();

	function init(){
		$scope.doctors = {};
		$scope.query = {};
    	$scope.queryBy = '$';
    	$scope.currentPage = 1;
    	$scope.pageSize = 10;
    	
		DoctorFactory.getAllDoctor(function(data){
			$scope.doctors = data;
		});

		SpecificationFactory.getAllSpecification(function(data){
			$scope.specifications = data;
		});

		BranchFactory.getAllBranch(function(data){
			$scope.branchs = data;
		});
	}

	$scope.refesh = function(){
		$scope.doctorname = '';
		$scope.branch = '$';
		$scope.specification = '$';
		init();
	}

	$scope.logout=function(){
		loginFactory.logout();
	}


}

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}

polymedic.Controllers.controller('homeCTRL', ['$scope','$filter','DoctorFactory','SpecificationFactory','BranchFactory','loginFactory',homeCTRL]);