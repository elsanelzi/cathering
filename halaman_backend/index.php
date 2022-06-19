<?php
include "../config/koneksi.php";

session_start();
if (!isset($_SESSION['level'])) {
    header("location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "components/header.php" ?>
</head>

<body>
    <div class="wrapper">
        <?php include "components/navbar.php" ?>

        <!-- Sidebar -->
        <?php include "components/sidebar.php" ?>
        <!-- End Sidebar -->
        <?php include "content.php" ?>

        <!-- Custom template | don't include it in your project! -->

        <!-- End Custom template -->
    </div>

    <!-- Script -->
    <?php include "components/script.php" ?>
    <!-- Script -->

</body>

</html>