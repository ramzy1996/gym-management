<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="userassets/css/style.css" rel="stylesheet">
</head>
<?php
include('./restrictuser.php');
// include('./links.php');
include('./connection.php')
?>

<?php
if (isset($_GET['editres'])) {
    $edit_id = $_GET['editres'];
    $sql = "select * from reservation where id='$edit_id'";
    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {
        $i = 1;
        while ($row_pack = $res->fetch_assoc()) {
            $trainer = $row_pack['trainer_id'];
            $plan = $row_pack['plan_name'];
            $duration = $row_pack['duration'];
            $amount = $row_pack['amount'];
            $user = $row_pack['user_id'];
            $cardname = $row_pack['card_holder_name'];
            $cardnumber = $row_pack['card_number'];
            $cvv = $row_pack['cvv'];
            $exp = $row_pack['expire_date'];


            // user
            $sqlusr = "select * from users where id='$user'";
            $resusr = mysqli_query($conn, $sqlusr);
            $rowusr = mysqli_fetch_array($resusr);
            $usrname = $rowusr['fname'];
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
    <div class="container" style="margin-top: 100px;">
        <h2 class="text-center">View Reservation</h2>
        <br><br>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="trainer" class="form-label">Trainer</label>
                        <?php $sqltrainer = "select * from employee where emp_id='$trainer'";
                        $restrainer = mysqli_query($conn, $sqltrainer);
                        $rowtrainer = mysqli_fetch_array($restrainer);
                        $trainername = $rowtrainer['emp_fname'] ?>
                        <input type="text" class="form-control" value="<?php echo $trainername; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="plan" class="form-label">Plan Name</label>
                        <input type="text" class="form-control" value="<?php echo $plan ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input name="duration" class="form-control" id="duration" readonly value="<?php echo $duration; ?>" autocomplete="off" placeholder="Enter duration">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input class="form-control" id="amount" name="amount" readonly value="<?php echo $amount; ?>" autocomplete="off" placeholder="Enter amount" maxlength="10">
                    </div>
                </div>
            </div>


            <!-- table for available -->

            <div class="form-group">
                <table class="table table-bordered" id="dynamic_field">
                    <?php
                    $available = "SELECT * FROM reservedtime WHERE  reservation_id='$edit_id'";
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
                                    <input name="start_time[]" readonly class="form-control" value="<?php echo $row_available['start_time']; ?>" />
                                </td>
                                <td>
                                    <label for="end_time[]" class="form-label">End Time</label>
                                    <input name="end_time[]" readonly class="form-control" value="<?php echo $row_available['end_time']; ?>" />
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
            <br><br>
            <div class="row">
                <a class="btn btn-success btn-block" href="settings_user.php#profile">Back</a>
            </div>
        </form>
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

</body>


</html>