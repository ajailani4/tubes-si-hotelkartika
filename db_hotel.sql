-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 05:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `foto` varchar(50) NOT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `kelas`, `harga`, `satuan`, `foto`, `deskripsi`) VALUES
('F0101', 'Kamar', 'Standard', 300000, 'malam', 'img/kamar-standard.jpg', 'Sesuai dengan namanya, tipe standard room ini merupakan tipe kamar paling dasar dan dengan harga yang relatif murah tetapi fasilitas yang berkelas.\r\n\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Satu kasur king size atau dua queen size</p>\r\n<p>2. Televisi</p>\r\n<p>3. Lemari es </p>\r\n<p>4. Kamar mandi</p>'),
('F0102', 'Kamar', 'Superior', 500000, 'malam', 'img/kamar-superior.jpg', 'Terletak di dua lantai teratas, kamar ini menawarkan pemandangan yang megah di saat matahari terbit/terbenam.\r\n\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Satu kasur king size atau two twin size</p>\r\n<p>2. Televisi, kulkas, kamar mandi</p>\r\n<p>3. Fasilitas pembuatan teh dan kopi</p>\r\n<p>4. Area meja kerja yang luas</p>\r\n<p>5. Dry cleaning & laundry tersedia</p>'),
('F0103', 'Kamar', 'Deluxe', 700000, 'malam', 'img/kamar-deluxe.jpg', 'Kamar deluxe memiliki desain yang mewah dan berkelas. Setiap kamar Deluxe dilengkapi dengan tempat tidur tarik dan tempat tidur sofa.\r\n\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Kasur king size,Televisi, kulkas, kamar mandi</p>\r\n<p>2. Area meja kerja yang luas</p>\r\n<p>3. Dry cleaning & laundry tersedia</p>\r\n<p>4. Diskon 15% untuk makanan dan minuman, isi bar harian</p>'),
('F0201', 'Meeting Room', 'Reguler', 70000, 'jam', 'img/meetingroom-reguler.jpg', 'Ruang pertemuan ini dapat mengakomodasi sampai dengan 12 tamu.Ruang pertemuan ini menjadi tempat yang ideal untuk mengadakan acara pertemuan resmi atau pesta pribadi yang minimalis.\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Peralatan audio-visual mutakhir</p>\r\n<p>2. Layar portabel dan proyektor LCD</p>\r\n<p>3. Standard sound system dengan 2 mikrofon</p>\r\n<p>4. Penataan ruangan</p>'),
('F0202', 'Meeting Room', 'VIP', 150000, 'jam', 'img/meetingroom-vip.jpg', 'Ruang ini dapat menampung hingga 20 orang yang bisa digunakann untuk konferensi, pertemuan dan seminar. Ruangan pendukung juga tersedia. Serta dilengkapi Staff kami yang profesional dan berpengalaman.\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Peralatan audio-visual mutakhir</p>\r\n<p>2. Layar portabel dan proyektor LCD</p>\r\n<p>3. Standard sound system dengan 2 mikrofon</p>\r\n<p>4. Penataan ruangan</p>\r\n<p>5. Flipchart, wireless mic, notepad & ballpoint, Wi-Fi, sound system</p>'),
('F0203', 'Meeting Room', 'VVIP', 200000, 'jam', 'img/meetingroom-vvip.jpg', 'Ruang VVIP ini menawarkan suasana nyaman dan privat bagi acara bisnis yang cukup serius, dengan meja konferensi yang luas dan dapat memuat hingga 20 orang. Ada lounge area yang menenangkan dengan sofa empuk dan lukisan, serta sebuah pantry demi kemudahan dan kenyamanan maksimal untuk sesi rapat yang panjang.\r\n\r\n<p><b>Fasilitas yang ditawarkan:</b></p>\r\n<p>1. Peralatan audio-visual mutakhir</p>\r\n<p>2. Layar portabel dan proyektor LCD</p>\r\n<p>3. Standard sound system dengan 2 mikrofon</p>\r\n<p>4. Penataan ruangan</p>\r\n<p>5. Flipchart, wireless mic, notepad & ballpoint, Wi-Fi, sound system</p>'),
('F0301', 'Lainnya', 'Kolam Renang', 15000, 'orang', 'img/lainnya-kolamrenang.jpg', ''),
('F0302', 'Lainnya', 'Restoran', NULL, NULL, 'img/lainnya-restoran.jpg', ''),
('F0303', 'Lainnya', 'GYM', 20000, 'jam', 'img/lainnya-gym.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `nomor` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`nomor`, `kelas`, `status`) VALUES
(1, 'Standard', '0'),
(2, 'Standard', '0'),
(3, 'Standard', '0'),
(4, 'Standard', '0'),
(5, 'Standard', '0'),
(6, 'Superior', '0'),
(7, 'Superior', '0'),
(8, 'Superior', '0'),
(9, 'Superior', '0'),
(10, 'Superior', '0'),
(11, 'Deluxe', '0'),
(12, 'Deluxe', '0'),
(13, 'Deluxe', '0'),
(14, 'Deluxe', '0'),
(15, 'Deluxe', '0');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_room`
--

CREATE TABLE `meeting_room` (
  `nomor` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting_room`
--

INSERT INTO `meeting_room` (`nomor`, `kelas`, `status`) VALUES
(1, 'Reguler', '0'),
(2, 'Reguler', '0'),
(3, 'Reguler', '0'),
(4, 'Reguler', '0'),
(5, 'Reguler', '0'),
(6, 'VIP', '0'),
(7, 'VIP', '0'),
(8, 'VIP', '0'),
(9, 'VIP', '0'),
(10, 'VIP', '0'),
(11, 'VVIP', '0'),
(12, 'VVIP', '0'),
(13, 'VVIP', '0'),
(14, 'VVIP', '0'),
(15, 'VVIP', '0');

-- --------------------------------------------------------

--
-- Table structure for table `melakukan`
--

CREATE TABLE `melakukan` (
  `user` varchar(20) NOT NULL,
  `transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `fasilitas` varchar(20) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `harga` double NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `nik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`, `no_hp`, `nik`) VALUES
('claud', '$2y$10$1eL7sgrlvAtksDoL3Z7BIOOiRF3S3ZfUfAbCllMft.A0aqeYpcRfG', 'Claud', 'claud@email.com', '0192039', '21314123'),
('keyla', '$2y$10$sc0CLA.ynoZ5ewHGeOSAdewt9pF8/jGFWXxoc4rSLCT4a74EDC6DK', 'Keyla Thygenia', 'keyla@email.com', '9123012', '129948730129'),
('neil', '$2y$10$woofQXl22I56HvVQEq.npeI2R51qDBnmm0Oa8L2d9K.uJLjf1mbDe', 'Neil', 'neil@email.com', '0812345678', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `meeting_room`
--
ALTER TABLE `meeting_room`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `melakukan`
--
ALTER TABLE `melakukan`
  ADD KEY `user` (`user`),
  ADD KEY `transaksi` (`transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fasilitas` (`fasilitas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `meeting_room`
--
ALTER TABLE `meeting_room`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `melakukan`
--
ALTER TABLE `melakukan`
  ADD CONSTRAINT `melakukan_ibfk_2` FOREIGN KEY (`transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `melakukan_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`fasilitas`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
