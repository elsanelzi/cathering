-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2022 pada 10.21
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_catering`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `id_user`, `nama_lengkap`, `username`, `nohp`, `alamat`) VALUES
(5, 5, 'admin4', 'admin', '081234567713', 'Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `kode_order` varchar(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `status_bayar` enum('sudah bayar','belum bayar') NOT NULL,
  `status_order` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `tgl_antar` date NOT NULL,
  `note_order` text DEFAULT NULL,
  `harga_tambahan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `kode_order`, `id_pelanggan`, `total_harga`, `status_bayar`, `status_order`, `nama_lengkap`, `nohp`, `tgl_antar`, `note_order`, `harga_tambahan`) VALUES
(1, '202206170001', 1, 281000, 'sudah bayar', 'selesai', 'Zahra Novita', '083161953796', '2022-06-16', 'Tambahan Telor Ceplok ya', 5000),
(2, '202206180001', 1, 301000, 'belum bayar', 'proses', 'Zahra Novita', '083161953796', '2022-06-18', 'Telur Mata Sapi, Es Campur', 11000),
(3, '202206180002', 2, 217000, 'sudah bayar', 'selesai', 'Juni Safitri', '081342567891', '2022-06-18', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`id_order_detail`, `id_order`, `id_paket`, `id_pelanggan`, `nama_paket`, `harga`, `jumlah_beli`) VALUES
(1, 1, 2, 1, 'Paket 2', 87000, 3),
(2, 1, 4, 1, 'Paket 3', 20000, 1),
(3, 2, 2, 1, 'Paket 2', 87000, 3),
(4, 2, 4, 1, 'Paket 3', 20000, 2),
(5, 3, 2, 2, 'Paket 2', 87000, 1),
(6, 3, 1, 2, 'Paket 1', 65000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar_paket` varchar(255) NOT NULL,
  `harga_paket` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `keterangan`, `gambar_paket`, `harga_paket`) VALUES
(1, 'Paket 1', '<p>Paket 1 : Ayam Bumbu</p>\r\n\r\n<p>2. Ice Cream</p>\r\n', '1655368365_1654017047_ayam goreng1.jpg', 65000),
(2, 'Paket 2', '<p>Paket 2 terdiri dari : 1. Rendang Sapi</p>\r\n\r\n<p>2. Donat</p>\r\n', '1655368891_1654008859_donat.jfif', 87000),
(4, 'Paket 3', '<p>Nasi dan Drink</p>\r\n', '1655369311_1654017156_drinkjarkaca1.jpg', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `id_user`, `nama_lengkap`, `username`, `nohp`, `alamat`) VALUES
(1, 11, 'Zahra Novita', 'zahra', '083161953796', 'Bukittinggi'),
(2, 12, 'Juni Safitri', 'juni', '081342567891', 'Pariaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `total_bayar` double NOT NULL,
  `nama_bank` varchar(30) DEFAULT NULL,
  `nomor_rekening` varchar(30) DEFAULT NULL,
  `atas_nama` varchar(100) DEFAULT NULL,
  `tanggal_bayar` date NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_order`, `total_bayar`, `nama_bank`, `nomor_rekening`, `atas_nama`, `tanggal_bayar`, `bukti_bayar`) VALUES
(1, 1, 286000, 'BNI', '12345678918888', 'Zahra Novita', '2022-06-18', '1655553598_bukti.jpg'),
(2, 3, 217000, 'BCA', '123456789188276', 'Juni Safitri', '2022-05-19', '1655573404_bukti.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pimpinan`
--

CREATE TABLE `tb_pimpinan` (
  `id_pimpinan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pimpinan`
--

INSERT INTO `tb_pimpinan` (`id_pimpinan`, `id_user`, `nama_lengkap`, `username`, `nohp`, `alamat`) VALUES
(1, 8, 'pimpinan1', 'pimpinan1', '081234567764', 'Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil_usaha`
--

CREATE TABLE `tb_profil_usaha` (
  `id_profil_usaha` int(11) NOT NULL,
  `tentang_kami` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `maps` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_profil_usaha`
--

INSERT INTO `tb_profil_usaha` (`id_profil_usaha`, `tentang_kami`, `alamat`, `no_telp`, `no_wa`, `email`, `instagram`, `facebook`, `maps`) VALUES
(1, '<p>Catering A merupakan sebuah usaha catering yang berada dikota Padang, berroperasi sejak tahun 2006</p>\r\n', 'Jati No 3 Padang', '6283161953796', '6283161953796', 'cateringandri@gmail.com', '@cateringandri', 'cateringandri', 'maps');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sementara`
--

CREATE TABLE `tb_sementara` (
  `id_sementara` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','pimpinan','karyawan','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`) VALUES
(5, 'admin', 'admin', 'admin'),
(8, 'pimpinan1', 'pimpinan1', 'pimpinan'),
(11, 'zahra', 'zahra', 'pelanggan'),
(12, 'juni', 'juni', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tb_pimpinan`
--
ALTER TABLE `tb_pimpinan`
  ADD PRIMARY KEY (`id_pimpinan`);

--
-- Indeks untuk tabel `tb_profil_usaha`
--
ALTER TABLE `tb_profil_usaha`
  ADD PRIMARY KEY (`id_profil_usaha`);

--
-- Indeks untuk tabel `tb_sementara`
--
ALTER TABLE `tb_sementara`
  ADD PRIMARY KEY (`id_sementara`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pimpinan`
--
ALTER TABLE `tb_pimpinan`
  MODIFY `id_pimpinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_profil_usaha`
--
ALTER TABLE `tb_profil_usaha`
  MODIFY `id_profil_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_sementara`
--
ALTER TABLE `tb_sementara`
  MODIFY `id_sementara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
