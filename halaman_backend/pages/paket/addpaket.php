<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Form Tambah Data Paket</h4>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="" method="POST" class="bg-light" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_paket">Nama Paket</label>
                                <input type="text" class="form-control" name="nama_paket" id="nama_paket" placeholder="Masukan Nama paket...." required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control" placeholder="Masukan Keterangan paket" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga_paket">Harga Paket</label>
                                <input type="float" class="form-control" name="harga_paket" id="harga_paket" placeholder="Masukan Harga paket...." required>
                            </div>

                            <div class="form-group">
                                <label for="gambar_paket">Gambar Paket</label>
                                <input type="file" class="form-control" name="gambar_paket" id="gambar_paket" placeholder="Masukan Gambar paket...." required>
                            </div>

                            <div class="card-action text-center">
                                <a href="?page=pages/paket/viewpaket" class="btn btn-warning">Kembali</a>
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

<script>
    CKEDITOR.replace('keterangan');
</script>

<?php

if (isset($_POST['tambah'])) {

    $nama_paket = $_POST['nama_paket'];
    $keterangan = $_POST['keterangan'];

    $namagambar = $_FILES['gambar_paket']['name'];
    $lokasigambar = $_FILES['gambar_paket']['tmp_name'];
    $gambar = time() . '_' . $namagambar;
    $pindah = move_uploaded_file($lokasigambar, 'assets/file/image/paket/' . $gambar);
    $harga_paket = $_POST['harga_paket'];

    // Menyimpan data ke dalam tabel paket
    $simpan = mysqli_query($koneksi, "INSERT INTO tb_paket (`nama_paket`,`keterangan`,`gambar_paket`,`harga_paket` ) VALUES ('$nama_paket','$keterangan','$gambar','$harga_paket')");

    if ($simpan) {
        $_SESSION['info'] = 'Berhasil Disimpan';
        echo "<script>
            window.location.href = '?page=pages/paket/viewpaket'</script>";
    } else {
        $_SESSION['info'] = 'Gagal Disimpan';
        echo "window.location.href = '?page=pages/paket/viewpaket'
              </script>";
    }
}

?>