<?php
// Mengambil data profil usaha
$profil_usaha = $koneksi->query("SELECT * FROM tb_profil_usaha")->fetch_assoc();

?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Profil Usaha</h4>
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
                            <?php
                            if ($profil_usaha == NULL) { ?>
                                <a href="" data-toggle="modal" data-target="#tambahdata" class="btn btn-primary"><i class="far fa-plus-square"></i> Tambah Data </a>
                                <!-- MODAL -->
                                <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profil</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="" method="POST" class="bg-light" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="tentang_kami">Tentang Kami</label>
                                                        <textarea type="textarea" class="form-control" name="tentang_kami" id="tentang_kami" required></textarea>
                                                    </div>
                                                    <script>
                                                        CKEDITOR.replace('tentang_kami');
                                                    </script>

                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea type="textarea" class="form-control" name="alamat" id="alamat" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_telp">Nomor Telepon (+62)</label>
                                                        <input type="text" class="form-control" name="no_telp" id="no_telp" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_wa">Nomor WhatsApp (+62)</label>
                                                        <input type="text" class="form-control" name="no_wa" id="no_wa" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" class="form-control" name="instagram" id="instagram" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" class="form-control" name="facebook" id="facebook" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" class="form-control" name="email" id="email" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="maps">Maps (Gunakan 100% untuk Width, dan 280 untuk Height)</label>
                                                        <textarea type="textarea" rows="7" class="form-control" name="maps" id="maps" required></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                    </div>

                                                </form>

                                                <?php

                                                if (isset($_POST['tambah'])) {
                                                    $tentang_kami = $_POST['tentang_kami'];
                                                    $alamat = $_POST['alamat'];
                                                    $no_telp = $_POST['no_telp'];
                                                    $no_wa = $_POST['no_wa'];
                                                    $instagram = $_POST['instagram'];
                                                    $facebook = $_POST['facebook'];
                                                    $email = $_POST['email'];
                                                    $maps = $_POST['maps'];
                                                    // Menyimpan data ke tabel profil_usaha
                                                    $simpan = mysqli_query($koneksi, "INSERT INTO tb_profil_usaha (`tentang_kami`,`alamat`,`no_telp`,`no_wa`,`instagram`,`facebook`,`email`,`maps`) VALUES ('$tentang_kami','$alamat','$no_telp','$no_wa','$instagram','$facebook','$email','$maps')");

                                                    if ($simpan == TRUE) {
                                                        $_SESSION['info'] = 'Berhasil Disimpan';
                                                        echo "<script>
                                                                window.location = '?page=pages/profil_usaha/viewprofilusaha'
                                                            </script>";
                                                    } else {
                                                        $_SESSION['info'] = 'Gagal Disimpan';
                                                        echo "<script>
                                                                window.location = '?page=pages/profil_usaha/viewprofilusaha'
                                                            </script>";
                                                    }
                                                }

                                                ?>

                                            </div> <!-- /MODAL BODY -->
                                        </div>
                                    </div>
                                </div> <!-- /MODAL -->

                            <?php } else { ?>
                                <a href="" data-toggle="modal" data-target="#ubahdata" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Data </a>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="" class="display table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Tentang Kami</th>
                                                    <td><?= $profil_usaha['tentang_kami']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><?= $profil_usaha['alamat']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Nomor Telepon</th>
                                                    <td><?= $profil_usaha['no_telp']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Nomor Whatsapp</th>
                                                    <td><?= $profil_usaha['no_wa']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Link Instagram</th>
                                                    <td><?= $profil_usaha['instagram']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Link Facebook</th>
                                                    <td><?= $profil_usaha['facebook']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>E-mail</th>
                                                    <td><?= $profil_usaha['email']; ?></td>
                                                </tr>

                                                <tr>
                                                    <th>Link Maps</th>
                                                    <td><?= $profil_usaha['maps']; ?></td>
                                                </tr>

                                                </tbbody>

                                        </table>
                                    </div>

                                </div>

                                <!-- MODAL -->
                                <div class="modal fade" id="ubahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profil</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" class="bg-light" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="tentang_kami">Tentang Kami</label>
                                                        <textarea type="textarea" class="form-control" name="tentang_kami" id="tentang_kami" required><?php echo $profil_usaha['tentang_kami'] ?></textarea>
                                                    </div>
                                                    <script>
                                                        CKEDITOR.replace('tentang_kami');
                                                    </script>

                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea type="textarea" class="form-control" name="alamat" id="alamat" required><?php echo $profil_usaha['alamat'] ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_telp">Nomor Telepon (+62)</label>
                                                        <input type="text" value="<?php echo $profil_usaha['no_telp'] ?>" class="form-control" name="no_telp" id="no_telp" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_wa">Nomor Whatsapp (+62)</label>
                                                        <input type="text" value="<?php echo $profil_usaha['no_wa'] ?>" class="form-control" name="no_wa" id="no_wa" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" value="<?php echo $profil_usaha['instagram'] ?>" class="form-control" name="instagram" id="instagram" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" value="<?php echo $profil_usaha['facebook'] ?>" class="form-control" name="facebook" id="facebook" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" value="<?php echo $profil_usaha['email'] ?>" class="form-control" name="email" id="email" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="maps">Maps (Gunakan 100% untuk Width, dan 280 untuk Height)</label>
                                                        <textarea type="textarea" rows="7" class="form-control" name="maps" id="maps" required><?php echo $profil_usaha['maps'] ?></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>

                                                </form>

                                                <?php

                                                if (isset($_POST['update'])) {
                                                    $tentang_kami = $_POST['tentang_kami'];
                                                    $alamat = $_POST['alamat'];
                                                    $no_telp = $_POST['no_telp'];
                                                    $no_wa = $_POST['no_wa'];
                                                    $instagram = $_POST['instagram'];
                                                    $facebook = $_POST['facebook'];
                                                    $email = $_POST['email'];
                                                    $maps = $_POST['maps'];

                                                    // Edit data pada tabel profil_usaha 
                                                    $update = $koneksi->query("UPDATE tb_profil_usaha SET tentang_kami = '$tentang_kami',alamat = '$alamat', no_telp = '$no_telp', no_wa = '$no_wa', instagram = '$instagram', facebook = '$facebook', email = '$email', maps = '$maps' WHERE id_profil_usaha = 1 ");
                                                    if ($update == TRUE) {
                                                        $_SESSION['info'] = 'Berhasil Diubah';
                                                        echo "<script>
                                                                window.location = '?page=pages/profil_usaha/viewprofilusaha'
                                                            </script>";
                                                    } else {
                                                        $_SESSION['info'] = 'Gagal Diubah';
                                                        echo "<script>
                                                            window.location = '?page=pages/profil_usaha/viewprofilusaha'
                                                        </script>";
                                                    }
                                                }

                                                ?>

                                            </div> <!-- /MODAL BODY -->
                                        </div>
                                    </div>
                                </div> <!-- /MODAL -->
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- main -->
</div>