<?php

session_start();
unset($_SESSION['id_user']);
unset($_SESSION['level']);
unset($_SESSION['username']);
// session_destroy();

echo "<script>
    alert('Logout Berhasil')
    window.location='login.php'
</script>";
