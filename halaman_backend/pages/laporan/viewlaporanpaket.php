<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Penjualan Paket</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="POST">
                                <div class="row float-center">

                                    <select class="form-control" name="id_paket" aria-label="Default select example">
                                        <?php
                                        $paket = mysqli_query($koneksi, "SELECT * FROM tb_paket");
                                        ?>
                                        <option value="">Pilih Paket</option>
                                        <?php foreach ($paket as $key => $value) : ?>
                                            <option value="<?= $value['id_paket']; ?>"><?= $value['nama_paket']; ?></option>
                                        <?php endforeach;  ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary my-2" name="cari">Cari</button>

                                    <?php if (isset($_POST['cari'])) : ?>
                                        <?php if ($_POST['id_paket'] != NULL) : ?>
                                            <a href="printpaket.php?&id_paket=<?= $_POST['id_paket']; ?>" target="_blank" class="btn btn-danger mt-2 ml-1 my-2 mr-1">
                                                Print</a>
                                        <?php else : ?>
                                            <a href="printpaket1.php" target="_blank" class="btn btn-danger mt-2 ml-1 my-2 mr-1">
                                                Print</a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="printpaket1.php" target="_blank" class="btn btn-danger mt-2 ml-1 my-2 mr-1">
                                            Print</a>
                                    <?php endif; ?>
                                    <button type="reset" class="btn btn-warning my-2">Reset</button>
                            </form>
                            <?php
                            // Mengambil data untuk laporan penjualan paket dari gabungan tabel order, tabel order detail, dan tabel paket
                            $laporan_penjualan_paket = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket ORDER BY od.id_order_detail DESC");

                            // tombol cari ditekan
                            if (isset($_POST['cari'])) {
                                $id_paket = $_POST['id_paket'];
                                if ($id_paket != NULL) {
                                    // Mengambil data untuk laporan penjualan paket dari gabungan tabel order, tabel order detail, dan tabel paket dimana id_paket sama dengan id paket yang dipilih
                                    $laporan_penjualan_paket = mysqli_query($koneksi, "SELECT * FROM tb_order o LEFT JOIN tb_order_detail od ON o.id_order=od.id_order JOIN tb_paket p ON od.id_paket=p.id_paket WHERE od.id_paket = $id_paket ORDER BY od.id_order_detail DESC");
                                }
                            }

                            ?>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
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
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>