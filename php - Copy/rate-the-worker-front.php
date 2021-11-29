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
    <style>
        .hide {
            display: none;
        }

        label {
            font-size: 2rem;
        }

        .rating {
            direction: rtl;
        }

        .rating>label:hover::before,
        .rating>label:hover~label:before,
        .rating>input:checked~label:before {
            color: gold;
            content: "\2605";
            position: absolute;
        }

    </style>
    <script>
        <?php
        session_start();
        ?>
        var module = angular.module("ourmodule", []);
        module.controller("ourcontroller", function($scope, $http) {
            $scope.CitizenName = '<?php  echo $_SESSION["activeuser"];?>';
            $scope.jsonArraySelected;
            $(document).ready(function() {

                var uid = '<?php  echo $_SESSION["activeuser"];?>';
                $scope.doFetchWorkers = function() {
                    //                    alert(uid);
                    $http.get("Rating-process.php?cus_uid=" + uid).then(okFx, notOkFx);

                    function okFx(response) {
//                        alert(JSON.stringify(response.data));
                        $scope.jsonArraySelected = response.data;
                        //                        alert(JSON.stringify($scope.jsonArraySelected));
                        $("#columnBar").prop("hidden", false);

                    }

                    function notOkFx(response) {
                        alert(response.data); //shows error
                    }


                }
                $scope.doRating = function(rid, index, wor_id) {
//                    alert(rid + " " + index + " " + wor_id);
                    var ele = document.getElementsByName(rid);
                    for (i = 0; i < ele.length; i++) {
                        if (ele[i].checked) {
                            $scope.ratingsValue = ele[i].value;
//                            alert($scope.ratingsValue);

                            $http.get("citizen-updateRatings.php?username=" + wor_id + "&rating=" + $scope.ratingsValue + "&rid=" + rid).then(ok, notok);

                            function ok(response) {
                                //                                if (response.data == "ok") {
                                ////                                    $scope.ratingsInfo.splice(index, 1);
                                //                                    alert();
                                //                                }
//                                alert();
                                $scope.doFetchWorkers();
                            }

                            function notok(response) {

                            }
                        }
                    }


                }
            });


        });

    </script>
    <style>
        .wid {
            width: 30%;
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
            <input type="text" ng-model="CitizenName" readonly>
            &nbsp;
            <input type="button" class="btn" value="FETCH RATING REQUESTS" style="background-color:gold;" ng-click="doFetchWorkers();">&nbsp;
        </div>
    </nav>

    <center>
        <div class="container mt-5" style="width:100%;margin-left:13%;">
            <center>
                <table style="align-content: center; text-align: center;" class="table table-striped">
                    <thead>
                        <tr style="height: 20px;" id="columnBar" hidden>
                            <th style="color: red;" class="wid" scope="col">WORKER UID</th>
                            <th style="color: red;"scope="col">RATE</th>
                            <th style="color: red;" scope="col">POST</th>
                        </tr>
                    </thead>
                    <tr style="height: 20px;" ng-repeat="obj in jsonArraySelected">
                        <td style="font-weight: 400;">{{obj.wor_uid}}</td>
                        <td>
                            <div class="rating">
                                <input type="radio" name={{obj.rid}} class="hide" id="star5-{{obj.rid}}" value="5"><label for="star5-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star4-{{obj.rid}}" value="4"><label for="star4-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star3-{{obj.rid}}" value="3"><label for="star3-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star2-{{obj.rid}}" value="2"><label for="star2-{{obj.rid}}">&#9734;</label>
                                <input type="radio" name={{obj.rid}} class="hide" id="star1-{{obj.rid}}" value="1"><label for="star1-{{obj.rid}}">&#9734;</label>
                            </div>
                        </td>
                        <td style="padding: 1px;"><input type="button" value="POST RATING" class="btn btn-dark" style="width: 100%; height: 100%;" ng-click="doRating(obj.rid,$index,obj.wor_uid);"> </td>
                    </tr>
                </table>
            </center>
        </div>
    </center>
</body>

</html>
