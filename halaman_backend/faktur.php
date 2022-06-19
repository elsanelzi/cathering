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

// Mendapatkan id_user
$id_order = $_GET['id'];
$paket = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order=$id_order ORDER BY id_order_detail ASC");

// Mendapatkan data pelanggan yang melakukan order
$dataorder = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan LEFT JOIN tb_pembayaran pb ON o.id_order=pb.id_order WHERE o.id_order=$id_order");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <?php include "components/header.php" ?>
</head>

<body onload="window.print()">

    <div class="container-fluid">
        <!-- judul laporan -->
        <div class="row mb-6 mt-8">
            <div class="col-md-12">
                <h2 class="text-center">Faktur Penjualan</h2>
                <h3 class="text-center">Tanggal <?= date('d-m-Y'); ?></h3>
            </div>
        </div>

        <br><br>
        <div class="row">
            <?php foreach ($dataorder as $key => $value) : ?>
                <div class="col-md-4 offset-md-0">
                    <h5>Nama : <?= $value['nama_lengkap'] ?></h5>
                    <h5>Alamat : <?= $value['alamat'] ?></h5>
                    <h5>No. Handphone : <?= $value['nohp'] ?></h5>
                </div>
                <div class="col-md-4">
                    <h5>Kode Order : <?= $value['kode_order'] ?></h5>
                    <h5>Tanggal Antar : <?= $value['tgl_antar'] ?></h5>
                </div>
                <div class="col-md-4" <h5>Total Bayar : Rp. <?= number_format($value['total_bayar'], 0, '.', '.'); ?></h5>
                    <h5>Tanggal Bayar : <?= $value['tanggal_bayar'] ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
        <br><br>
        <!-- blok 1 -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered  table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Nama Paket</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Sub Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paket as $key => $value) : ?>
                            <tr>
                                <td><?= $value['nama_paket']; ?></td>
                                <td><?= $value['harga']; ?></td>
                                <td><?= $value['jumlah_beli']; ?></td>
                                <td>Rp. <?= number_format($value['harga'] * $value['jumlah_beli'], 0, '.', '.'); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>

        <?php foreach ($dataorder as $key => $value) : ?>
            <div class="row">
                <div class="col-md-9 offset-md-0">
                    <h3>Total : </h3>
                </div>
                <div class="col-md-3  text-center">
                    <h4 class="mb-5">Rp. <?= number_format($value['total_harga'], 0, '.', '.'); ?></h4>

                </div>
            </div>
            <div class="row">
                <div class="col-md-9 offset-md-0">
                    <h3>Harga Tambahan : </h3>
                </div>
                <div class="col-md-3  text-center">
                    <h4 class="mb-5">Rp. <?= number_format($value['harga_tambahan'], 0, '.', '.'); ?></h4>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="row text-danger fw-bold">
            <div class="col-md-9 offset-md-0">
                <h3>Grand Total : </h3>
            </div>
            <div class="col-md-3  text-center">
                <h4 class="mb-5">Rp. <?= number_format($value['harga_tambahan'] + $value['total_harga'], 0, '.', '.'); ?></h4>
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