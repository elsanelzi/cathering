<?php
$id_pelanggan = $_GET['id_pelanggan'];
$id_paket = $_GET['id'];
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
