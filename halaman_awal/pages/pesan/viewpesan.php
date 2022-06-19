<?php

if (!isset($_SESSION['level_pelanggan'])) {
    header("location: ?page=halaman_awal/login/login");
    die();
}

$id_user = $_SESSION['id_pelanggan'];
$pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_user='$id_user'")->fetch_array();
$id_pelanggan = $pelanggan['id_pelanggan'];

$paketterbaru = mysqli_query($koneksi, "SELECT * FROM tb_paket ORDER BY id_paket DESC LIMIT 3");


$pesananpaket = mysqli_query($koneksi, "SELECT * FROM tb_sementara LEFT JOIN tb_paket ON tb_sementara.id_paket=tb_paket.id_paket ORDER BY id_sementara DESC");
?>


<!--::header part start::-->
<header class="main_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php include "halaman_awal/components/navbar.php"; ?>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Pilih Pesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!--::exclusive_item_part start::-->
                <div class="container blog_item_section blog_section">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="section_tittle">
                                <h2>Daftar Paket</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $no = 1;
                        foreach ($paketterbaru as $key => $value) : ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="single_blog_item">
                                    <div class="single_blog_img">
                                        <img src="halaman_backend/assets/file/image/paket/<?= $value['gambar_paket'] ?>" alt="" style="height:180px; border-radius:10px">
                                    </div>

                                    <div class="single_blog_text">
                                        <form action="" method="POST">
                                            <span>Rp. <?= number_format($value['harga_paket'], 0, '.', '.'); ?></span>
                                            <h3><?= $value['nama_paket']; ?></h3>
                                            <input type="hidden" name="id_paket" value="<?= $value['id_paket'] ?>">
                                            <input type="hidden" name="harga_paket" value="<?= $value['harga_paket'] ?>">
                                            <input type="hidden" name="jumlah_beli" value="1">
                                            <button type="submit" name="pesan_paket" class="btn btn-success mt-10 form-control">Pesan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>
                <!--::exclusive_item_part end::-->
            </div>
            <div class="col-md-6">
                <div class="card" style="padding: 20px;">
                    <div class="col-md-12 text-left">
                        <h2 class="contact-title">Data Pesanan</h2>
                        <h6 class="mb-3">Lengkapi data pesanan kamu</h6>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                                                        echo $_SESSION['info'];
                                                                    }
                                                                    unset($_SESSION['info']); ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 text-left">
                        <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap :</label>
                                        <input class="form-control text-danger" name="nama_lengkap" id="nama_lengkap" type="text" value="<?= $pelanggan['nama_lengkap'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nohp">No. Handphone :</label>
                                        <input class="form-control text-danger" name="nohp" id="nohp" type="text" value="<?= $pelanggan['nohp'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="display table table-striped table-hover">
                                                <thead style="background-color:aqua;">
                                                    <tr class="text-center">
                                                        <th>No</th>
                                                        <th></th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah Beli</th>
                                                        <th>Sub Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $total = 0;
                                                    foreach ($pesananpaket as $key => $value) : ?>
                                                        <tr>
                                                            <form action="" method="POST">
                                                                <td><?= $no++ ?></td>
                                                                <td>
                                                                    <a href="?page=halaman_awal/pages/pesan/hapuspesanan&id=<?php echo $value['id_paket']; ?>&id_pelanggan=<?= $id_pelanggan; ?>" class="btn btn-danger delete-data"><i class="fas fa-times"></i></a>
                                                                </td>

                                                                <td><?= $value['nama_paket']; ?></td>
                                                                <td><span id="harga" data-harga="<?= $value['harga'] ?>"><?= $value['harga']; ?><span></td>
                                                                <td><input type="number" name="jumlah_beli" value="<?= $value['jumlah_beli']; ?>" min="1" id="jumlah_beli" style="color:red; width:40px"></td>
                                                                <td><?= $value['harga'] * $value['jumlah_beli']; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                                                                    <input type="hidden" name="id_paket" value="<?= $value['id_paket']; ?>">
                                                                    <button type="submit" name="update" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                        <?php $total += $value['harga'] * $value['jumlah_beli']; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="6">Total :</td>
                                                        <td>Rp. <?= $total; ?></td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                                            <button type="submit" class="form-control" name="deleteAll" style="background-color:#22ff00; font-weight:bold; color:white;">Clear</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tgl_antar">Tanggal Antar :</label>
                                        <input class="form-control" name="tgl_antar" id="tgl_antar" type="date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tanggal Antar'" placeholder='Tanggal Antar' required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="note_order">Note Order :</label>
                                        <textarea class="form-control" name="note_order" id="note_order" cols="30" rows="4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan Note Order'" placeholder='Masukan Note Order'></textarea>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top:-5px">
                                    <div class="row">
                                        <div class="col-md-12"> <button type="submit" class="button button-loginForm btn_5 float-right ml-6" name="pesan">Pesan Sekarang</button></div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- ================ contact section end ================= -->
<!-- footer part start-->
<?php include "halaman_awal/components/footer.php"; ?>
<!-- footer part end-->

<?php

// Add Paket
if (isset($_POST['pesan_paket'])) {
    $id_pelanggan = $id_pelanggan;
    $id_paket = $_POST['id_paket'];
    $harga_paket = $_POST['harga_paket'];
    $jumlah_beli = $_POST['jumlah_beli'];

    $cek_paket = mysqli_query($koneksi, "SELECT * FROM tb_sementara WHERE id_paket=$id_paket AND id_pelanggan = $id_pelanggan")->fetch_array();
    if ($cek_paket == NULL) {
        $simpan = mysqli_query($koneksi, "INSERT INTO tb_sementara (`id_pelanggan`,`id_paket`,`harga`, `jumlah_beli`) VALUES ('$id_pelanggan','$id_paket','$harga_paket', '$jumlah_beli')");
    } else {
        $jumlah_beli = $cek_paket['jumlah_beli'] + $jumlah_beli;
        $simpan = $koneksi->query("UPDATE tb_sementara SET jumlah_beli= '$jumlah_beli' WHERE id_paket=$id_paket AND id_pelanggan = $id_pelanggan");
    }
    if ($simpan) {
        $_SESSION['info'] = 'Berhasil Melakukan Pesanan';
        echo "<script>
            window.location.href = '?page=halaman_awal/pages/pesan/viewpesan'</script>";
    } else {
        $_SESSION['info'] = 'Gagal Melakukan Pesanan';
        echo "<script>window.location.href = '?page=halaman_awal/pages/pesan/viewpesan'
              </script>";
    }
}

// Delete Paket
if (isset($_POST['delete'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_paket = $_POST['id_paket'];
    $hapus = $koneksi->query("DELETE FROM tb_sementara WHERE id_pelanggan='$id_pelanggan' AND id_paket='$id_paket'");
    if ($hapus == TRUE) {
        $_SESSION['info'] = 'Berhasil Dihapus';
        echo "<script>
        	window.location = '?page=halaman_awal/pages/pesan/viewpesan'
       	</script>";
    } else {
        $_SESSION['info'] = 'Gagal Dihapus';
        echo "<script>
        	window.location = '?page=halaman_awal/pages/pesan/viewpesan'
       	</script>";
    }
}

// Update Paket
if (isset($_POST['update'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_paket = $_POST['id_paket'];
    $jumlah_beli = $_POST['jumlah_beli'];
    $edit = $koneksi->query("UPDATE tb_sementara SET jumlah_beli= '$jumlah_beli' WHERE id_pelanggan='$id_pelanggan' AND id_paket='$id_paket'");

    if ($edit) {
        $_SESSION['info'] = 'Berhasil Diubah';
        echo "<script>
                            window.location.href = '?page=halaman_awal/pages/pesan/viewpesan'</script>";
    } else {
        $_SESSION['info'] = 'Gagal Diubah';
        echo "<script>window.location.href = '?page=halaman_awal/pages/pesan/viewpesan'
                            </script>";
    }
}

// Delete All Paket
if (isset($_POST['deleteAll'])) {
    $id = $_POST['id_pelanggan'];
    $hapus = $koneksi->query("DELETE FROM tb_sementara WHERE id_pelanggan='$id'");
    if ($hapus == TRUE) {
        $_SESSION['info'] = 'Berhasil Dihapus';
        echo "<script>
        	window.location = '?page=halaman_awal/pages/pesan/viewpesan'
       	</script>";
    } else {
        $_SESSION['info'] = 'Gagal Dihapus';
        echo "<script>
        	window.location = '?page=halaman_awal/pages/pesan/viewpesan'
       	</script>";
    }
}

// 
if (isset($_POST['pesan'])) {
    // Membuat Kode Order Otomatis
    $kode_order = mysqli_query($koneksi, "SELECT COUNT(kode_order) AS jumlahKodeOrder FROM tb_order")->fetch_array();
    $countKodeOrder =  $kode_order['jumlahKodeOrder'];
    $kode_oredr = '';
    if ($countKodeOrder == 0) {
        $kode_order = date("Ymd") . '0001';
    } else {
        // Baca tanggal hari ini
        $today = date("Ymd");
        // Query mencari kode order terakhir yang berawalan tanggal hari ini 
        $ambil = mysqli_query($koneksi, "SELECT max(kode_order) AS terakhirKodeOrder FROM tb_order WHERE kode_order LIKE '$today%'")->fetch_array();
        $kodeOrderTerakhir = $ambil['terakhirKodeOrder'];

        // Baca nomor urut order dari id order terakhir
        $terakhirNoUrut = substr($kodeOrderTerakhir, 8, 4);

        // Nomor urut ditambah 1
        $nextNoUrut = ((int)$terakhirNoUrut) + 1;

        // Membuat format No Order berikutnya
        $kode_order = $today . sprintf('%04s', $nextNoUrut);
    }
    $id_pelanggan = $id_pelanggan;
    $nama_lengkap = $_POST['nama_lengkap'];
    $nohp = $_POST['nohp'];
    $tgl_antar = $_POST['tgl_antar'];
    $tgl_antar = date('Y-m-d', strtotime($tgl_antar));

    $note_order = $_POST['note_order'];
    $status_bayar = 'belum bayar';
    $status_order = 'pending';
    $total = 0;

    // Ambil pesanan sementara 
    $pesanansementara = mysqli_query($koneksi, "SELECT * FROM tb_sementara JOIN tb_paket ON tb_sementara.id_paket=tb_paket.id_paket WHERE id_pelanggan='$id_pelanggan'");
    $sub_harga = 0;
    $total_harga = 0;
    foreach ($pesanansementara as $key => $value) : ?>
        <?php
        $sub_harga = $value['harga'] * $value['jumlah_beli'];
        $total_harga += $sub_harga;
        ?>
    <?php endforeach; ?>
    <?php
    // Insert Data ke tabel order
    $simpanOrder = mysqli_query(
        $koneksi,
        "INSERT INTO tb_order (`kode_order`, `id_pelanggan`,`total_harga`,`status_bayar`, `status_order`,`nama_lengkap`,`nohp`,`tgl_antar`,`note_order`,`harga_tambahan`) VALUES ('$kode_order', '$id_pelanggan', '$total_harga','$status_bayar', '$status_order', '$nama_lengkap','$nohp', '$tgl_antar', '$note_order', NULL)"
    );
    // Ambil id_order dari tabel order yang baru di simpan
    $id_order = $koneksi->insert_id;


    // Delete data pada tabel sementara
    $delete = mysqli_query($koneksi, "DELETE FROM tb_sementara WHERE id_pelanggan='$id_pelanggan'");



    // Insert Data ke tabel order detail
    foreach ($pesanansementara as $key => $value) : ?>
        <?php
        $id_paket = $value['id_paket'];
        $nama_paket = $value['nama_paket'];
        $harga = $value['harga'];
        $jumlah_beli = $value['jumlah_beli'];

        $simpanOrderDetail = mysqli_query($koneksi, "INSERT INTO tb_order_detail (`id_order`,`id_paket`, `id_pelanggan`, `nama_paket`,`harga`,`jumlah_beli` ) VALUES ('$id_order','$id_paket', '$id_pelanggan','$nama_paket', '$harga','$jumlah_beli')");
        ?>
    <?php endforeach; ?>
<?php
    if ($simpanOrder) {
        echo "<script>
                alert('Pesanan Diterima, Tunggu Konfirmasi Pemesanan dan lakukan pembayaran!')
                window.location.href = '?page=halaman_awal/pages/pembayaran/viewpembayaran'
              </script>";
    } else {
        echo "<script>
                alert('Maaf, Anda gagal melakukan pemesanan. Silahkan ulangi kembali proses pemesanan')
                window.location.href = '?page=halaman_awal/pages/pesan/viewpesan'
              </script>";
    }
}
?>