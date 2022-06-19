<?php
unset($_SESSION['id_pelanggan']);
unset($_SESSION['level_pelanggan']);
unset($_SESSION['username_pelanggan']);
// session_destroy();

echo "<script>
    alert('Logout Berhasil')
    window.location='index.php'
</script>";
