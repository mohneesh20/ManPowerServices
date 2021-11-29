<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.8.2.min.js"></script>
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
            print_state("State");
            $("#btnFetchProfile").click(function() {
                var uid = $("#inputUsrname").val();
                var url = "JSON-WORKER.php?inputUsrname=" + uid;
                $.getJSON(url, function(jsonAryResponse) {
                    alert(JSON.stringify(jsonAryResponse));
                    if (jsonAryResponse.length == 0)
                        alert("invalid id");
                    else {
                        $("#CitName").val(jsonAryResponse[0].name);
                        $("#inputContactNumber4").val(jsonAryResponse[0].contact);
                        $("#inputEmail4").val(jsonAryResponse[0].email);
                        $("#inputAddress").val(jsonAryResponse[0].address);
                        var pos = state_arr.indexOf(jsonAryResponse[0].state);
                        $("#State").val(jsonAryResponse[0].state);
                        print_city('inputCity', pos + 1);
                        $("#inputCity").val(jsonAryResponse[0].city);
                        $("#State").val(jsonAryResponse[0].state);
                        $("#inputShopName").val(jsonAryResponse[0].shopname);
                        $("#inputExp").val(jsonAryResponse[0].exp);
                        $("#inputSpl").val(jsonAryResponse[0].spl);
                        $("#inputCategory").val(jsonAryResponse[0].category);
                        $("#prev").attr("src", "uploads/" + jsonAryResponse[0].picname);
                        $("#prev2").attr("src", "uploads/" + jsonAryResponse[0].aadharpic);
                        $("#hdn").val(jsonAryResponse[0].picname);
                        $("#hdn2").val(jsonAryResponse[0].aadharpic);

                    }
                });
            });
        });

    </script>
    <script>
        function showpreview(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#prev2').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

        }

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
                <font style="font-size: 50px; color:white;">WORKER PROFILE</font>
            </b>
        </div>
    </nav>
    <div class="container">
        <div style="width=100%;height:100px;" class="mt-3">
            <center>
                <table border="0" cellpadding="5" style="50%;">
                    <tr style="100%; height:100%;">
                        <td style="100%;"> <img id="prev" src="../imges/user.jpg" alt="" class="img-fluid" width="100" height="100" style="border:1px black solid;">
                        </td>
                        <td style="100%;"> <img id="prev2" src="../imges/user.jpg" alt="" class="img-fluid" width="100" height="100" style="border:1px black solid;">
                        </td>
                    </tr>
                    <tr>
                        <td><span widht="100" height="100">PROFILE PIC</span></td>
                        <td><span widht="100" height="100">AADHAR PIC</span></td>
                    </tr>
                </table>
            </center>
        </div>
        <form style="margin-top:2%;" action="Profile-worker-process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="hdn" name="hdn">
            <input type="hidden" id="hdn2" name="hdn2">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputUsrname">Username</label>
                    <input type="text" class="form-control" id="inputUsrname" name="inputUsrname" readonly value='<?php echo $_SESSION["activeuser"];?>'>
                </div>
                <button type="button" class="btn btn-danger" style="width: 30%; height: 10%; margin-top: 2.75%; margin-left: 3.0%;" id="btnFetchProfile">FETCH PROFILE</button>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Select Your Profile Pic</label>

                    <input type="file" class="form-control" id="inputProfilePic" name="inputProfilePic" onchange="showPreview(this);">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Worker Name</label>
                    <input type="text" class="form-control" id="CitName" name="CitName">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Shop Name</label>
                    <input type="text" class="form-control" id="inputShopName" name="inputShopName">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4"><b>
                            <font style="color:crimson;">UPLOAD YOUR AADHAR CARD</font>
                        </b></label>

                    <input type="file" class="form-control" id="inputAadharPic" name="inputAadharPic" onchange="showpreview(this);">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputPassword4">Contact Number</label>
                    <input type="text" class="form-control" id="inputContactNumber4" name="inputContactNumber4">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="inputEmail4">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Experience</label>
                    <select id="inputExp" name="inputExp" class="form-control">
                        <option selected>1 year</option>
                        <option>2 year</option>
                        <option>3 year</option>
                        <option>4 year</option>
                        <option>5 year</option>
                        <option>6 year</option>
                        <option>7 year</option>
                        <option>8 year</option>
                        <option>9 year</option>
                        <option>10 year</option>
                        <option>Above 10 year</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Please Enter your address">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <select type="text" class="form-control" readonly id="inputCity" name="inputCity"></select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputState">State</label>
                    <select onchange="print_city('inputCity', this.selectedIndex); enable();" id="State" name="State" class="form-control">
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">Category</label>
                    <select id="inputCategory" name="inputCategory" class="form-control">
                        <option>Carpenter</option>
                        <option>Appliance Services/Repair</option>
                        <!--
                            AC Service & Repair
                            • Chimney Servicing & repair
                            • Geyser Service & repair
                            • Refrigerator Repair
                            • TV Repair
                            • Washing Machine Service & repair
                            • Water Purifier Repair
-->


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
                <div class="form-group col-md-6">
                    <label for="inputCity">Specialization</label>
                    <input type="text" class="form-control" id="inputSpl" name="inputSpl">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4"><button type="submit" id="save" class="btn btn-primary" style="width:100%;" name="btn3" value="save">SAVE</button></div>
                <div class="col-md-6 mb-4"><button type="submit" id="update" class="btn btn-primary" style="width:100%;" name="btn3" value="update">UPDATE</button></div>
            </div>
        </form>
    </div>
</body>

</html>
