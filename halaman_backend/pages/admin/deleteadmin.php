<?php

$id = $_GET['id'];

// Query mmengambil data dari tabel admin berdasarkan id
$ambil = $koneksi->query("SELECT * FROM tb_admin WHERE id_admin='$id'");
$pecah = $ambil->fetch_array();

$iduser = $pecah['id_user'];

// Query hapus data tabel user berdasarkan id
$hapus = $koneksi->query("DELETE FROM tb_user WHERE id_user='$iduser'");

// Query hapus data tabel admin berdasarkan id
$hapusadmin = $koneksi->query("DELETE FROM tb_admin WHERE id_admin='$id'");

if ($hapus == TRUE) {
	$_SESSION['info'] = 'Berhasil Dihapus';
	echo "<script>
        	window.location = '?page=pages/admin/viewadmin'
       	</script>";
} else {
	$_SESSION['info'] = 'Gagal Dihapus';
	echo "<script>
        	window.location = '?page=pages/admin/viewadmin'
       	</script>";
}
