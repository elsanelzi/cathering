<?php
if (isset($_SESSION['level_pelanggan'])) {
    header("location: ?page=halaman_awal/home");
    die();
}
?>
<!--::header part start::-->
<header class="main_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php include "halaman_awal/components/navbar.php"; ?>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12">
                        <h2 class="contact-title">Register</h2>
                        <h6 class="mb-3">Lengkapi data diri kamu</h6>
                    </div>
                    <div class="col-md-12 mt-3">
                        <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Lengkap'" placeholder='Nama Lengkap' required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" name="username" id="username" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" placeholder='Username' required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" name="nohp" id="nohp" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No. Handphone'" placeholder='No. Handphone' required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'" placeholder='Alamat' required></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" placeholder='Password' required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:-5px">
                                <div class="row">
                                    <div class="col-md-8" style="padding: 14.5px 43px 14.5px 0px;"><a href="?page=halaman_awal/login/login">Sudah Punya Akun? Silahkan <strong>Login!!</strong></a></div>
                                    <div class="col-md-4"> <button type="submit" class="button button-loginForm btn_5 float-right ml-6" name="register">Register</button></div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
</section>
<!-- ================ contact section end ================= -->

<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->

<?php
// Aksi jika menekan tombol register
if (isset($_POST['register'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $level = 'pelanggan';
    $password = $_POST['password'];

    // Query untuk menyimpan data ke dalam tabel user
    $simpanUser = mysqli_query($koneksi, "INSERT INTO tb_user (`username`, `password`,`level` ) VALUES ('$username', '$password', '$level')");

    // Mengambil id_user dari tabel user
    $id_user = $koneksi->insert_id;

    // Query untuk menyimpan data ke table pelanggan
    $simpanPelanggan = mysqli_query($koneksi, "INSERT INTO tb_pelanggan (`id_user`,`nama_lengkap`, `username`, `nohp`,`alamat` ) VALUES ('$id_user','$nama_lengkap', '$username','$nohp', '$alamat')");

    if ($simpanPelanggan) {
        echo "<script>
                alert('Selamat, Akun Anda Sudah Terdaftar. Silahkan Login!')
                window.location.href = '?page=halaman_awal/login/login'
              </script>";
    } else {
        echo "<script>
                alert('Maaf, Anda gagal mendaftar. Silahkan mendaftar kembali')
                window.location.href = '?page=halaman_awal/registered/viewregistered'
              </script>";
    }
}

?> ?>