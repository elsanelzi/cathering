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
$datapelangganorder = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pelanggan p ON o.id_pelanggan=p.id_pelanggan WHERE o.id_pelanggan=$id_pelanggan ORDER BY id_order DESC");
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
                        <h2>Riwayat Pesanan</h2>
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
                <div class="card">
                    <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                                                echo $_SESSION['info'];
                                                            }
                                                            unset($_SESSION['info']); ?>"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12">
                        <h2 class="contact-title">Riwayat Pesanan Saya</h2>
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
                                        <div class="country">Kode Order</div>
                                        <div class="country">Tanggal Antar</div>
                                        <div class="country">Total Bayar</div>
                                        <div class="country">Aksi</div>
                                    </div>
                                    <?php
                                    $no = 1;
                                    $total_harga = 0;
                                    foreach ($datapelangganorder as $key => $value) : ?>
                                        <div class="table-row">
                                            <div class="serial"><?= $no++; ?></div>
                                            <div class="country"><?= $value['kode_order']; ?></div>
                                            <div class="country"><?= $value['tgl_antar']; ?></div>
                                            <div class="country">Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></div>
                                            <div class="country">
                                                <div class="button-group-area mt-40 float-right">
                                                    <a href="?page=halaman_awal/pages/pesan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="genric-btn success radius float-left">Detail</a>
                                                    <?php if ($value['status_bayar'] == 'sudah bayar' && $value['status_order'] == 'dikirim') : ?>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                            <button type="submit" name="konfirmasi_diterima" class="genric-btn danger radius float-left">Konfirmasi Diterima</button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if ($value['status_bayar'] == 'sudah bayar' && $value['status_order'] == 'selesai') : ?>
                                                        <a href="?page=halaman_awal/pages/pesan/faktur&id=<?php echo $value['id_order']; ?>" class="genric-btn danger radius float-left" target="__blank">Cetak</a>
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
        </div>

</section>

<!-- Proses Konfirmasi Pesanan Dicancel -->
<?php
if (isset($_POST['konfirmasi_diterima'])) {
    $id_order = $_POST['id_order'];
    $status_order = 'selesai';

    $edit = $koneksi->query("UPDATE tb_order SET status_order= '$status_order' WHERE id_order=$id_order");

    if ($edit) {
        $_SESSION['info'] = "Berhasil Dikonfirmasi";
        echo "<script>
                                window.location = '?page=halaman_awal/pages/pesan/viewriwayatpesanan'
                            </script>";
    } else {
        $_SESSION['info'] = "Gagal Dikonfirmasi";
        echo "<script>
                            window.location = '?page=halaman_awal/pages/pesan/viewriwayatpesanan'
                        </script>";
    }
}

?>

<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->
<!-- ================ contact section end ================= -->