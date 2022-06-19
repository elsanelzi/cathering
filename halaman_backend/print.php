<style>
    th,
    td {
        font-size: 13px;
    }
</style>

<?php
include "../config/koneksi.php";

session_start();
if (!isset($_SESSION['level'])) {
    header("location: login.php");
    die();
}

$periode = $_GET['periode'];
$laporan_penjualan = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan LEFT JOIN tb_pembayaran pb ON o.id_order=pb.id_order WHERE status_bayar='sudah bayar' AND tanggal_bayar LIKE '%$periode%' GROUP BY o.id_order ORDER BY o.id_order DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <?php include "components/header.php" ?>
</head>

<body onload="window.print()">

    <div class="container-fluid">
        <!-- judul laporan -->
        <div class="row mb-6 mt-8">
            <div class="col-md-12">
                <h2 class="text-center">Laporan Penjualan</h2>
                <h3 class="text-center">Periode <?= date('d') . '-' . $periode . '-' . date('Y'); ?></h3>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered  table-sm">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Status Order</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($laporan_penjualan as $key => $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_lengkap']; ?></td>
                                <td><?= $value['nohp']; ?></td>
                                <td><?= $value['alamat']; ?></td>
                                <td><?= $value['status_order']; ?></td>
                                <td><?= $value['tanggal_bayar']; ?></td>
                                <td>Rp. <?= number_format($value['total_bayar'], 0, '.', '.'); ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <!-- disetujui -->
    <div class="row">
        <div class="col-md-9 offset-md-0 text-center">
        </div>
        <div class="col-md-3  text-center">

            <h5 style="font-size:15px;" class="mb-5">Padang, <?= date('d-m-Y') ?><br>Hormat Kami,</h5>
            <p style="margin-top: -10px;">(............................)</p>
        </div>
    </div>

    <?php include "components/script.php" ?>

</body>

</html>