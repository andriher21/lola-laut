<!doctype html>
<html lang="en" ng-app="myApp">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		
		<title>Regio Teknologi Indonesia</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/angular.min.js"></script>
		
		<style>
			body {
				padding-top: 4.5rem;
			}
		</style>
	</head>
	
	<body ng-controller="myCon">
		<nav class="navbar navbar-expand-lg bg-light fixed-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="logo.png" alt="" width="60" height="30">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarNav">
					<a class="btn btn-light" href="dashboard" role="button">Home</a>
					<a class="btn btn-light" href="material" role="button">Material</a>
				</div>
			</div>
		</nav>
		
		<div class="container-fluid">
			<div class="row align-items-start">
				<div class="col col-sm-2">
					<div class="list-group">
						<a href="dashboard" class="list-group-item list-group-item-action list-group-item-primary">Dashboard</a>
						<a href="record" class="list-group-item list-group-item-action list-group-item-primary">Transaction</a>
					</div>
					
					<br>
					
					<div class="list-group">
						<a href="customer" class="list-group-item list-group-item-action list-group-item-warning">Customer</a>
						<a href="vehicle" class="list-group-item list-group-item-action list-group-item-warning">Vehicle</a>
						<a href="material" class="list-group-item list-group-item-action list-group-item-warning">Material</a>
					</div>
					
					<br>
					
					<div class="list-group">
						<a href="clientid" class="list-group-item list-group-item-action list-group-item-info">Client ID</a>
					</div>
					
					<br>
					
					<div class="list-group">
						<a href="logoff" class="list-group-item list-group-item-action list-group-item-secondary">Logoff</a>
					</div>
					
				</div>
				<div class="col">
					<div class="card border-success" ng-if="tab==1">
						<h5 class="card-header">Material ID: NEW</h5>
						<div class="card-body">
							<div class="row">
								<div class="col"></div>
								<div class="col-6">
									<div class="mb-3 row">
										<label for="materialname" class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="materialname" ng-model="row.materialname">
										</div>
									</div>
									<div class="mb-3 row">
										<label for="materialdesc" class="col-sm-2 col-form-label">Description</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="materialdesc" ng-model="row.materialdesc">
										</div>
									</div>	
									<div class="mb-3 row">
										<div class="col-sm-2"></div>
										<div class="col-sm-10">
											<button type="submit" class="btn btn-success" ng-click="insertrow()">Create</button>
											<button type="submit" class="btn btn-secondary" ng-click="clearrow()">Cancel</button>
										</div>
									</div>
								</div>
								<div class="col"></div>
							</div>
						</div>
					</div>					
					<br ng-if="tab==1">
					
					<div class="card border-warning" ng-if="tab==2">
						<h5 class="card-header">Material ID: {{row.materialid}}</h5>
						<div class="card-body">
							<div class="row">
								<div class="col"></div>
								<div class="col-6">
									<div class="mb-3 row">
										<label for="materialname" class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="materialname" ng-model="row.materialname">
										</div>
									</div>
									<div class="mb-3 row">
										<label for="materialdesc" class="col-sm-2 col-form-label">Description</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="materialdesc" ng-model="row.materialdesc">
										</div>
									</div>	
									<div class="mb-3 row">
										<div class="col-sm-2"></div>
										<div class="col-sm-10">
											<button type="submit" class="btn btn-warning" ng-click="updaterow(row.materialid)">Update</button>
											<button type="submit" class="btn btn-danger" ng-click="deleterow(row.materialid)">Delete</button>
											<button type="submit" class="btn btn-secondary" ng-click="clearrow()">Close</button>
										</div>
									</div>
								</div>
								<div class="col"></div>
							</div>
						</div>
					</div>					
					<br ng-if="tab==2">
					
					<div class="card border-primary">
						<h5 class="card-header">Material Index</h5>
						<div class="card-body">
							<button type="button" class="btn btn-primary btn-sm" ng-click="selecttab(1)">New</button>
							<table class="table">
								<thead>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Description</th>
									<th scope="col">Command</th>
								</thead>
								<tbody>
									<tr ng-repeat="x in table">
										<td>{{ x.materialid }}</td>
										<td>{{ x.materialname }}</td>
										<td>{{ x.materialdesc }}</td>
										<td>
											<button type="button" class="btn btn-outline-primary btn-sm" ng-click="loadrow(x.materialid)">Info</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="card-footer text-end">
							<small class="text-muted">Showing {{ table.length }} records</small>
						</div>
					</div>
					
					<hr>
					<p class="text-muted">PT Regio Teknologi &copy; 2015–2022</p>
				</div>
			</div>
		</div>
		
		<script>
			var myApp = angular.module('myApp', []);
			myApp.controller('myCon', ($scope, $http) => {
				$scope.tab = 0;
				$scope.table = [];
				$scope.row = {};
				
				$scope.selecttab = function ($tab) {
					$scope.tab = $tab;
				}
				
				$scope.loadtable = function () {
					$http({
                        method: 'GET',
                        url: 'api/material',
                        //data: $.param(formData),
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
							$scope.table = res.data;
                        },
                        function(err) {
                        }
                    );
				}
				$scope.loadtable();
				
				$scope.insertrow = function () {
					var formData = {};
					formData.name = $scope.row.materialname;
					formData.desc = $scope.row.materialdesc;
					
					$http({
                        method: 'POST',
                        url: 'api/material',
						data: $.param(formData),
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
							$scope.tab = 0;
							$scope.row = {};
							$scope.loadtable();
                        },
                        function(err) {
                        }
                    );
				}
				
				$scope.loadrow = function (id) {
					$http({
                        method: 'GET',
                        url: 'api/material/' + id,
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
							console.log(res);
							$scope.row = res.data;
							$scope.tab = 2;
                        },
                        function(err) {
                        }
                    );
				}
				
				$scope.clearrow = function () {
					$scope.tab = 0;
					$scope.row = {};
				}
				
				$scope.updaterow = function (id) {
					var formData = {};
					formData.name = $scope.row.materialname;
					formData.desc = $scope.row.materialdesc;
					
					$http({
                        method: 'PATCH',
                        url: 'api/material/' + id,
						data: $.param(formData),
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
							$scope.tab = 0;
							$scope.row = {};
							$scope.loadtable();
                        },
                        function(err) {
                        }
                    );
				}
				
				$scope.deleterow = function (id) {
					$http({
                        method: 'DELETE',
                        url: 'api/material/' + id,
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
							$scope.tab = 0;
							$scope.row = {};
							$scope.loadtable();
                        },
                        function(err) {
                        }
                    );
				}
			});
		</script>
	</body>
</html>
