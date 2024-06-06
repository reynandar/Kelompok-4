-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2024 pada 06.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keybee_web (1)`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_siswa`
--

CREATE TABLE `login_siswa` (
  `id` int(11) NOT NULL,
  `nis_siswa` varchar(110) NOT NULL,
  `email` varchar(110) NOT NULL,
  `password` varchar(110) NOT NULL,
  `is_active` int(11) NOT NULL,
  `kode_unik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_siswa`
--

INSERT INTO `login_siswa` (`id`, `nis_siswa`, `email`, `password`, `is_active`, `kode_unik`) VALUES
(214, '1122334455', 'budi@gmail.com', '$2y$10$Py6qUFKUqB7kRBP.zCzS8eTtK283FO6CMjAu4z1dUTY84VLAS6xzC', 1, '381'),
(215, '1122334455', 'budi@gmail.com', '$2y$10$Py6qUFKUqB7kRBP.zCzS8eTtK283FO6CMjAu4z1dUTY84VLAS6xzC', 1, '381'),
(216, '1122334455', 'budi@gmail.com', '$2y$10$Py6qUFKUqB7kRBP.zCzS8eTtK283FO6CMjAu4z1dUTY84VLAS6xzC', 1, '381'),
(217, '1133445566', 'asrahan@gmail.com', '$2y$10$.D8SvepzaeSmY3UPurNrquY8LCWPvGzpalBrxp5EnBHUeKxy/0ydq', 1, '923'),
(218, '1213141516', 'aleena@gmail.com', '$2y$10$zLwCbbJyap2CcMnbfzhuNu1giFOoTJMgRXKAZ.7cDnnRlm8t/Dq6K', 1, '536'),
(219, '1144223355', 'syamsie@gmail.com', '$2y$10$.VtbVqnz8nSB2Kkn7U4AJOz0n4V0qjo8mWjhs8WNeNrf.k123OJha', 1, '499'),
(220, '1234554321', 'laila@gmail.com', '$2y$10$WfeD2jpNipGfvj/1a8s.8ucAp46.6LzQ7zWVjCoxMH1rAkrgVeM/e', 1, '823');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_api`
--

CREATE TABLE `tabel_api` (
  `id_api` int(11) NOT NULL,
  `api_key` varchar(200) NOT NULL,
  `sender` varchar(150) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_api`
--

INSERT INTO `tabel_api` (`id_api`, `api_key`, `sender`, `url`) VALUES
(1, 'YiAbot1wFW8p0tJ3MiC9t1LOzIqq2c', '628998184700', 'https://wa.inisekolahku.my.id/send-message');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jurusan`
--

CREATE TABLE `tabel_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tabel_jurusan`
--

INSERT INTO `tabel_jurusan` (`id_jurusan`, `jurusan`) VALUES
(0, 'agama'),
(1, 'IPA 1'),
(2, 'IPA'),
(3, 'IPS'),
(4, 'IPA 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_absen`
--

CREATE TABLE `tb_detail_absen` (
  `id_detail` int(11) NOT NULL,
  `jam_absen` timestamp NOT NULL DEFAULT current_timestamp(),
  `jam_pulang` datetime DEFAULT NULL,
  `tanggal_absen` date DEFAULT NULL,
  `nis` varchar(12) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `kode_kelas` int(11) NOT NULL,
  `kode_jurusan` int(11) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_detail_absen`
--

INSERT INTO `tb_detail_absen` (`id_detail`, `jam_absen`, `jam_pulang`, `tanggal_absen`, `nis`, `keterangan`, `kode_kelas`, `kode_jurusan`, `masuk`, `keluar`) VALUES
(273, '2023-08-29 05:50:58', NULL, '2023-08-29', '1122334455', 'h', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_izin`
--

CREATE TABLE `tb_izin` (
  `id` int(11) NOT NULL,
  `nis_siswa` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `file_bukti` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_izin` date NOT NULL,
  `status` enum('Diterima','Ditolak','Menunggu Konfirmasi') NOT NULL,
  `pemberi_izin` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam_absen`
--

CREATE TABLE `tb_jam_absen` (
  `id` int(11) NOT NULL,
  `type` enum('Masuk','Keluar','Terlambat') NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_jam_absen`
--

INSERT INTO `tb_jam_absen` (`id`, `type`, `mulai`, `selesai`) VALUES
(1, 'Masuk', '05:00:00', '13:30:00'),
(2, 'Keluar', '21:03:00', '21:20:00'),
(3, 'Terlambat', '20:55:00', '21:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kelas`) VALUES
(2, 'no name', 'X'),
(3, 'no name2', 'XI'),
(4, 'No name3', 'XII'),
(5, 'Satu', '1'),
(6, 'Dua', '2'),
(7, 'Tiga', '3'),
(8, 'Empat', '4'),
(9, 'Lima', '5'),
(10, 'Enam', '6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_libur`
--

CREATE TABLE `tb_libur` (
  `id` int(11) NOT NULL,
  `type` enum('weekend','other') NOT NULL,
  `tanggal` varchar(110) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_libur`
--

INSERT INTO `tb_libur` (`id`, `type`, `tanggal`, `keterangan`, `status`) VALUES
(0, 'other', '2021-10-06', 'sdasdsadsadsa', 'Aktif'),
(1, 'weekend', '2021-09-30', 'sabtu', 'Non Aktif'),
(2, 'weekend', '2021-09-16', 'minggu', 'Non Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` text DEFAULT NULL,
  `nis` varchar(12) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` text DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `kode_jurusan` varchar(15) DEFAULT NULL,
  `kode_kelas` varchar(15) DEFAULT NULL,
  `gambar` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nama_siswa`, `nis`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `kode_jurusan`, `kode_kelas`, `gambar`) VALUES
(10199, 'Budi Setiadi', '1122334455', '2011-11-11', 'L', 'Jakarta Selatan', '08998184700', 'default', '10', 'default.jpg'),
(10200, 'Asrahan Pradipta', '1133445566', '2017-10-04', 'L', 'P. Seterang Mentari. Blok A.10 No.09', '081645328971', 'default', '5', 'default.jpg'),
(10201, 'Laila Kalyana', '1234554321', '2017-05-27', 'P', 'P. Cinta Damai. Blok B.07 No.02', '081957632195', 'default', '5', 'default.jpg'),
(10202, 'Aleena Almahyra', '1213141516', '2017-09-12', 'P', 'Cikampek Utara. Jalan Zamrud', '089573548911', 'default', '5', 'default.jpg'),
(10203, 'Syamsie Zafier Ithnanda', '1144223355', '2017-11-20', 'L', 'Cikampek Barat. Jalan Mutiara', '081377541094', 'default', '5', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `kode_unik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `email`, `password`, `image`, `role_id`, `is_active`, `date_create`, `kode_unik`) VALUES
(3, 'Digital Center', 'admin@gmail.com', '$2y$10$wDD5uGospbApgEEiY0H28uWC41JbTy9lJqbtjs61deXAcxbFzomLm', 'default.jpg', 1, 1, '2021-09-29', ''),
(4, 'Asep', 'petugas@gmail.com', '$2y$10$A5xUE3d/AZRRQEix03ca0OL6RpVd1qyM.x9fn9o6CFqpmcPrv8Rz6', 'default.jpg', 2, 1, '2021-10-01', ''),
(5, 'Fauzan', 'guru@gmail.com', '$2y$10$oQcVJfLyTKXazNUukuzTDe.6Utgwv4laUPlrhH7HPTTYwbJFcYrtS', 'default.jpg', 3, 1, '2021-10-02', 'nmKrj^eZPzVaM&F&up&J'),
(9, 'Arius Mahendra', 'arius@gmail.com', '$2y$10$G.v/f0L.N42rzner/Y5.dOGWILWKSZTksc37q3OzVUH19LiWs6wum', 'default.Jpg', 2, 1, '2024-05-16', '*B^%&JCD^WfuETQxoOh^'),
(10, 'Hosea Mahesa', 'hosea@gmail.com', '$2y$10$ZDCCxk7o7aWxedaDZaTYj.Qo3D17HeRrN.DZ52IvqQ5eqXX2NHVYW', 'default.Jpg', 1, 1, '2024-05-16', '%&%AfJ^Sc(&gB&tv%^WZ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Wali Kelas'),
(3, 'Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(9, 1, 5),
(10, 1, 4),
(11, 2, 2),
(12, 2, 3),
(13, 3, 3),
(14, 2, 4),
(15, 3, 4),
(16, 3, 5),
(17, 2, 5),
(18, 1, 12),
(19, 1, 13),
(20, 2, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_submenu`
--

CREATE TABLE `user_access_submenu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_access_submenu`
--

INSERT INTO `user_access_submenu` (`id`, `role_id`, `submenu_id`) VALUES
(1, 1, 30),
(2, 1, 36),
(3, 1, 1),
(4, 1, 3),
(5, 1, 39),
(6, 1, 41),
(7, 1, 6),
(8, 1, 37),
(9, 1, 43),
(10, 1, 44),
(11, 1, 4),
(12, 1, 46),
(13, 1, 47),
(14, 2, 3),
(15, 2, 39),
(16, 2, 41),
(17, 3, 3),
(18, 3, 39),
(19, 2, 43),
(20, 3, 6),
(21, 2, 6),
(22, 2, 44),
(23, 3, 44),
(24, 2, 47),
(25, 3, 47),
(26, 1, 48),
(27, 1, 49),
(28, 2, 49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
(2, 'Kelola Menu', 'flaticon-381-controls-3'),
(3, 'Kelola Absensi', 'flaticon-381-calendar-5'),
(4, 'Siswa', 'flaticon-381-user-8'),
(5, 'Users', 'flaticon-381-user'),
(12, 'Api Config', 'flaticon-381-user'),
(13, 'Nilai', 'flaticon-381-calculator-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `url` text NOT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `is_active`) VALUES
(1, 3, 'Atur libur', 'absen/libur', 1),
(3, 3, 'Data Absensi', 'absen', 1),
(4, 5, 'Data User', 'user', 1),
(6, 4, 'Data seluruh siswa', 'siswa', 1),
(30, 2, 'Acces User', 'Menu/Access', 1),
(36, 2, 'Menu', 'menu/management', 1),
(37, 4, 'Kelas & Jurusan', 'siswa/kelas', 1),
(39, 3, 'Rekap Absen', 'absen/rekap', 1),
(41, 3, 'Jam absen', 'absen/jam', 1),
(43, 4, 'Siswa per kelas', 'siswa/daftar_kelas', 1),
(44, 4, 'Data Izin', 'izin', 1),
(45, 1, 'Data ', 'Admin', 1),
(46, 2, 'Sub menu', 'menu/submanagement', 1),
(47, 5, 'Data User Siswa', 'user/user_siswa', 1),
(48, 12, 'API Config', 'api/apimanagement', 1),
(49, 13, 'Nilai siswa', 'nilaisiswa', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login_siswa`
--
ALTER TABLE `login_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabel_api`
--
ALTER TABLE `tabel_api`
  ADD PRIMARY KEY (`id_api`);

--
-- Indeks untuk tabel `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `tb_izin`
--
ALTER TABLE `tb_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jam_absen`
--
ALTER TABLE `tb_jam_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_libur`
--
ALTER TABLE `tb_libur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login_siswa`
--
ALTER TABLE `login_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT untuk tabel `tabel_api`
--
ALTER TABLE `tabel_api`
  MODIFY `id_api` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_absen`
--
ALTER TABLE `tb_detail_absen`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT untuk tabel `tb_izin`
--
ALTER TABLE `tb_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10204;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
