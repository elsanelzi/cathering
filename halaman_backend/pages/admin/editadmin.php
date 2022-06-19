<?php $id = $_GET['id'];
$user = mysqli_query($koneksi, "SELECT * FROM tb_admin LEFT JOIN tb_user ON tb_admin.id_user=tb_user.id_user WHERE id_admin = '$id'")->fetch_array();
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Ubah Data Admin</h4>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" action="" class="form-horizontal bg-white" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="id_user" value="<?php echo $user['id_user'] ?>">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $user['username'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor Handphone</label>
                                    <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $user['nohp'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="10" rows="3" class="form-control" required><?= $user['alamat'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="<?= $user['password'] ?>" required>
                                </div>

                            </div>
                            <div class="card-action text-center">
                                <a href="index.php?page=pages/admin/viewadmin" class="btn btn-danger">Batal</a>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                    </div>
                    </form>
                    <?php

                    if (isset($_POST['update'])) {
                        $id_user = $_POST['id_user'];
                        $nama_lengkap = $_POST['nama_lengkap'];
                        $username = $_POST['username'];
                        $nohp = $_POST['nohp'];
                        $alamat = $_POST['alamat'];
                        $level = 'admin';
                        $password = $_POST['password'];

                        // Query update tabel admin
                        $edit = $koneksi->query("UPDATE tb_admin SET nama_lengkap= '$nama_lengkap', nohp='$nohp', alamat= '$alamat' WHERE id_admin='$_GET[id]'");

                        // Query menampilkan update tabel user
                        $koneksi->query("UPDATE tb_user SET username= '$username',password= '$password' WHERE id_user='$id_user'");

                        if ($edit) {
                            $_SESSION['info'] = 'Berhasil Diubah';
                            echo "<script>
                            window.location.href = '?page=pages/admin/viewadmin'</script>";
                        } else {
                            $_SESSION['info'] = 'Gagal Diubah';
                            echo "<script>window.location.href = '?page=pages/admin/viewadmin'
                            </script>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>