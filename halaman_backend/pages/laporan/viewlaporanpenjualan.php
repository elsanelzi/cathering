<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Penjualan</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            date_default_timezone_set('Asia/Jakarta');
                            $tgl = date('m');
                            ?>
                            <form action="" method="POST">
                                <div class="row float-center">

                                    <select class="form-control" name="periode" aria-label="Default select example">
                                        <?php
                                        $bulan = ['Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04', 'Mei' => '05', 'Juni' => '06', 'Juli' => '07', 'Agustus' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'];
                                        ?>
                                        <option value="<?= $tgl; ?>">Pilih Bulan</option>
                                        <?php foreach ($bulan as $b => $value_bulan) : ?>
                                            <option value="<?= $value_bulan; ?>"><?= $b; ?></option>
                                        <?php endforeach;  ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary my-2" name="cari">Cari</button>

                                    <?php if (isset($_POST['cari'])) : ?>
                                        <a href="print.php?&periode=<?= $_POST['periode']; ?>" target="_blank" class="btn btn-danger mt-2 ml-1 my-2 mr-1">
                                            Print</a>
                                    <?php else : ?>
                                        <a href="print1.php" target="_blank" class="btn btn-danger mt-2 ml-1 my-2 mr-1">
                                            Print</a>
                                    <?php endif; ?>
                                    <button type="reset" class="btn btn-warning my-2">Reset</button>
                            </form>
                            <?php
                            // Mengambil data untuk laporan penjualan dari gabungan tabel order, tabel order detail, tabel paket, tabel pelanggan, dan tabel pembayaran
                            $laporan_penjualan = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan LEFT JOIN tb_pembayaran pb ON o.id_order=pb.id_order WHERE status_bayar='sudah bayar' GROUP BY o.id_order ORDER BY o.id_order DESC");

                            // tombol cari ditekan
                            if (isset($_POST['cari'])) {
                                $periode = $_POST['periode'];
                                // Mengambil data untuk laporan penjualan dari gabungan tabel order, tabel order detail, tabel paket, tabel pelanggan, dan tabel pembayaran dimana tanggal bayar sama dengan periode yang diinputkan
                                $laporan_penjualan = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket JOIN tb_pelanggan pl ON o.id_pelanggan=pl.id_pelanggan LEFT JOIN tb_pembayaran pb ON o.id_order=pb.id_order WHERE status_bayar='sudah bayar' AND tanggal_bayar LIKE '%-$periode-%' GROUP BY o.id_order ORDER BY o.id_order DESC");
                            }

                            ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
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
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>