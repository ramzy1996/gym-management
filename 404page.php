<?php
session_start();
include('./connection.php');
// include('./restrictuser.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    body {
        background: #dedede;
    }

    .page-wrap {
        min-height: 100vh;
    }
</style>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <?php if (isset($_SESSION['employee'])) { ?>
                    <a href="dashboard.php" class="btn btn-link">Back to Dashboard</a>
                <?php } else { ?>
                    <a href="index.php" class="btn btn-link">Back to Home</a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>