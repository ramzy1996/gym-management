<?php
include('./header.php');
include('./links.php');
include('./connection.php');

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        .circle-tile {
            margin-bottom: 15px;
            text-align: center;
        }

        .circle-tile-heading {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 100%;
            color: #FFFFFF;
            height: 80px;
            margin: 0 auto -40px;
            position: relative;
            transition: all 0.3s ease-in-out 0s;
            width: 80px;
        }

        .circle-tile-heading .fa {
            line-height: 80px;
        }

        .circle-tile-content {
            padding-top: 50px;
        }

        .circle-tile-number {
            font-size: 26px;
            font-weight: 700;
            line-height: 1;
            padding: 5px 0 15px;
        }

        .circle-tile-description {
            text-transform: uppercase;
        }

        .circle-tile-footer {
            background-color: rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.5);
            display: block;
            padding: 5px;
            transition: all 0.3s ease-in-out 0s;
        }

        .circle-tile-footer:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
        }

        .circle-tile-heading.dark-blue:hover {
            background-color: #2E4154;
        }

        .circle-tile-heading.green:hover {
            background-color: #138F77;
        }

        .circle-tile-heading.orange:hover {
            background-color: #DA8C10;
        }

        .circle-tile-heading.blue:hover {
            background-color: #2473A6;
        }

        .circle-tile-heading.red:hover {
            background-color: #CF4435;
        }

        .circle-tile-heading.purple:hover {
            background-color: #7F3D9B;
        }

        .tile-img {
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
        }

        .dark-blue {
            background-color: #34495E;
        }

        .green {
            background-color: #16A085;
        }

        .blue {
            background-color: #2980B9;
        }

        .orange {
            background-color: #F39C12;
        }

        .red {
            background-color: #E74C3C;
        }

        .purple {
            background-color: #8E44AD;
        }

        .dark-gray {
            background-color: #7F8C8D;
        }

        .gray {
            background-color: #95A5A6;
        }

        .light-gray {
            background-color: #BDC3C7;
        }

        .yellow {
            background-color: #F1C40F;
        }

        .text-dark-blue {
            color: #34495E;
        }

        .text-green {
            color: #16A085;
        }

        .text-blue {
            color: #2980B9;
        }

        .text-orange {
            color: #F39C12;
        }

        .text-red {
            color: #E74C3C;
        }

        .text-purple {
            color: #8E44AD;
        }

        .text-faded {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>

</head>

<body>
    <div class="container body">
        <div class="container bootstrap snippet">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="circle-tile ">
                        <a>
                            <div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div>
                        </a>
                        <div class="circle-tile-content dark-blue">
                            <div class="circle-tile-description text-faded"> Users</div>
                            <div class="circle-tile-number text-faded ">
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM users");
                                $rows = mysqli_num_rows($result);
                                echo $rows;
                                ?>
                            </div>
                            <a class="circle-tile-footer" href="user_view.php">More Info<i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="circle-tile ">
                        <a>
                            <div class="circle-tile-heading red"><i class="fa fa-users fa-fw fa-3x"></i></div>
                        </a>
                        <div class="circle-tile-content red">
                            <div class="circle-tile-description text-faded"> Trainers </div>
                            <div class="circle-tile-number text-faded ">
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM employee where emp_role='trainer'");
                                $rows = mysqli_num_rows($result);
                                echo $rows;
                                ?>
                            </div>
                            <a class="circle-tile-footer" href="employee_view.php">More Info<i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="circle-tile ">
                        <a>
                            <div class="circle-tile-heading green"><i class="fa fa-users fa-fw fa-3x"></i></div>
                        </a>
                        <div class="circle-tile-content green">
                            <div class="circle-tile-description text-faded"> Our Packages </div>
                            <div class="circle-tile-number text-faded ">
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM package");
                                $rows = mysqli_num_rows($result);
                                echo $rows;
                                ?>
                            </div>
                            <a class="circle-tile-footer" href="package_view.php">More Info<i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>