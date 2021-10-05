<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php');
?>
<?php
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $sql = "delete from users where id='$del_id'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Deleted success!",
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
                    text: "Failed!",
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
    <title>Users</title>
</head>

<body>
    <div class="container p-30 body">
        <div>
            <div class="row">
                <div class="col-md-12 main-datatable">
                    <div class="card_body">
                        <div class="row d-flex">
                            <div class="col-sm-4 createSegment">
                                <a class="btn dim_button create_new" href="user_add.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                        <th>Reg-No</th>
                                        <th>Image</th>
                                        <th>F-Name</th>
                                        <th>L-Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from users";
                                    $res = mysqli_query($conn, $sql);


                                    while ($users = mysqli_fetch_array($res)) {

                                        $id = $users['id'];
                                        $regno = $users['regno'];
                                        $fname = $users['fname'];
                                        $lname = $users['lname'];
                                        $email = $users['email'];
                                        $image = $users['image'];
                                        $mobile = $users['mobile'];

                                    ?>
                                        <tr>
                                            <td><?php echo $regno ?></td>
                                            <?php if (!empty($image)) : ?>
                                                <td><img src="uploads/<?php echo $image ?>" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php else : ?>
                                                <td><img src="uploads/Default.png" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php endif ?>
                                            <td><?php echo $fname ?></td>
                                            <td><?php echo $lname ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $mobile ?></td>
                                            <td>
                                                <a href="user_edit.php?edit=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                                </a>
                                                <a href="user_view.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                </a>


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
                    "aTargets": [6],
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