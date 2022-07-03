<?php $id = $_GET['id'];
$paket = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE id_paket = '$id'")->fetch_array();
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Ubah Data Paket</h4>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" action="" class="form-horizontal bg-white" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $paket['id_paket'] ?>">
                                <div class="form-group">
                                    <label for="nama_paket">Nama Paket</label>
                                    <input type="text" class="form-control" name="nama_paket" id="nama_paket" value="<?= $paket['nama_paket'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_paket">Kategori Paket</label>
                                    <input type="text" class="form-control" name="kategori_paket" id="kategori_paket" value="<?= $paket['kategori_paket'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control" required><?= $paket['keterangan']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="harga_paket">Harga</label>
                                    <input type="float" class="form-control" name="harga_paket" id="harga_paket" value="<?= $paket['harga_paket'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_paket">Gambar Paket</label>
                                    <div class="row ml-2">
                                        <img src="assets/file/image/paket/<?= $paket['gambar_paket'] ?>" alt="" width="100px" height="100px">
                                        <input type="hidden" name="gambar_paket_lama" value="<?= $paket['gambar_paket'] ?>">
                                        <input type="file" class="form-control" name="gambar_paket" id="gambar_paket">
                                    </div>

                                </div>
                            </div>
                            <div class="card-action text-center">
                                <a href="index.php?page=pages/paket/viewpaket" class="btn btn-danger">Batal</a>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                    </div>
                    </form>

                    <script>
                        CKEDITOR.replace('keterangan');
                    </script>
                    <?php


                    if (isset($_POST['update'])) {
                        $id_paket = $_POST['id'];
                        $nama_paket = $_POST['nama_paket'];
                        $kategori_paket = $_POST['kategori_paket'];
                        $keterangan = $_POST['keterangan'];
                        $namagambar = $_FILES['gambar_paket']['name'];
                        $gambarlama = $_POST['gambar_paket_lama'];
                        $lokasigambar = $_FILES['gambar_paket']['tmp_name'];
                        $harga_paket = $_POST['harga_paket'];

                        if ($namagambar == "") {
                            // Query edit tabel paket jika gambar bernilai NULL
                            $edit = $koneksi->query("UPDATE tb_paket SET 
                            nama_paket='$nama_paket' ,
                            keterangan='$keterangan',
                            harga_paket='$harga_paket',
                            kategori_paket='$kategori_paket'
                            WHERE id_paket='$id_paket'");

                            $_SESSION['info'] = 'Berhasil Diubah';
                            echo "<script>
                                window.location = '?page=pages/paket/viewpaket'
                            </script>";
                        } else {
                            $gambar = time() . '_' . $namagambar;
                            $pindah = move_uploaded_file($lokasigambar, 'assets/file/image/paket/' . $gambar);
                            unlink('assets/file/image/paket/' . $gambarlama);

                            if ($pindah) {
                                // Query edit tabel paket jika gambar tidak bernilai NULL
                                $edit = $koneksi->query("UPDATE tb_paket SET 
                                        nama_paket='$nama_paket' ,
                                        keterangan='$keterangan',
                                        gambar_paket='$gambar',
                                        harga_paket='$harga_paket',
                                        kategori_paket='$kategori_paket'
                                        WHERE id_paket='$id_paket'");

                                $_SESSION['info'] = 'Berhasil Diubah';
                                echo "<script>
                                            window.location = '?page=pages/paket/viewpaket'
                                        </script>";
                            } else {
                                $_SESSION['info'] = 'Gagal Diubah';
                                echo "<script>
                                    window.location = '?page=pages/paket/viewpaket'
                                </script>";
                            }
                        }
                    }


                    ?>
                </div>
            </div>
        </div>
    </div>
</div>