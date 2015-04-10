'use strict';

var BranchFactory = function($http){
	var BranchFactory = {};

	BranchFactory.saveBranch = function(data,cb){
		$http.post('php/classes/insertBranch',data).success(function(data){
			cb(data);
		}).error(function(err){
			cb(err);
		});
	};

	BranchFactory.updateBranch = function(id, branch,cb){
		$http.post('php/classes/updateBranch', {b_id:id, branch:branch}).success(function(data){
			cb(data);
		}).error(function(err){
			console.log('Error ...',err);
		});
	};

	BranchFactory.getSpecificBranch = function(id,cb){
		$http.get('php/classes/branch?b_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			cb(err);
		});
	};

	BranchFactory.getAllBranch = function(cb){
		$http.get('php/classes/branchs').success(function(data){
			cb(data);
		}).error(function(err){
			cb(err);
		});
	};

	BranchFactory.deleteBranch = function(id,cb){
		$http.delete('php/classes/deleteBranch?b_id='+id).success(function(data){
			cb(data);
		}).error(function(err){
			cb(err);
		});
	};

	return BranchFactory;
}
polymedic.Services.factory('BranchFactory',['$http' ,BranchFactory]);

