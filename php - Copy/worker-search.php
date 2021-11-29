<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
    <script>
        var module = angular.module("ourmodule", []);
        module.controller("ourcontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.jsonArraySelected;
            $scope.doFetchAll = function() {

                $http.get("JSON-FETCH-ALL-CAT.php").then(okFx, notOkFx);
                $http.get("JSON-FETCH-ALL-CIT.php").then(oFx, notFx);

                function okFx(response) {
                    $scope.jsonArray = response.data;
                    $scope.selObject = $scope.jsonArray[0];
                }

                function notOkFx(response) {
                    alert(response.data);

                }

                function oFx(response) {
                    $scope.jsonArray1 = response.data;
                    $scope.selObject1 = $scope.jsonArray1[0];
                }

                function notFx(response) {
                    alert(response.data);
                }

            }
            $scope.doFetchSelected = function() {
                
                $http.get("JSON-FETCH-SELECTED.php?category=" + $scope.selObject.category + "&city=" + $scope.selObject1.city).then(okFx, notOkFx);

                function okFx(response) {
                    $scope.jsonArraySelected = response.data;
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }

            }
            $scope.doShowDetails = function(index) {

                $scope.jsonArraySelectedDetail = $scope.jsonArraySelected[index];

            }
        });

    </script>
</head>

<body style="background-image: url(../imges/admin%20background.jpg); background-size: cover; background-repeat: no-repeat;" ng-app="ourmodule" ng-controller="ourcontroller" ng-init="doFetchAll();">
    <nav class="navbar navbar-dark" style="background-color: black;">
        <b>
            <a class="navbar-brand">

                <font style="font-size: 50px; color: aliceblue;"><img src="../imges/logo.jpg" width="50" height="50" alt="">&nbsp;mps.com</font>
            </a>
        </b>
        <div class="nav-item">
            <font style="color: white;">CATEGORY</font>
            <select ng-model="selObject" ng-options="obj.category for obj in jsonArray" style="width:200px; margin-top:10px; margin-bottom: 10px; border-radius: 5px; margin-right: 2px;"></select>

            <font style="color: white;">CITY</font>
            <select ng-model="selObject1" ng-options="obj.city for obj in jsonArray1" style="width:200px; margin-top:10px; margin-bottom: 10px; border-radius: 5px;margin-right: 2px;"></select>


            <div class="btn" ng-click="doFetchSelected();" style="background-color: gold;">SEARCH WORKER</div>
        </div>
        

    </nav>
        <div class="container">
        <div class="row" style="margin-top: auto;">
            <div class="col-md-4" ng-repeat="obj in jsonArraySelected">
                <div class="card mt-4" style="border:2px solid gold; padding:2px;">
                    <img src="uploads/{{obj.picname}}" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$index+1}})<u id="wrkerUsrnme"> {{obj.uid}}</u></h5>
                        <p class="card-text">Experience-{{obj.exp}}</p>
                        <p class="card-text">Rating-{{obj.total/obj.count}}</p>
                        <p class="card-text">Specialization-{{obj.spl}} </p>
                        <div class="btn btn-primary" data-toggle="modal" data-target="#ShowWorkerInfo" ng-click="doShowDetails($index);">More Info..</div>
                        <div class="modal fade" tabindex="-1" role="dialog" id="ShowWorkerInfo">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:gold;">
                                        <h5 class="modal-title"><b>ABOUT WORKER</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="align-content: center;">
                                        <table width="100%" border="2" rules="all">
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%" ;>NAME</th>
                                                <td style="width: 50%; color: red;">{{jsonArraySelectedDetail.name}}</td>
                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%" ;>SHOPNAME</th>
                                                <td style="width: 50%; color: red;">{{jsonArraySelectedDetail.shopname}}</td>
                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%" ;>EMAIL</th>
                                                <td style="width: 50%; color: red;">{{jsonArraySelectedDetail.email}}</td>
                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%" ;>CITY</th>
                                                <td style="width: 50%; color: red;">{{jsonArraySelectedDetail.city}}</td>
                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%" ;>STATE</th>
                                                <td style="width: 50%; color: red;">{{jsonArraySelectedDetail.state}}</td>
                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 50%; color:cornflowerblue;" ; colspan="2">AADHAR CARD</th>

                                            </tr>
                                            <tr style="height: 20px; text-align: center;">
                                                <th style="width: 100%" ; height="400px;" colspan="2"><img src="uploads/{{jsonArraySelectedDetail.aadharpic}}" style="width: inherit; height: inherit;" alt=""></th>

                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
