-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 01:13 AM
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
-- Database: `project_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `NIK` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `no_hp`, `email`, `NIK`, `username`, `password`) VALUES
('MB001', 'Perong', 'kp.pamoyanan', '085795847276', 'eginovianisaputra313@gmail.com', 12323723, 'Perong', '$2y$10$cZuq6v6Dy3l5xck08FFPbeEnQEhx/Uf5Z3Bp6es3kEvXFAIvkl8r2');

-- --------------------------------------------------------

--
-- Table structure for table `booking_buku`
--

CREATE TABLE `booking_buku` (
  `id_booking` varchar(250) NOT NULL,
  `id_buku` varchar(250) NOT NULL,
  `id_anggota` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` varchar(250) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `genre` varchar(100) NOT NULL,
  `status` enum('dipinjam','tersedia','hilang') NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `gambar`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `genre`, `status`, `sinopsis`) VALUES
('bk001', '6735460b654d3.png', 'tes', 'tes', 'tes', '2024-11-14', 'tes', 'tersedia', 'rtyuil'),
('bk002', '67419cd7dfe24.jpg', 'tes2', 'sdads', 'trdc', '2024-11-23', 'hgmhf', 'tersedia', 'adadasd'),
('bk003', '6743eb1644466.jpeg', 'Dunia Shopie', 'egi sapsap', 'airil halim', '2024-11-13', 'misteri, horor, supranatural', 'tersedia', 'shopie yang suka makan banyak memutuskan menjelajahi dunia. apakah akan menyenangkan baginya? atau sebaliknya?.'),
('bk004', '6743ed998fe48.jpg', 'The Adventure of Arentha', 'mukarim', 'akbar abu', '2024-11-15', 'slice of life, adventure.', 'tersedia', 'suatu hari ada seorang anak yang penasaran dengan budaya budaya di negara wakanda. hingga, terjadi hal yang tidak terduga. dimana dia menemukan manis dan pahitnya ke hidupan.'),
('bk005', '6743f0fd2b454.jpeg', 'Rahasia Ayu', 'lixie xin lit', 'Gm Production', '2023-02-24', 'misteri, slice of life, horor', 'tersedia', 'Ayu adalah seorang pelajar tingkat atas(SMA). dia adalah gadis yang aneh, karena dia tidak pernah sekalipun memperlihatkan atau memberi tahu teman temannya tempat tinggal nya. suatu hari, di kabarkan bahwa siti tidak pernah pulang dan hilang. begitu pula dengan beberapa hari seterusnya. masalah ini membuat orang orang khawatir dan mulai menaruh curiga pada ayu. karena dari mereka ada beberapa orang yang lumayan sering berbincang dengan ayu yang pendiam dan misterius. apakah masalah ini betul berkaitan dengan ayu? bagaimana selanjutnya?'),
('bk006', '6743f3e7f2dda.jpeg', 'Keigo Higashino', 'egi dingin', 'alpha EG', '2024-11-14', 'misteri, magic.', 'tersedia', 'dikabarkan terjadi pencurian pada Bank Mini di Smakzie. banyak murid yang direpotkan karena uang yang mereka tabung hilang begitu saja. airil yang bingung antara kesal dan marah tetapi tidak bisa melakukan apa apa dan sedih, tiba tiba di datangi oleh egi yang sedang meniru karakter detektif kesukaanya, kemudian mengajak airil atau sahabatnya untuk mencari pelakunya. bagaimana kisahnya? apakah mereka berhasil menemukan pelakunya?.'),
('bk007', '6743f5bb9eb11.jpeg', 'Bukan 350 tahun dijajah', 'saputra indonesia', 'GeraTidur', '2023-05-20', 'fighting, millitary.', 'tersedia', 'orang orang menyebut wakanda dijajah selama 350 tahun. tetapi sebenarnya tidak! kebenaran ini akan diungkap oleh seorang remaja yang sejak kecil merasakan pahitnya kehidupan. apa yang sebenarnya terjadi? apakah wakanda masih dijajah?'),
('bk008', '6743f78d98d01.jpeg', 'Rumah Lebah', 'Andi lukito', 'Reza Fisch', '2024-11-09', 'science, slice of life.', 'tersedia', 'bukan hanya manusia yang harus bekerja untuk bertahan hidup, tetapi mahluk lain juga! seperti semut, berang berang, dan lain lain. natasha yang penasaran dengan pekerjaan hewan pun meminta kakeknya bercerita. kakek pun menceritakan tentang kisah para lebah. bagaimana kisahnya? ayo ikuti kisah kakek!'),
('bk009', '6743f9eeae47d.jpeg', 'Funiculi Funicula', 'egi mewing', 'Hindi global', '2024-11-16', 'school, slice of life.', 'tersedia', 'egi saputra, adalah seorang remaja yang baru masuk sekolah tingkat atas(SMA). dia adalah tipe anak yang sangat rajin bekerja untuk mendapatkan uang, karena dia tidak mau merepotkan ayahnya untuk biaya sekolahnya yang mahal. tetapi karena hal itu dia jadi sering bolos, dan tidak punya banyak teman yang dekat dengannya. egi percaya, dengan uang yag di dapatnya dari Crypto dia akan sekaya timor ronaldo. orang yang memotivasinya dan mengajarannya Crypto. akankah nasip egi berubah? berakibat baik atau buruk?');

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_tamu` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_tamu`, `tanggal`, `nama`, `alamat`, `no_hp`) VALUES
('5', '2024-10-28', '', 'kdjlfskaj', '0'),
('zt001', '2024-10-31', 'perong1', 'sad', '0'),
('zt002', '2024-11-04', 'test', 'sdfa', '872318237'),
('zt003', '2024-11-04', 'asdf', 'adfasd', '085795872764');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` varchar(250) NOT NULL,
  `id_anggota` varchar(255) NOT NULL,
  `jumlah_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_anggota`, `jumlah_buku`) VALUES
('P001', 'MB001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_detail`
--

CREATE TABLE `pinjaman_detail` (
  `id_pinjam_detail` varchar(250) NOT NULL,
  `id_anggota` varchar(250) NOT NULL,
  `id_buku` varchar(250) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jamPinjam` time NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('dipinjam','dikembalikan','hilang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_users` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_role` enum('admin','operator') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_users`, `username`, `user_role`, `password`) VALUES
('usr01', 'admin', 'admin', '$2y$10$Nz2AFTfLwAXbyO/OqGQAo.FN.2fFtk2GAtXASS9aHYxI/9t2YYoo2'),
('usr02', 'operator', 'operator', '$2y$10$gTnugSFiB.pqW9N5rYMWwetNxwEp7Xzoiv5QfGSVwCRHVPkvPYJ1i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `booking_buku`
--
ALTER TABLE `booking_buku`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `fk_booking_buku` (`id_buku`),
  ADD KEY `fk_booking_anggota` (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `fk_anggota` (`id_anggota`);

--
-- Indexes for table `pinjaman_detail`
--
ALTER TABLE `pinjaman_detail`
  ADD PRIMARY KEY (`id_pinjam_detail`),
  ADD KEY `fk_buku` (`id_buku`),
  ADD KEY `fk_pinjamdetail_anggota` (`id_anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_buku`
--
ALTER TABLE `booking_buku`
  ADD CONSTRAINT `booking_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `pinjaman_detail`
--
ALTER TABLE `pinjaman_detail`
  ADD CONSTRAINT `fk_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `fk_pinjamdetail_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
