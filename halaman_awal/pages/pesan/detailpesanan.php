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

// Mendapatkan detail data order beserta data pelanggan yang melakukan order
$menu = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_pelanggan=$id_pelanggan ORDER BY id_order_detail ASC");

$datapelangganorder = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_pelanggan=$id_pelanggan ORDER BY id_order ASC");
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
                        <h2>Detail Data Pesanan</h2>
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
                        <h2 class="contact-title">Detail Data Pesanan</h2>
                    </div>
                    <div class="col-md-12">
                        <a href="?page=halaman_awal/pages/pesan/viewriwayatpesanan" class="genric-btn info radius">Kembali</a>
                    </div>
                    <div class="col-md-12">
                        <div class="section-top-border">
                            <div class="progress-table-wrap">
                                <div class="progress-table">
                                    <div class="table-head">
                                        <div class="serial">No</div>
                                        <div class="country">Gambar</div>
                                        <div class="country">Nama Paket</div>
                                        <div class="country">Harga</div>
                                        <div class="country">Jumlah Beli</div>
                                        <div class="country">Sub Harga</div>
                                    </div>
                                    <?php
                                    $no = 1;
                                    $total_harga = 0;
                                    foreach ($menu as $key => $value) : ?>
                                        <div class="table-row">
                                            <div class="serial"><?= $no++; ?></div>
                                            <div class="country"> <img src="halaman_backend/assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="gambar paket" width="100px"></div>
                                            <div class="country"><?= $value['nama_paket']; ?></div>
                                            <div class="country">Rp. <?= number_format($value['harga_paket'], 0, '.', '.'); ?></div>
                                            <div class="country"><?= $value['jumlah_beli']; ?></div>
                                            <div class="country">Rp. <?= number_format($value['harga_paket'] * $value['jumlah_beli'], 0, '.', '.'); ?></div>

                                            <?php $total_harga += $value['harga_paket'] * $value['jumlah_beli']; ?>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="table-row text-danger fw-bold" style="font-size: 18px;">
                                        <div class="serial"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country">Total :</div>
                                        <div class="country"></div>
                                        <div class="country">Rp. <?= number_format($total_harga, 0, '.', '.'); ?></div>
                                    </div>
                                    <div class="table-row text-danger fw-bold" style="font-size: 18px;">
                                        <div class="serial"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country">Harga Tambahan :</div>
                                        <div class="country"></div>
                                        <div class="country">Rp. <?= number_format($value['harga_tambahan'], 0, '.', '.'); ?></div>
                                    </div>
                                    <div class="table-row text-success fw-bold" style="font-size: 18px;">
                                        <div class="serial"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country"></div>
                                        <div class="country">Total Pembayaran :</div>
                                        <div class="country"></div>
                                        <div class="country">Rp. <?= number_format($total_harga + $value['harga_tambahan'], 0, '.', '.'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-md-2">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12">
                        <div class="button-group-area mt-40">
                            <a href="#" class="genric-btn primary radius">Primary</a>
                            <a href="#" class="genric-btn success radius">Success</a>
                            <a href="#" class="genric-btn info radius">Info</a>
                            <a href="#" class="genric-btn warning radius">Pending</a>
                            <a href="#" class="genric-btn danger radius">cancel</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
</section>
<!-- ================ contact section end ================= -->
<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->