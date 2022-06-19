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

$id_paket = $_GET['id_paket'];
$laporan_penjualan_paket = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket WHERE od.id_paket = $id_paket ORDER BY od.id_order_detail DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Paket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <?php include "components/header.php" ?>
</head>

<body onload="window.print()">

    <div class="container-fluid">
        <!-- judul laporan -->
        <div class="row mb-6 mt-8">
            <div class="col-md-12">
                <h2 class="text-center">Laporan Penjualan Paket</h2>
                <h3 class="text-center">Paket <?php $value = $laporan_penjualan_paket->fetch_array();
                                                echo $value['nama_paket']; ?></h3>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered  table-sm">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Nama Paket</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Sub Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($laporan_penjualan_paket as $key => $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['kode_order']; ?></td>
                                <td><?= $value['nama_paket']; ?></td>
                                <td>Rp. <?= number_format($value['harga'], 0, '.', '.'); ?></td>
                                <td><?= $value['jumlah_beli']; ?></td>
                                <td>Rp. <?= number_format($value['harga'] * $value['jumlah_beli'], 0, '.', '.'); ?></td>
                                <?php $total += $value['harga'] * $value['jumlah_beli']; ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="text-danger fw-bold">
                            <td colspan="5">Total :</td>
                            <td>Rp. <?= number_format($total, 0, '.', '.'); ?></td>
                        </tr>
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