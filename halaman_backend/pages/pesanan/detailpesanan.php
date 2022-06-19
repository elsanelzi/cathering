<?php
// Mengambil id dari methode request get
$id_order = $_GET['id'];
// Mengambil data untuk detail order dari gabungan tabel order, tabel order detail, dan tabel paket, dan tabel pelanggan berdarkan id order
$detailorder = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order='$id_order' ORDER BY od.id_order_detail DESC");

// Mengambil data pelanggan yang melakukan order
$datapelanggan = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE o.id_order=$id_order ORDER BY id_order ASC");
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Data Pesanan Pelanggan</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="?page=pages/pesanan/viewkelolapesanan" class="btn btn-success btn-md float-left">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mb-5">
                                <table id="basic-datatables" class="display table">
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($datapelanggan as $key => $value) : ?>
                                            <tr>
                                                <td width="20%">Nama Pelanggan</td>
                                                <td width="2%">:</td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">No. Handphone</td>
                                                <td width="2%">:</td>
                                                <td><?= $value['nohp']; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Status Order</td>
                                                <td width="2%">:</td>
                                                <?php if ($value['status_order'] == 'cancel') : ?>
                                                    <td style="color:red; font-weight:bold"><?= $value['status_order']; ?></td>
                                                <?php elseif ($value['status_order'] == 'proses') : ?>
                                                    <td style="color:green; font-weight:bold"><?= $value['status_order']; ?></td>
                                                <?php else : ?>
                                                    <td style="color:blue; font-weight:bold"><?= $value['status_order']; ?></td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <td width="20%">Status Bayar</td>
                                                <td width="2%">:</td>
                                                <td><?= $value['status_bayar']; ?></td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Gambar </th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah Beli</th>
                                            <th>Sub Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($detailorder as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><img src="assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" width="100px" height="100px"></td>
                                                <td><?= $value['nama_paket']; ?></td>
                                                <td>Rp. <?= number_format($value['harga_paket'], 0, '.', '.'); ?></td>
                                                <td><?= $value['jumlah_beli']; ?></td>
                                                <td><?= number_format($value['harga_paket'] * $value['jumlah_beli'], 0, '.', '.'); ?></td>
                                            </tr>

                                        <?php endforeach; ?>
                                        <tr style="font-size: 18px; font-weight:bold">
                                            <td colspan="5" class="text-right text-danger">Total</td>
                                            <td class="text-center text-danger">Rp. <?= number_format($value['total_harga'], 0, '.', '.'); ?></td>
                                        </tr>
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