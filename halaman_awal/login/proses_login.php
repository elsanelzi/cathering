<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query mengambil data dari tabel user sesuai dengan username dan password yang dikirim melalui methode request post
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' and password = '$password' ") or die(mysqli_error($koneksi));

    // Jika jumlah data > 0 
    if (mysqli_num_rows($query) == 1) {
        $sql = mysqli_fetch_array($query);
        if ($sql['level'] == 'pelanggan') {
            $_SESSION['username_pelanggan'] = $username;
            $_SESSION['level_pelanggan'] = $sql['level'];
            $_SESSION['id_pelanggan'] = $sql['id_user'];
            echo "<script>
            alert('Selamat Datang $_SESSION[username_pelanggan] ');
            window.location='?page=halaman_awal/home';
            </script>";
        } else {
            echo "<script>
            alert('Maaf, Anda tidak dapat mengkases halaman ini');
            window.location='?page=halaman_awal/login/login';
            </script>";
        }
    } else {
        echo "<script>
            alert('Username atau Password Salah');
            window.location='?page=halaman_awal/login/login';
            </script>";
    }
}
