<?php
session_start();
if (!isset($_SESSION['employee'])) {
    echo "<script type='text/javascript'>window.open('login.php','_self')</script>";
}
