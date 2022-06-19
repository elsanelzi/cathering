<?php
// Mengambil data user dengan level admin
$userAdmin = mysqli_query($koneksi, "SELECT * FROM tb_user u LEFT JOIN tb_admin a ON u.id_user=a.id_user WHERE level='admin' ORDER BY u.id_user ASC");
// Mengambil data user dengan level pimpinan
$userPimpinan = mysqli_query($koneksi, "SELECT * FROM tb_user u LEFT JOIN tb_pimpinan p ON u.id_user=p.id_user WHERE level='pimpinan' ORDER BY u.id_user ASC");
// Mengambil data user dengan level pelanggan
$userPelanggan = mysqli_query($koneksi, "SELECT * FROM tb_user u LEFT JOIN tb_pelanggan p ON u.id_user=p.id_user WHERE level='pelanggan' ORDER BY u.id_user ASC");
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pengguna</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Administrator</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Handphone</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($userAdmin as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                                <td><?= $value['username']; ?></td>
                                                <td><?= $value['nohp']; ?></td>
                                                <td><?= $value['alamat']; ?></td>
                                                <td><?= $value['level']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pimpinan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead style="background-color:aqua;">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Handphone</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($userPimpinan as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                                <td><?= $value['username']; ?></td>
                                                <td><?= $value['nohp']; ?></td>
                                                <td><?= $value['alamat']; ?></td>
                                                <td><?= $value['level']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pelanggan</h5>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($userPelanggan as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['nama_lengkap']; ?></td>
                                                <td><?= $value['username']; ?></td>
                                                <td><?= $value['nohp']; ?></td>
                                                <td><?= $value['alamat']; ?></td>
                                                <td><?= $value['level']; ?></td>
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