<!DOCTYPE html>
<html lang="en">
<?php
    include_once("SMS_OK_sms.php");
?>

<head>
    <meta charset="UTF-8">
    <title>ManPowerServices</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#btnPwd").click(function() {
                if ($("#eye").hasClass("fa fa-eye-slash")) {
                    $("#eye").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                    $("#txtPwd").attr("type", "text");
                } else {
                    $("#eye").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                    $("#txtPwd").attr("type", "password");
                }
                $("#txtName").focus();
                check = 0;

                $("#txtName").blur(function() {
                    //                alert();
                    var uid = $("#txtName").val();
                    var actionUrl = "CheckUid.php?ForgotPasswordName=" + uid;
                    $.get(actionUrl, function(response) {
                        //                    alert(response);
                        $("#USN").html(response);
                        if (response == "NOT VALID USERNAME") {
                            check = 0;
                        } else {
                            check = 1;
                        }


                    });
                });

                //=--=-=-=-=-===-=-=-



                $("#txtPwd").blur(function() {
                    var r = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;

                    var pwd = $("#txtPwd").val();

                    if (r.test(pwd) == false) {
                        check = 0;
                        $("#UPD").html("min-8,numerics,spl symbol,alph."); //.css("color","red");
                    } else {
                        $("#UPD").html("VALID PASSWORD");
                        check = 1;

                    }
                });
                //--==-===-====-
                $("#txtMob").blur(function() {
                    var r = /^[6-9]{1}[0-9]{9}$/;
                    var pwd = $("#txtMob").val();

                    if (r.test(pwd) == false) {
                        check = 0;
                        $("#UMN").html("INVALID MOBILE NUMBER"); //.css("color","red");
                    } else {
                        $("#UMN").html("VALID MOBILE NUMBER");
                        check = 1;

                    }

                });
            });
            $("#txtPwd").keydown(function() {
                var pwd = $(this).val();
                if (pwd.length <= 4)
                    $("#UPD").html("WEAK");
                else
                if (pwd.length > 4 && pwd.length <= 7)
                    $("#UPD").html("AVERAGE");
                else
                    $("#UPD").html("STRONG");

            });


        });
        //        $("#btnPwd").mouseup(function() {
        //            $("#errUid").removeClass("ok").addClass("not-ok");
        //            $("#txtPwd").attr("type", "password");
        //        });
        //        $("#btnPwd2").mousedown(function() {
        //            $("#LoginPassword").attr("type", "text");
        //        });
        //        $("#btnPwd2").mouseup(function() {
        //            $("#LoginPassword").attr("type", "password");
        //        });


        $("#btn").click(function() {
            //                if (check == 1) {
            var uid = $("#txtName").val();
            var password = $("#txtPwd").val();
            var mobile = $("#txtMob").val();
            if (worker.checked == true) {
                var category = worker.value;
                $("#UCG").html("*");
            }
            if (citizen.checked == true) {
                var category = citizen.value;
                $("#UCG").html("*");
            }
            if (worker.checked == false && citizen.checked == false) {
                $("#UCG").html("PLEASE SELECT YOUR CATEGORY");
                return;
            }
            //                    alert(mobile+" "+category);
            //                alert(category);
            var actionUrl = "signup-process.php?txtName=" + uid + "&txtPwd=" + password + "&txtMob=" + mobile + "&txtCat=" + category;
            $.get(actionUrl, function(response) {
                $("#signupStatus").html(response);
            });
            //                }
            //                else
            //                    {
            //                      $("#signupStatus").html("PLEASE FILL INFO CORRECTLY");  
            //                    }


        });

    </script>
    <script>
        $(document).ready(function() {

            $("#getOtp").click(function() {
                //                alert();
                var iid = this.value;
                if (iid == "GetOtp") {
                    frgtpsswrd = $("#ForgotPasswordName").val();
                    //                    alert(frgtpsswrd);
                    var actionUrl = "ForgotPassword.php?ForgotPasswordName=" + frgtpsswrd;
                    $.get(actionUrl, function(response) {
                        if (response == "NOT VALID USERNAME") {
                            $("#chngePasswordError").html(response);
                        } else {
                            //                            alert(response);
                            otp = response;
                            //                            alert(otp);
                            //                        
                            $("#getOtp").html("VERIFY");
                            //                                this.value="verify";
                            $("#getOtp").val("verify");
                            //                            alert(iid);

                        }
                    });
                } else {
                    if (iid == "verify") {

                        var Otp = $("#EnterOtp").val();
                        alert(Otp);
                        alert(otp);
                        if (otp == Otp) {
                            $("#getOtp").html("CHANGE PASSWORD");
                            $("#getOtp").val("ChngePassword");

                            $("#NwPsswrd").prop("hidden", false);
                            $("#ForgotPasswordName").prop("hidden", true);
                            $("#UsrNameee").prop("hidden", true);
                            $("#otp").prop("hidden", true);

                        } else {
                            $("#chngePasswordError").html("INCORRECT OTP");
                        }
                    } else {
                        var NewPassword = $("#NewPassword").val();
                        var actionUrl = "ChangePassword.php?Name=" + frgtpsswrd + "&Newpassword=" + NewPassword;
                        $.get(actionUrl, function(response) {
                            $("#chngePasswordError").html(response);
                        });

                    }
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $("#btnPwd2").click(function() {
                if ($("#eye2").hasClass("fa fa-eye-slash")) {
                    $("#eye2").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                    $("#LoginPassword").attr("type", "text");
                } else {
                    $("#eye2").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                    $("#LoginPassword").attr("type", "password");
                }
            });


            $("#loginBtn").click(function() {
                var lgnName = $("#LoginName").val();
                var lgnPsswrd = $("#LoginPassword").val();

                var actionUrl = "signIn-process.php?loginName=" + lgnName + "&loginPassword=" + lgnPsswrd;
                $.get(actionUrl, function(response) {
                    if (response == "Citizen")
                        location.href = "dash-citizen.php";

                    //                        $("#loginStatus").html(
                    else
                    if (response == "Worker")
                        location.href = "dash-worker.php";
                    else
                        $("#loginStatus").html(response);
                });
            });

        });

    </script>
    <!--
    <script>
        function showPreview(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#prev').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

        }

    </script>
-->
    <style>
        nav {
            position: fixed;

        }

        td {
            width: 50%;
        }

    </style>
</head>

<body style="background-image: url(../imges/admin%20background.jpg); background-size: cover; background-repeat: no-repeat;">
    <nav class="navbar navbar-dark" style="background-color: black;">
        <b>
            <a class="navbar-brand">

                <font style="font-size: 50px; color: aliceblue;"><img src="../imges/logo.jpg" width="50px" height="50px" alt="">&nbsp;mps.com</font>
            </a>
        </b>
        <div class="nav-item">
            <input type="submit" class="btn btn-secondary mt-1-2" value="SIGNUP" data-toggle="modal" data-target="#modalSignup">
            <input type="button" class="btn btn-secondary" value="LOGIN" data-toggle="modal" data-target="#modalLogin">
            <input type="button" class="btn btn-secondary" value="FORGOT PASSWORD" data-toggle="modal" data-target="#modalForgetPassword">

        </div>
    </nav>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../imges/plumber.jpg" class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
                <img src="../imges/electrician.jpg" class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
            <img src="../imges/construction.png" class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
                <img src="../imges/painting.jpg" class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
                <img src="../imges/fabrication.jpg" class="d-block w-100" alt="..." height="400">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div width="100%" style="background-color:black; height: 50px;">
        <center>
            <font style="font-size: 30px; color:white;">OUR SERVICES</font>
        </center>
    </div>
    <div class="container-fluid">
        <div class="row ml-5">
            <div class="col-md-3">
                <div class="card mt-4 mb-4" style=" padding: 2px;">
                    <img src="../imges/workerserach.jpg" height="200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">WORKER SERCHING</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mt-4 mb-4" style=" padding: 2px;">
                    <img src="../imges/getto%20work.jpg" height="200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">GET WORK</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mt-4 mb-4" style=" padding: 2px;">
                    <img src="../imges/workdone.jpg" height="200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">POST WORK</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <div class="card mt-4 mb-4" style=" padding: 2px;">
                    <img src="../imges/rate.jpg" class="card-img-top" height="200" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">RATE THE WORKER</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--
    <div width="100%" style="background-color:black; height: 20px;">

        <font style="color:white; margin-bottom:10px;">MEET THE DEVELOPER</font>

    </div>
-->
    <!--
    <div class="row">
        <div class="col-md-5 mr-1 ml-5 mb-2" style=" background-color:black;">
            <font style="color:white; font-size:20px;"><u>MEET THE DEVELOPER</u></font>
            <table border="0" style=" margin-left:2px; margin-top:20px;;  align-content:center;">
                <tr>
                    <td rowspan="4" style="width:30%"><img src="../imges/devimage.jpg" width="100%" height="80%" style="border-radius:50%;"></td>
                    <td style="color:white; padding-left:4px;">MOHNEESH BANSAL<br>THAPAR UNIVERSITY<br>BATHINDA,PUNJAB</td>

                </tr>
            </table>

        </div>
        <div class="col-md-5" style="background-color:black;">
            <font style="color:white; font-size:20px;"><u>REACH US</u></font>
            <table border="0" width="50%" height="40" style=" margin-left:2px; margin-top:20px;;  align-content:center;">
                <tr>
                    <td rowspan="4" style="width:30%"><img src="../imges/devimage.jpg" width="100%" height="80%" style="border-radius:50%;"></td>
                    <td style="color:white; padding-left:4px;">MOHNEESH BANSAL<br>THAPAR UNIVERSITY<br>BATHINDA,PUNJAB</td>

                </tr>
            </table>

        </div>
    </div>
-->
    <div class="row" style="background-color:black;">
        <div class="col-md-3 mb-3 ml-5 " style="color:white; margin-top:30px;">
            <div class="card" style=" background-color:black;text-align:center; border-right:2px solid white; padding:35.0px;">
                <h5 class="card-title" style="color:white;"><u>MEET THE DEVLEOPER</u></h5>
                <img src="../imges/devimage.jpg" class="card-img" height="200" width="150" alt="..." style="border-radius:50%;">
                <div class="card-body">
                    <p class="card-text" style="color:white; text-align:center;">MOHNEESH BANSAL<br>THAPAR UNIVERSITY<br>BATHINDA,PUNJAB</p>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3 mb-3" style="color:white;margin-top:30px;">
            <div class="card" style=" padding: 2px; background-color:black;text-align:center; border-right:2px dotted white; padding:35.0px;">
                <h5 class="card-title" style="color:white;"><u>MEET THE DEVLEOPER</u></h5>
                <img src="../imges/devimage.jpg" class="card-img-top" height="200" alt="..." style="border-radius:50%;">
                <div class="card-body">
                    <p class="card-text" style="color:white; text-align:center;">MOHNEESH BANSAL<br>THAPAR UNIVERSITY<br>BATHINDA,PUNJAB</p>
                </div>
            </div>
        </div> -->
        <div class="col-md-6" style="color:white; margin-top:30px;">
            <div class="card" style=" padding: 2px; background-color:black;text-align:center; height:420px;">
                <h5 class="card-title" style="color:white;"><u>REACH US</u></h5>
                <div class="card-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.8807337916096!2d74.95013941507348!3d30.211951281821662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1594744150585!5m2!1sen!2sin" width="600" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="card-img"></iframe>
                    <p class="card-text" style="color:white; text-align:center;">mohneeshbansal20@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" style="border:2px solid red; border-radius: 10px;">
            <div class="modal-content" style=" background-color:#f5f5f5;">
                <div class="modal-header" style="background-color:black; margin-top: -1px;">
                    <h5 class="modal-title" style="color:white;">ENTER DETAILS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group mt-n2">
                        <label for="txtUid">USERNAME</label>
                        <input type="text" class="form-control" id="txtName" name="txtName">
                        <span id="USN" class="form-text text-muted">*</span>
                    </div>
                    <div class="form-group mt-n2">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="txtPwd" name="txtPwd">
                        <button id="btnPwd" style="margin-top:3px; border-radius:3px; outline:none; background-color:black;float:right;">
                            <i class="fa fa-eye-slash" style="color:white;" id="eye"></i>

                        </button>
                        <span id="UPD" class="form-text text-muted">*</span>
                    </div>
                    <div class="form-group mt-n2">
                        <label for="txtMob">Mobile Number</label>
                        <input type="text" class="form-control" id="txtMob" name="txtMob">
                        <span id="UMN" class="form-text text-muted">*</span>
                    </div>
                    <div class="form-group mt-n2">
                        <input type="radio" name="category" id="worker" value="Worker" style="margin-left: 20px;" checked> WORKER
                        <input type="radio" name="category" id="citizen" value="Citizen" style="margin-left: 200px;"> CITIZEN

                    </div>
                    <div id="signupStatus"></div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btn">SUBMIT</button>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalLogin">
        <div class="modal-dialog" style="border:2px solid red; border-radius: 10px;">
            <div class="modal-content" style=" background-color:#f5f5f5;">
                <div class="modal-header" style="background-color:black; margin-top: -1px;">
                    <h5 class="modal-title" style="color:white;"><b>LOGIN</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="LoginName" name="LoginName">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="LoginPassword" name="LoginPassword">
                        <button id="btnPwd2" style="margin-top:3px; border-radius:3px; outline:none; background-color:black;float:right;">
                            <i class="fa fa-eye-slash" style="color:white;" id="eye2"></i>

                        </button>
                    </div>
                    <div id="loginStatus">*</div>


                    <div></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-dark" id="loginBtn">LOGIN</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalForgetPassword">
        <div class="modal-dialog" style="border:2px solid red; border-radius: 10px;">
            <div class="modal-content" style=" background-color:#f5f5f5;">
                <div class="modal-header" style="background-color:black; margin-top: -1px;">
                    <h5 class="modal-title" style="color:white;"><b>FORGOT PASSWORD</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label id="UsrNameee">USERNAME</label>
                            <input type="text" class="form-control" id="ForgotPasswordName" name="ForgotPasswordName">
                        </div>
                        <div class="form-group" id="otp">
                            <label>ENTER OTP</label>
                            <input type="text" class="form-control" id="EnterOtp" name="EnterOtp">
                        </div>
                        <div class="form-group" id="NwPsswrd" hidden>
                            <label>NEW PASSWORD</label>
                            <input type="text" class="form-control" id="NewPassword" name="NewPassword">
                        </div>
                        <div id="chngePasswordError"></div>

                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-dark" id="getOtp" value="GetOtp">GET OTP</button>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
