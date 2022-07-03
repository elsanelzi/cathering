<?php
// Mengambil data pesanan dari gabungan tabel order, tabel pembayaran, dan tabel pelanggan dimana status bayar =  sudah bayar
$pesanan = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_pembayaran pb ON o.id_order=pb.id_order JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan WHERE status_bayar='sudah bayar' ORDER BY pb.id_pembayaran");

?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pembayaran</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua; font-size:9px">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kode Order</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Total Bayar</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pesanan as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['kode_order']; ?></td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                                <td>Rp. <?= number_format($value['total_bayar'], 0, '.', '.'); ?></td>
                                                <td><?= $value['tanggal_bayar']; ?></td>
                                                <td><a href="assets/file/image/bukti bayar/<?= $value['bukti_bayar'] ?>" class="btn btn-danger" target="__blank">Bukti</a></td>
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