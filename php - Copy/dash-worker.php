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
    <script>
        $(document).ready(function() {

            $("#btn4").click(function() {
                var cus_uid = $("#CitName").val();
                var wor_uid = $("#WorName").val();
                var actionUrl = "Rating-send-request.php?cus_uid=" + cus_uid + "&wor_uid=" + wor_uid;
                $.get(actionUrl, function(response) {
                    $("#rat").html(response);
                });
            });
        });

    </script>
</head>

<body style="background-image: url(../imges/admin%20background.jpg); background-size: cover; background-repeat: no-repeat;">
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
            <div class="col-md-4">
                <div class="card ml-3" style="border-color: darkgray; border-width: 3px; height:350px;">
                    <img src="../imges/profile.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="Profile-worker-front.php">
                            <center>
                                <h5 class="card-title">PROFILE</h5>
                            </center>
                            <p class="card-text">Worker can update profile here.</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ml-3" style="border-color: darkgray; border-width: 3px; height:350px;">
                    <img src="../imges/rate.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <center>
                            <h5 class="card-title">REQUEST RATE WORK</h5>
                        </center>
                        <p class="card-text"></p>
                        <input type="button" class="btn" style="background-color:#24498b; color: white; width:100%;" value="RATE" data-toggle="modal" data-target="#RateWork">
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card ml-3" style="border-color: darkgray; border-width: 3px; height:350px;">
                    <img src="../imges/workerserach.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="citizen-search-by-worker.php">
                            <center>
                                <h5 class="card-title">SEARCH WORK</h5>
                            </center>
                            <p class="card-text">Worker can search work here.</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="RateWork">
        <div class="modal-dialog" style="border:5px solid black; border-radius: 10px;">
            <div class="modal-content" style="background-image: url(../imges/OIP%20(1).jpg); margin-top:-1px;">
                <div class="modal-header mt-2 mr-1 ml-1" style="background-color:chocolate; border-radius: 0px; ">
                    <h5 class="modal-title">REQUEST RATING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="txtUid">Citizen Username</label>
                            <input type="text" class="form-control" id="CitName" name="txtName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="txtUid">Worker Username</label>
                            <input type="text" class="form-control" id="WorName" name="txtName" readonly value='<?php echo $_SESSION["activeuser"];?>'>
                        </div>



                    </div>
                    <div id="rat"></div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn4">RATE</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
