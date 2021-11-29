<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>-->
    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
    <script>
        var module = angular.module("ourmodule", []);
        module.controller("ourcontroller", function($scope, $http) {
            $(document).ready(function() {
                $("#CatAdmin").change(function() {
                    //                    alert(this.value);
                    if (this.value == "CS") {
                        alert("PLEASE SELECT CATEGORY");
                    } else {
                        if (this.value == "workers") {
                            $http.get("JSON-ADMIN.php?category=" + this.value).then(okFx, notOkFx);

                            function okFx(response) {
                                $scope.jsonArraySelected = response.data;
                                $("#columnBar").prop("hidden", false);



                            }

                            function notOkFx(response) {
                                alert(response.data); //shows error
                            }



                        } else {

                            $http.get("JSON-ADMIN.php?category=" + this.value).then(okFx, notOkFx);

                            function okFx(response) {
                                $scope.jsonArraySelected = response.data;
                                $("#columnBar").prop("hidden", false);

                            }

                            function notOkFx(response) {
                                alert(response.data); //shows error
                            }

                        }
                    }

                });
            });
            $scope.doAction = function(uid, action, index) {
                var cat = $("#CatAdmin").val();
                $http.get("JSON-ADMIN-ACTION.php?user-uid=" + uid + "&action=" + action + "&category" + cat).then(okFx, notOkFx);
                alert();

                function okFx(response) {
                    //                alert($("#CatAdmin").val());
                    if (action == "block") {
                        alert("BLOCKED");
                    }
                    if (action == "resume") {
                        alert("RESUMED");
                    }
                    if (action == "delete") {
                        alert(cat);
                        //                      $scope.jsonArraySelected.splice(index,1);  
                    }
                }

                function notOkFx(response) {
                    alert(response.data); //shows error
                }
            }
        });

    </script>
    <style>
        .list1 {
            width: 200px;
            height: 30px;
            font-weight: 500;
            margin-left: 40px;
            border-radius: 3.0px;
            outline: none;

        }

    </style>
</head>

<body style="background-image: url(../imges/admin%20background.jpg); background-size: cover; background-repeat: no-repeat;" ng-app="ourmodule" ng-controller="ourcontroller">
    <nav class="navbar navbar-dark" style="background-color: black;">
        <b>
            <a class="navbar-brand">

                <font style="font-size: 50px; color: aliceblue;"><img src="../imges/logo.jpg" width="50" height="50" alt="">&nbsp;mps.com</font>
            </a>
        </b>
        <div class="nav-item">
            <select id="CatAdmin" class="list1">
                <option selected value="CS">CHOOSE CATEGORY</option>
                <option value="citizens">CITIZENS</option>
                <option value="workers">WORKER</option>
            </select></div>

    </nav>

    <center>
        <div class="container mt-5" style="margin-left:13%;">
            <center>
                <table class="table table-striped" width="100%" style="align-content: center; text-align: center;">
                    <thead>
                        <tr id="columnBar" hidden>
                            <th style="color: red;" scope="col">UID</th>
                            <th style="color: red;" scope="col">NAME</th>
                            <th style="color: red;" scope="col">CONTACT</th>
                            <th style="color: red;" scope="col">E-MAIL</th>
                            <th style="color: red;" scope="col">BLOCK USER</th>
                            <th style="color: red;" scope="col">RESUME USER</th>
                            <th style="color: red;" scope="col">DELETE USER</th>
                        </tr>
                    </thead>
                    <tr style="height: 20px;" ng-repeat="obj in jsonArraySelected">
                        <td style="font-weight: 400;" id="uiD" value="{{obj.uid}}">{{obj.uid}}</td>
                        <td>{{obj.name}}</td>
                        <td>{{obj.contact}}</td>
                        <td>{{obj.email}}</td>
                        <td><input type="button" value="BLOCK" class="btn btn-dark" style="width: 100%; height: 100%;" ng-click="doAction(obj.uid,'block',$index);"> </td>
                        <td><input type="button" value="RESUME" class="btn btn-dark" style="width: 100%; height: 100%;" ng-click="doAction(obj.uid,'resume',$index);"></td>
                        <td><input type="button" value="DELETE" class="btn btn-dark" style="width: 100%; height: 100%;" ng-click="doAction(obj.uid,'delete',$index);"></td>
                    </tr>
                </table>
            </center>
        </div>
    </center>
</body>

</html>
