<?php
include('./restrict.php');
include('./header.php');
include('./links.php');
include('./connection.php');
?>

<?php
if (isset($_GET['pckgid'])) {
    $del_id = $_GET['pckgid'];
    $sql = "DELETE a.*, b.* FROM package a
    INNER JOIN available b ON a.id = b.package_id
    WHERE a.id='$del_id'";
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
                    text: "Delete Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package</title>
</head>

<body>

    <div class="container p-30 body">
        <h2 class="text-center"><?php if ($_SESSION['role'] == 'admin') echo "All Packages";
                                else echo "Your Packages"; ?></h2>
        <div>
            <div class="row">
                <div class="col-md-12 main-datatable">
                    <div class="card_body">
                        <div class="row d-flex">
                            <div class="col-sm-4 createSegment">
                                <a class="btn dim_button create_new" href="package_add.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                        <th>Id</th>
                                        <th>Trainer</th>
                                        <th>Plan Name</th>
                                        <th>Duration</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 'trainer') {
                                        $sql = "select * from package where trainer='$id'";
                                    } else {
                                        $sql = "select * from package";
                                    }
                                    $res = mysqli_query($conn, $sql);


                                    while ($row = mysqli_fetch_array($res)) {

                                        $id = $row['id'];
                                        $trainer = $row['trainer'];
                                        $plan = $row['plan'];
                                        $duration = $row['duration'];
                                        $amount = $row['amount'];
                                        $status = $row['status'];
                                        // plan
                                        $sqlpln = "select * from plan where plan_id='$plan'";
                                        $respln = mysqli_query($conn, $sqlpln);
                                        $rowpln = mysqli_fetch_array($respln);
                                        $planname = $rowpln['plan_name'];

                                        // trainer
                                        $sqltrainer = "select * from employee where emp_id='$trainer'";
                                        $restrainer = mysqli_query($conn, $sqltrainer);
                                        $rowtrainer = mysqli_fetch_array($restrainer);
                                        $trainername = $rowtrainer['emp_fname']


                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $trainername ?></td>
                                            <td><?php echo $planname ?></td>
                                            <td><?php echo $duration ?></td>
                                            <td><?php echo $amount ?></td>
                                            <td>
                                                <span class="<?php if ($status == 'available') echo "badge badge-success";
                                                                else if ($status == 'unavailable') echo "badge badge-warning"  ?>  " style="font-size: 13px;"><?php echo $status ?></span>

                                            </td>
                                            <td>
                                                <a href="view_packge.php?editpck=<?php echo $id; ?>" class="btn btn-primary"><i class="fas fa-book-open"></i>
                                                </a>

                                                <a href="package_edit.php?editpck=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                                </a>
                                                <a href="package_view.php?pckgid=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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