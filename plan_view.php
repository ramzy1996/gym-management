<?php
include('./restrict.php');
include('./restricttrainer.php');
include('./header.php');
include('./links.php');
include('./connection.php')
?>
<?php
if (isset($_POST['add'])) {

    $pname = $_POST['pname'];
    $pimage = $_FILES['pimage']['name'];
    $tmp_name = $_FILES['pimage']['tmp_name'];


    $sql = "insert into plan (plan_name,plan_image) values ('$pname','$pimage')";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        move_uploaded_file($tmp_name, "uploads/$pimage");
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Plan added success!",
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
                    text: "Plan added Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $e_pname = $_POST['e_pname'];
    $e_pimage = $_FILES['e_pimage']['name'];
    $e_tmp_name = $_FILES['e_pimage']['tmp_name'];

    $sql = "select * from plan";
    $res = mysqli_query($conn, $sql);


    $plan = mysqli_fetch_array($res);

    // $pid = $plan['plan_id'];
    $plan_name = $plan['plan_name'];
    $plan_image = $plan['plan_image'];

    if (empty($e_pimage)) {
        $e_pimage = $plan_image;
    }

    $sqlupdate = "update plan set plan_name ='$e_pname', plan_image='$e_pimage' where plan_id='$id'";
    $resultupdate = mysqli_query($conn, $sqlupdate);
    if ($resultupdate == true) {
        move_uploaded_file($e_tmp_name, "uploads/$e_pimage");
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Plan updated success!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "plan_view.php";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Plan updated Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>
<?php
if (isset($_GET['planid'])) {
    $del_id = $_GET['planid'];
    $sqldelete = "delete from plan where plan_id='$del_id'";
    $resdelete = mysqli_query($conn, $sqldelete);
    if ($resdelete == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Plan deleted success!",
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan</title>
</head>


<body>
    <!-- Modal for add plan -->
    <div class="modal fade" id="addplan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addplanLabel">Add Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="pname">Plan Name</label>
                            <input type="text" class="form-control" name="pname" id="pname">
                        </div>
                        <div class="form-group">
                            <label for="pimage">Image</label>
                            <input type="file" name="pimage" class="form-control" id="pimage" accept=".png,.jpg,.jpeg,.gif,.tif">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="add" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ############################################################################################################## -->


    <!-- Modal for edit plan -->
    <div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Edit Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="e_pname">Plan Name</label>
                            <input type="text" class="form-control" name="e_pname" id="e_pname">
                        </div>
                        <div class="form-group">
                            <label for="e_pimage">Image</label>
                            <input type="file" name="e_pimage" class="form-control" id="e_pimage" accept=".png,.jpg,.jpeg,.gif,.tif">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="edit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>












    <!-- table -->
    <div class="container p-30 body">
        <div>
            <div class="row">
                <div class="col-md-12 main-datatable">
                    <div class="card_body">
                        <div class="row d-flex">
                            <div class="col-sm-4 createSegment">
                                <a class="btn dim_button create_new" data-toggle="modal" data-target="#addplan"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                        <th>Plan Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from plan";
                                    $res = mysqli_query($conn, $sql);


                                    while ($plan = mysqli_fetch_array($res)) {

                                        $id = $plan['plan_id'];
                                        $plan_name = $plan['plan_name'];
                                        $plan_image = $plan['plan_image'];

                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $plan_name ?></td>
                                            <?php if (!empty($plan_image)) : ?>
                                                <td><img src="uploads/<?php echo $plan_image ?>" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php else : ?>
                                                <td><img src="uploads/Fitness.png" height="70px" width="70px" style="border-radius: 50%;"></td>
                                            <?php endif ?>
                                            <td>
                                                <button class="btn btn-primary editbtn"><i class="far fa-edit"></i>
                                                </button>
                                                <a href="plan_view.php?planid=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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








    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    pname: {
                        required: true
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('.editbtn').on('click', function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                // console.log(data);

                $('#id').val(data[0]);
                $('#e_pname').val(data[1]);
                $('#e_pimage').val(data[2]);
            })


        });
    </script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#filtertable').DataTable({
                "pageLength": 6,
                aoColumnDefs: [{
                    "aTargets": [3],
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