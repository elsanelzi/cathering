YU<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Form Tambah Data Pimpinan</h4>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="" method="POST" class="bg-light" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama...." required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username..." required>
                            </div>
                            <div class="form-group">
                                <label for="nohp">Nomor Handphone</label>
                                <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Masukan Nomor HP..." required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="10" rows="3" class="form-control" placeholder="Masukan Alamat...." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password..." required>
                            </div>

                            <div class="card-action text-center">
                                <a href="?page=pages/pimpinan/viewpimpinan" class="btn btn-warning">Kembali</a>
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['tambah'])) {

    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $level = 'pimpinan';
    $password = $_POST['password'];

    // Menyimpan data ke dalam tabel user
    $simpanUser = mysqli_query($koneksi, "INSERT INTO tb_user (`username`, `password`,`level` ) VALUES ('$username', '$password', '$level')");

    // Mendapatkan id user
    $id_user = $koneksi->insert_id;

    // Menyimpan data ke dalam tabel pimpinan
    $simpanpimpinan = mysqli_query($koneksi, "INSERT INTO tb_pimpinan (`id_user`,`nama_lengkap`, `username`, `nohp`,`alamat` ) VALUES ('$id_user','$nama_lengkap', '$username','$nohp', '$alamat')");

    if ($simpanpimpinan) {
        $_SESSION['info'] = 'Berhasil Disimpan';
        echo "<script>
            window.location.href = '?page=pages/pimpinan/viewpimpinan'</script>";
    } else {
        $_SESSION['info'] = 'Gagal Disimpan';
        echo "<script>window.location.href = '?page=pages/pimpinan/viewpimpinan'
              </script>";
    }
}

?>