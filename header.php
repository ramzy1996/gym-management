<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="title icon" href="~/images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">

</head>
<?php
include('./restrict.php');
include('./connection.php');
?>
<?php

$url_array =  explode('/', $_SERVER['REQUEST_URI']);
$url = end($url_array);
?>
<?php
if (isset($_SESSION['employee'])) {
    $set_id = $_SESSION['empid'];
    $sql = "select * from employee where emp_id='$set_id'";
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($res);

    $id = $row['emp_id'];
    $fname = $row['emp_fname'];
    $lname = $row['emp_lname'];
    $email = $row['emp_email'];
    $image = $row['emp_image'];
    $role = $row['emp_role'];
    $mobile = $row['emp_mobile'];
}


?>

<body>
    <!--wrapper start-->
    <div class="wrapper">
        <!--header satrt-->
        <div class="header">
            <div class="header-menu">
                <div class="title">Gym <span>Management</span></div>
                <div class="sidebar-btn">
                </div>
                <ul>
                    <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
        <!--header end-->

        <!--sidebar start-->
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="text-center profile">
                    <?php if ($image) : ?>
                        <img src="uploads/<?php echo $image ?>">
                    <?php else : ?>
                        <img src="uploads/Default.png">
                    <?php endif ?>
                    <div class="text-muted">
                        <?php echo $fname; ?>
                    </div>
                    <div class="text-primary" style="user-select:none;">(<?php echo $role ?>)</div>
                </li>

                <li class="item">
                    <a class="menu-btn <?php if ($url == 'dashboard.php') {
                                            echo "current";
                                        } ?>" href="dashboard.php"><i class="fas fa-home mar"></i><span>Dashboard</span></a>
                </li>

                <?php if ($role == 'admin') { ?>
                    <li class="item">
                        <a class="menu-btn <?php if ($url == 'user_view.php' || $url == 'user_add.php' || isset($_GET['edit']) || isset($_GET['del'])) {
                                                echo "current";
                                            } ?>" href="user_view.php"><i class="fas fa-user mar"></i> <span>Users</span></a>
                    </li>


                    <li class="item">
                        <a class="menu-btn <?php if ($url == 'employee_view.php' || $url == 'employee_add.php' || isset($_GET['delemp']) || isset($_GET['editemp'])) {
                                                echo "current";
                                            } ?>" href="employee_view.php"><i class="fas fa-cart-plus mar"></i><span>Employees</span></a>
                    </li>

                    <li class="item">
                        <a class="menu-btn <?php if ($url == 'plan_view.php' || isset($_GET['planid'])) {
                                                echo "current";
                                            } ?>" href="plan_view.php"><i class="fas fa-people-carry mar"></i><span>Plan</span></a>
                    </li>
                <?php } ?>


                <li class="item">
                    <a href="package_view.php" class="menu-btn <?php if ($url == 'package_add.php' || $url == 'package_view.php' || isset($_GET['editpck']) || isset($_GET['pckgid'])) {
                                                                    echo "current";
                                                                } ?>"><i class="far fa-file-alt mar"></i><span>Packages</span></a>
                </li>

                <li class="item">
                    <a href="reserved_user.php" class="menu-btn <?php if ($url == 'reserved_user.php' || isset($_GET['rsvid']) || isset($_GET['editres'])) {
                                                                    echo "current";
                                                                } ?>"><i class="far fa-file-alt mar"></i><span>Reservation</span></a>
                </li>

                <li class="item" style="padding-bottom: 50px">
                    <a href="settings.php" class="menu-btn <?php if ($url == 'settings.php') {
                                                                echo "current";
                                                            } ?>"><i class="fas fa-cog  mar"></i><span>Settings</span></a>
                </li>
            </ul>
        </div>
        <!--sidebar end-->

    </div>
</body>

</html>