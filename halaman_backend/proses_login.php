<?php
// Mengaktifkan atau memulai session
session_start();

// Koneksi ke database
include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' and password = '$password' ") or die(mysqli_error($koneksi));

    if (mysqli_num_rows($query) == 1) {
        $sql = mysqli_fetch_array($query);
        if ($sql['level'] == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $sql['level'];
            $_SESSION['id_user'] = $sql['id_user'];
            // header('location:index.php');
            echo "<script>
            alert('Selamat Datang $_SESSION[username] ');
            window.location='index.php';
            </script>";
        } elseif ($sql['level'] == 'pimpinan') {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $sql['level'];
            $_SESSION['id_user'] = $sql['id_user'];
            // header('location:index.php');
            echo "<script>
            alert('Selamat Datang $_SESSION[username] ');
            window.location='index.php';
            </script>";
        } else {
            echo "<script>
            alert('Maaf, Anda tidak dapat mengkases halaman ini');
            window.location='login.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Username atau Password Salah');
            window.location='login.php';
            </script>";
    }
}
