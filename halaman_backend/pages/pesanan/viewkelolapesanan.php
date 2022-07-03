<?php
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = pending
$pesanan_pending = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='pending' GROUP BY o.id_order ORDER BY o.id_order DESC");
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = proses
$pesanan_proses = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='proses' GROUP BY o.id_order ORDER BY o.id_order DESC");
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = cancel
$pesanan_cancel = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='cancel' GROUP BY o.id_order ORDER BY o.id_order DESC");
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = menunggu konfirmasi bayar
$pesanan_konfirmasi_bayar = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='menunggu konfirmasi bayar' GROUP BY o.id_order ORDER BY o.id_order DESC");
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = dikirim
$pesanan_dikirim = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='dikirim' GROUP BY o.id_order ORDER BY o.id_order DESC");
// Mengambil data pesanan dari gabungan tabel order, tabel order detail, tabel paket, dan tabel pelanggan dimana status order = selesai
$pesanan_selesai = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_order='selesai' GROUP BY o.id_order ORDER BY o.id_order DESC");

?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pesanan Pelanggan</h4>
            </div>
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
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pending" class="nav-link active" data-toggle="tab">Pending</a></li>
                            <li><a href="#diproses" class="nav-link" data-toggle="tab">Diproses</a></li>
                            <li><a href="#dicancel" class="nav-link" data-toggle="tab">Dicancel</a></li>
                            <li><a href="#konfirmasi_bayar" class="nav-link" data-toggle="tab">Konfirmasi Bayar</a></li>
                            <li><a href="#dikirim" class="nav-link" data-toggle="tab">Dikirim</a></li>
                            <li><a href="#selesai" class="nav-link" data-toggle="tab">Selesai</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Menampilkan pesanan dengan status order = pending -->
                                <div id="pending" class="tab-pane fade-in active">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="3">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_pending as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td>
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                                <button type="submit" name="cancel" class="btn btn-danger btn-md float-right mr-2">Cancel</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                                <!-- <button type="submit" name="konfirmasi" class="btn btn-primary btn-md float-right"></i> Konfirmasi</button> -->
                                                                <a href="" data-toggle="modal" data-target="#konfirmasi_pesanan" class="btn btn-primary btn-md float-right">Konfirmasi</a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Menampilkan pesanan dengan status order = proses -->
                                <div id="diproses" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="2">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_proses as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td>
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                                <button type="submit" name="cancel" class="btn btn-danger btn-md float-right mr-2">Cancel</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Menampilkan pesanan dengan status order = cancel -->
                                <div id="dicancel" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="3">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_cancel as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td colspan="3">
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Menampilkan pesanan dengan status order = menunggu konfirmasi bayar -->
                                <div id="konfirmasi_bayar" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="3">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_konfirmasi_bayar as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td>
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                                <button type="submit" name="cancel" class="btn btn-danger btn-md float-right mr-2">Cancel</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="" method=" POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">

                                                                <!-- <button type="submit" name="konfirmasi" class="btn btn-primary btn-md float-right"></i> Konfirmasi</button> -->
                                                                <a href="" data-toggle="modal" data-target="#konfirmasi_pembayaran" class="btn btn-primary btn-md float-right">Konfirmasi</a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Menampilkan pesanan dengan status order = dikirim -->
                                <div id="dikirim" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="2">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_dikirim as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td>
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                                                                <button type="submit" name="selesai" class="btn btn-danger btn-md float-right mr-2">Selesai</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Menampilkan pesanan dengan status order = selesai -->
                                <div id="selesai" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead style="background-color:aqua; font-size:9px">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Antar</th>
                                                    <th>Nama Paket & Kuantitas</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Order</th>
                                                    <th colspan="2">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($pesanan_selesai as $key => $value) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $value['nama_lengkap']; ?></td>
                                                        <td><?= $value['tgl_antar']; ?></td>
                                                        <?php
                                                        $id_order = $value['id_order'];
                                                        $paketdanKuantitas = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC"); ?>
                                                        <td>
                                                            <?php foreach ($paketdanKuantitas as $key => $value) : ?>
                                                                <storng class="mb-10 text-info fw-bold"> <?= $value['nama_paket'] . '</strong> <br> <smal class="text-danger fw-bold">Qyt : ' . $value['jumlah_beli']; ?><br></small>
                                                                <?php endforeach; ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($value['total_harga'] + $value['harga_tambahan'], 0, '.', '.'); ?></td>
                                                        <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                        <td>
                                                            <a href="?page=pages/pesanan/detailpesanan&id=<?php echo $value['id_order']; ?>" class="btn btn-success">Detail</a>
                                                        </td>
                                                        <td>
                                                            <a href="faktur.php?&id=<?php echo $value['id_order']; ?>" class="btn btn-danger float-left" target="__blank">Cetak</a>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Proses Konfirmasi Pesanan Dikonfirmasi -->
<?php
if (isset($_POST['konfirmasi'])) {
    $id_order = $_POST['id_order'];
    $status_order = 'proses';

    $edit = $koneksi->query("UPDATE tb_order SET status_order= '$status_order' WHERE id_order=$id_order");

    if ($edit) {
        $_SESSION['info'] = "Berhasil Dikonfirmasi";
        echo "<script>
                                window.location = '?page=pages/pesanan/viewkelolapesanan'
                            </script>";
    } else {
        $_SESSION['info'] = "Gagal Dikonfirmasi";
        echo "<script>
                            window.location = '?page=pages/pesanan/viewkelolapesanan'
                        </script>";
    }
}

?>

<!-- Proses Konfirmasi Pesanan Dicancel -->
<?php
if (isset($_POST['cancel'])) {
    $id_order = $_POST['id_order'];
    $status_order = 'cancel';

    $edit = $koneksi->query("UPDATE tb_order SET status_order= '$status_order' WHERE id_order=$id_order");

    if ($edit) {
        $_SESSION['info'] = "Berhasil Dibatalkan";
        echo "<script>
                                window.location = '?page=pages/pesanan/viewkelolapesanan'
                            </script>";
    } else {
        $_SESSION['info'] = "Gagal Dibatalkan";
        echo "<script>
                            window.location = '?page=pages/pesanan/viewkelolapesanan'
                        </script>";
    }
}

?>

<!-- Proses Konfirmasi Pesanan Selesai -->
<?php
if (isset($_POST['selesai'])) {
    $id_order = $_POST['id_order'];
    $status_order = 'selesai';

    $edit = $koneksi->query("UPDATE tb_order SET status_order= '$status_order' WHERE id_order=$id_order");

    if ($edit) {
        $_SESSION['info'] = "Berhasil Dikirim";
        echo "<script>
                                window.location = '?page=pages/pesanan/viewkelolapesanan'
                            </script>";
    } else {
        $_SESSION['info'] = "Gagal Dikirim";
        echo "<script>
                            window.location = '?page=pages/pesanan/viewkelolapesanan'
                        </script>";
    }
}

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('ul li a').click(function() {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>

<!-- Modal Konfirmasi Pesanan -->
<!-- MODAL -->
<div class="modal fade" id="konfirmasi_pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="POST" class="bg-light" enctype="multipart/form-data">

                    <?php foreach ($pesanan_pending as $key => $value) : ?>
                        <div class="form-group">
                            <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                            <input type="hidden" name="total_bayar" value="<?= $value['total_harga'] ?>">
                            <label for="kode_order">Kode Order : </label>
                            <input type="text" name="kode_order" class="form-control text-danger fw-bold" id="kode_order" value="<?= $value['kode_order']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="harga_awal">Harga Awal: </label>
                            <input type="float" name="harga_awal" id="harga_awal" value="Rp. <?= number_format($value['total_harga'], 0, '.', '.'); ?>" class="form-control text-danger fw-bold" readonly>
                        </div>

                        <div class="form-group">
                            <label for="note_order">Note Order: </label>
                            <textarea name="note_order" id="note_order" class="form-control text-danger fw-bold" cols="30" rows="5" readonly><?= $value['note_order']; ?></textarea>
                        </div>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <label for="harga_tambahan">Masukan Harga Tambahan: </label>
                        <input type="float" name="harga_tambahan" id="harga_tambahan" placeholder="Masukan Harga Tambahan" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="konfirmasi_pesanan">Konfirmasi</button>
                    </div>

                </form>

                <?php

                if (isset($_POST['konfirmasi_pesanan'])) {
                    $id_order = $_POST['id_order'];
                    $total_bayar = $_POST['total_bayar'];
                    $status_order = 'proses';
                    $harga_tambahan = $_POST['harga_tambahan'];
                    if ($harga_tambahan !== NULL) {
                        $harga_tambahan = $_POST['harga_tambahan'];
                    } else {
                        $harga_tambahan = NULL;
                    }


                    $update_status = $koneksi->query("UPDATE tb_order SET status_order='$status_order', harga_tambahan='$harga_tambahan' WHERE id_order='$id_order'");


                    if ($update_status == TRUE) {
                        echo "<script>
                        alert('Pesanan Berhasil Dikonfirmasi')
                        window.location = '?page=pages/pesanan/viewkelolapesanan'
                      </script>";
                    } else {
                        echo "<script>
                        alert('Pesanan Gagal Dikonfirmasi')
                        window.location =  '?page=pages/pesanan/viewkelolapesanan'
                      </script>";
                    }
                }
                ?>
            </div> <!-- /MODAL BODY -->
        </div>
    </div>
</div>
<!--/MODAL -->

<!-- Modal Konfirmasi Pembayaran -->
<!-- MODAL -->
<div class="modal fade" id="konfirmasi_pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php foreach ($pesanan_konfirmasi_bayar as $key => $value) : ?>
                    <?php $id_order = $value['id_order']; ?>
                <?php endforeach; ?>
                <?php
                // 
                $data_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran pb LEFT JOIN tb_order o ON pb.id_order=o.id_order WHERE o.id_order=$id_order"); ?>

                <form action="" method="POST" class="bg-light" enctype="multipart/form-data">
                    <?php foreach ($data_pembayaran as $key => $value) : ?>
                        <div class="form-group">
                            <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                            <label for="kode_order">Kode Order : </label>
                            <input type="text" name="kode_order" class="form-control text-danger fw-bold" id="kode_order" value="<?= $value['kode_order']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_bayar"> Total Bayar: </label>
                            <input type="float" name="total_bayar" id="total_bayar" value="Rp. <?= number_format($value['total_bayar'], 0, '.', '.'); ?>" class="form-control text-danger fw-bold" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bukti_bayar"> Bukti Pembayaran: </label><br>
                                    <img src="assets/file/image/bukti bayar/<?= $value['bukti_bayar'] ?>" alt="bukti_bayar" class="form-control" height="300px">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="konfirmasi_pembayaran">Konfirmasi</button>
                    </div>

                </form>

                <?php

                if (isset($_POST['konfirmasi_pembayaran'])) {
                    $id_order = $_POST['id_order'];
                    $status_order = 'dikirim';
                    $status_bayar = 'sudah bayar';

                    // Updata status bayar dan status order pada table order
                    $update_status = $koneksi->query("UPDATE tb_order SET status_bayar='$status_bayar', status_order='$status_order' WHERE id_order='$id_order'");

                    if ($update_status == TRUE) {
                        echo "<script>
                        alert('Pembayaran Berhasil Dilakukan')
                        window.location = '?page=pages/pesanan/viewkelolapesanan'
                      </script>";
                    } else {
                        echo "<script>
                        alert('Pembayaran Gagal Dilakukan')
                        window.location =  '?page=pages/pesanan/viewkelolapesanan'
                      </script>";
                    }
                }
                ?>
            </div> <!-- /MODAL BODY -->
        </div>
    </div>
</div>
<!--/MODAL -->