<?php

// Mengaktifkan atau memulai session
session_start();

// Koneksi ke database
include 'config/koneksi.php';

?>
<!doctype html>
<html lang="en">

<head>
    <?php include "halaman_awal/components/header.php"; ?>
</head>

<body>

    <?php include "content.php"; ?>



    <?php include "halaman_awal/components/script.php"; ?>
</body>

</html>