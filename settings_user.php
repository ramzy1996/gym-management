<?php
include('./links.php');
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
    $lname = $users['lname'];
    $email = $users['email'];
    $image = $users['image'];
    $password = $users['password'];
    $mobile = $users['mobile'];
    $regno = $users['regno'];
}


?>

<?php
if (isset($_SESSION['user'])) {
    $setuser_id = $_SESSION['userid'];
    $sqlusr = "select * from users where id='$setuser_id'";
    $resusr = mysqli_query($conn, $sqlusr);

    $rowusr = mysqli_fetch_array($resusr);

    $usrid = $rowusr['id'];
    $usrfname = $rowusr['fname'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <style>
        .avatar-xl img {
            width: 110px;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .text-muted {
            font-weight: 300;
        }



        ::-webkit-file-upload-button {
            cursor: pointer;
        }

        input[type=file] {
            cursor: pointer;
        }
    </style>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="userassets/css/style.css" rel="stylesheet">
</head>

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
    <input value="<?php echo $password ?>" id="Oldpassword" style="display: none;">
    <div class="container" style="margin-top: 100px;" id="profile">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <h2 class="h3 mb-4 page-title mt-3">Profile</h2>
                <div class="my-4">
                    <form id="form" method="post" enctype="multipart/form-data">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-5">
                                <label for="image" style="cursor:pointer" class="avatar avatar-xl">
                                    <?php if (empty($image)) : ?>
                                        <img id="profilePicture" style="height: 100px; width: 100px;" class="avatar-img rounded-circle" src="uploads/Default.png">
                                    <?php else : ?>
                                        <img id="profilePicture" style="height: 100px; width: 100px;" class="avatar-img rounded-circle" src="uploads/<?php echo $image ?>">
                                    <?php endif ?>
                                </label>
                                <input type="file" id="image" name="image" style="display: none" accept=".png,.jpg,.jpeg,.gif,.tif" onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-md-5 mb-5 align-items-center">
                                <h4 class="mb-1">Hi, <b><?php echo $fname ?></b></h4>
                                <br>
                                <h6>Your registration number is <b><?php echo $regno ?></b></h6>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input name="fname" class="form-control" id="fname" autocomplete="off" value="<?php echo $fname ?>" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo $lname ?>" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" autocomplete="off" value="<?php echo $email ?>" placeholder="Enter email address">
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input class="form-control" id="mobile" name="mobile" autocomplete="off" value="<?php echo $mobile ?>" placeholder="Enter mobile number" maxlength="10">
                        </div>

                        <hr class="my-4" />
                        <button type="submit" name="submit" class="btn btn-primary">Save Change</button>
                    </form>
                    <br><br>
                    <form id="formPass" method="post" enctype="multipart/form-data">
                        <h2>Change Password</h2>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter old password">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="c_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="c_password" class="form-control" id="password" placeholder="Enter confirm password">
                                </div>
                            </div>


                        </div>
                        <hr class="my-4" />
                        <button type="submit" name="submitPass" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br>

        <h2 class="text-center">Your Packages</h2>
        <hr>

        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-8 add_flex">
                            <div class="form-group searchInput">
                                <label for="search">Search:</label>
                                <input type="search" name="search" class="form-control" id="filterbox" placeholder=" ">
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x">
                        <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Trainer</th>
                                    <th>Plan Name</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($_SESSION['user']) {
                                    $sql = "select * from reservation where user_id='$usrid'";
                                }
                                $res = mysqli_query($conn, $sql);


                                while ($row = mysqli_fetch_array($res)) {

                                    $id = $row['id'];
                                    $trainer = $row['trainer_id'];
                                    $plan = $row['plan_name'];
                                    $duration = $row['duration'];
                                    $amount = $row['amount'];
                                    $user = $row['user_id'];


                                    // user
                                    $sqlusr = "select * from users where id='$user'";
                                    $resusr = mysqli_query($conn, $sqlusr);
                                    $rowusr = mysqli_fetch_array($resusr);
                                    $usrname = $rowusr['fname'];

                                    // trainer
                                    $sqltrainer = "select * from employee where emp_id='$trainer'";
                                    $restrainer = mysqli_query($conn, $sqltrainer);
                                    $rowtrainer = mysqli_fetch_array($restrainer);
                                    $trainername = $rowtrainer['emp_fname'];

                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $trainername ?></td>
                                        <td><?php echo $plan ?></td>
                                        <td><?php echo $duration ?></td>
                                        <td><?php echo $amount ?></td>
                                        <td>
                                            <a href="view_reservation_user.php?editres=<?php echo $id; ?>" class="btn btn-primary"><i class="fas fa-book-open"></i>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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



    <script>
        $(document).ready(function() {
            var dataTable = $('#filtertable').DataTable({
                "pageLength": 6,
                aoColumnDefs: [{
                    "aTargets": [5],
                    "bSortable": false
                }],
                "dom": '<"top">ct<"top"p><"clear">'
            });
            $("#filterbox").keyup(function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>
    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    fname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        rangelength: [10, 10],
                        number: true,
                    },
                },
                messages: {
                    name: 'Please enter first name.',
                    email: {
                        required: 'Please enter Email Address.',
                        email: 'Please enter a valid Email Address.',
                    },
                    mobile: {
                        required: 'Please enter mobile number.',
                        rangelength: 'Mobile number should be 10 digit number.'
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $(document).ready(function() {
            $('#formPass').validate({
                rules: {
                    old_password: {
                        required: true,
                        equalTo: "#Oldpassword"
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    c_password: {
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    old_password: {
                        required: 'Please enter Confirm Password.',
                        equalTo: 'Old Password do not match with Password.',
                    },
                    password: {
                        required: 'Please enter Password.',
                        minlength: 'Password must be at least 8 characters long.',
                    },
                    c_password: {
                        required: 'Please enter Confirm Password.',
                        equalTo: 'Confirm Password do not match with Password.',
                    }
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
        $("#mobile").ForceNumericOnly();
    </script>
    <?php
    if (isset($_POST['submit'])) {
        $e_fname = $_POST['fname'];
        $e_lname = $_POST['lname'];
        $e_email = $_POST['email'];
        $e_mobile = $_POST['mobile'];
        $e_image = $_FILES['image']['name'];
        $e_tmp_name = $_FILES['image']['tmp_name'];
        if (empty($e_image)) {
            $e_image = $image;
        }

        $query = "update users set fname='$e_fname',lname='$e_lname',email='$e_email',mobile='$e_mobile',image='$e_image' where id='$set_id'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($result == true) {
            move_uploaded_file($e_tmp_name, "uploads/$e_image");
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Updated successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Updated Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
    if (isset($_POST['submitPass'])) {
        $e_password = $_POST['password'];


        $sql = "update users set password='$e_password' where id='$set_id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == true) {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Password updated successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Update Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
    ?>
</body>

</html>