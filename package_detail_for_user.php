<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="userassets/css/style.css" rel="stylesheet">
    <style>
        .card {
            max-width: 1000px;
            margin: 2vh
        }

        .card-top {
            padding: 0.7rem 5rem
        }

        .card-top a {
            float: left;
            margin-top: 0.7rem
        }

        #logo {
            font-family: 'Dancing Script';
            font-weight: bold;
            font-size: 1.6rem
        }

        .row {
            margin: 0
        }

        .icons {
            margin-left: auto
        }

        form span {
            color: rgb(179, 179, 179)
        }

        form {
            padding: 2vh 0
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247)
        }

        input:focus::-webkit-input-placeholder {
            color: transparent
        }

        .left {
            background-color: #ffffff;
            padding: 2vh
        }

        .left img {
            width: 2rem
        }

        .left .col-4 {
            padding-left: 0
        }

        #cvv {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575), rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }
    </style>
</head>
<?php
include('./connection.php');
include('./restrictuser.php');
?>
<?php
if (isset($_SESSION['user'])) {
    $set_id = $_SESSION['userid'];
    $sql = "select * from users where id='$set_id'";
    $res = mysqli_query($conn, $sql);

    $users = mysqli_fetch_array($res);

    $id = $users['id'];
    $fname = $users['fname'];
    $email = $users['email'];
    $regno = $users['regno'];
}
?>
<?php
if (isset($_GET['pckid'])) {
    $edit_id = $_GET['pckid'];
    $sql = "select * from package where id='$edit_id'";
    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {
        $i = 1;
        while ($row_pack = $res->fetch_assoc()) {
            $packid = $row_pack['id'];
            $trainer = $row_pack['trainer'];
            $plan = $row_pack['plan'];
            $duration = $row_pack['duration'];
            $amount = $row_pack['amount'];
            // $description = $row_pack['description'];
            // $status = $row_pack['status'];
        }
    }
}
?>



<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php">Gym Management</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#services">Our Services</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li><a class="nav-link scrollto" href="settings_user.php#profile">Profile</a></li>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else if (isset($_SESSION['employee'])) { ?>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a class="nav-link scrollto" href="login.php#login">Login</a></li>
                    <?php } ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->
    <?php
    $sqlpln = "select * from plan where plan_id='$plan'";
    $respln = mysqli_query($conn, $sqlpln);
    $rowpln = mysqli_fetch_array($respln);
    $planname = $rowpln['plan_name'];

    $sqltrainer = "select * from employee where emp_id='$trainer'";
    $restrainer = mysqli_query($conn, $sqltrainer);
    $rowtrainer = mysqli_fetch_array($restrainer);
    $trainername = $rowtrainer['emp_fname']
    ?>

    <div class="container" style="margin-top: 100px;">
        <br><br>

        <table class="table" style="width: 75%;">
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="trainer" class="form-label">Trainer Name</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="trainer" id="trainer" value="<?php echo $trainername; ?>" readonly></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="plan" class="form-label">Plan Name</label></td>

                <td><input type="text" class="form-control" style="border: none;" value="<?php echo $planname; ?>" name="plan" id="plan" readonly></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="duration" class="form-label">Duration</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="duration" id="duration" value="<?php echo $duration; ?>" readonly></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="amount" class="form-label">Amount</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="amount" id="amount" value="<?php echo $amount; ?>" readonly></td>
            </tr>
            <!-- <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="regfee" class="form-label">Registartion Fees</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="regfee" id="regfee" readonly></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="total" class="form-label">Total</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="total" id="total" readonly></td>
            </tr> -->
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="usremail" class="form-label">User</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="usremail" id="usremail" readonly value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="usrname" class="form-label">User name</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="usrname" id="usrname" readonly value="<?php echo $fname; ?>"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="usrid" class="form-label">User Id</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="usrid" id="usrid" readonly value="<?php echo $id; ?>"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;vertical-align: middle;"><label for="usrregno" class="form-label">User Reg no</label></td>
                <td><input type="text" class="form-control" style="border: none;" name="usrregno" id="usrregno" readonly value="<?php echo $regno; ?>"></td>
            </tr>
        </table>

        <!-- table for available -->
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="text-center" style="font-size: 25px; font-weight: bold;">Time Table</div>
            <div class="form-group">
                <table class="table table-bordered" id="dynamic_field">
                    <?php
                    $available = "SELECT * FROM available WHERE  package_id	='" . $_GET['pckid'] . "'";
                    $result_available = mysqli_query($conn, $available);
                    if ($result_available->num_rows > 0) {
                        $i = 1;
                        while ($row_available = $result_available->fetch_assoc()) {
                    ?>


                            <tr id="row<?php echo $i - 1; ?>">
                                <td>
                                    <label for="days" class="form-label">Day</label>
                                    <input name="days[]" id="days" readonly class="form-control" value="<?php echo $row_available['days']; ?>" />
                                </td>
                                <td>
                                    <label for="start_time[]" class="form-label">Start Time</label>
                                    <input name="start_time[]" readonly class="form-control start_time timepicker" placeholder="Select your time" value="<?php echo $row_available['start_time']; ?>" />
                                </td>
                                <td>
                                    <label for="end_time[]" class="form-label">End Time</label>
                                    <input name="end_time[]" readonly class="form-control end_time timepicker" placeholder="Select your time" value="<?php echo $row_available['end_time']; ?>" />
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </table>
            </div>
            <!-- end table for available -->

            <div class="card">
                <div class="card-top border-bottom text-center"><span style="color: black; font-weight: bold;" id="logo">Payment</span> </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="left border">
                                <div class="row">
                                    <div class="icons"> <img src="https://img.icons8.com/color/48/000000/visa.png" /> <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /> <img src="https://img.icons8.com/color/48/000000/maestro.png" /> </div>
                                </div>

                                <div class="row">
                                    <label for="cardname" class="form-label">Cardholder's name:</label>
                                    <input placeholder=" John Williams" name="cardname" id="cardname">
                                </div>
                                <div class="row">
                                    <label for="cardnumber" class="form-label">Card Number:</label>
                                    <input placeholder="0125 6780 4567 9909" maxlength="16" name="cardnumber" id="cardnumber">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exp" class="form-label">Expiry date:</label>
                                        <input placeholder="YY/MM" maxlength="5" name="exp" id="exp">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label">CVV:</label>
                                        <input id="cvv" maxlength="3" name="cvv">
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" class="btn btn-primary btn-block" value="Pay and reserve" name="submit">
                                    <a class="btn btn-success btn-block" href="index.php#services">Back</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br><br>

    </div>
    <br><br>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>2021</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by Laily
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="userassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="userassets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        .error {
            color: red;
        }
    </style>
</body>
<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                cardname: {
                    required: true
                },
                cardnumber: {
                    required: true,
                    rangelength: [16, 16],
                    number: true,
                },
                exp: {
                    required: true,
                },
                cvv: {
                    required: true,
                    rangelength: [3, 3],
                    number: true,
                },
            },
            messages: {
                cardname: 'Please enter card holder name.',
                cardnumber: {
                    required: 'Please enter card number.',
                    rangelength: 'Card number should be 16 digit number.'
                },
                exp: 'Please enter expire date.',
                cvv: {
                    required: 'Please enter CVV.',
                    rangelength: 'Cvv should be 3 digit number.'
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    jQuery.fn.ForceNumericOnly =
        function() {
            return this.each(function() {
                $(this).keydown(function(e) {
                    var key = e.charCode || e.keyCode || 0;
                    return (
                        key == 8 ||
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };
    $("#cardnumber").ForceNumericOnly();
    $("#cvv").ForceNumericOnly();
</script>


<?php
if (isset($_POST['submit'])) {

    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $cvv = $_POST['cvv'];
    $exp = $_POST['exp'];




    $sql = "insert into reservation (package_id,trainer_id,plan_name,duration,amount,user_id,card_holder_name,card_number,cvv,expire_date) values ('$packid','$trainer','$planname','$duration','$amount','$id','$cardname','$cardnumber','$cvv','$exp')";
    $result = mysqli_query($conn, $sql);
    $reservation_id = $conn->insert_id;

    foreach ($_POST['days'] as $key => $value) {
        $query1 = "INSERT INTO reservedtime(days,start_time,end_time,reservation_id)VALUES ('" . $_POST['days'][$key] . "','" . $_POST['start_time'][$key] . "' ,'" . $_POST['end_time'][$key] . "','" . $reservation_id . "')";
        $result1 = mysqli_query($conn, $query1);
    }
    if ($result1 == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Your payment has been accepted!",
                    icon: "success",
                  }).then(function() {
                    window.location = "index.php#services";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Payment Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

</html>