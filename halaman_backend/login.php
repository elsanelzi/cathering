<?php

include '../config/koneksi.php';

session_start();
if (isset($_SESSION['level'])) {
    header("location: index.php");
    die();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="icon" type="image/png" href="foto/logobaru.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="assets/css/login/style.css">


</head>

<body style="background-image: url(assets/css/login/bg-1.jpg); background-size: cover;">

    <div class="card" style="margin-top: 100px;">

        <div class="card-body">
            <div class="form">
                <h1 style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">LOGIN ADMINISTRATOR</h1>
                <div class=""><img width="100px" height="120" src="assets/css/login/icon-login.jpg" /></div>
                <form class="login-form" action="proses_login.php" method="POST">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="submit" name="login" value="Login" style="background-color: black; color: white; font-weight: bold; font-size: 16px;">
                </form>
            </div>
        </div>

    </div>


    <video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
        <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4" />
    </video>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="assets/css/login/index.js"></script>
</body>

</html>