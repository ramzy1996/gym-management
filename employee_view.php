<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php');
?>
<?php
if (isset($_GET['delemp'])) {
    $del_id = $_GET['delemp'];
    $sql = "delete from employee where emp_id='$del_id'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Deleted successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Deleted Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>

<body>
    <div class="container p-30 body">
        <div>
            <div class="row">
                <div class="col-md-12 main-datatable">
                    <div class="card_body">
                        <div class="row d-flex">
                            <div class="col-sm-4 createSegment">
                                <a class="btn dim_button create_new" href="employee_add.php"> <i class="fa fa-plus" aria-hidden="true"></i>Create New</a>
                            </div>
                            <div class="col-sm-8 add_flex">
                                <div class="form-group searchInput">
                                    <label for="search">Search:</label>
                                    <input type="search" name="search" class="form-control" id="filterbox" placeholder=" ">
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x">
                            <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>F-Name</th>
                                        <th>L-Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from employee";
                                    $res = mysqli_query($conn, $sql);


                                    while ($employee = mysqli_fetch_array($res)) {

                                        $id = $employee['emp_id'];
                                        $fname = $employee['emp_fname'];
                                        $lname = $employee['emp_lname'];
                                        $email = $employee['emp_email'];
                                        $image = $employee['emp_image'];
                                        $mobile = $employee['emp_mobile'];
                                        $role = $employee['emp_role'];


                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <?php if (!empty($image)) : ?>
                                                <td><img src="uploads/<?php echo $image ?>" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php else : ?>
                                                <td><img src="uploads/Default.png" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php endif ?>
                                            <td><?php echo $fname ?></td>
                                            <td><?php echo $lname ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $mobile ?></td>
                                            <td><?php echo $role ?></td>
                                            <td>
                                                <a href="employee_edit.php?editemp=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                                </a>
                                                <?php if ($_SESSION['employee'] != $email) : ?>
                                                    <a href="employee_view.php?delemp=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt"></i>
                                                    </a>
                                                <?php endif ?>


                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var dataTable = $('#filtertable').DataTable({
                "pageLength": 6,
                aoColumnDefs: [{
                    "aTargets": [7],
                    "bSortable": false
                }],
                "dom": '<"top">ct<"top"p><"clear">'
            });
            $("#filterbox").keyup(function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>
</body>

</html>