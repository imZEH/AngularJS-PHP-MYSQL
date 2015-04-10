'use strict';

var branchCTRL = function($scope ,toaster,BranchFactory){
	init();

	$scope.save = function(){
		if($scope.branch.b_name === undefined){
			toaster.pop('error', "", "Branch Name is Required.");
		}else{
			if($scope.branch.b_id === undefined){
				BranchFactory.saveBranch($scope.branch,function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}else{
				BranchFactory.updateBranch($scope.branch.b_id,$scope.branch, function(data){
					toaster.pop('success', "", data.msg);
					init();
				});
			}
		}
	}

	$scope.get = function(id){
		BranchFactory.getSpecificBranch(id, function(data){
			$scope.branch = data;
		});
	}

	$scope.delete = function(id){
		BranchFactory.deleteBranch(id,function(data){
			toaster.pop('success', "", data.msg);
			init();
		});
	}

	function init(){
		$scope.branch = {};
		BranchFactory.getAllBranch(function(data){
			$scope.response = data;

		});
	}
}

polymedic.Controllers.controller('branchCTRL', ['$scope','toaster','BranchFactory',branchCTRL]);