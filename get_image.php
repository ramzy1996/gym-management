<?php
include('./connection.php');


$output = '';

if (isset($_POST['id'])) {
    if ($_POST['id'] != '') {
        $sql = "select * from plan where plan_id='" . $_POST['id'] . "'";
    }
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        $output .= $row['plan_image'];
    }
    echo $output;
}
