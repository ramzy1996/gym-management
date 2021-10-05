<?php
if ($_SESSION['role'] == 'trainer') {
    echo "<script type='text/javascript'>window.open('404page.php','_self')</script>";
}
