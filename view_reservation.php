<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
</head>
<?php
include('./restrict.php');
include('./header.php');
include('./links.php');
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
    <div class="container body">
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
                <a class="btn btn-success btn-block" href="reserved_user.php">Back</a>
            </div>
        </form>
    </div>
</body>


</html>