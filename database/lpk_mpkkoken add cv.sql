-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 03:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpk_mpkkoken`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image_main` varchar(255) NOT NULL,
  `image_secondary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image_main`, `image_secondary`) VALUES
(1, 'Tentang LPK MPK-KOKEN', 'LPK MPK-KOKEN adalah lembaga pelatihan kerja yang mempersiapkan pemuda Indonesia untuk berkarier di Jepang melalui program Magang, Engineering, dan Tokutei Ginou. Kami fokus pada pelatihan bahasa, keterampilan, dan budaya kerja Jepang agar peserta siap secara profesional dan mental untuk hidup dan bekerja di negeri Sakura.', '3505194f0d1f7a99ca69d06acf7b145c.jpg', 'a5520f07e50a27ef065dca41d1db3c1e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `about_features`
--

CREATE TABLE `about_features` (
  `id` int(11) NOT NULL,
  `about_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_features`
--

INSERT INTO `about_features` (`id`, `about_id`, `text`) VALUES
(4, 1, 'Program magang, engineering, dan tokutei ginou resmi ke Jepang'),
(5, 1, 'Pelatihan bahasa dan budaya Jepang intensif sebelum keberangkatan'),
(6, 1, 'Bimbingan langsung hingga penempatan kerja di Jepang');

-- --------------------------------------------------------

--
-- Table structure for table `about_founder`
--

CREATE TABLE `about_founder` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `paragraph_1` text DEFAULT NULL,
  `paragraph_2` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_founder`
--

INSERT INTO `about_founder` (`id`, `title`, `subtitle`, `description`, `paragraph_1`, `paragraph_2`, `image`) VALUES
(1, 'Tentang MPK-KOKEN', 'Ratusan alumni kami telah sukses bekerja dan belajar di Jepang', 'MPK-KOKEN adalah Lembaga Pelatihan Kerja yang fokus menyiapkan generasi muda Indonesia untuk meniti karier di Jepang melalui program Magang, Tokutei Ginou, dan Engineering.', 'Dengan pelatihan intensif, bimbingan bahasa, serta pembekalan budaya kerja Jepang, kami memastikan setiap peserta siap secara mental dan keterampilan.', 'Didampingi oleh para pengajar berpengalaman, MPK-KOKEN menciptakan lingkungan belajar yang disiplin, hangat, dan penuh semangat kebersamaan.', '686e91456edb1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `about_founder_features`
--

CREATE TABLE `about_founder_features` (
  `id` int(11) NOT NULL,
  `about_founder_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_founder_features`
--

INSERT INTO `about_founder_features` (`id`, `about_founder_id`, `text`) VALUES
(2, 1, 'Pelatihan intensif bahasa dan budaya Jepang'),
(3, 1, 'Pembinaan karakter dan kedisiplinan kerja'),
(4, 1, 'Dukungan proses magang hingga penempatan');

-- --------------------------------------------------------

--
-- Table structure for table `caraousel`
--

CREATE TABLE `caraousel` (
  `id_caraousel` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caraousel`
--

INSERT INTO `caraousel` (`id_caraousel`, `judul`, `foto`, `deskripsi`) VALUES
(50, 'LPK MPK-KOKEN', '20250708Jul5618.jpg', 'Lembaga Pelatihan Kerja Jepang - Indonesia\r\nMagang • Tokutei Ginou • Engineering\r\nRaih masa depan global bersama kami');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `menikah` varchar(50) NOT NULL,
  `tinggi_badan` varchar(10) NOT NULL,
  `berat_badan` varchar(10) NOT NULL,
  `buta_warna` varchar(15) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `tangan_dominan` varchar(20) NOT NULL,
  `operasi` varchar(20) NOT NULL,
  `alkohol` varchar(6) NOT NULL,
  `merokok` varchar(6) NOT NULL,
  `tato` varchar(6) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `motivasi` varchar(150) NOT NULL,
  `promosi` varchar(150) NOT NULL,
  `kelebihan` varchar(150) NOT NULL,
  `kekurangan` varchar(150) NOT NULL,
  `hobi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv_keluarga`
--

CREATE TABLE `cv_keluarga` (
  `id` int(11) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `hubungan` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `usia` int(11) NOT NULL,
  `serumah` varchar(6) NOT NULL,
  `tempat_tinggal` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv_pendidikan`
--

CREATE TABLE `cv_pendidikan` (
  `id` int(11) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `jenjang` varchar(20) NOT NULL,
  `tahun_mulai` int(11) NOT NULL,
  `tahun_berakhir` int(11) NOT NULL,
  `sekolah` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv_pengalaman`
--

CREATE TABLE `cv_pengalaman` (
  `id` int(11) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `tahun_awal` int(11) NOT NULL,
  `tahun_berakhir` int(11) NOT NULL,
  `tempat` varchar(40) NOT NULL,
  `sebagai` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gaji` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `status`) VALUES
(3, 'Apa saja program yang tersedia di MPK-KOKEN?', 'Kami menyediakan program pelatihan bahasa Jepang, budaya kerja Jepang, pelatihan mentalitas, serta persiapan magang, TG (Tokutei Ginou), dan Engineering ke Jepang.\r\n', 1),
(4, 'Apakah ada biaya pendaftaran?', 'Ya, terdapat biaya pendaftaran awal untuk mengikuti seleksi dan pelatihan di LPK MPK-KOKEN. Informasi rinci akan disampaikan saat konsultasi awal.\r\n', 1),
(5, 'Berapa lama waktu persiapan sebelum keberangkatan?', 'Rata-rata peserta menjalani pelatihan intensif selama 4–6 bulan sebelum keberangkatan ke Jepang, tergantung tingkat bahasa dan kesiapan dokumen.\r\n', 1),
(6, 'Apa saja syarat mendaftar program magang Jepang?', 'Minimal lulusan SMA/sederajat, sehat jasmani & rohani, tidak buta warna, serta siap mengikuti pelatihan bahasa Jepang secara intensif.\r\n', 1),
(7, 'Apakah peserta dijamin berangkat ke Jepang?', 'Kami memberikan bimbingan maksimal dan akses ke perusahaan mitra di Jepang. Namun, keberangkatan tetap tergantung hasil seleksi dan kelengkapan syarat peserta.\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`, `tanggal`) VALUES
(47, '20250713Jul1524.jpg', '2025-07-13'),
(49, '20250713151742_1.jpg', '2025-07-13'),
(50, '20250713151742_2.jpg', '2025-07-13'),
(51, '20250713151742_3.jpg', '2025-07-13'),
(52, '20250713151742_4.jpg', '2025-07-13'),
(53, '20250713151742_5.jpg', '2025-07-13'),
(54, '20250713151742_6.jpg', '2025-07-13'),
(55, '20250713151742_7.jpg', '2025-07-13'),
(56, '20250713151742_8.jpg', '2025-07-13'),
(57, '20250713151742_9.jpg', '2025-07-13'),
(58, '20250713151742_10.jpg', '2025-07-13'),
(59, '20250713151742_11.jpg', '2025-07-13'),
(60, '20250713151916_0.jpg', '2025-07-13'),
(61, '20250713151917_1.jpg', '2025-07-13'),
(62, '20250713151917_2.jpg', '2025-07-13'),
(63, '20250713151917_3.jpg', '2025-07-13'),
(64, '20250713151917_4.jpg', '2025-07-13'),
(65, '20250713151917_5.jpg', '2025-07-13'),
(66, '20250713151917_6.jpg', '2025-07-13'),
(67, '20250713151917_7.jpg', '2025-07-13'),
(68, '20250713151917_8.jpg', '2025-07-13'),
(69, '20250713151917_9.jpg', '2025-07-13'),
(70, '20250713151917_10.jpg', '2025-07-13'),
(71, '20250713151917_11.jpg', '2025-07-13'),
(72, '20250713151917_12.jpg', '2025-07-13'),
(73, '20250713151917_13.jpg', '2025-07-13'),
(74, '20250713151917_14.jpg', '2025-07-13'),
(75, '20250713151917_15.jpg', '2025-07-13'),
(76, '20250713151917_16.jpg', '2025-07-13'),
(77, '20250713151917_17.jpg', '2025-07-13'),
(78, '20250713151917_18.jpg', '2025-07-13'),
(79, '20250713151917_19.jpg', '2025-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `judul_website` varchar(60) NOT NULL,
  `profil_website` text DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `google_maps_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `judul_website`, `profil_website`, `alamat`, `google_maps_link`) VALUES
(1, 'LPK MPK-KOKEN', 'tescsa', 'Jl. Depok No. 1, Manahan, Banjarsari, Surakarta, Jawa Tengah', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1879075537036!2d110.80730327404562!3d-7.554479274591765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a169dc8843541%3A0x3dc77ad84aeac215!2sJl.%20Depok%20No.1%2C%20Manahan%2C%20Kec.%20Banjarsari%2C%20Kota%20Surakarta%2C%20Jawa%20Tengah%2057139!5e0!3m2!1sen!2sid!4v1751615449147!5m2!1sen!2sid');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `whatsapp_1` varchar(20) DEFAULT NULL,
  `whatsapp_2` varchar(20) DEFAULT NULL,
  `whatsapp_3` varchar(20) DEFAULT NULL,
  `active_whatsapp` enum('1','2','3') DEFAULT '1',
  `facebook` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_wa1` varchar(35) NOT NULL,
  `nama_wa2` varchar(35) NOT NULL,
  `nama_wa3` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `instagram`, `tiktok`, `whatsapp_1`, `whatsapp_2`, `whatsapp_3`, `active_whatsapp`, `facebook`, `email`, `nama_wa1`, `nama_wa2`, `nama_wa3`) VALUES
(1, 'tes', 'tes', '6285229654768', '098', '09092112', '1', 'tes', 'tes@gmail.com', 'ninik', 'nunik', 'nini');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `isi` text NOT NULL,
  `status` enum('publish','draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `isi`, `status`) VALUES
(2, 'Aulia Rahma', ' Belajar di MPK-KOKEN benar-benar membuka jalan saya ke Jepang. Suasana belajarnya intensif dan penuh dukungan.', 'publish'),
(3, 'Rizki Maulana', 'Saya diterima magang di Jepang! Terima kasih untuk bimbingan dan semangat dari para sensei di sini', 'publish'),
(4, 'Dewi Ayunda', 'Selain bahasa Jepang, saya juga belajar disiplin dan budaya kerja. Ini pengalaman hidup yang sangat berharga', 'publish'),
(5, 'Aditya Wira', 'Awalnya ragu, tapi sekarang saya bersyukur sudah jadi bagian dari keluarga MPK-KOKEN. Prosesnya jelas dan aman', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(70) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `recent_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `level`, `recent_login`) VALUES
(7, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '2025-07-16 13:22:58'),
(9, 'Binco Ran Nusantara', 'Binco Ran Nusantara', 'b79e3f61af120786a60dcf8ff7bb494d', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_features`
--
ALTER TABLE `about_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_id` (`about_id`);

--
-- Indexes for table `about_founder`
--
ALTER TABLE `about_founder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_founder_features`
--
ALTER TABLE `about_founder_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_founder_id` (`about_founder_id`);

--
-- Indexes for table `caraousel`
--
ALTER TABLE `caraousel`
  ADD PRIMARY KEY (`id_caraousel`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_keluarga`
--
ALTER TABLE `cv_keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_pendidikan`
--
ALTER TABLE `cv_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_pengalaman`
--
ALTER TABLE `cv_pengalaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_features`
--
ALTER TABLE `about_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `about_founder`
--
ALTER TABLE `about_founder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_founder_features`
--
ALTER TABLE `about_founder_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `caraousel`
--
ALTER TABLE `caraousel`
  MODIFY `id_caraousel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv_keluarga`
--
ALTER TABLE `cv_keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv_pendidikan`
--
ALTER TABLE `cv_pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv_pengalaman`
--
ALTER TABLE `cv_pengalaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_features`
--
ALTER TABLE `about_features`
  ADD CONSTRAINT `about_features_ibfk_1` FOREIGN KEY (`about_id`) REFERENCES `about` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `about_founder_features`
--
ALTER TABLE `about_founder_features`
  ADD CONSTRAINT `about_founder_features_ibfk_1` FOREIGN KEY (`about_founder_id`) REFERENCES `about_founder` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
