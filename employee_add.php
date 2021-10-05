<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php')
?>

<body>
    <div class="container body">
        <h2 class="text-center">Register Here</h2>
        <br><br>
        <div class="text-center">
            <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="uploads/Default.png">
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_fname" class="form-label">First Name</label>
                        <input name="emp_fname" class="form-control" id="emp_fname" autocomplete="off" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_lname" class="form-label">Last Name</label>
                        <input class="form-control" id="emp_lname" name="emp_lname" autocomplete="off" placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_email" class="form-label">Email address</label>
                        <input type="email" name="emp_email" class="form-control" id="emp_email" autocomplete="off" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_mobile" class="form-label">Mobile Number</label>
                        <input class="form-control" id="emp_mobile" name="emp_mobile" autocomplete="off" placeholder="Enter mobile number" maxlength="10">
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
                    <label for="emp_role" id="emp_role" class="form-label">Role</label>
                    <select class="form-control form-select" id="emp_role" name="emp_role">
                        <option value="" selected disabled>--Select--</option>
                        <option value="admin">Admin</option>
                        <option value="trainer">Trainer</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emp_password" class="form-label">Password</label>
                        <input type="password" name="emp_password" class="form-control" id="emp_password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="c_emp_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_emp_password" class="form-control" id="c_emp_password" placeholder="Enter confirm password">
                    </div>
                </div>
            </div>

            <br><br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
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
                    rangelength: [9, 10],
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
    $("#emp_mobile").ForceNumericOnly();
</script>

<?php
if (isset($_POST['submit'])) {

    $fname = $_POST['emp_fname'];
    $lname = $_POST['emp_lname'];
    $email = $_POST['emp_email'];
    $mobile = $_POST['emp_mobile'];
    $image = $_FILES['emp_image']['name'];
    $tmp_name = $_FILES['emp_image']['tmp_name'];
    $role = $_POST['emp_role'];
    $password = $_POST['emp_password'];


    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT emp_email FROM employee WHERE emp_email='$email'"));
    $check_email_user = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

    if ($check_email > 0 || $check_email_user > 0) {
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
        $sql = "insert into employee (emp_fname,emp_lname,emp_email,emp_mobile,emp_role,emp_password,emp_image) values ('$fname','$lname','$email','$mobile','$role','$password','$image')";
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
                    text: "Registration Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
}
?>

</html>