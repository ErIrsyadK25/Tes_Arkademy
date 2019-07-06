-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 06 Jul 2019 pada 17.11
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arkademy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hobi`
--

CREATE TABLE `hobi` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hobi`
--

INSERT INTO `hobi` (`id`, `name`, `id_category`) VALUES
(1, 'Koleksi Tas', 1),
(2, 'InstaStory', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `name`) VALUES
(1, 'Shopping'),
(2, 'Media Sosial');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama`
--

CREATE TABLE `nama` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `id_hobby` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nama`
--

INSERT INTO `nama` (`id`, `name`, `id_hobby`, `id_category`) VALUES
(1, 'Novi', 1, 1),
(2, 'Vita', 2, 2),
(3, 'Tasya', 2, 2),
(4, 'Resya', 1, 1),
(5, 'Annisa', 2, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_arkademy`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_arkademy` (
`name` varchar(20)
,`Hobby` varchar(20)
,`Category` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_arkademy`
--
DROP TABLE IF EXISTS `v_arkademy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_arkademy`  AS  select `nama`.`name` AS `name`,`hobi`.`name` AS `Hobby`,`kategori`.`name` AS `Category` from ((`nama` join `hobi`) join `kategori`) where ((`nama`.`id_hobby` = `hobi`.`id`) and (`nama`.`id_category` = `kategori`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hobi`
--
ALTER TABLE `hobi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nama`
--
ALTER TABLE `nama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hobby` (`id_hobby`),
  ADD KEY `id_category` (`id_category`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hobi`
--
ALTER TABLE `hobi`
  ADD CONSTRAINT `hobi_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `nama`
--
ALTER TABLE `nama`
  ADD CONSTRAINT `nama_ibfk_1` FOREIGN KEY (`id_hobby`) REFERENCES `hobi` (`id`),
  ADD CONSTRAINT `nama_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
