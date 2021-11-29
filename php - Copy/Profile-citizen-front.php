<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/cities.js"></script>


    <?php session_start();?>



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
    <script>
        $(document).ready(function() {
            print_state('State');
            $("#btnFetchProfile").click(function() {
                alert("cs");
                var uid = $("#inputUsrname").val();
                alert(uid);
                var url = "JSON-CITIZEN.php?userid=" + uid;
                alert(url);
                $.getJSON(url, function(jsonAryResponse) {
                    alert(JSON.stringify(jsonAryResponse));
                    if (jsonAryResponse.length == 0)
                        alert("invalid id");
                    else {
                        $("#inputCitName").val(jsonAryResponse[0].name);
                        $("#inputContactNumber4").val(jsonAryResponse[0].contact);
                        $("#inputEmail4").val(jsonAryResponse[0].email);
                        var pos = state_arr.indexOf(jsonAryResponse[0].state);
                        $("#State").val(jsonAryResponse[0].state);
                        print_city('inputCity', pos + 1);
                        $("#inputAddress").val(jsonAryResponse[0].address);
                        $("#inputCity").val(jsonAryResponse[0].city);
                        $("#State").val(jsonAryResponse[0].state);
                        $("#prev").attr("src", "uploads/" + jsonAryResponse[0].picname);
                        $("#hdn").val(jsonAryResponse[0].picname);

                    }
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
        <div>
            <b>
                <font style="font-size: 50px; color:white;">CITIZEN PROFILE</font>
            </b>
        </div>
    </nav>

    <div class="container">
        <div style="width=100%;height:100px;" class="mt-3">
            <center>
                <table border="2" style="50%;">
                    <tr style="100%; height:100%;">
                        <td style="100%;"> <img id="prev" src="../imges/user.jpg" alt="" class="img-fluid" width="100" height="100" style="border:1px black solid;"></td>
                    </tr>
                </table>
            </center>
        </div>
        <form style="margin-top:2%" action="Profile-citizen-process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="hdn" name="hdn">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputUsrname">Username</label>
                    <input type="text" class="form-control" id="inputUsrname" name="inputUsrname" readonly value='<?php echo $_SESSION["activeuser"];?>'>
                </div>
                <div class=" form-group col-md-6">
                    <label for="" style="color:white;">r</label>
                    <button type="button" class="btn btn-danger" style="width: 100%; height: 9;" id="btnFetchProfile">FETCH PROFILE</button></div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Citizen Name</label>
                    <input type="text" class="form-control" id="inputCitName" name="CitName">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contact Number</label>
                    <input type="text" class="form-control" id="inputContactNumber4" name="inputContactNumber4">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="inputEmail4">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Please Enter your address">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="State">State</label>
                    <select onchange="print_city('inputCity', this.selectedIndex); enable();" id="State" name="State" class="form-control"></select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <select class="form-control" id="inputCity" disabled name="inputCity"></select>
                </div>
            </div>
            <div class="form-group" style="width:100%;">
                <label for="inputEmail4">Select Your Profile Pic</label>

                <input type="file" class="form-control" id="inputProfilePic" name="inputProfilePic" onchange="showPreview(this);">
            </div>
            <div class="row">
                <div class="col-md-6 mb-4"><button type="submit" id="save" class="btn btn-primary" style="width:100%;" name="btn3" value="save">SAVE</button></div>
                <div class="col-md-6 mb-4"><button type="submit" id="update" class="btn btn-primary" style="width:100%;" name="btn3" value="update">UPDATE</button></div>
            </div>
        </form>
    </div>
</body>

</html>
