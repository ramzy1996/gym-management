<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php')
?>
<?php
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql = "select * from users where id='$edit_id'";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users</title>
</head>

<body>
    <div class="container body">
        <h2 class="text-center">Edit Users</h2>
        <br><br>
        <div class="text-center">
            <?php if (empty($image)) : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="uploads/Default.png">
            <?php else : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px" src="uploads/<?php echo $image ?>">
            <?php endif ?>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="regno" class="form-label">Reg-No</label>
                        <input name="regno" class="form-control" id="regno" value="<?php echo $regno ?>" readonly>
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
                        <input name="fname" class="form-control" id="fname" autocomplete="off" value="<?php echo $fname ?>" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo $lname ?>" placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" autocomplete="off" value="<?php echo $email ?>" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input class="form-control" id="mobile" name="mobile" autocomplete="off" value="<?php echo $mobile ?>" placeholder="Enter mobile number" maxlength="10">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password ?>" id="password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_password" class="form-control" value="<?php echo $password ?>" id="c_password" placeholder="Enter confirm password">
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-success btn-block" href="user_view.php">Back</a>
                </div>
            </div>
            <br><br>
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
<?php
if (isset($_POST['submit'])) {

    $e_fname = $_POST['fname'];
    $e_lname = $_POST['lname'];
    $e_email = $_POST['email'];
    $e_mobile = $_POST['mobile'];
    $e_image = $_FILES['image']['name'];
    $e_tmp_name = $_FILES['image']['tmp_name'];
    $e_password = $_POST['password'];
    $e_regno = $_POST['regno'];

    if (empty($e_image)) {
        $e_image = $image;
    }

    $sql = "update users set regno='$e_regno', fname='$e_fname',lname='$e_lname',email='$e_email',mobile='$e_mobile',image='$e_image',password='$e_password' where id='$edit_id'";
    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        move_uploaded_file($e_tmp_name, "uploads/$e_image");
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Updated success!",
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
                    text: "Update Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

</html>