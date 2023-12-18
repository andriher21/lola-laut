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
					<a class="btn btn-light" href="record" role="button">Record</a>
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
					<div class="card border-warning" ng-if="tab==2">
						<h5 class="card-header">Record ID: {{row.recordid}}</h5>
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="mb-3 row">
										<label for="dtcreate" class="col-sm-3 col-form-label">Server Date</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="dtcreate" ng-model="row.recordcreate" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="cname" class="col-sm-3 col-form-label">Customer</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="cname" ng-model="row.recordcname" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="caddr" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="caddr" ng-model="row.recordcaddr" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="vnumb" class="col-sm-3 col-form-label">Vehicle</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="vnumb" ng-model="row.recordvnumb" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="vtype" class="col-sm-3 col-form-label">Type</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="vtype" ng-model="row.recordvtype" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="mname" class="col-sm-3 col-form-label">Material</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="mname" ng-model="row.recordmname" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="mdesc" class="col-sm-3 col-form-label">Description</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="mdesc" ng-model="row.recordmdesc" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-danger" ng-click="deleterow(row.recordid)">Delete</button>
											<button type="submit" class="btn btn-secondary" ng-click="clearrow()">Close</button>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="mb-3 row">
										<label for="dtin" class="col-sm-3 col-form-label">Date In</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="dtin" ng-model="row.recorddtin" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="dout" class="col-sm-3 col-form-label">Date Out</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="dout" ng-model="row.recorddtout" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="win" class="col-sm-3 col-form-label">Weight In</label>
										<div class="col-sm-9">
											<input type="text" class="form-control text-end" id="win" ng-model="row.recordwin" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="wout" class="col-sm-3 col-form-label">Weight Out</label>
										<div class="col-sm-9">
											<input type="text" class="form-control text-end" id="wout" ng-model="row.recordwout" readonly>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="nett" class="col-sm-3 col-form-label">Nett</label>
										<div class="col-sm-9">
											<input type="text" class="form-control text-end" id="nett" ng-model="row.recordnett" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<br ng-if="tab==2">
					
					<div class="card border-primary">
						<h5 class="card-header">Record Index</h5>
						<div class="card-body">
							<table class="table">
								<thead>
									<th scope="col">#</th>
									<th scope="col">Date</th>
									<th scope="col">Customer</th>
									<th scope="col">Vehicle</th>
									<th scope="col">Material</th>
									<th scope="col">Weight</th>
									<th scope="col">Command</th>
								</thead>
								<tbody>
									<tr ng-repeat="x in table">
										<td>{{ x.recordid }}</td>
										<td>{{ x.recordcreate }}</td>
										<td>{{ x.recordcname }}</td>
										<td>{{ x.recordvnumb }}</td>
										<td>{{ x.recordmname }}</td>
										<td class="text-end">{{ x.recordnett }}</td>
										<td>
											<button type="button" class="btn btn-outline-primary btn-sm" ng-click="loadrow(x.recordid)">Info</button>
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
                        url: 'api/record',
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
				
				$scope.loadrow = function (id) {
					$http({
                        method: 'GET',
                        url: 'api/record/' + id,
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        function(res) {
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
				
				$scope.deleterow = function (id) {
					$http({
                        method: 'DELETE',
                        url: 'api/record/' + id,
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
