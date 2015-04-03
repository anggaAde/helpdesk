-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 01 Apr 2015 pada 10.57
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `dbhelpdesk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_komplain`
--

CREATE TABLE IF NOT EXISTS `db_komplain` (
  `nama` varchar(50) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `masalah` varchar(200) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `action` int(1) NOT NULL,
  `executor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_komplain`
--

INSERT INTO `db_komplain` (`nama`, `bagian`, `ruang`, `email`, `masalah`, `tanggal`, `action`, `executor`) VALUES
('lp', 'plp', 'lp', 'lp', 'lp', '15-04-01 10:48:05', 0, ''),
('lo', 'lo', 'lo', 'lo', 'lo', '15-04-01 10:53:20', 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
