<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/timepicker/mdtimepicker.css">
    <title>Add Packages</title>
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

<body>
    <div class="container body">
        <h2 class="text-center">Add Package</h2>
        <br><br>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="trainer" class="form-label">Trainer</label>
                        <select name="trainer" class="form-control" id="trainer">
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <option selected disabled>--Trainer--</option>
                                <?php
                                $qrtrainer = "select * from employee where emp_role='trainer'";
                                $restrainer = mysqli_query($conn, $qrtrainer);
                                while ($rowtrainer = mysqli_fetch_array($restrainer)) { ?>
                                    <option value="<?php echo $rowtrainer['emp_id'] ?>"><?php echo $rowtrainer['emp_fname'] ?></option>
                                <?php } ?>
                            <?php } else if ($_SESSION['role'] == 'trainer') { ?>
                                <option value="<?php echo $id ?>" selected><?php echo $fname ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="plan" class="form-label">Plan Name</label>
                        <select name="plan" class="form-control" id="plan">
                            <option selected disabled>--Plan Name--</option>
                            <?php
                            $qrplan = "select * from plan";
                            $resplan = mysqli_query($conn, $qrplan);
                            while ($rowplan = mysqli_fetch_array($resplan)) { ?>
                                <option value="<?php echo $rowplan['plan_id'] ?>"><?php echo $rowplan['plan_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="plan_image" id="plan_image">

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input name="duration" class="form-control" id="duration" autocomplete="off" placeholder="Enter duration">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input class="form-control" id="amount" name="amount" autocomplete="off" placeholder="Enter amount" maxlength="10">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option selected disabled>--Status--</option>
                            <option value="available">Available</option>
                            <option value="unavailable">UnAvailable</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- table for available -->

            <div class="form-group">
                <label>Add Available Time</label>
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td>
                            <label for="days" class="form-label">Day</label>
                            <select name="days[]" class="form-control days">
                                <option selected disabled>--select day--</option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </td>
                        <td>
                            <label for="start_time[]" class="form-label">Start Time</label>
                            <input name="start_time[]" class="form-control start_time timepicker" placeholder="Select your time" />
                        </td>
                        <td>
                            <label for="end_time[]" class="form-label">End Time</label>
                            <input name="end_time[]" class="form-control end_time timepicker" placeholder="Select your time" />
                        </td>

                        <td>
                            <label class="form-label">Add Row</label>
                            <button type="button" name="add" id="add" class="btn btn-success form-control"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                </table>
            </div>




            <!-- end table for available -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>
            <br><br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-success btn-block" href="package_view.php">Back</a>
                </div>
            </div>
        </form>
    </div>




</body>
<style>
    .error {
        color: red;
    }
</style>

<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                trainer: {
                    required: true
                },
                plan: {
                    required: true,
                },
                duration: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true,
                },
                status: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><label for="days" class="form-label">Day</label><select name="days[]" class="form-control days"><option selected disabled>--select day--</option><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></td><td><label for="start_time[]" class="form-label">Start Time</label><input name="start_time[]" class="form-control start_time timepicker" placeholder="Select your time" /></td><td><label for="end_time[]" class="form-label">End Time</label><input name="end_time[]" class="form-control end_time timepicker" placeholder="Select your time" /></td><td><label class="form-label">Remove Row</label><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove form-control"><i class="fa fa fa-trash"></i></button></td></tr>');
            $('.timepicker').mdtimepicker();
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $('.days').each(function() {
                $(this).rules("add", {
                    required: true
                });
            }),
            $('.start_time').each(function() {
                $(this).rules("add", {
                    required: true
                });
            }),
            $('.end_time').each(function() {
                $(this).rules("add", {
                    required: true
                });
            })
    });
</script>
<script src="./assets/timepicker/mdtimepicker.js"></script>
<script>
    $(document).ready(function() {
        $('.timepicker').mdtimepicker();
    });
</script>
<?php
if (isset($_POST['submit'])) {

    $trainer = $_POST['trainer'];
    $plan = $_POST['plan'];
    $plan_image = $_POST['plan_image'];
    $duration = $_POST['duration'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $status = $_POST['status'];



    $sql = "insert into package (trainer,plan,plan_image,duration,amount,status,description) values ('$trainer','$plan','$plan_image','$duration','$amount','$status','$description')";
    $result = mysqli_query($conn, $sql);
    $package_id = $conn->insert_id;


    foreach ($_POST['days'] as $key => $value) {
        $query1 = "INSERT INTO available(days,start_time,end_time,package_id)VALUES ('" . $_POST['days'][$key] . "','" . $_POST['start_time'][$key] . "' ,'" . $_POST['end_time'][$key] . "','" . $package_id . "')";
        $result1 = mysqli_query($conn, $query1);
    }


    if ($result == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Package added successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "package_view.php";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Package added Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

<script>
    $(document).ready(function() {
        $('#plan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "get_image.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#plan_image').val(data);
                }
            })
        })
    })
</script>

</html>