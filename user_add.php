<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="userassets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<?php
include('./connection.php');
include('./links.php');

if (isset($_SESSION['employee'])) {
    include('./header.php');
    include('./links.php');
}
?>

<body>
    <?php if (!isset($_SESSION['employee'])) { ?>
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
    <?php } ?>
    <div class="container <?php if (isset($_SESSION['employee'])) {
                                echo "body";
                            } else echo ""; ?>" style="margin-top: 100px;" id="login">
        <h2 class="text-center">Register Here</h2>
        <br><br>
        <div class="text-center">
            <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="uploads/Default.png">
        </div>
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="regno" class="form-label">Reg-No</label>
                        <input name="regno" class="form-control" id="regno" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" accept=".png,.jpg,.jpeg,.gif,.tif" style="border:0px!important;" onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input name="fname" class="form-control" id="fname" autocomplete="off" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input class="form-control" id="lname" name="lname" autocomplete="off" placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" autocomplete="off" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input class="form-control" id="mobile" name="mobile" autocomplete="off" placeholder="Enter mobile number" maxlength="10">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Enter confirm password">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-success btn-block" href="user_view.php">Back</a>
                </div>
            </div>
            <br><br>
        </form>
    </div>
    <?php if (!isset($_SESSION['employee'])) { ?>
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
        <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

        <!-- Template Main JS File -->
        <script src="userassets/js/main.js"></script>

    <?php } ?>


</body>

<style>
    .error {
        color: red;
    }
</style>
<script>
    var currentdate = new Date();
    var datetime = currentdate.getDate() + "" +
        currentdate.getMinutes() + "" +
        currentdate.getSeconds();

    var x = Math.floor((Math.random() * 100) + 1);
    document.getElementById("regno").value = "GMS#" + datetime + "" + x;
</script>
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
                    rangelength: [10, 12],
                    number: true,
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
                fname: 'Please enter first name.',
                email: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                },
                mobile: {
                    required: 'Please enter mobile number.',
                    rangelength: 'Mobile number should be 10 digit number.'
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

</html>

<?php
if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $password = $_POST['password'];
    $regno = $_POST['regno'];

    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));
    if ($check_email > 0) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Email already exists!",
                    icon: "error",
                  });
            });
            </script>';
    } else {
        $sql = "insert into users (regno,fname,lname,email,mobile,password,image) values ('$regno','$fname','$lname','$email','$mobile','$password','$image')";
        $result = mysqli_query($conn, $sql);
        if ($result == true) {
            move_uploaded_file($tmp_name, "uploads/$image");
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Registration success!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "user_view.php";
                });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Registration Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
}
?>