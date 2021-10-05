<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php')
?>
<?php
if (isset($_GET['editemp'])) {
    $edit_id = $_GET['editemp'];
    $sql = "select * from employee where emp_id='$edit_id'";
    $res = mysqli_query($conn, $sql);

    $users = mysqli_fetch_array($res);

    $id = $users['emp_id'];
    $fname = $users['emp_fname'];
    $lname = $users['emp_lname'];
    $email = $users['emp_email'];
    $image = $users['emp_image'];
    $password = $users['emp_password'];
    $role = $users['emp_role'];
    $mobile = $users['emp_mobile'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employees</title>
</head>

<body>
    <div class="container body">
        <h2 class="text-center">Edit Employees</h2>
        <br><br>
        <div class="text-center">
            <?php if (empty($image)) : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="uploads/Default.png">
            <?php else : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px" src="uploads/<?php echo $image ?>">
            <?php endif ?>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="emp_id" class="form-label">ID</label>
                <input name="emp_id" class="form-control" id="emp_id" value="<?php echo $id ?>" readonly>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_fname" class="form-label">First Name</label>
                        <input name="emp_fname" class="form-control" id="emp_fname" autocomplete="off" value="<?php echo $fname ?>" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_lname" class="form-label">Last Name</label>
                        <input class="form-control" id="emp_lname" name="emp_lname" autocomplete="off" value="<?php echo $lname ?>" placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_email" class="form-label">Email address</label>
                        <input type="email" name="emp_email" class="form-control" id="emp_email" autocomplete="off" value="<?php echo $email ?>" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_mobile" class="form-label">Mobile Number</label>
                        <input class="form-control" id="emp_mobile" name="emp_mobile" autocomplete="off" value="<?php echo $mobile ?>" placeholder="Enter mobile number" maxlength="10">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_image" class="form-label">Image</label>
                        <input type="file" name="emp_image" class="form-control" id="emp_image" accept=".png,.jpg,.jpeg,.gif,.tif" style="border:0px!important;" onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="emp_role" class="form-label">Role</label>
                    <select class="form-control form-select" name="emp_role" id="emp_role">
                        <option value="admin" <?php if ($role == "admin") echo 'selected="selected"'; ?>>Admin</option>
                        <option value="trainer" <?php if ($role == "trainer") echo 'selected="selected"'; ?>>Trainer</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_password" class="form-label">Password</label>
                        <input type="password" name="emp_password" class="form-control" value="<?php echo $password ?>" id="emp_password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="c_emp_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_emp_password" class="form-control" value="<?php echo $password ?>" id="password" placeholder="Enter confirm password">
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-success btn-block" href="employee_view.php">Back</a>
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
                emp_fname: {
                    required: true
                },
                emp_email: {
                    required: true,
                    email: true
                },
                emp_mobile: {
                    required: true,
                    rangelength: [10, 12],
                    number: true,
                },
                emp_role: {
                    required: true
                },
                emp_password: {
                    required: true,
                    minlength: 8
                },
                c_emp_password: {
                    required: true,
                    equalTo: "#emp_password"
                },
            },
            messages: {
                emp_name: 'Please enter first name.',
                emp_email: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                },
                emp_mobile: {
                    required: 'Please enter mobile number.',
                    rangelength: 'Mobile number should be 10 digit number.'
                },
                emp_role: 'Please select role.',
                emp_password: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
                c_emp_password: {
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
    $("#emp_mobiles").ForceNumericOnly();
</script>
<?php
if (isset($_POST['submit'])) {

    $e_fname = $_POST['emp_fname'];
    $e_lname = $_POST['emp_lname'];
    $e_email = $_POST['emp_email'];
    $e_mobile = $_POST['emp_mobile'];
    $e_image = $_FILES['emp_image']['name'];
    $e_tmp_name = $_FILES['emp_image']['tmp_name'];
    $e_password = $_POST['emp_password'];
    $e_role = $_POST['emp_role'];
    if (empty($e_image)) {
        $e_image = $image;
    }

    $sql = "update employee set emp_fname='$e_fname',emp_lname='$e_lname',emp_email='$e_email',emp_mobile='$e_mobile',emp_image='$e_image',emp_password='$e_password',emp_role='$e_role' where emp_id='$edit_id'";
    $result = mysqli_query($conn, $sql);

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
                  }).then(function() {
                    window.location = "employee_view.php";
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

</html>