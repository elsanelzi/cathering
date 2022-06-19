<?php

$id = $_GET['id'];

// query mengambil data paket berdasarkan id
$hapusgambarlama = $koneksi->query("SELECT * FROM tb_paket WHERE id_paket = '$id' ")->fetch_assoc();
$gambarlama = $hapusgambarlama['gambar_paket'];

// hapus gambar lama
unlink('assets/file/image/paket/' . $gambarlama);

// Hapus tabel paket berdasarkan id
$hapuspaket = $koneksi->query("DELETE FROM tb_paket WHERE id_paket='$id'");

if ($hapuspaket == TRUE) {
	$_SESSION['info'] = 'Berhasil Dihapus';
	echo "<script>
        	window.location = '?page=pages/paket/viewpaket'
       	</script>";
} else {
	$_SESSION['info'] = 'Gagal Dihapus';
	echo "<script>
        	window.location = '?page=pages/paket/viewpaket'
       	</script>";
}
