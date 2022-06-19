<?php

$id = $_GET['id'];

// Mengambil data pada tabel pimpinan berdasarkan id
$ambil = $koneksi->query("SELECT * FROM tb_pimpinan WHERE id_pimpinan='$id'");
$pecah = $ambil->fetch_array();

// Mengambil id user
$iduser = $pecah['id_user'];

// Hapus data pada tabel user berdasarkan id
$hapus = $koneksi->query("DELETE FROM tb_user WHERE id_user='$iduser'");

// hapus data pada tabel pimpinan berdasarkan id
$hapuspimpinan = $koneksi->query("DELETE FROM tb_pimpinan WHERE id_pimpinan='$id'");

if ($hapuspimpinan == TRUE) {
	$_SESSION['info'] = 'Berhasil Dihapus';
	echo "<script>
        	window.location = '?page=pages/pimpinan/viewpimpinan'
       	</script>";
} else {
	$_SESSION['info'] = 'Gagal Dihapus';
	echo "<script>
        	window.location = '?page=pages/pimpinan/viewpimpinan'
       	</script>";
}
