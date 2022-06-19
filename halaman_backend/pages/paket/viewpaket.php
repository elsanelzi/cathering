<?php
// Query menampilkan data pada tabel paket diurutkan berdasarkan nama lengkap 
$paket = mysqli_query($koneksi, "SELECT * FROM tb_paket ORDER BY nama_paket ASC");
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Paket</h4>
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
                        <div class="card-header">
                            <a href="index.php?page=pages/paket/addpaket" class="btn btn-primary btn-md"><i class="far fa-plus-square"></i> Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Paket</th>
                                            <th>Gambar</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($paket as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><img src="assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" width="100px" height="100px"></td>
                                                <td><?= $value['nama_paket']; ?></td>
                                                <td><?= $value['harga_paket']; ?></td>
                                                <td><?= $value['keterangan']; ?></td>
                                                <td class="text-center">
                                                    <a href="?page=pages/paket/editpaket&id=<?php echo $value['id_paket']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah</a>
                                                    <a href="?page=pages/paket/deletepaket&id=<?php echo $value['id_paket']; ?>" class="btn btn-danger delete-data"><i class="fas fa-trash-alt"></i> Hapus</a>
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