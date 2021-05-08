var app = angular.module('app',[]);

app.controller('AppCctrl',function($scope,$http){
	$scope.get_khach_hang = function(){
		if ($scope.tenkh !='') {
			$http.get('http://test.web500.vn/api/khach-hang.php?ten_kh='+$scope.tenkh)
			.then(function(res){
		      $scope.khs =res.data;
			});
		}
	}
	
	$scope.chon_kh = function(kh){
		$scope.kh_da_chon = kh;
		$scope.mkh = kh.ma_kh;
	}

	$scope.get_ncc = function(){
		console.log($scope.tenncc);
		if ($scope.tenncc !='') {
			$http.get('http://test.web500.vn/api/nha-cc.php?ten_ncc='+$scope.tenncc)
			.then(function(resncc){
		      $scope.nccs =resncc.data;
			});
		}
	}
	
	$scope.chon_ncc = function(ncc){
		$scope.ncc_da_chon = ncc;
		$scope.mncc = ncc.ma_ncc;
	}

	$scope.get_hh = function(){
		console.log($scope.tenhh);
		if ($scope.tenhh !='') {
			$http.get('http://test.web500.vn/api/hang-hoa.php?ten_hh='+$scope.tenhh)
			.then(function(reshh){
		      $scope.hhs =reshh.data;
			});
		}
	}
	
	

});
