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
if (isset($_SESSION['employee'])) {
    $set_id = $_SESSION['empid'];
    $sql = "select * from employee where emp_id='$set_id'";
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($res);

    $id = $row['emp_id'];
    $fname = $row['emp_fname'];
}
?>
<?php
if (isset($_GET['editpck'])) {
    $edit_id = $_GET['editpck'];
    $sql = "select * from package where id='$edit_id'";
    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {
        $i = 1;
        while ($row_pack = $res->fetch_assoc()) {
            $trainer = $row_pack['trainer'];
            $plan = $row_pack['plan'];
            $duration = $row_pack['duration'];
            $amount = $row_pack['amount'];
            $description = $row_pack['description'];
            $status = $row_pack['status'];
        }
    }
}
?>



<body>
    <div class="container body">
        <h2 class="text-center">Add Package</h2>
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
                        <?php
                        $qrplan = "select * from plan where plan_id=$plan";
                        $resplan = mysqli_query($conn, $qrplan);
                        $rowplan = mysqli_fetch_array($resplan);
                        $planname = $rowplan['plan_name'] ?>
                        <input type="text" class="form-control" value="<?php echo $planname ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input name="duration" class="form-control" id="duration" readonly value="<?php if (isset($duration)) {
                                                                                                        echo $duration;
                                                                                                    } ?>" autocomplete="off" placeholder="Enter duration">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input class="form-control" id="amount" name="amount" readonly value="<?php if (isset($amount)) {
                                                                                                    echo $amount;
                                                                                                } ?>" autocomplete="off" placeholder="Enter amount" maxlength="10">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" value="<?php echo $status; ?>" readonly>
                    </div>
                </div>
            </div>


            <!-- table for available -->

            <div class="form-group">
                <table class="table table-bordered" id="dynamic_field">
                    <?php
                    $available = "SELECT * FROM available WHERE  package_id	='" . $_GET['editpck'] . "'";
                    $result_available = mysqli_query($conn, $available);
                    if ($result_available->num_rows > 0) {
                        $i = 1;
                        while ($row_available = $result_available->fetch_assoc()) {
                    ?>


                            <tr id="row<?php echo $i - 1; ?>">
                                <td>
                                    <label for="days" class="form-label">Day</label>
                                    <select name="days[]" class="form-control days" disabled>
                                        <option value="monday" <?php if ($row_available['days'] == 'monday') {
                                                                    echo "selected";
                                                                } ?>>Monday</option>
                                        <option value="tuesday" <?php if ($row_available['days'] == 'tuesday') {
                                                                    echo "selected";
                                                                } ?>>Tuesday</option>
                                        <option value="wednesday" <?php if ($row_available['days'] == 'wednesday') {
                                                                        echo "selected";
                                                                    } ?>>Wednesday</option>
                                        <option value="thursday" <?php if ($row_available['days'] == 'thursday') {
                                                                        echo "selected";
                                                                    } ?>>Thursday</option>
                                        <option value="friday" <?php if ($row_available['days'] == 'friday') {
                                                                    echo "selected";
                                                                } ?>>Friday</option>
                                        <option value="saturday" <?php if ($row_available['days'] == 'saturday') {
                                                                        echo "selected";
                                                                    } ?>>Saturday</option>
                                        <option value="sunday" <?php if ($row_available['days'] == 'sunday') {
                                                                    echo "selected";
                                                                } ?>>Sunday</option>
                                    </select>
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
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea readonly class="form-control" name="description" id="description" rows="4"><?php if (isset($description)) {
                                                                                                            echo $description;
                                                                                                        } ?></textarea>
            </div>
            <br><br>
            <div class="row">
                <a class="btn btn-success btn-block" href="package_view.php">Back</a>
            </div>
        </form>
    </div>




</body>


</html>