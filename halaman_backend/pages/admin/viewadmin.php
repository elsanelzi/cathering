<?php
// Query menampilkan data user dengan level admin
$user = mysqli_query($koneksi, "SELECT * FROM tb_admin LEFT JOIN tb_user ON tb_admin.id_user=tb_user.id_user ORDER BY nama_lengkap ASC");
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Administrator</h4>
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
                            <a href="index.php?page=pages/admin/addadmin" class="btn btn-primary btn-md"><i class="far fa-plus-square"></i> Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Handphone</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($user as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                                <td><?= $value['username']; ?></td>
                                                <td><?= $value['nohp']; ?></td>
                                                <td><?= $value['alamat']; ?></td>
                                                <td><?= $value['level']; ?></td>
                                                <td class="text-center">
                                                    <a href="?page=pages/admin/editadmin&id=<?php echo $value['id_admin']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah</a>
                                                    <a href="?page=pages/admin/deleteadmin&id=<?php echo $value['id_admin']; ?>" class="btn btn-danger delete-data"><i class="fas fa-trash-alt"></i> Hapus</a>
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