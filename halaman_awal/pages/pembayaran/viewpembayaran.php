<?php

if (!isset($_SESSION['level_pelanggan'])) {
    header("location: ?page=halaman_awal/login/login");
    die();
}


// Mendapatkan id_user
$id_user = $_SESSION['id_pelanggan'];

// Mendapatkan data tabel pelanggan berdasarkan id_user yang login
$pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_user='$id_user'")->fetch_array();

// Mendapatkan id_pelanggan
$id_pelanggan = $pelanggan['id_pelanggan'];

// Mendapatkan data pelanggan yang melakukan order
$datapelangganorder = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pelanggan p ON o.id_pelanggan=p.id_pelanggan WHERE o.id_pelanggan=$id_pelanggan ORDER BY id_order DESC LIMIT 1");
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
                        <h2>Pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding text-left">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12">
                        <h2 class="contact-title">Pembayaran</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="button-group-area mt-40 float-right">

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="section-top-border">
                            <div class="table table-striped table-hover table-bordered">
                                <div class="progress-table">
                                    <div class="table-head">
                                        <div class="serial">No</div>
                                        <div class="country">Nama Pelanggan</div>
                                        <div class="country">No. Handphone</div>
                                        <div class="country">Tanggal Antar</div>
                                        <div class="country">Total Harga</div>
                                        <div class="country">Aksi / Status</div>
                                    </div>
                                    <?php
                                    $no = 1;
                                    $total_harga = 0;
                                    foreach ($datapelangganorder as $key => $value) : ?>
                                        <div class="table-row">
                                            <div class="serial"><?= $no++; ?></div>
                                            <div class="country"><?= $value['nama_lengkap']; ?></div>
                                            <div class="country"><?= $value['nohp']; ?></div>
                                            <div class="country"><?= $value['tgl_antar']; ?></div>
                                            <div class="country">Rp. <?= number_format($value['total_harga'], 0, '.', '.'); ?></div>
                                            <div class="country">
                                                <div class="button-group-area mt-40 float-right">
                                                    <?php if ($value['status_order'] == 'pending') : ?>
                                                        <div class="country" style="color:blue; font-weight:bold">Menunggu Konfirmasi Pesanan</div>
                                                    <?php endif; ?>

                                                    <?php if ($value['status_order'] == 'menunggu konfirmasi bayar') : ?>
                                                        <div class="country" style="color:blue; font-weight:bold">Menunggu Konfirmasi Bayar</div>
                                                    <?php endif; ?>

                                                    <?php if ($value['status_bayar'] == 'sudah bayar') : ?>
                                                        <div class="country" style="color:blue; font-weight:bold">Sudah Bayar</div>
                                                    <?php endif; ?>

                                                    <?php if ($value['status_bayar'] == 'belum bayar' && $value['status_order'] != 'cancel' && $value['status_order'] != 'menunggu konfirmasi bayar') : ?>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                            <button type="submit" name="cancel" class="genric-btn danger radius float-left">cancel</button>
                                                        </form>
                                                    <?php endif;  ?>

                                                    <?php if ($value['status_order'] == 'cancel') : ?>
                                                        <div class="country" style="color:red; font-weight:bold">Cancel</div>
                                                    <?php endif;  ?>

                                                    <?php if ($value['status_order'] == 'proses') : ?>
                                                        <!-- <button type="submit" class="genric-btn warning radius float-left" data-toggle="modal" data-target="#tambahdata">Bayar</button> -->
                                                        <a href="" data-toggle="modal" data-target="#bayar" class="genric-btn warning radius float-left">Bayar</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proses Konfirmasi Pesanan Dicancel -->
            <?php
            if (isset($_POST['cancel'])) {
                $id_order = $_POST['id_order'];
                $status_order = 'cancel';

                $edit = $koneksi->query("UPDATE tb_order SET status_order= '$status_order' WHERE id_order=$id_order");

                if ($edit) {
                    echo "<script>
                                alert('Pesanan Berhasil Dibatalkan')
                                window.location = '?page=halaman_awal/pages/pembayaran/viewpembayaran'
                            </script>";
                } else {
                    echo "<script>
                            alert('Pesanan gagal Dibatalkan')
                            window.location = '?page=halaman_awal/pages/pembayaran/viewpembayaran'
                        </script>";
                }
            }

            ?>


        </div>
</section>
<!-- ================ contact section end ================= -->

<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->

<!-- MODAL -->
<div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="POST" class="bg-light" enctype="multipart/form-data">
                    <div class="form-group">
                        <?php foreach ($datapelangganorder as $key => $value) : ?>
                            <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                            <input type="hidden" name="total_harga" value="<?= $value['total_harga'] ?>">
                            <input type="hidden" name="harga_tambahan" value="<?= $value['harga_tambahan'] ?>">
                        <?php endforeach; ?>
                        <label for="tanggal_bayar">Tanggal Pembayaran</label>
                        <input type="text" name="tanggal_bayar" class="form-control" id="tanggal_bayar" value="<?= date('d/m/Y'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_bank">Nama Bank : </label>
                        <select name="nama_bank" id="nama_bank" class="form-control" required>
                            <option value="">--- PILIH BANK --- </option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="Bank Nagari">Bank Nagari</option>
                            <option value="BCA">BCA</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <!-- <input type="text" name="nama_bank" id="nama_bank" placeholder="Masukan Nama Bank" class="form-control" required><br> -->
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Atas Nama : </label>
                        <input type="text" name="atas_nama" id="atas_nama" placeholder="Masukan Atas Nama" class="form-control" required><br>
                    </div>

                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening : </label>
                        <input type="text" name="nomor_rekening" id="nomor_rekening" placeholder="Masukan Nomor Rekening" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        <label for="bukti_bayar">Kirim Bukti Pembayaran : </label>
                        <input type="file" name="bukti_bayar" id="bukti_bayar" placeholder="Masukan Bukti Pembayaran" class="form-control" required><br>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>

                </form>

                <?php

                if (isset($_POST['simpan'])) {
                    $id_order = $_POST['id_order'];
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal_bayar = date('Y-m-d');
                    $total_harga = $_POST['total_harga'];
                    $harga_tambahan = $_POST['harga_tambahan'];
                    $total_bayar = $total_harga + $harga_tambahan;
                    $status_order = 'menunggu konfirmasi bayar';

                    // Metode Bayar Transfer
                    $nama_bank = $_POST['nama_bank'];
                    $nomor_rekening = $_POST['nomor_rekening'];
                    $atas_nama = $_POST['atas_nama'];

                    $namafile = $_FILES['bukti_bayar']['name'];
                    $lokasifile = $_FILES['bukti_bayar']['tmp_name'];
                    $file = time() . '_' . $namafile;
                    $pindah = move_uploaded_file($lokasifile, 'halaman_backend/assets/file/image/bukti bayar/' . $file);
                    $simpan = $koneksi->query("INSERT INTO tb_pembayaran (id_order, total_bayar, nama_bank, nomor_rekening, atas_nama, tanggal_bayar, bukti_bayar) VALUES ('$id_order', '$total_bayar', '$nama_bank','$nomor_rekening','$atas_nama','$tanggal_bayar','$file' ) ");

                    $update_status = $koneksi->query("UPDATE tb_order SET status_order='$status_order' WHERE id_order='$id_order'");

                    if ($simpan == TRUE) {
                        echo "<script>
                        alert('Pembayaran Berhasil Dilakukan')
                        window.location = '?page=halaman_awal/pages/pesan/viewriwayatpesanan'
                      </script>";
                    } else {
                        echo "<script>
                        alert('Pembayaran Gagal Dilakukan')
                        window.location =  '?page=halaman_awal/pages/pesan/viewriwayatpesanan'
                      </script>";
                    }
                }

                ?>



            </div> <!-- /MODAL BODY -->
        </div>
    </div>
</div> <!-- /MODAL -->