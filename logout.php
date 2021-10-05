<?php
include('./links.php');
session_start();
echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Logout successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "index.php";
                });
            });
            </script>';
session_destroy();
?>

<?php
include('./connection.php');
?>