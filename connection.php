<?php
$conn = mysqli_connect('localhost', 'root', '', 'gym_db');

if (mysqli_connect_errno()) {
    echo 'Failed to connect ' . mysqli_connect_error();
}
