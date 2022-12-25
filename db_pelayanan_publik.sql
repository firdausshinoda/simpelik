-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Okt 2018 pada 03.32
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pelayanan_publik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_tb_admin` int(10) NOT NULL,
  `nama_admin` varchar(20) DEFAULT NULL,
  `deskripsi_admin` longtext,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `img_admin` varchar(20) DEFAULT NULL,
  `lati` varchar(50) DEFAULT NULL,
  `longi` varchar(50) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_tb_admin`, `nama_admin`, `deskripsi_admin`, `username`, `password`, `img_admin`, `lati`, `longi`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 'Dinas Kesehatan', 'Aduan yang akan kami berupa aduan tentang kesehatan, pemberian atau penerbitan izin di bidang kesehatan di Kota Tegal.', 'dinkes', 'e10adc3949ba59abbe56e057f20f883e', '20180322171110.png', '-6.8554888', '109.1353944', '2018-01-19 18:46:37', '2018-03-22 17:19:11', NULL, 'superadmin', 1, 'admin', 1, NULL, NULL, 1),
(2, 'Dinas Pekerjaan Umum', 'Aduan yang kami terima tentang jalan seperti jalan rusak, berlubang, jembatan, dan trotoar rusak di wilayah Kota Tegal', 'dpu', 'e10adc3949ba59abbe56e057f20f883e', '20180322171353.png', '-6.8568038', '109.1339326', '2018-01-19 18:47:03', '2018-05-27 18:45:59', NULL, 'superadmin', 1, 'admin', 2, NULL, NULL, 1),
(3, 'Dinas Perhubungan', 'Aduan yang dapat kami tindak lanjuti berupa aduan tentang lampu penerangan jalan, lampu lalu lintas, rambu-rambu lalu-lintas, arus angkutan kota, angkutan antar kota, dan antar provinsi di wilayah Kota Tegal', 'dishub', 'e10adc3949ba59abbe56e057f20f883e', '20180322171416.png', '-6.8513583', '109.1404933', '2018-01-19 18:47:15', '2018-03-22 17:21:02', NULL, 'superadmin', 1, 'admin', 3, NULL, NULL, 1),
(4, 'Satpol PP', 'Aduan yang kami tindak lanjuti seperti menertibkan ketertiban umum dan ketenteraman masyarakat di wilayah Kota Tegal.', 'satpolpp', 'e10adc3949ba59abbe56e057f20f883e', '20180322171437.png', '-6.8683346', '109.1353086', '2018-01-19 18:47:30', '2018-03-22 17:21:47', NULL, 'superadmin', 1, 'admin', 4, NULL, NULL, 1),
(5, 'Dinas Lingkungan Hid', 'Aduan yang dapat kami tindak lanjuti seperti menata kebersihan, sampah, dan taman yang berada di wilayah Kota Tegal', 'dinaslingkungan', 'e10adc3949ba59abbe56e057f20f883e', '20180322171457.png', '-6.8579147', '109.1266742', '2018-01-19 18:47:46', '2018-03-22 17:22:39', NULL, 'superadmin', 1, 'admin', 5, NULL, NULL, 1),
(6, 'PLN', 'Pengaduan yang ditangani seperti pemadaman lampu, kesemrawutan kabel listrik, tiang listrik, dan kerusakan tabung listrik pada tiang listrik di wilayah Kota Tegal.', 'pln', '827ccb0eea8a706c4c34a16891f84e7b', '20180322171517.png', '-6.868807227276593', '109.12098944774948', '2018-01-19 18:47:55', '2018-03-22 17:23:21', NULL, 'admin', 6, 'admin', 6, NULL, NULL, 1),
(7, 'PDAM', 'Aduan yang dapat kami tindak lanjuti seperti pipa kebocoran, penggalian pipa yang tidak kembali rapi seperti sebelumnya di wilayah Kota Tegal.', 'pdam', 'e10adc3949ba59abbe56e057f20f883e', '20180322171534.png', '-6.8582288', '109.1486541', '2018-01-19 18:48:08', '2018-03-22 17:24:25', NULL, 'superadmin', 1, 'admin', 7, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aduan`
--

CREATE TABLE IF NOT EXISTS `tb_aduan` (
  `id_tb_aduan` int(10) NOT NULL,
  `id_tb_user` int(10) DEFAULT NULL,
  `id_tb_admin` int(10) DEFAULT NULL,
  `isi_aduan` longtext,
  `lati` varchar(50) DEFAULT NULL,
  `longi` varchar(50) DEFAULT NULL,
  `stt_notif_admin` int(1) DEFAULT '1',
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_aduan`
--

INSERT INTO `tb_aduan` (`id_tb_aduan`, `id_tb_user`, `id_tb_admin`, `isi_aduan`, `lati`, `longi`, `stt_notif_admin`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 8, 3, 'Untuk lampu lalu lintas diatas supaya diganti dengan yang baru mengingat sudah lama tidak ada. Mohon untuk disegera di betulkan.', '-6.866430907797326', '109.13351822644472', 0, '2018-03-22 02:15:40', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(2, 11, 2, 'Supaya lebih ditata kembali biar lebih tertata dan sudah banyak tanaman yg rusak dan pagar sudah roboh.', '-6.8673399786635505', '109.14179384708405', 0, '2018-03-22 02:21:39', '2018-03-22 02:22:19', '2018-03-24 17:12:01', 'user', 11, 'user', 11, 'superadmin', 1, 1),
(3, 9, 2, 'Mohon kepada dinas pekerjaan umum untuk menambal jalan yg berlubang karena bekas galian kabel karena berdiameter lumayan dalam.', '-6.874157455475663', '109.10859916359186', 0, '2018-04-07 00:44:17', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_comment_aduan`
--

CREATE TABLE IF NOT EXISTS `tb_comment_aduan` (
  `id_tb_comment_aduan` int(10) NOT NULL,
  `id_tb_aduan` int(10) DEFAULT NULL,
  `id_tb_user` int(10) DEFAULT NULL,
  `id_tb_admin` int(10) DEFAULT NULL,
  `isi_comment` longtext,
  `img_comment` varchar(20) DEFAULT '',
  `stt_notif_admin` int(1) DEFAULT '0',
  `stt_notif_user` int(1) DEFAULT '0',
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_comment_aduan`
--

INSERT INTO `tb_comment_aduan` (`id_tb_comment_aduan`, `id_tb_aduan`, `id_tb_user`, `id_tb_admin`, `isi_comment`, `img_comment`, `stt_notif_admin`, `stt_notif_user`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 1, NULL, 3, 'Terimakasih atas aduan yang telah disampaikan, untuk penggantian lampu lalu lintas baru sedang dalam proses pemesanan tinggal nanti kami pasang yang baru lagi setelah selesai proses pemesanan. ', '', 0, 0, '2018-03-22 17:30:21', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(2, 1, 8, NULL, 'Baik pak terimakasih atas responya..', '', 0, 0, '2018-03-22 23:51:46', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(3, 1, 11, NULL, 'Semoga cepat terealisasi..\\uD83D\\uDE42', '', 0, 0, '2018-03-23 22:52:14', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gallery_admin`
--

CREATE TABLE IF NOT EXISTS `tb_gallery_admin` (
  `id_tb_gallery_admin` int(10) NOT NULL,
  `id_tb_admin` int(10) DEFAULT NULL,
  `img_gallery_admin` varchar(20) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gallery_admin`
--

INSERT INTO `tb_gallery_admin` (`id_tb_gallery_admin`, `id_tb_admin`, `img_gallery_admin`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(5, 1, '180318191351.JPG', '2018-03-18 19:13:51', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(6, 2, '180318191416.JPG', '2018-03-18 19:14:16', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(7, 3, '180318191451.jpg', '2018-03-18 19:14:51', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(8, 4, '180318191511.jpg', '2018-03-18 19:15:11', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(9, 5, '180318191536.JPG', '2018-03-18 19:15:36', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(10, 7, '180318191602.jpg', '2018-03-18 19:16:02', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(11, 6, '180318192006.PNG', '2018-03-18 19:20:06', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gallery_aduan`
--

CREATE TABLE IF NOT EXISTS `tb_gallery_aduan` (
  `id_tb_gallery_aduan` int(10) NOT NULL,
  `id_tb_aduan` int(10) DEFAULT NULL,
  `img_gallery_aduan` varchar(20) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gallery_aduan`
--

INSERT INTO `tb_gallery_aduan` (`id_tb_gallery_aduan`, `id_tb_aduan`, `img_gallery_aduan`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 1, '1803212015410.jpg', '2018-03-22 02:15:40', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(2, 1, '1803212015411.jpg', '2018-03-22 02:15:40', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(3, 2, '1803212021400.jpg', '2018-03-22 02:21:39', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(4, 2, '1803212021401.jpg', '2018-03-22 02:21:39', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(5, 3, '1804061944160.jpg', '2018-04-07 00:44:17', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(6, 3, '1804061944161.jpg', '2018-04-07 00:44:17', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(7, 3, '1804061944162.jpg', '2018-04-07 00:44:17', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gallery_lokasi_tempat_umum`
--

CREATE TABLE IF NOT EXISTS `tb_gallery_lokasi_tempat_umum` (
  `id_tb_gallery_lokasi_umum` int(10) NOT NULL,
  `id_tb_lokasi_tempat_umum` int(10) DEFAULT NULL,
  `img_gallery_lokasi_tempat_umum` varchar(20) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gallery_lokasi_tempat_umum`
--

INSERT INTO `tb_gallery_lokasi_tempat_umum` (`id_tb_gallery_lokasi_umum`, `id_tb_lokasi_tempat_umum`, `img_gallery_lokasi_tempat_umum`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 4, '180317204203.PNG', '2018-03-17 20:42:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(2, 4, '180317204204.PNG', '2018-03-17 20:42:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(3, 4, '1803172042041.PNG', '2018-03-17 20:42:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(4, 4, '180317204205.PNG', '2018-03-17 20:42:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(5, 5, '180317204354.PNG', '2018-03-17 20:43:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(6, 5, '180317204355.PNG', '2018-03-17 20:43:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(7, 5, '180317204356.PNG', '2018-03-17 20:43:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(8, 5, '180317204357.PNG', '2018-03-17 20:43:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(9, 2, '180317204433.PNG', '2018-03-17 20:44:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(10, 2, '180317204434.PNG', '2018-03-17 20:44:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(11, 2, '180317204435.PNG', '2018-03-17 20:44:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(12, 2, '180317204436.PNG', '2018-03-17 20:44:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(13, 3, '180317204501.PNG', '2018-03-17 20:45:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(14, 3, '180317204502.PNG', '2018-03-17 20:45:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(15, 3, '1803172045021.PNG', '2018-03-17 20:45:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(16, 3, '180317204503.PNG', '2018-03-17 20:45:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(17, 1, '180317204525.PNG', '2018-03-17 20:45:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(18, 1, '180317204526.PNG', '2018-03-17 20:45:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(19, 1, '180317204527.PNG', '2018-03-17 20:45:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(20, 1, '1803172045271.PNG', '2018-03-17 20:45:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(21, 7, '180317221148.PNG', '2018-03-17 22:11:48', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(22, 7, '180317221149.PNG', '2018-03-17 22:11:48', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(23, 7, '180317221150.PNG', '2018-03-17 22:11:48', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(24, 7, '1803172211501.PNG', '2018-03-17 22:11:48', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(25, 11, '180317221218.PNG', '2018-03-17 22:12:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(26, 11, '1803172212181.PNG', '2018-03-17 22:12:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(27, 11, '180317221219.PNG', '2018-03-17 22:12:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(28, 11, '1803172212191.PNG', '2018-03-17 22:12:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(29, 9, '180317221304.PNG', '2018-03-17 22:13:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(30, 9, '180317221305.PNG', '2018-03-17 22:13:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(31, 9, '180317221306.PNG', '2018-03-17 22:13:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(32, 9, '180317221307.PNG', '2018-03-17 22:13:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(33, 8, '180317221327.PNG', '2018-03-17 22:13:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(34, 8, '180317221328.PNG', '2018-03-17 22:13:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(35, 8, '1803172213281.PNG', '2018-03-17 22:13:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(36, 8, '180317221329.PNG', '2018-03-17 22:13:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(37, 6, '180317221350.PNG', '2018-03-17 22:13:50', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(38, 6, '180317221351.PNG', '2018-03-17 22:13:50', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(39, 6, '180317221352.PNG', '2018-03-17 22:13:50', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(40, 6, '1803172213521.PNG', '2018-03-17 22:13:50', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(41, 15, '180317221409.PNG', '2018-03-17 22:14:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(42, 15, '180317221410.PNG', '2018-03-17 22:14:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(43, 15, '180317221411.PNG', '2018-03-17 22:14:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(44, 15, '180317221412.PNG', '2018-03-17 22:14:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(45, 13, '180317221427.PNG', '2018-03-17 22:14:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(46, 13, '180317221428.PNG', '2018-03-17 22:14:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(47, 13, '1803172214281.PNG', '2018-03-17 22:14:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(48, 13, '180317221429.PNG', '2018-03-17 22:14:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(49, 12, '180317221447.PNG', '2018-03-17 22:14:47', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(50, 12, '180317221448.PNG', '2018-03-17 22:14:47', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(51, 12, '180317221449.PNG', '2018-03-17 22:14:47', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(52, 12, '180317221450.PNG', '2018-03-17 22:14:47', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(53, 16, '180318174445.PNG', '2018-03-18 17:44:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(54, 17, '180318174842.PNG', '2018-03-18 17:48:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(55, 18, '180318175018.PNG', '2018-03-18 17:50:18', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(56, 19, '180318175152.PNG', '2018-03-18 17:51:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(57, 19, '180318175153.PNG', '2018-03-18 17:51:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(58, 20, '180318175422.PNG', '2018-03-18 17:54:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(59, 20, '180318175423.PNG', '2018-03-18 17:54:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(60, 21, '180318175604.PNG', '2018-03-18 17:56:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(61, 21, '180318175605.PNG', '2018-03-18 17:56:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(62, 22, '180318175836.PNG', '2018-03-18 17:58:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(63, 22, '180318175837.PNG', '2018-03-18 17:58:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(64, 22, '180318175838.PNG', '2018-03-18 17:58:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(65, 23, '180318180146.PNG', '2018-03-18 18:01:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(66, 23, '1803181801461.PNG', '2018-03-18 18:01:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(67, 23, '180318180147.PNG', '2018-03-18 18:01:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(68, 24, '180318180326.PNG', '2018-03-18 18:03:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(69, 24, '180318180327.PNG', '2018-03-18 18:03:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(70, 24, '1803181803271.PNG', '2018-03-18 18:03:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(71, 25, '180318180619.PNG', '2018-03-18 18:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(72, 25, '180318180620.PNG', '2018-03-18 18:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(73, 25, '180318180621.PNG', '2018-03-18 18:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(74, 26, '180318180846.PNG', '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(75, 26, '180318180847.PNG', '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(76, 26, '180318180848.PNG', '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(77, 26, '180318180849.PNG', '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(78, 27, '180318181050.PNG', '2018-03-18 18:10:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(79, 27, '180318181051.PNG', '2018-03-18 18:10:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(80, 27, '180318181052.PNG', '2018-03-18 18:10:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(81, 28, '180318181408.PNG', '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(82, 28, '1803181814081.PNG', '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(83, 28, '180318181409.PNG', '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(84, 28, '1803181814091.PNG', '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(85, 29, '180318181723.PNG', '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(86, 29, '180318181724.PNG', '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(87, 29, '1803181817241.PNG', '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(88, 29, '180318181725.PNG', '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(89, 30, '180318181923.PNG', '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(90, 30, '180318181924.PNG', '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(91, 30, '1803181819241.PNG', '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(92, 30, '180318181925.PNG', '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(93, 31, '180318182103.PNG', '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(94, 31, '1803181821031.PNG', '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(95, 31, '180318182104.PNG', '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(96, 31, '180318182105.PNG', '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(97, 32, '180318182450.PNG', '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(98, 32, '1803181824501.PNG', '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(99, 32, '180318182451.PNG', '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(100, 32, '1803181824511.PNG', '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(101, 33, '180318182648.PNG', '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(102, 33, '1803181826481.PNG', '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(103, 33, '180318182649.PNG', '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(104, 33, '180318182650.PNG', '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(105, 34, '180318182904.PNG', '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(106, 34, '180318182905.PNG', '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(107, 34, '1803181829051.PNG', '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(108, 34, '180318182906.PNG', '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(109, 35, '180318183234.PNG', '2018-03-18 18:32:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(110, 35, '180318183235.PNG', '2018-03-18 18:32:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(111, 35, '1803181832351.PNG', '2018-03-18 18:32:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(112, 36, '180318183516.PNG', '2018-03-18 18:35:16', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(113, 36, '180318183517.PNG', '2018-03-18 18:35:16', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(114, 37, '180318183655.PNG', '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(115, 37, '1803181836551.PNG', '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(116, 37, '180318183656.PNG', '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(117, 37, '180318183657.PNG', '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(118, 38, '180318183845.PNG', '2018-03-18 18:38:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(119, 38, '180318183846.PNG', '2018-03-18 18:38:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(120, 39, '180318184156.PNG', '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(121, 39, '180318184157.PNG', '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(122, 39, '1803181841571.PNG', '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(123, 39, '180318184158.PNG', '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(124, 40, '180318184511.PNG', '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(125, 40, '180318184512.PNG', '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(126, 40, '1803181845121.PNG', '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(127, 40, '180318184513.PNG', '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(128, 41, '180318184720.PNG', '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(129, 41, '180318184721.PNG', '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(130, 41, '1803181847211.PNG', '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(131, 41, '180318184722.PNG', '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(132, 42, '180318184931.PNG', '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(133, 42, '180318184932.PNG', '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(134, 42, '1803181849321.PNG', '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(135, 42, '1803181849322.PNG', '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(136, 43, '180318185350.PNG', '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(137, 43, '180318185351.PNG', '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(138, 43, '1803181853511.PNG', '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(139, 43, '180318185352.PNG', '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(140, 44, '180318185609.PNG', '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(141, 44, '180318185610.PNG', '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(142, 44, '180318185611.PNG', '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(143, 44, '1803181856111.PNG', '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(144, 45, '180318185854.PNG', '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(145, 45, '180318185855.PNG', '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(146, 45, '180318185856.PNG', '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(147, 45, '1803181858561.PNG', '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(148, 46, '180318190139.PNG', '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(149, 46, '180318190140.PNG', '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(150, 46, '1803181901401.PNG', '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(151, 46, '180318190141.PNG', '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(152, 47, '180318190452.PNG', '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(153, 47, '180318190453.PNG', '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(154, 47, '180318190454.PNG', '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(155, 47, '180318190455.PNG', '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_lokasi_tempat_umum`
--

CREATE TABLE IF NOT EXISTS `tb_jenis_lokasi_tempat_umum` (
  `id_tb_jenis_lokasi_tempat_umum` int(10) NOT NULL,
  `nama_jenis_lokasi` varchar(20) DEFAULT NULL,
  `icon_materialize` varchar(35) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis_lokasi_tempat_umum`
--

INSERT INTO `tb_jenis_lokasi_tempat_umum` (`id_tb_jenis_lokasi_tempat_umum`, `nama_jenis_lokasi`, `icon_materialize`, `cdate`, `mdate`, `ddate`, `deleted_flage`) VALUES
(1, 'Caffe', 'local_cafe', '2018-01-22 00:00:00', NULL, NULL, 1),
(2, 'Tempat Perbelanjaan', 'local_grocery_store', '2018-01-28 20:02:08', NULL, NULL, 1),
(3, 'Tempat Makan', 'restaurant_menu', '2018-03-18 17:38:58', NULL, NULL, 1),
(4, 'Tempat Hiburan', 'local_play', '2018-03-18 17:41:12', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_like_aduan`
--

CREATE TABLE IF NOT EXISTS `tb_like_aduan` (
  `id_tb_like_aduan` int(10) NOT NULL,
  `id_tb_aduan` int(10) DEFAULT NULL,
  `id_tb_user` int(10) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_like_aduan`
--

INSERT INTO `tb_like_aduan` (`id_tb_like_aduan`, `id_tb_aduan`, `id_tb_user`, `cdate`, `mdate`, `deleted_flage`) VALUES
(1, 1, 11, '2018-03-22 02:19:54', '2018-03-22 02:20:01', 1),
(2, 2, 11, '2018-03-22 02:23:20', '2018-03-22 02:23:21', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
  `id_tb_log` int(10) NOT NULL,
  `keterangan` longtext,
  `id_tb_user` int(10) DEFAULT '0',
  `id_tb_admin` int(10) DEFAULT '0',
  `id_tb_superadmin` int(10) DEFAULT '0',
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id_tb_log`, `keterangan`, `id_tb_user`, `id_tb_admin`, `id_tb_superadmin`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 'Admin mengkonfirmasi tempat umum dengan nama nirmala', 0, 6, 0, '2018-02-26 09:01:15', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(2, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, '2018-02-26 09:13:10', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(3, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, '2018-02-26 09:13:13', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(4, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, '2018-02-26 09:13:14', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(5, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, '2018-02-26 09:13:16', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(6, 'Admin mengkonfirmasi tempat umum dengan nama Caffe Canopoint', 0, 6, 0, '2018-02-26 09:22:24', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(7, 'Admin mengkonfirmasi tempat umum dengan nama RIta Mall', 0, 6, 0, '2018-02-26 09:22:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(8, 'Admin mengkonfirmasi tempat umum dengan nama EatBos', 0, 6, 0, '2018-02-26 09:22:30', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(9, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, '2018-02-26 09:22:31', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(10, 'Pengguna admin mengubah peta lokasi admin', 0, 6, 0, '2018-02-27 10:02:03', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(11, 'Pengguna admin mengubah peta lokasi admin', 0, 6, 0, '2018-02-27 10:02:25', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(12, 'Pengguna admin mengubah peta lokasi admin', 0, 6, 0, '2018-02-27 10:05:17', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(13, 'Pengguna admin mengubah peta lokasi admin', 0, 6, 0, '2018-02-27 10:07:24', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(14, 'Pengguna admin memberikan komentar', 0, 6, 0, '2018-02-27 10:11:20', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(15, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-27 03:38:06', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(16, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-02-27 03:41:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(17, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-02-27 03:42:05', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(18, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-02-27 03:42:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(19, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-02-27 04:12:00', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(20, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-27 04:12:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(21, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-02-27 04:14:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(22, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-27 04:14:52', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(23, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-02-27 04:24:08', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(24, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-02-27 04:24:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(25, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-02-27 05:22:41', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(26, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-27 22:36:56', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(27, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-28 04:49:45', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(28, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-02-28 06:07:17', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(29, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-28 06:15:29', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(30, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-02-28 13:32:07', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(31, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-02-28 16:34:01', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(32, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-02-28 16:34:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(33, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 08:28:13', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(34, 'Admin tidak mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 6, 0, NULL, NULL, '2018-03-01 08:41:45', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(35, 'Admin tidak mengkonfirmasi tempat umum dengan nama EatBos', 0, 6, 0, NULL, NULL, '2018-03-01 08:41:48', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(36, 'Admin mengkonfirmasi tempat umum dengan nama Caffe Canopoint', 0, 6, 0, '2018-03-01 08:42:12', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(37, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 08:43:20', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(38, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-01 08:43:29', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(39, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-01 08:46:49', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(40, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 08:46:56', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(41, 'Pengguna masyarakat sign-in ke aplikasi', 9, 0, 0, '2018-03-01 09:37:59', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(42, 'Pengguna masyarakat memberikan komentar', 9, 0, 0, '2018-03-01 15:41:42', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(43, 'Pengguna masyarakat memberikan komentar', 9, 0, 0, '2018-03-01 15:42:27', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(44, 'Pengguna masyarakat sign-in ke aplikasi', 9, 0, 0, '2018-03-01 09:54:02', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(45, 'Pengguna masyarakat memberikan komentar', 9, 0, 0, '2018-03-01 16:57:44', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(46, 'Pengguna masyarakat memberikan komentar', 9, 0, 0, '2018-03-01 16:58:05', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(47, 'Pengguna masyarakat memberikan komentar', 9, 0, 0, '2018-03-01 17:06:56', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(48, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 10:12:32', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(49, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 10:12:37', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(50, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 10:34:39', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(51, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 10:40:10', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(52, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 10:41:33', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(53, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 10:41:37', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(54, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 10:41:40', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(55, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-01 10:46:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(56, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-01 10:48:49', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(57, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 10:48:55', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(58, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 10:53:56', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(59, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-01 10:54:31', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(60, 'Admin menghapus aduan user', 0, 6, 0, NULL, NULL, '2018-03-01 12:11:36', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(61, 'Admin menghapus aduan user', 0, 6, 0, NULL, NULL, '2018-03-01 12:15:14', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(62, 'Admin menghapus aduan user', 0, 6, 0, NULL, NULL, '2018-03-01 12:17:02', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(63, 'Admin menghapus aduan user', 0, 6, 0, NULL, NULL, '2018-03-01 12:19:12', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(64, 'Admin menghapus aduan user', 0, 6, 0, NULL, NULL, '2018-03-01 12:21:24', NULL, NULL, NULL, NULL, 'admin', 6, 1),
(65, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-01 12:26:34', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(66, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-01 12:29:10', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(67, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-01 18:21:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(68, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-02 09:20:13', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(69, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-02 12:42:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(70, 'Admin tidak mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 5, 0, NULL, NULL, '2018-03-03 00:01:04', NULL, NULL, NULL, NULL, 'admin', 5, 1),
(71, 'Admin mengkonfirmasi tempat umum dengan nama Caffe Canopoint', 0, 6, 0, '2018-03-03 00:01:08', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(72, 'Admin mengkonfirmasi tempat umum dengan nama EatBos', 0, 7, 0, '2018-03-03 00:01:10', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(73, 'Admin mengkonfirmasi tempat umum dengan nama RIta Mall', 0, 8, 0, '2018-03-03 00:01:12', NULL, NULL, 'admin', 8, NULL, NULL, NULL, NULL, 1),
(74, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 5, 0, '2018-03-03 00:03:46', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(75, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 5, 0, '2018-03-03 00:11:00', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(76, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 5, 0, '2018-03-03 00:13:19', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(77, 'Admin mengkonfirmasi tempat umum dengan nama Nakula Caffe', 0, 5, 0, '2018-03-03 00:15:02', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(78, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-02 17:45:22', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(79, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-02 19:15:32', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(80, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-02 19:15:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(81, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-02 19:17:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(82, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-02 19:18:05', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(83, 'Admin mengubah profil', 0, 6, 0, '2018-03-02 20:46:12', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(84, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-02 20:56:35', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(85, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-02 20:56:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(86, 'Superadmin menghapus aduan user', 0, 1, 0, NULL, NULL, '2018-03-02 21:02:56', NULL, NULL, NULL, NULL, 'superadmin', 1, 1),
(87, 'Superadmin menghapus aduan user', 0, 1, 0, NULL, NULL, '2018-03-02 21:04:38', NULL, NULL, NULL, NULL, 'superadmin', 1, 1),
(88, 'Superadmin menghapus aduan user', 0, 1, 0, NULL, NULL, '2018-03-02 21:05:00', NULL, NULL, NULL, NULL, 'superadmin', 1, 1),
(89, 'Superadmin menghapus aduan user', 0, 1, 0, NULL, NULL, '2018-03-02 21:15:04', NULL, NULL, NULL, NULL, 'superadmin', 1, 1),
(90, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-05 09:51:32', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(91, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-05 18:37:19', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(92, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-06 03:39:32', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(93, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-06 12:12:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(94, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-07 12:34:15', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(95, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-07 14:35:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(96, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-07 12:39:24', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(97, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-08 05:04:15', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(98, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-08 08:14:17', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(99, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-08 13:05:52', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(100, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-09 13:54:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(101, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-10 04:11:38', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(102, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-10 10:09:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(103, 'Superadmin mengubah profil superadmin dengan nama baru Pemerintah Kota Tegal', 0, 0, 1, '2018-03-10 10:28:32', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(104, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-10 10:30:47', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(105, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-10 15:24:12', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(106, 'Pengguna instansi dengan nama PLN masuk ke aplikasi mobile', 0, 6, 0, '2018-03-10 22:29:11', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(107, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-10 16:49:49', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(108, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-10 16:50:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(109, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-10 16:50:16', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(110, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-10 16:56:03', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(111, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-10 16:56:13', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(112, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-11 02:11:58', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(113, 'Superadmin menambahkan user dengan nama AGOES SOEHARNO', 0, 0, 1, '2018-03-11 02:39:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(114, 'Superadmin menambahkan user dengan nama MAEMUNAH', 0, 0, 1, '2018-03-11 02:41:53', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(115, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-11 02:46:30', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(116, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-11 02:46:37', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(117, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-11 02:46:52', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(118, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-11 02:47:00', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(119, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-11 02:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(120, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-11 02:47:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(121, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-11 02:47:40', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(122, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-11 02:47:47', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(123, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-11 03:14:23', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(124, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-11 03:17:29', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(125, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-12 09:04:55', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(126, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-12 10:23:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(127, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-12 10:23:49', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(128, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-13 02:52:07', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(129, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-13 10:22:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(130, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-13 10:33:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(131, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-14 18:16:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(132, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-14 18:19:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(133, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-14 19:30:47', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(134, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-15 05:14:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(135, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-15 13:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(136, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-16 00:06:51', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(137, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-16 09:22:11', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(138, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-16 09:24:06', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(139, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-01-17 19:39:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(140, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-17 19:40:30', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(141, 'Superadmin menambahkan tempat umum dengan nama Rita Mall', 0, 0, 1, '2018-03-17 19:42:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(142, 'Superadmin menambahkan tempat umum dengan nama Pasific Mall', 0, 0, 1, '2018-03-17 19:45:06', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(143, 'Superadmin menambahkan tempat umum dengan nama Transmart', 0, 0, 1, '2018-03-17 19:47:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(144, 'Superadmin menambahkan tempat umum dengan nama Yogya Mall', 0, 0, 1, '2018-03-17 19:47:43', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(145, 'Superadmin menambahkan tempat umum dengan nama Super Indo Debe Mall', 0, 0, 1, '2018-03-17 19:49:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(146, 'Superadmin menambahkan tempat umum dengan nama Caffe Bean Transmart', 0, 0, 1, '2018-03-17 19:51:44', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(147, 'Superadmin menambahkan tempat umum dengan nama Waroeng Sadewa', 0, 0, 1, '2018-03-17 19:54:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(148, 'Superadmin menambahkan tempat umum dengan nama EatBoss Tegal', 0, 0, 1, '2018-03-17 19:55:38', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(149, 'Superadmin menambahkan tempat umum dengan nama Caffe Yaul', 0, 0, 1, '2018-03-17 19:58:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(150, 'Superadmin menambahkan tempat umum dengan nama Caffe Pirly', 0, 0, 1, '2018-03-17 19:59:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(151, 'Superadmin menambahkan tempat umum dengan nama Boss''A Caffe', 0, 0, 1, '2018-03-17 20:01:17', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(152, 'Superadmin menambahkan tempat umum dengan nama My Story', 0, 0, 1, '2018-03-17 20:02:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(153, 'Superadmin menambahkan tempat umum dengan nama Awe Chocolate And Milk', 0, 0, 1, '2018-03-17 20:03:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(154, 'Superadmin menambahkan tempat umum dengan nama Dewi Caffe', 0, 0, 1, '2018-03-17 20:04:28', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(155, 'Superadmin menambahkan tempat umum dengan nama Wijikopi', 0, 0, 1, '2018-03-17 20:05:42', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(156, 'Superadmin menambahkan foto tempat umum dengan nama 180317204205.PNG', 0, 0, 1, '2018-03-17 20:42:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(157, 'Superadmin menambahkan foto tempat umum dengan nama 180317204357.PNG', 0, 0, 1, '2018-03-17 20:43:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(158, 'Superadmin menambahkan foto tempat umum dengan nama 180317204436.PNG', 0, 0, 1, '2018-03-17 20:44:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(159, 'Superadmin menambahkan foto tempat umum dengan nama 180317204503.PNG', 0, 0, 1, '2018-03-17 20:45:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(160, 'Superadmin menambahkan foto tempat umum dengan nama 1803172045271.PNG', 0, 0, 1, '2018-03-17 20:45:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(161, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-17 20:46:49', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(162, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-17 20:46:56', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(163, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-17 21:52:51', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(164, 'Admin menambahkan foto tempat umum dengan nama 1803172211501.PNG', 0, 6, 0, '2018-03-17 22:11:48', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(165, 'Admin menambahkan foto tempat umum dengan nama 1803172212191.PNG', 0, 6, 0, '2018-03-17 22:12:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(166, 'Admin menambahkan foto tempat umum dengan nama 180317221307.PNG', 0, 6, 0, '2018-03-17 22:13:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(167, 'Admin menambahkan foto tempat umum dengan nama 180317221329.PNG', 0, 6, 0, '2018-03-17 22:13:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(168, 'Admin menambahkan foto tempat umum dengan nama 1803172213521.PNG', 0, 6, 0, '2018-03-17 22:13:50', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(169, 'Admin menambahkan foto tempat umum dengan nama 180317221412.PNG', 0, 6, 0, '2018-03-17 22:14:09', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(170, 'Admin menambahkan foto tempat umum dengan nama 180317221429.PNG', 0, 6, 0, '2018-03-17 22:14:27', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(171, 'Admin menambahkan foto tempat umum dengan nama 180317221450.PNG', 0, 6, 0, '2018-03-17 22:14:47', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(172, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-18 17:37:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(173, 'Superadmin menambahkan jenis tempat umum dengan nama Tempat Makan', 0, 0, 1, '2018-03-18 17:38:58', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(174, 'Superadmin menambahkan jenis tempat umum dengan nama Tempat Hiburan', 0, 0, 1, '2018-03-18 17:41:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(175, 'Superadmin menambahkan tempat umum dengan nama Warung Makan Sate Kumis', 0, 0, 1, '2018-03-18 17:44:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(176, 'Superadmin menambahkan tempat umum dengan nama R.M. Berkah Lesehan', 0, 0, 1, '2018-03-18 17:48:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(177, 'Superadmin menambahkan tempat umum dengan nama Ikan Bakar Mas Bro', 0, 0, 1, '2018-03-18 17:50:18', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(178, 'Superadmin menambahkan tempat umum dengan nama RM. Sauto Rawi', 0, 0, 1, '2018-03-18 17:51:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(179, 'Superadmin menambahkan tempat umum dengan nama Sate Rizki Tegal', 0, 0, 1, '2018-03-18 17:54:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(180, 'Superadmin menambahkan tempat umum dengan nama Pondok Sate Gule', 0, 0, 1, '2018-03-18 17:56:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(181, 'Superadmin menambahkan tempat umum dengan nama W.M. Tanjung Bintang', 0, 0, 1, '2018-03-18 17:58:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(182, 'Superadmin menambahkan tempat umum dengan nama Warung Makan Simpati', 0, 0, 1, '2018-03-18 18:01:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(183, 'Superadmin menambahkan tempat umum dengan nama Pecel Lele', 0, 0, 1, '2018-03-18 18:03:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(184, 'Superadmin menambahkan tempat umum dengan nama Warung Makan Lamongan', 0, 0, 1, '2018-03-18 18:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(185, 'Superadmin menambahkan tempat umum dengan nama RM Sariminang', 0, 0, 1, '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(186, 'Superadmin menambahkan tempat umum dengan nama RM.sate Kambing Eva', 0, 0, 1, '2018-03-18 18:10:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(187, 'Superadmin menambahkan tempat umum dengan nama Rumah Makan D''Pawon', 0, 0, 1, '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(188, 'Superadmin menambahkan tempat umum dengan nama MCD Tegal', 0, 0, 1, '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(189, 'Superadmin menambahkan tempat umum dengan nama KFC Tegal', 0, 0, 1, '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(190, 'Superadmin menambahkan tempat umum dengan nama Richeese Factory Tegal', 0, 0, 1, '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(191, 'Superadmin menambahkan tempat umum dengan nama RM. Padang Indonesia', 0, 0, 1, '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(192, 'Superadmin menambahkan tempat umum dengan nama RM Sari Sedap', 0, 0, 1, '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(193, 'Superadmin menambahkan tempat umum dengan nama RM. Semeru', 0, 0, 1, '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(194, 'Superadmin menambahkan tempat umum dengan nama Rumah Makan Indah', 0, 0, 1, '2018-03-18 18:32:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(195, 'Superadmin menambahkan tempat umum dengan nama RM. Prima Rasa', 0, 0, 1, '2018-03-18 18:35:16', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(196, 'Superadmin menambahkan tempat umum dengan nama RM Dewi', 0, 0, 1, '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(197, 'Superadmin menambahkan tempat umum dengan nama RM Es Sari Buah', 0, 0, 1, '2018-03-18 18:38:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(198, 'Superadmin menambahkan tempat umum dengan nama Pondok Sate Kambing Muda', 0, 0, 1, '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(199, 'Superadmin menambahkan tempat umum dengan nama Gerbang Mas Bahari', 0, 0, 1, '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(200, 'Superadmin menambahkan tempat umum dengan nama Rita Park', 0, 0, 1, '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(201, 'Superadmin menambahkan tempat umum dengan nama Win''s Spa & Karaoke', 0, 0, 1, '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(202, 'Superadmin menambahkan tempat umum dengan nama Transtudio Mini', 0, 0, 1, '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(203, 'Superadmin menambahkan tempat umum dengan nama Inul Vista', 0, 0, 1, '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(204, 'Superadmin menambahkan tempat umum dengan nama Poci Park', 0, 0, 1, '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(205, 'Superadmin menambahkan tempat umum dengan nama Orange Karaoke', 0, 0, 1, '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(206, 'Superadmin menambahkan tempat umum dengan nama Karaoke Happy', 0, 0, 1, '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(207, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-18 19:12:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(208, 'Admin sign-in ke aplikasi', 0, 1, 0, '2018-03-18 19:13:16', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(209, 'Admin menambahkan gallery', 0, 1, 0, '2018-03-18 19:13:51', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(210, 'Admin log-out dari aplikasi', 0, 1, 0, '2018-03-18 19:14:01', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(211, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-03-18 19:14:07', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(212, 'Admin menambahkan gallery', 0, 2, 0, '2018-03-18 19:14:16', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(213, 'Admin log-out dari aplikasi', 0, 2, 0, '2018-03-18 19:14:24', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(214, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-18 19:14:36', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(215, 'Admin menambahkan gallery', 0, 3, 0, '2018-03-18 19:14:51', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(216, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-18 19:14:56', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(217, 'Admin sign-in ke aplikasi', 0, 4, 0, '2018-03-18 19:15:03', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(218, 'Admin menambahkan gallery', 0, 4, 0, '2018-03-18 19:15:11', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(219, 'Admin log-out dari aplikasi', 0, 4, 0, '2018-03-18 19:15:17', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(220, 'Admin sign-in ke aplikasi', 0, 5, 0, '2018-03-18 19:15:28', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(221, 'Admin menambahkan gallery', 0, 5, 0, '2018-03-18 19:15:36', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(222, 'Admin log-out dari aplikasi', 0, 5, 0, '2018-03-18 19:15:43', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(223, 'Admin sign-in ke aplikasi', 0, 7, 0, '2018-03-18 19:15:53', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(224, 'Admin menambahkan gallery', 0, 7, 0, '2018-03-18 19:16:02', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(225, 'Admin log-out dari aplikasi', 0, 7, 0, '2018-03-18 19:19:00', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(226, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-18 19:19:04', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(227, 'Admin menambahkan gallery', 0, 6, 0, '2018-03-18 19:20:06', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(228, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-19 18:12:58', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(229, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-19 20:02:30', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(230, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-20 03:21:27', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(231, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-21 02:49:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(232, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-21 08:51:29', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(233, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-21 09:02:18', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(234, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-21 09:02:28', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(235, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-21 14:47:44', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(236, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-21 17:29:07', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(237, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-21 18:11:46', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(238, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-21 18:56:26', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(239, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Untuk lampu lalu lintas supaya digantikan yang baru karena sekarang sudah terbengkalai tidak tergantikan. Mohon dipasang kembali lampu lalu lintasnya. kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 01:00:19', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(240, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Untuk lampu lalu lintas di pertigaan jln hos cokro aminoto untuk dipasang kembali karena keberadaannya sekarang sudah tidak ada. Mohon untuk dipasang kembali dengan yang baru. kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 01:04:20', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(241, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-21 20:02:48', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(242, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Untuk lampu lalu lintas di jln conkro aminoto untuk dipasang yang baru mengingat sekarang sudah tidak ada lampu lalu lintas untuk yg di atas. kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 02:06:05', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(243, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Fff kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 02:08:58', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(244, 'Pengguna masyarakat menambahkan aduan dengan isi aduan C kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 02:09:28', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(245, 'Pengguna masyarakat menambahkan aduan dengan isi aduan F kepada instansi PDAM', 8, 0, 0, '2018-03-22 02:11:29', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(246, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Untuk lampu lalu lintas diatas supaya diganti dengan yang baru mengingat sudah lama tidak ada. Mohon untuk disegera di betulkan. kepada instansi Dinas Perhubungan', 8, 0, 0, '2018-03-22 02:15:40', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(247, 'Pengguna masyarakat sign-in ke aplikasi', 11, 0, 0, '2018-03-21 20:19:48', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(248, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Supaya lebih ditata kembali biar lebih tertata dan sudah banyak tanaman yg rusak. kepada instansi Dinas Pekerjaan Umum', 11, 0, 0, '2018-03-22 02:21:39', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(249, 'Pengguna masyarakat mengubah aduan pada instansi Dinas Pekerjaan Umum', 11, 0, 0, '2018-03-22 02:22:19', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(250, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-22 12:09:10', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(251, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-22 16:36:02', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(252, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-22 16:59:27', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(253, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-22 17:05:29', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(254, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-22 17:10:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(255, 'Admin sign-in ke aplikasi', 0, 1, 0, '2018-03-22 17:10:42', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(256, 'Admin mengubah foto', 0, 1, 0, '2018-03-22 17:11:10', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(257, 'Admin log-out dari aplikasi', 0, 1, 0, '2018-03-22 17:11:21', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(258, 'Admin sign-in ke aplikasi', 0, 1, 0, '2018-03-22 17:11:27', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(259, 'Admin log-out dari aplikasi', 0, 1, 0, '2018-03-22 17:11:30', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(260, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-03-22 17:12:18', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(261, 'Admin mengubah foto', 0, 2, 0, '2018-03-22 17:13:53', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(262, 'Admin log-out dari aplikasi', 0, 2, 0, '2018-03-22 17:13:57', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(263, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-22 17:14:09', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(264, 'Admin mengubah foto', 0, 3, 0, '2018-03-22 17:14:16', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(265, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-22 17:14:23', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(266, 'Admin sign-in ke aplikasi', 0, 4, 0, '2018-03-22 17:14:28', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(267, 'Admin mengubah foto', 0, 4, 0, '2018-03-22 17:14:37', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(268, 'Admin log-out dari aplikasi', 0, 4, 0, '2018-03-22 17:14:42', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(269, 'Admin sign-in ke aplikasi', 0, 5, 0, '2018-03-22 17:14:51', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(270, 'Admin mengubah foto', 0, 5, 0, '2018-03-22 17:14:58', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(271, 'Admin log-out dari aplikasi', 0, 5, 0, '2018-03-22 17:15:02', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(272, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-22 17:15:10', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(273, 'Admin mengubah foto', 0, 6, 0, '2018-03-22 17:15:18', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(274, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-22 17:15:21', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(275, 'Admin sign-in ke aplikasi', 0, 7, 0, '2018-03-22 17:15:26', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(276, 'Admin mengubah foto', 0, 7, 0, '2018-03-22 17:15:35', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(277, 'Admin log-out dari aplikasi', 0, 7, 0, '2018-03-22 17:18:20', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(278, 'Admin sign-in ke aplikasi', 0, 1, 0, '2018-03-22 17:18:26', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(279, 'Admin mengubah deskripsi', 0, 1, 0, '2018-03-22 17:19:11', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(280, 'Admin log-out dari aplikasi', 0, 1, 0, '2018-03-22 17:19:15', NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1),
(281, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-03-22 17:19:29', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(282, 'Admin mengubah deskripsi', 0, 2, 0, '2018-03-22 17:20:06', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(283, 'Admin log-out dari aplikasi', 0, 2, 0, '2018-03-22 17:20:20', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(284, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-22 17:20:27', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(285, 'Admin mengubah deskripsi', 0, 3, 0, '2018-03-22 17:21:02', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(286, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-22 17:21:06', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(287, 'Admin sign-in ke aplikasi', 0, 4, 0, '2018-03-22 17:21:19', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(288, 'Admin mengubah deskripsi', 0, 4, 0, '2018-03-22 17:21:47', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(289, 'Admin log-out dari aplikasi', 0, 4, 0, '2018-03-22 17:21:56', NULL, NULL, 'admin', 4, NULL, NULL, NULL, NULL, 1),
(290, 'Admin sign-in ke aplikasi', 0, 5, 0, '2018-03-22 17:22:11', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(291, 'Admin mengubah deskripsi', 0, 5, 0, '2018-03-22 17:22:39', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(292, 'Admin log-out dari aplikasi', 0, 5, 0, '2018-03-22 17:22:42', NULL, NULL, 'admin', 5, NULL, NULL, NULL, NULL, 1),
(293, 'Admin sign-in ke aplikasi', 0, 6, 0, '2018-03-22 17:22:55', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(294, 'Admin mengubah deskripsi', 0, 6, 0, '2018-03-22 17:23:21', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(295, 'Admin log-out dari aplikasi', 0, 6, 0, '2018-03-22 17:23:32', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(296, 'Admin sign-in ke aplikasi', 0, 7, 0, '2018-03-22 17:23:39', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(297, 'Admin mengubah deskripsi', 0, 7, 0, '2018-03-22 17:24:25', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(298, 'Admin log-out dari aplikasi', 0, 7, 0, '2018-03-22 17:25:44', NULL, NULL, 'admin', 7, NULL, NULL, NULL, NULL, 1),
(299, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-22 17:25:49', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(300, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-22 17:28:54', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(301, 'Pengguna instansi dengan nama Dinas Perhubungan masuk ke aplikasi mobile', 0, 3, 0, '2018-03-22 23:49:15', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(302, 'Pengguna masyarakat memberikan komentar', 8, 0, 0, '2018-03-22 23:51:46', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(303, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-23 16:34:30', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(304, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-23 16:34:37', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(305, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-23 16:35:05', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(306, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-23 16:49:07', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(307, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-23 16:49:38', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(308, 'Pengguna masyarakat sign-in ke aplikasi', 11, 0, 0, '2018-03-23 16:51:39', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(309, 'Pengguna masyarakat memberikan komentar', 11, 0, 0, '2018-03-23 22:52:14', NULL, NULL, 'user', 11, NULL, NULL, NULL, NULL, 1),
(310, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-23 18:08:32', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(311, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-24 09:28:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(312, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-24 09:50:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(313, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-24 09:50:14', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(314, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-24 09:52:18', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(315, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-24 09:52:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(316, 'Pengguna instansi dengan nama Dinas Perhubungan masuk ke aplikasi mobile', 0, 3, 0, '2018-03-24 16:56:13', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(317, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-24 11:04:52', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(318, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-24 12:12:57', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(319, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-24 12:16:51', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(320, 'Pengguna instansi dengan nama Dinas Perhubungan masuk ke aplikasi mobile', 0, 3, 0, '2018-03-24 20:13:36', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(321, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-24 15:08:53', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(322, 'Superadmin mengubah profil user dengan nama baru tasirah', 0, 0, 1, '2018-03-24 15:22:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(323, 'Superadmin mengubah profil user dengan nama baru tasirah', 0, 0, 1, '2018-03-24 17:08:28', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(324, 'Superadmin menghapus aduan user', 0, 1, 0, NULL, NULL, '2018-03-24 17:12:01', NULL, NULL, NULL, NULL, 'superadmin', 1, 1),
(325, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-24 17:57:02', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(326, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-24 17:57:32', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(327, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-25 06:25:24', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(328, 'Admin menambahkan gallery', 0, 3, 0, '2018-03-25 06:48:24', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(329, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-25 06:53:51', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(330, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-25 07:10:06', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(331, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-26 20:02:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(332, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-27 05:03:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(333, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-27 05:08:10', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(334, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-27 05:08:21', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(335, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-27 14:45:00', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(336, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-28 04:35:31', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(337, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-28 04:37:16', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(338, 'Pengguna instansi dengan nama Dinas Perhubungan masuk ke aplikasi mobile', 0, 3, 0, '2018-03-28 09:47:25', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(339, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-28 05:54:12', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(340, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-03-28 05:57:47', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(341, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-28 07:12:15', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(342, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-28 07:19:54', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(343, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-28 07:20:10', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(344, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-28 10:10:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(345, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-28 10:43:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(346, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-28 10:44:08', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(347, 'Admin log-out dari aplikasi', 0, 3, 0, '2018-03-28 10:54:03', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(348, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-28 10:54:12', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(349, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-03-28 11:20:10', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(350, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-03-28 11:20:21', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(351, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-28 13:33:17', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(352, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-28 15:33:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(353, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-03-29 09:22:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(354, 'Pengguna masyarakat sign-in ke aplikasi', 9, 0, 0, '2018-03-29 09:40:10', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(355, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 18:03:28', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(356, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 18:11:54', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(357, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 18:19:04', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(358, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 18:22:57', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(359, 'Pengguna instansi dengan nama PLN masuk ke aplikasi mobile', 0, 6, 0, '2018-04-07 00:07:32', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(360, 'Pengguna instansi dengan nama PLN masuk ke aplikasi mobile', 0, 6, 0, '2018-04-07 00:11:21', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(361, 'Pengguna masyarakat sign-in ke aplikasi', 9, 0, 0, '2018-04-06 19:30:15', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(362, 'Pengguna masyarakat menambahkan aduan dengan isi aduan Mohon kepada dinas pekerjaan umum untuk menambal jalan yg berlubang karena bekas galian kabel karena berdiameter lumayan dalam. kepada instansi Dinas Pekerjaan Umum', 9, 0, 0, '2018-04-07 00:44:17', NULL, NULL, 'user', 9, NULL, NULL, NULL, NULL, 1),
(363, 'Pengguna instansi dengan nama PLN masuk ke aplikasi mobile', 0, 6, 0, '2018-04-07 00:49:38', NULL, NULL, 'admin', 6, NULL, NULL, NULL, NULL, 1),
(364, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 19:54:03', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(365, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-04-06 20:22:12', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(366, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-06 20:30:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(367, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-06 20:31:32', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(368, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-04-06 20:31:44', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1);
INSERT INTO `tb_log` (`id_tb_log`, `keterangan`, `id_tb_user`, `id_tb_admin`, `id_tb_superadmin`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(369, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-06 20:32:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(370, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-06 20:32:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(371, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-06 20:38:44', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(372, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-25 10:16:29', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(373, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-28 10:33:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(374, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-04-28 10:34:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(375, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-04-28 10:34:33', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(376, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-04-29 11:55:14', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(377, 'Admin log-out dari aplikasi', 0, 2, 0, '2018-04-29 11:56:11', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(378, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-04-29 11:56:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(379, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-04-30 10:22:25', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(380, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-05-08 12:10:00', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(381, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-05-09 10:22:07', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(382, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-05-10 13:55:43', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(383, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-05-17 16:39:27', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(384, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-05-21 05:44:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(385, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-05-24 14:19:09', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(386, 'Pengguna instansi dengan nama Dinas Pekerjaan Umum masuk ke aplikasi mobile', 0, 2, 0, '2018-05-24 19:30:24', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(387, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-05-24 18:32:31', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(388, 'Admin log-out dari aplikasi', 0, 2, 0, '2018-05-24 18:32:51', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(389, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-05-24 18:33:01', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(390, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-05-24 18:51:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(391, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-05-24 18:51:15', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(392, 'Admin sign-in ke aplikasi', 0, 2, 0, '2018-05-27 18:44:34', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(393, 'Admin mengubah deskripsi', 0, 2, 0, '2018-05-27 18:45:54', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(394, 'Admin mengubah deskripsi', 0, 2, 0, '2018-05-27 18:45:59', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(395, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-06-21 12:15:00', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(396, 'Superadmin log-out dari aplikasi', 0, 0, 1, '2018-06-21 12:15:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(397, 'Admin sign-in ke aplikasi', 0, 3, 0, '2018-06-21 12:16:17', NULL, NULL, 'admin', 3, NULL, NULL, NULL, NULL, 1),
(398, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-06-24 11:51:59', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(399, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-07-05 06:58:40', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(400, 'Pengguna instansi dengan nama Dinas Pekerjaan Umum masuk ke aplikasi mobile', 0, 2, 0, '2018-07-10 00:38:19', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(401, 'Pengguna instansi dengan nama Dinas Pekerjaan Umum masuk ke aplikasi mobile', 0, 2, 0, '2018-07-10 08:07:48', NULL, NULL, 'admin', 2, NULL, NULL, NULL, NULL, 1),
(402, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-07-11 08:16:12', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(403, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-08-23 09:51:13', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1),
(404, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-08-25 20:59:14', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(405, 'Superadmin sign-in ke aplikasi', 0, 0, 1, '2018-09-12 03:56:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(406, 'Pengguna masyarakat sign-in ke aplikasi', 8, 0, 0, '2018-10-01 03:40:02', NULL, NULL, 'user', 8, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi_tempat_umum`
--

CREATE TABLE IF NOT EXISTS `tb_lokasi_tempat_umum` (
  `id_tb_lokasi_tempat_umum` int(10) NOT NULL,
  `id_tb_jenis_lokasi_tempat_umum` int(10) DEFAULT NULL,
  `nama_lokasi` varchar(25) DEFAULT NULL,
  `deskripsi_lokasi` longtext,
  `lati` varchar(50) DEFAULT NULL,
  `longi` varchar(50) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lokasi_tempat_umum`
--

INSERT INTO `tb_lokasi_tempat_umum` (`id_tb_lokasi_tempat_umum`, `id_tb_jenis_lokasi_tempat_umum`, `nama_lokasi`, `deskripsi_lokasi`, `lati`, `longi`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 2, 'Rita Mall', 'Tempat Perbelanjaan Keluarga', '-6.86969869489683', '109.11986410617828', '2018-03-17 19:42:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(2, 2, 'Pasific Mall', 'Tempat Perbelanjaan Keluarga', '-6.869491908864596', '109.12869056021214', '2018-03-17 19:45:06', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(3, 2, 'Transmart', 'Tempat Perbelanjaan Keluarga dan Rekreasi', '-6.8686018551632895', '109.12315718927834', '2018-03-17 19:47:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(4, 2, 'Yogya Mall', 'Tempat Perbelanjaan', '-6.872351390654441', '109.136243996698', '2018-03-17 19:47:43', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(5, 2, 'Super Indo Debe Mall', 'Tempat Perbelanjaan', '-6.87279083393848', '109.12750825359922', '2018-03-17 19:49:25', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(6, 1, 'Caffe Bean Transmart', 'Rantai kedai kopi yang menyajikan aneka minuman termasuk pilihan es krimnya.', '-6.868537049523625', '109.12277231937696', '2018-03-17 19:51:44', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(7, 1, 'Waroeng Sadewa', 'Makanan larut malam · Nyaman · Santai', '-6.858804430546646', '109.13441777229309', '2018-03-17 19:54:35', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(8, 1, 'EatBoss Tegal', 'Makanan larut malam · Nyaman · Santai', '-6.867588300172631', '109.13072973489761', '2018-03-17 19:55:38', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(9, 1, 'Caffe Yaul', 'Menyediakan makanan penutup, makanan ringan, dan casual', '-6.867800434214537', '109.13636468332083', '2018-03-17 19:58:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(11, 1, 'Boss''A Caffe', 'Menyediakan makan ringan, kopi dan hiburan musik untuk bersantai bersama rekan - rekan', '-6.871637749122115', '109.14234524068036', '2018-03-17 20:01:17', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(12, 1, 'My Story', 'Menyediakan makanan ringan, kopi dan hiburan musik', '-6.875296188594761', '109.12726297974586', '2018-03-17 20:02:33', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(13, 1, 'Awe Chocolate And Milk', 'Tempat nongkrong anak muda. Menyediakan makan dan minuman ringan', '-6.878579559309862', '109.13316786289215', '2018-03-17 20:03:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(15, 1, 'Wijikopi', 'Tempat nongkrong masa kini. Menyediakan makan ringan dan minuman seperti kopi.', '-6.88591580032652', '109.14021000266075', '2018-03-17 20:05:42', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(16, 3, 'Warung Makan Sate Kumis', 'Rumah Makan Sate', '-6.878369189928267', '109.09056901931763', '2018-03-18 17:44:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(17, 3, 'R.M. Berkah Lesehan', 'Menyediakan aneka makanan sop', '-6.877951113792047', '109.09271210432053', '2018-03-18 17:48:41', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(18, 3, 'Ikan Bakar Mas Bro', 'Menyediakan anekan makanan ikan bakar', '-6.8784357625274515', '109.09065216779709', '2018-03-18 17:50:18', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(19, 3, 'RM. Sauto Rawi', 'Menyediakan makanan sauto rawi', '-6.878875303944565', '109.08939284991811', '2018-03-18 17:51:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(20, 3, 'Sate Rizki Tegal', 'Menyediakan makanan sate', '-6.878752647971689', '109.08776342868805', '2018-03-18 17:54:22', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(21, 3, 'Pondok Sate Gule', 'Menyediakan makanan sate gule', '-6.878720693146558', '109.08614069223404', '2018-03-18 17:56:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(22, 3, 'W.M. Tanjung Bintang', 'Menyediakan makanan warung tegal', '-6.878249359226211', '109.07945930957794', '2018-03-18 17:58:36', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(23, 3, 'Warung Makan Simpati', 'Menyediakan aneka makanan', '-6.878160151906161', '109.07916963100433', '2018-03-18 18:01:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(24, 3, 'Pecel Lele', 'Menyediakan makanan pecel lele', '-6.878335903625175', '109.07792240381241', '2018-03-18 18:03:26', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(25, 3, 'Warung Makan Lamongan', 'Menyediakan makanan lamongan', '-6.877997714653486', '109.0946714580059', '2018-03-18 18:06:19', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(26, 3, 'RM Sariminang', 'Menyediakan aneka jenis makanan', '-6.875997867860085', '109.103152602911', '2018-03-18 18:08:46', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(27, 3, 'RM.sate Kambing Eva', 'Menyediakan makanan sate kambing', '-6.875639705328508', '109.1041973233223', '2018-03-18 18:10:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(28, 3, 'Rumah Makan D''Pawon', 'Menyediakan aneka makanan', '-6.868955730503548', '109.12252217531204', '2018-03-18 18:14:08', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(29, 3, 'MCD Tegal', 'Menyediakan aneka makanan junk food', '-6.8690729005924664', '109.12852227687836', '2018-03-18 18:17:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(30, 3, 'KFC Tegal', 'Menyediakan aneka makanan junk food', '-6.869152789272925', '109.1301691532135', '2018-03-18 18:19:23', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(31, 3, 'Richeese Factory Tegal', 'Menyediakan aneka makanan junk food', '-6.869240666805912', '109.13078472018242', '2018-03-18 18:21:03', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(32, 3, 'RM. Padang Indonesia', 'Menyediakan aneka makanan khas padang', '-6.869325494131162', '109.13208228654457', '2018-03-18 18:24:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(33, 3, 'RM Sari Sedap', 'Menyediakan aneka makanan sop, sate dan lainnya.', '-6.867333986990142', '109.13329124450684', '2018-03-18 18:26:48', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(34, 3, 'RM. Semeru', 'Menyediakan aneka macam makanan', '-6.8647322621209375', '109.13667887449265', '2018-03-18 18:29:04', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(35, 3, 'Rumah Makan Indah', 'Menyediakan aneka makanan', '-6.861336216421729', '109.13725356888847', '2018-03-18 18:32:34', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(36, 3, 'RM. Prima Rasa', 'Menyediakan aneka macam makanan', '-6.854990979683274', '109.14078801870346', '2018-03-18 18:35:16', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(37, 3, 'RM Dewi', 'Menyediakan aneka makanan', '-6.866588355933304', '109.13840353488922', '2018-03-18 18:36:55', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(38, 2, 'RM Es Sari Buah', 'Menyediakan makanan', '-6.8671808664220375', '109.13986936211586', '2018-03-18 18:38:45', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(39, 3, 'Pondok Sate Kambing Muda', 'Menyediakan makanan sate', '-6.876510479192047', '109.12711143493652', '2018-03-18 18:41:56', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(40, 4, 'Gerbang Mas Bahari', 'Waterboom', '-6.872235812621582', '109.11111739341243', '2018-03-18 18:45:11', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(41, 4, 'Rita Park', 'Tempat rekreasi keluarga', '-6.8716479723033554', '109.11925256252289', '2018-03-18 18:47:20', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(42, 4, 'Win''s Spa & Karaoke', 'Tempat spa dan karaoke keluarga', '-6.86924599271648', '109.12147611379623', '2018-03-18 18:49:31', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(43, 4, 'Transtudio Mini', 'Tempat liburan keluarga', '-6.8679544576573095', '109.12317931652069', '2018-03-18 18:53:50', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(44, 4, 'Inul Vista', 'Tempat karaoke keluarga', '-6.869927708776862', '109.12874221801758', '2018-03-18 18:56:09', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(45, 4, 'Poci Park', 'Tempat Bermain Keluarga', '-6.865561779834285', '109.1421639919281', '2018-03-18 18:58:54', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(46, 4, 'Orange Karaoke', 'Tempat Karaoke', '-6.857624714021995', '109.13770213723183', '2018-03-18 19:01:39', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1),
(47, 4, 'Karaoke Happy', 'Bar dan Karaoke', '-6.857382379114623', '109.13885146379471', '2018-03-18 19:04:52', NULL, NULL, 'superadmin', 1, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_masyarakat`
--

CREATE TABLE IF NOT EXISTS `tb_masyarakat` (
  `id_tb_masyarakat` int(10) NOT NULL,
  `no_kk` char(16) DEFAULT NULL,
  `no_nik` char(16) DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=752 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_masyarakat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_superadmin`
--

CREATE TABLE IF NOT EXISTS `tb_superadmin` (
  `id_tb_superadmin` int(10) NOT NULL,
  `nama_superadmin` varchar(25) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_superadmin`
--

INSERT INTO `tb_superadmin` (`id_tb_superadmin`, `nama_superadmin`, `username`, `password`, `email`, `cdate`, `mdate`, `ddate`, `input_ket`, `input_by`, `modify_ket`, `modify_by`, `deleted_ket`, `deleted_by`, `deleted_flage`) VALUES
(1, 'Pemerintah Kota Tegal', 'pemkottegal', 'e10adc3949ba59abbe56e057f20f883e', 'firdausns44@gmail.com', '2018-01-19 21:00:00', '2018-03-10 10:28:32', NULL, 'superadmin', 1, 'superadmin', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_tb_user` int(10) NOT NULL,
  `nama_user` varchar(40) DEFAULT NULL,
  `no_nik` char(16) DEFAULT NULL,
  `no_kk` char(16) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `img_user` varchar(20) DEFAULT NULL,
  `sex` varchar(12) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `input_ket` varchar(10) DEFAULT NULL,
  `input_by` int(10) DEFAULT NULL,
  `modify_ket` varchar(10) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `deleted_ket` varchar(10) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `deleted_flage` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_tb_admin`);

--
-- Indexes for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`id_tb_aduan`),
  ADD KEY `id_tb_aduan_user` (`id_tb_user`);

--
-- Indexes for table `tb_comment_aduan`
--
ALTER TABLE `tb_comment_aduan`
  ADD PRIMARY KEY (`id_tb_comment_aduan`),
  ADD KEY `id_tb_aduan` (`id_tb_aduan`);

--
-- Indexes for table `tb_gallery_admin`
--
ALTER TABLE `tb_gallery_admin`
  ADD PRIMARY KEY (`id_tb_gallery_admin`),
  ADD KEY `id_tb_admin_gallery` (`id_tb_admin`);

--
-- Indexes for table `tb_gallery_aduan`
--
ALTER TABLE `tb_gallery_aduan`
  ADD PRIMARY KEY (`id_tb_gallery_aduan`),
  ADD KEY `id_tb_aduan_gallery` (`id_tb_aduan`);

--
-- Indexes for table `tb_gallery_lokasi_tempat_umum`
--
ALTER TABLE `tb_gallery_lokasi_tempat_umum`
  ADD PRIMARY KEY (`id_tb_gallery_lokasi_umum`),
  ADD KEY `id_tb_lokasi_tempat_umum_gallery` (`id_tb_lokasi_tempat_umum`);

--
-- Indexes for table `tb_jenis_lokasi_tempat_umum`
--
ALTER TABLE `tb_jenis_lokasi_tempat_umum`
  ADD PRIMARY KEY (`id_tb_jenis_lokasi_tempat_umum`);

--
-- Indexes for table `tb_like_aduan`
--
ALTER TABLE `tb_like_aduan`
  ADD PRIMARY KEY (`id_tb_like_aduan`),
  ADD KEY `id_tb_like_aduan` (`id_tb_aduan`),
  ADD KEY `id_tb_like_user` (`id_tb_user`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_tb_log`);

--
-- Indexes for table `tb_lokasi_tempat_umum`
--
ALTER TABLE `tb_lokasi_tempat_umum`
  ADD PRIMARY KEY (`id_tb_lokasi_tempat_umum`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_tb_masyarakat`);

--
-- Indexes for table `tb_superadmin`
--
ALTER TABLE `tb_superadmin`
  ADD PRIMARY KEY (`id_tb_superadmin`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_tb_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_tb_admin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  MODIFY `id_tb_aduan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_comment_aduan`
--
ALTER TABLE `tb_comment_aduan`
  MODIFY `id_tb_comment_aduan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_gallery_admin`
--
ALTER TABLE `tb_gallery_admin`
  MODIFY `id_tb_gallery_admin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_gallery_aduan`
--
ALTER TABLE `tb_gallery_aduan`
  MODIFY `id_tb_gallery_aduan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_gallery_lokasi_tempat_umum`
--
ALTER TABLE `tb_gallery_lokasi_tempat_umum`
  MODIFY `id_tb_gallery_lokasi_umum` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `tb_jenis_lokasi_tempat_umum`
--
ALTER TABLE `tb_jenis_lokasi_tempat_umum`
  MODIFY `id_tb_jenis_lokasi_tempat_umum` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_like_aduan`
--
ALTER TABLE `tb_like_aduan`
  MODIFY `id_tb_like_aduan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_tb_log` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=407;
--
-- AUTO_INCREMENT for table `tb_lokasi_tempat_umum`
--
ALTER TABLE `tb_lokasi_tempat_umum`
  MODIFY `id_tb_lokasi_tempat_umum` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_tb_masyarakat` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=752;
--
-- AUTO_INCREMENT for table `tb_superadmin`
--
ALTER TABLE `tb_superadmin`
  MODIFY `id_tb_superadmin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_tb_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
