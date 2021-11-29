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

                $http.get("JSON-SEARCH-CAT.php").then(okFx, notOkFx);
                $http.get("JSON-SEARCH-CIT.php").then(oFx, notFx);

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
                $http.get("JSON-SEARCH-SELECTED.php?category=" + $scope.selObject.category + "&city=" + $scope.selObject1.city).then(okFx, notOkFx);

                function okFx(response) {
                    $scope.jsonArraySelected = response.data;
                    //                     alert(JSON.stringify(response.data));
                    $("#columnBar").prop("hidden", false);
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }

            }
            $scope.doShowDetails = function(cus_uid) {
                //                alert("JSON-SHOW-DETAILS.php?uid=" + cus_uid);
                $http.get("JSON-SHOW-DETAILS.php?cus_uid=" + cus_uid).then(okFx, notOkFx);

                function okFx(response) {
                    $scope.jsonArrayShowDetails = response.data;
                    //                    alert(JSON.stringify($scope.jsonArrayShowDetails));
                }

                function notOkFx(response) {
                    alert(response.data);
                }
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


            <div class="btn" ng-click="doFetchSelected();" style="background-color: gold;">FIND WORK</div>
        </div>

    </nav>
    <div class="container">
        <table width="100%" class="table table-striped" style="margin-top: 15px; text-align: center;">
            <thead>
                <tr style="height: 20px;" hidden id="columnBar" name="columnBar">
                    <th style="width: 20px;" scope="col">SERIAL NUMBER</th>
                    <th style="width: 150px;" scope="col">LOCATION,CITY</th>
                    <th style="width: 150px;" scope="col">PROBLEM</th>
                    <th style="width: 50px;" scope="col">CONTACT</th>

                </tr>
            </thead>
            <tr style="height: 20px;" ng-repeat="obj in jsonArraySelected">
                <td style="font-weight: 400;">{{$index+1}}</td>
                <td>{{obj.location}},{{obj.city}}</td>
                <td>{{obj.problem}}</td>
                <td><input type="button" value="GET CONTACT DETAILS" class="btn btn-danger" style="width: 100%; height: 100%;" ng-click="doShowDetails(obj.cus_uid);" data-toggle="modal" data-target="#ShowCitizenInfo"></td>
            </tr>
        </table>

    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="ShowCitizenInfo" style="transition-delay:0.2s">
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
                            <th style="width: 50%; color:cornflowerblue;" ; colspan="2">PROFILE PIC</th>

                        </tr>

                        <tr style="height: 20px; text-align: center;">
                            <th style="width: 100%" ; height="400px;" colspan="2"><img src="uploads/{{jsonArrayShowDetails[0].picname}}" style="width: inherit; height: inherit;" alt=""></th>

                        </tr>
                        <tr style="height: 20px; text-align: center;">
                            <th style="width: 50%" ;>NAME</th>
                            <td style="width: 50%; color: red;">{{jsonArrayShowDetails[0].name}}</td>
                        </tr>
                        <tr style="height: 20px; text-align: center;">
                            <th style="width: 50%" ;>CONTACT</th>
                            <td style="width: 50%; color: red;">{{jsonArrayShowDetails[0].contact}}</td>
                        </tr>

                        <tr style="height: 20px; text-align: center;">
                            <th style="width: 50%" ;>CITY</th>
                            <td style="width: 50%; color: red;">{{jsonArrayShowDetails[0].city}}</td>
                        </tr>
                        <tr style="height: 20px; text-align: center;">
                            <th style="width: 50%" ;>STATE</th>
                            <td style="width: 50%; color: red;">{{jsonArrayShowDetails[0].state}}</td>
                        </tr>


                    </table>

                </div>
            </div>
        </div>
    </div>


</body>

</html>
