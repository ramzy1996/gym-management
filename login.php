<?php
session_start();
include('./links.php');
include('./connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

    <div style="margin-top: 80px;">
        <section id="login" class="services">
            <div class="container">

                <div class="login-form">
                    <form id="form" action="" method="post">
                        <h2 class="text-center">Sign in</h2>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </span>
                                </div>
                                <input type="email" class="form-control" name="user_email" placeholder="Enter your email." required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="user_password" placeholder="Enter your password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login-btn" class="btn btn-primary login-btn btn-block">Sign in</button>
                        </div>
                    </form>
                    <p class="text-center text-muted small">Don't have an account? <a href="user_add.php">Sign up here!</a></p>
                </div>
                <div>
                    Adminusername = admin@gmail.com , pass= 12345678
                    <br>
                    Trainerusername = trainer@gmail.com, pass= 12345678
                    <br>
                    Userusername = user@gmail.com, pass= 12345678

                </div>

            </div>
        </section><!-- End Services Section -->
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
</body>

<?php
if (isset($_POST['login-btn'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    $sql = "select * from users where email='$user_email'";
    $sql1 = "select * from employee where emp_email='$user_email'";

    $res = mysqli_query($conn, $sql);
    $res1 = mysqli_query($conn, $sql1);


    // users login
    $users = mysqli_fetch_array($res);


    // employee login

    $employee = mysqli_fetch_array($res1);


    if ($users) {
        $id = $users['id'];
        $email = $users['email'];
        $fname = $users['fname'];
        $image = $users['image'];
        $password = $users['password'];
        if ($user_email == $email && $user_password == $password) {
            $_SESSION['userid'] = $id;
            $_SESSION['user'] = $email;

            if ($_GET['continue']) {
                echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "' . $_GET['continue'] . '";
                });
            });
            </script>';
            } else {
                echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "index.php";
                });
            });
            </script>';
            }
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Email or password wrong!",
                    icon: "error",
                  });
            });
            </script>';
        }
    } else if ($employee) {
        $idEmp = $employee['emp_id'];
        $emailEmp = $employee['emp_email'];
        $fnameEmp = $employee['emp_fname'];
        $imageEmp = $employee['emp_image'];
        $roleEmp = $employee['emp_role'];
        $passwordEmp = $employee['emp_password'];
        if ($user_email == $emailEmp && $user_password == $passwordEmp) {
            $_SESSION['empid'] = $idEmp;
            $_SESSION['employee'] = $emailEmp;
            $_SESSION['role'] = $roleEmp;

            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Login!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "dashboard.php";
                });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Email or password wrong!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
}
?>

</html>