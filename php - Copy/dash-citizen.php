<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if(isset($_SESSION["activeuser"])==false)
    {
        header("location:index.php");
    }
?>

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
    <script src="../js/cities.js"></script>
    <script>
        $(document).ready(function() {
            print_state('State');
            $("#btn4").click(function() {
                var cus_uid = $("#txtName").val();
                var category = $("#inputCategory").val();
                var problem = $("#YrPblm").val();
                var location = $("#lctn").val();
                var city = $("#inputCity").val();
                var state = $("#State").val();
//                alert(location);
                var actionUrl = "PostWork-process.php?cus_uid=" + cus_uid + "&category=" + category + "&problem=" + problem + "&location=" + location + "&city=" + city + "&state=" + state;
                $.get(actionUrl, function(response) {
                    $("#pstwrk").html(response);
                });
            });
        });
        var module = angular.module("ourmodule", []);
        module.controller("ourcontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.doFetchRequest = function() {
                $(document).ready(function() {
                    $("#columnBar").prop("hidden", false);

                });
                $http.get("JSON-FETCH-REQUIREMENTS.php?cus_uid=" + $("#cusId").val()).then(okFn, notFn);

                function okFn(response) {
                    $scope.jsonArray = response.data;
                    JSON.stringify(response.data);
                }

                function notFn(response) {
                    alert(response.data);

                }


            }
            $scope.doDelete = function(rid) {
//                alert(rid);
                $http.get("Delete-record.php?rid=" + rid).then(okFn, notOk);

                function okFn(response) {
                    $scope.doFetchRequest();
                    //                 $scope.jsonArray.splice(index,1);

                }

                function notOk(response) {
                    alert(response.data);

                }


            }

        });

    </script>
</head>

<body style="background-image: url(../imges/admin%20background.jpg); background-size: cover; background-repeat: no-repeat;" ng-app="ourmodule" ng-controller="ourcontroller">
    <nav class="navbar navbar-dark" style="background-color: black;">
        <b>
            <a class="navbar-brand">

                <font style="font-size: 50px; color: aliceblue;"><img src="../imges/logo.jpg" width="50" height="50" alt="">&nbsp;mps.com</font>
            </a>
        </b>
        <div class="nav-item">
            <a href="logout.php">
                <div class="btn btn-dark" value="LOGOUT">LOGOUT</div>
            </a>
        </div>
    </nav>
    <div style="height:60px; width:100%; background-color: gold; font-weight:500; font-size: 40px;">
        <marquee direction="right">Welcome:<?php echo $_SESSION["activeuser"];?></marquee>
    </div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 ml-n1">
                <div class="card" style=" width: 100%;height: 350PX;border-color: darkgray; border-width: 3px;">
                    <img src="../imges/profile.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="Profile-citizen-front.php">
                            <center>
                                <h5 class="card-title">PROFILE</h5>
                            </center>
                            <p class="card-text">Citizen can update profile here.</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ml-n3" style=" width: 100%;height: 350PX;border-color: darkgray; border-width: 3px;">
                    <img src="../imges/work.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <center>
                            <h5 class="card-title">POST WORK</h5>
                        </center>
                        <p class="card-text"></p>
                        <input type="button" class="btn" style="background-color:#24498b; color: white; width:100%;" value="POST HERE" data-toggle="modal" data-target="#PostWork">
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style=" width: 100%;height: 350PX;border-color: darkgray; border-width: 3px;">
                    <img src="../imges/ratework.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <center>
                            <h5 class="card-title">RATE WORK</h5>
                        </center>
                        <p class="card-text"></p>
                        <a href="rate-the-worker-front.php"> <input type="button" class="btn" style="background-color:#24498b; color: white; width:100%;" value="RATE">
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 mb-4">
                <div class="card" style=" width: 100%; height: 350PX; border-color: darkgray; border-width: 3px; margin-left:40%;">
                    <div class="card-body" style="padding-top: 30px;">
                        <h5><b>
                                <font style="font-size: 30px;color: dimgray;"><a href="" data-toggle="modal" data-target="#RqstMngr">REQUEST MANAGER</a></font>
                            </b></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" style=" width: 100%; height: 350PX; border-color: darkgray; border-width: 3px; margin-left:40%;">
                    <div class="card-body" style="padding-top: 30px;">
                        <h5><b>
                                <font style="font-size: 30px;color: dimgray;"><a href="worker-search.php">SEARCH WORKER</a></font>
                            </b></h5>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="PostWork">
        <div class="modal-dialog" style="border:5px solid black; border-radius: 10px;">
            <div class="modal-content">
                <div class="modal-header mt-2 mr-1 ml-1" style="background-color:chocolate; border-radius: 0px; margin-top: -1px; ">
                    <h5 class="modal-title">POST REQUIREMENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtUid">Username</label>
                            <input type="text" class="form-control" id="txtName" name="txtName" disabled value="<?php echo $_SESSION["activeuser"];?>">
                            <span id="USN" class="form-text text-muted">*</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Category</label>
                            <select id="inputCategory" name="inputCategory" class="form-control">
                                <option>Carpenter</option>
                                <option>Appliance Services/Repair</option>
                                <option>Cleaning</option>
                                <option>Car Cleaning</option>
                                <option>Carpet cleaning</option>
                                <option>Pest Control</option>
                                <option>Sofa Cleaning</option>
                                <option>Water tank Cleaning</option>
                                <option>Electrician</option>
                                <option>Mason</option>
                                <option>Painters</option>
                                <option>Plumber</option>
                                <option>Tiler</option>
                                <option>Other</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-n2">
                        <label for="w3review">What is your problem?</label>

                        <textarea id="YrPblm" name="YrPblm" rows="3" cols="60" placeholder="TYPE YOUR PROBLEM HERE" style="border-radius: 3px;">
                        </textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="txtUid">Location</label>
                            <input type="text" class="form-control" id="lctn" name="lctn" placeholder="LOCATION OF TASK">
                            <span id="USN" class="form-text text-muted">*</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="State">State</label>
                            <select onchange="print_city('inputCity', this.selectedIndex); enable();" id="State" name="State" class="form-control"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">City</label>
                            <select id="inputCity" name="inputCity" class="form-control" readonly>
                            </select>
                        </div>
                    </div>
                    <div id="pstwrk"></div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn4">POST</button>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="RqstMngr">
        <div class="modal-dialog" style="border:5px solid black; border-radius: 10px;">
            <div class="modal-content" style="width: 600px;">
                <div class="modal-header" style="background-color:cornflowerblue; margin-top: -1px;">
                    <h5 class="modal-title"><b>ABOUT WORKER</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top: 5%;">
                    <input type="text" style="width: 100%;" id="cusId" value='<?php echo $_SESSION["activeuser"];?>'>
                    <input type="button" class="btn btn-primary" style="width: 100%; height: 30px; margin-top: 5%; align-content: center; text-align: center; " value="FETCH REQUEST" ng-click="doFetchRequest();">

                    <table width="100%" style="margin-top: 15px; text-align: center;" class="table table-striped">
                        <thead>
                            <tr style="height: 20px;" id="columnBar" hidden>
                                <th style="width: 60px;" scope="col">CATEGORY</th>
                                <th style="width: 150px;" scope="col">LOCATION,CITY,STATE</th>
                                <th style="width: 150px;" scope="col">PROBLEM</th>
                                <th style="width: 50px;" scope="col">DELETE</th>
                            </tr>
                        </thead>
                        <tr style="height: 20px;" ng-repeat="obj in jsonArray">
                            <td>{{obj.category}}</td>
                            <td>{{obj.location}},{{obj.city}},{{obj.state}}</td>
                            <td>{{obj.problem}}</td>
                            <td><input type="button" value="delete" class="btn btn-secondary" style="width: 100%; height: 100%;" ng-click="doDelete(obj.rid);"></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
