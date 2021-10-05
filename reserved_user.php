<?php
include('./restrict.php');
include('./header.php');
include('./links.php');
include('./connection.php');
?>

<?php
if (isset($_GET['rsvid'])) {
    $del_id = $_GET['rsvid'];
    $sqldel = "DELETE a.*, b.* FROM reservation a
    INNER JOIN reservedtime b ON a.id = b.reservation_id
    WHERE a.id='$del_id'";
    $resdel = mysqli_query($conn, $sqldel);
    if ($resdel == true) {
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
                    title: "Deleted!",
                    text: "Error delete!",
                    icon: "error",
                    buttons: false,
                    timer: 1500,
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

$sqlusr = "select * from users";
$resusr = mysqli_query($conn, $sqlusr);

$rowusr = mysqli_fetch_array($resusr);

$usrid = $rowusr['id'];
$usrfname = $rowusr['fname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
</head>

<body>

    <div class="container p-30 body">
        <h2 class="text-center"><?php if ($_SESSION['role'] == 'admin') echo "All Reservations";
                                else echo "Your Reservation"; ?></h2>
        <div>
            <div class="row">
                <div class="col-md-12 main-datatable">
                    <div class="card_body">
                        <div class="row d-flex">
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
                                        <th>User Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 'admin') {
                                        $sql = "select * from reservation";
                                    } else
                                    if ($_SESSION['role'] == 'trainer') {
                                        $sql = "select * from reservation where trainer_id='$id'";
                                    } else {
                                        $sql = "select * from reservation where user_id='$usrid'";
                                    }
                                    $res = mysqli_query($conn, $sql);


                                    while ($row = mysqli_fetch_array($res)) {

                                        $trid = $row['id'];
                                        $trainer = $row['trainer_id'];
                                        $plan = $row['plan_name'];
                                        $duration = $row['duration'];
                                        $amount = $row['amount'];
                                        // $status = $row['status'];
                                        $user = $row['user_id'];


                                        // user
                                        $sqlusr = "select * from users where id='$user'";
                                        $resusr = mysqli_query($conn, $sqlusr);
                                        $rowusr = mysqli_fetch_array($resusr);
                                        $usrname = $rowusr['fname'];
                                        // trainer
                                        $sqltrainer = "select * from employee where emp_id='$trainer'";
                                        $restrainer = mysqli_query($conn, $sqltrainer);
                                        $rowtrainer = mysqli_fetch_array($restrainer);
                                        $trainername = $rowtrainer['emp_fname'];

                                    ?>
                                        <tr>
                                            <td><?php echo $trid ?></td>
                                            <td><?php echo $trainername ?></td>
                                            <td><?php echo $plan ?></td>
                                            <td><?php echo $duration ?></td>
                                            <td><?php echo $amount ?></td>
                                            <td><?php echo $usrname ?></td>
                                            <td>
                                                <a href="view_reservation.php?editres=<?php echo $trid; ?>" class="btn btn-primary"><i class="fas fa-book-open"></i>
                                                </a>
                                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                                    <a href="reserved_user.php?rsvid=<?php echo $trid; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                    </a>
                                                <?php } ?>
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