-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 01:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_sistem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admgudang`
--

CREATE TABLE IF NOT EXISTS `tbl_admgudang` (
  `kode_admgudang` varchar(15) NOT NULL,
  `nama_admgudang` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_admgudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admgudang`
--

INSERT INTO `tbl_admgudang` (`kode_admgudang`, `nama_admgudang`, `email`, `no_telp`, `aktif`) VALUES
('GDG_0001', 'AGUNG', 'admgudang@gmail.com', '078900987', 'Aktif'),
('GDG_0002', 'YANTO', 'admgudang1@gmail.com', '09876789', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admkeuangan`
--

CREATE TABLE IF NOT EXISTS `tbl_admkeuangan` (
  `kode_admkeuangan` varchar(15) NOT NULL,
  `nama_admkeuangan` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_admkeuangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admkeuangan`
--

INSERT INTO `tbl_admkeuangan` (`kode_admkeuangan`, `nama_admkeuangan`, `email`, `no_telp`, `aktif`) VALUES
('KEU_0001', 'TATIK', 'admkeu@gmail.com', '07890', 'Aktif'),
('KEU_0002', 'SURTI', 'admkeu1@gmail.com', '0987656789', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admper`
--

CREATE TABLE IF NOT EXISTS `tbl_admper` (
  `kode_admper` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `nama_admper` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_admper`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admper`
--

INSERT INTO `tbl_admper` (`kode_admper`, `kode_perwakilan`, `nama_admper`, `email`, `no_telp`, `aktif`) VALUES
('ADMPER_0001', 'KAPER_001', 'SITI', 'admsolo@gmail.com', '087997', 'Aktif'),
('ADMPER_0002', 'KAPER_002', 'SULIS', 'admsemarang@gmail.com', '086789', 'Aktif'),
('ADMPER_0003', 'KAPER_003', 'MINAH', 'admsumatra@gmail.com', '09686', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admproduksi`
--

CREATE TABLE IF NOT EXISTS `tbl_admproduksi` (
  `kode_admproduksi` varchar(15) NOT NULL,
  `nama_produksi` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_admproduksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admproduksi`
--

INSERT INTO `tbl_admproduksi` (`kode_admproduksi`, `nama_produksi`, `email`, `no_telp`, `aktif`) VALUES
('PROD_0001', 'SANDI', 'admproduk@gmail.com', '09890', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admpusat`
--

CREATE TABLE IF NOT EXISTS `tbl_admpusat` (
  `kode_admpusat` varchar(15) NOT NULL,
  `nama_admpusat` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_admpusat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admpusat`
--

INSERT INTO `tbl_admpusat` (`kode_admpusat`, `nama_admpusat`, `email`, `no_telp`, `aktif`) VALUES
('PUSAT_0001', 'TIKA', 'admpusat@gmail.com', '0878987', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE IF NOT EXISTS `tbl_buku` (
  `kode_buku` varchar(32) NOT NULL,
  `kode_penerbit` varchar(15) NOT NULL,
  `judul` varchar(80) DEFAULT NULL,
  `edisi` varchar(10) DEFAULT NULL,
  `jenjang` varchar(32) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `tipe` varchar(32) DEFAULT NULL,
  `kurikulum` varchar(20) DEFAULT NULL,
  `stok_real` int(10) unsigned DEFAULT NULL,
  `stok_pesan` int(10) unsigned DEFAULT NULL,
  `stok_mini` int(10) unsigned DEFAULT NULL,
  `stok_oc` int(12) NOT NULL,
  `ukuran_kertas` varchar(32) DEFAULT NULL,
  `warna_kertas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_buku`),
  KEY `kode_penerbit` (`kode_penerbit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`kode_buku`, `kode_penerbit`, `judul`, `edisi`, `jenjang`, `kelas`, `tipe`, `kurikulum`, `stok_real`, `stok_pesan`, `stok_mini`, `stok_oc`, `ukuran_kertas`, `warna_kertas`) VALUES
('M13H713001', 'PNB_0001', 'TEMA1-DIRIKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713002', 'PNB_0001', 'TEMA2-KEGEMARANKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713003', 'PNB_0001', 'TEMA3-KEGIATANKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713004', 'PNB_0001', 'TEMA4-KELUARGAKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713005', 'PNB_0001', 'TEMA5-PENGALAMANKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713006', 'PNB_0001', 'TEMA6-LINGK.BERSIH,SEHAT&ASRI-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 85, 17, 0, 0, '-', '-'),
('M13H713007', 'PNB_0001', 'TEMA7-BENDA,HEWAN&TANAMAN DI SEKITARKU-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 100, 32, 0, 0, '-', '-'),
('M13H713008', 'PNB_0001', 'TEMA8-PERISTIWA ALAM-SD1', 'VII', 'SD', '1', 'MATERI', '2013', 100, 32, 0, 0, '-', '-'),
('M13H713025', 'PNB_0001', 'TEMA1-INDAHNYA KEBERSAMAAN-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713026', 'PNB_0001', 'TEMA2-SELALU BERHEMAT ENERGI-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713027', 'PNB_0001', 'TEMA3-PEDULI TERHADAP LINGKUNGAN-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713028', 'PNB_0001', 'TEMA4-BERBAGAI PEKERJAAN-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713029', 'PNB_0001', 'TEMA5-PAHLAWANKU-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713030', 'PNB_0001', 'TEMA6-CITA-CITAKU-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713031', 'PNB_0001', 'TEMA7-INDAHNYA KEBERAGAMAN DI NEGERIKU-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713032', 'PNB_0001', 'TEMA8-DAERAH TEMPAT TINGGALKU-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13H713033', 'PNB_0001', 'TEMA9-KAYANYA NEGERIKU-SD4', 'VII', 'SD', '4', 'MATERI', '2013', 100, 0, 0, 0, '-', '-'),
('M13P713001', 'PNB_0001', 'TEMA1-DIRIKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 206, 3, 78, 500, '-', '-'),
('M13P713002', 'PNB_0001', 'TEMA2-KEGEMARANKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 501, 0, 88, 500, '-', '-'),
('M13P713003', 'PNB_0001', 'TEMA3-KEGIATANKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 7, 0, 79, 0, '-', '-'),
('M13P713004', 'PNB_0001', 'TEMA4-KELUARGAKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 2, 0, 79, 0, '-', '-'),
('M13P713005', 'PNB_0001', 'TEMA5-PENGALAMANKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 2, 0, 90, 0, '-', '-'),
('M13P713006', 'PNB_0001', 'TEMA6-LINGK.BERSIH,SEHAT&ASRI-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 95, 0, 0, 0, '-', '-'),
('M13P713007', 'PNB_0001', 'TEMA7-BENDA,HEWAN&TANAMAN DI SEKITARKU-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 95, 0, 0, 0, '-', '-'),
('M13P713008', 'PNB_0001', 'TEMA8-PERISTIWA ALAM-SD1', 'VII', 'PG-MT-SD', '1', 'BUKU GURU', '2013', 95, 0, 0, 0, '-', '-'),
('M13P713025', 'PNB_0001', 'TEMA1-INDAHNYA KEBERSAMAAN-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 0, 0, 0, '-', '-'),
('M13P713026', 'PNB_0001', 'TEMA2-SELALU BERHEMAT ENERGI-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 0, 0, 0, '-', '-'),
('M13P713027', 'PNB_0001', 'TEMA3-PEDULI TERHADAP LINGKUNGAN-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713028', 'PNB_0001', 'TEMA4-BERBAGAI PEKERJAAN-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713029', 'PNB_0001', 'TEMA5-PAHLAWANKU-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713030', 'PNB_0001', 'TEMA6-CITA-CITAKU-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713031', 'PNB_0001', 'TEMA7-INDAHNYA KEBERAGAMAN DI NEGERIKU-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713032', 'PNB_0001', 'TEMA8-DAERAH TEMPAT TINGGALKU-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-'),
('M13P713033', 'PNB_0001', 'TEMA9-KAYANYA NEGERIKU-SD4', 'VII', 'PG-MT-SD', '4', 'BUKU GURU', '2013', 100, 11, 0, 0, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_do`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_do` (
  `kode_buku` varchar(32) NOT NULL,
  `no_do` varchar(32) NOT NULL,
  `jumlah_beli` int(10) unsigned NOT NULL,
  `jumlah_kirim` int(10) unsigned DEFAULT NULL,
  `sisa_kirim` int(10) unsigned DEFAULT NULL,
  `harga` int(10) unsigned DEFAULT NULL,
  `ket` varchar(21) NOT NULL,
  PRIMARY KEY (`kode_buku`,`no_do`),
  KEY `no_do` (`no_do`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_do`
--

INSERT INTO `tbl_buku_do` (`kode_buku`, `no_do`, `jumlah_beli`, `jumlah_kirim`, `sisa_kirim`, `harga`, `ket`) VALUES
('M13H713001', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713002', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713003', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713004', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713005', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713006', '001/PSN/SLO/VIII/2019', 32, 15, 17, 70000, ''),
('M13H713007', '001/PSN/SLO/VIII/2019', 32, 0, 32, 70000, ''),
('M13H713008', '001/PSN/SLO/VIII/2019', 32, 0, 32, 70000, ''),
('M13P713001', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713001', '002/PSN/SLO/IX/2019', 11, 11, 0, 50000, 'stok_mini'),
('M13P713001', '002/PSN/SLO/VIII/2019', 3, 0, 3, 50000, ''),
('M13P713002', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713002', '002/PSN/SLO/IX/2019', 11, 11, 0, 50000, 'stok_mini'),
('M13P713002', '002/PSN/SLO/VIII/2019', 3, 3, 0, 50000, ''),
('M13P713003', '002/PSN/SLO/IX/2019', 11, 11, 0, 50000, 'stok_mini'),
('M13P713003', '002/PSN/SLO/VIII/2019', 3, 3, 0, 50000, ''),
('M13P713004', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713004', '002/PSN/SLO/IX/2019', 11, 11, 0, 50000, 'stok_mini'),
('M13P713004', '002/PSN/SLO/VIII/2019', 3, 3, 0, 50000, ''),
('M13P713005', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713005', '002/PSN/SLO/VIII/2019', 3, 3, 0, 50000, ''),
('M13P713006', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713007', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713008', '001/PSN/SMG/VIII/2019', 5, 5, 0, 50000, ''),
('M13P713027', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713028', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713029', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713030', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713031', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713032', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, ''),
('M13P713033', '001/PSN/SLO/IX/2019', 11, 0, 11, 50000, '');

--
-- Triggers `tbl_buku_do`
--
DROP TRIGGER IF EXISTS `Kurangi_Stok_pesan_saat_DO_hapus`;
DELIMITER //
CREATE TRIGGER `Kurangi_Stok_pesan_saat_DO_hapus` AFTER DELETE ON `tbl_buku_do`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku SET stok_pesan=stok_pesan-OLD.jumlah_beli WHERE kode_buku = OLD.kode_buku;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Tambah_Stok_pesan_saat_ke_DO`;
DELIMITER //
CREATE TRIGGER `Tambah_Stok_pesan_saat_ke_DO` AFTER INSERT ON `tbl_buku_do`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku SET stok_pesan=stok_pesan+NEW.jumlah_beli WHERE kode_buku = NEW.kode_buku;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_lpb`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_lpb` (
  `kode_oc` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `kode_lpb` varchar(32) NOT NULL,
  `total` int(10) unsigned DEFAULT NULL,
  KEY `kode_buku` (`kode_buku`,`kode_oc`),
  KEY `kode_lpb` (`kode_lpb`),
  KEY `kode_oc` (`kode_oc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_lpb`
--

INSERT INTO `tbl_buku_lpb` (`kode_oc`, `kode_buku`, `kode_lpb`, `total`) VALUES
('001/OC-MDT/IX/2019', 'M13P713002', '001/LPB-MDT/IX/2019', 200),
('001/OC-MDT/IX/2019', 'M13P713002', '002/LPB-MDT/IX/2019', 300),
('001/OC-MDT/IX/2019', 'M13P713001', '003/LPB-MDT/IX/2019', 200);

--
-- Triggers `tbl_buku_lpb`
--
DROP TRIGGER IF EXISTS `Hapus_LPB`;
DELIMITER //
CREATE TRIGGER `Hapus_LPB` AFTER DELETE ON `tbl_buku_lpb`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku, tbl_buku_oc 
 SET tbl_buku.stok_oc=tbl_buku.stok_oc+OLD.total,
     tbl_buku.stok_real=tbl_buku.stok_real-OLD.total,
     
     tbl_buku_oc.jadi=tbl_buku_oc.jadi-OLD.total,
     tbl_buku_oc.kurang=tbl_buku_oc.kurang+OLD.total
 WHERE tbl_buku_oc.kode_buku = OLD.kode_buku 
 AND tbl_buku.kode_buku = tbl_buku_oc.kode_buku;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Tambah_LPB`;
DELIMITER //
CREATE TRIGGER `Tambah_LPB` AFTER INSERT ON `tbl_buku_lpb`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku, tbl_buku_oc 
 SET tbl_buku.stok_oc=tbl_buku.stok_oc-NEW.total,
     tbl_buku.stok_real=tbl_buku.stok_real+NEW.total,
     
     tbl_buku_oc.jadi=tbl_buku_oc.jadi+NEW.total,
     tbl_buku_oc.kurang=tbl_buku_oc.kurang-NEW.total
 WHERE tbl_buku_oc.kode_buku = NEW.kode_buku 
 AND tbl_buku.kode_buku = tbl_buku_oc.kode_buku;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_oc`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_oc` (
  `kode_buku` varchar(32) NOT NULL,
  `kode_oc` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  `jadi` int(10) unsigned DEFAULT NULL,
  `kurang` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_buku`,`kode_oc`),
  KEY `kode_oc` (`kode_oc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_oc`
--

INSERT INTO `tbl_buku_oc` (`kode_buku`, `kode_oc`, `jumlah`, `jadi`, `kurang`) VALUES
('M13P713001', '001/OC-MDT/IX/2019', 500, 200, 300),
('M13P713001', '002/OC-MDT/IX/2019', 200, 0, 200),
('M13P713002', '001/OC-MDT/IX/2019', 1000, 500, 500);

--
-- Triggers `tbl_buku_oc`
--
DROP TRIGGER IF EXISTS `Kurang_stokoc`;
DELIMITER //
CREATE TRIGGER `Kurang_stokoc` AFTER DELETE ON `tbl_buku_oc`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku SET stok_oc=stok_oc-OLD.jumlah WHERE kode_buku = OLD.kode_buku;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Tambah_stokoc`;
DELIMITER //
CREATE TRIGGER `Tambah_stokoc` AFTER INSERT ON `tbl_buku_oc`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku SET stok_oc=stok_oc+NEW.jumlah WHERE kode_buku = NEW.kode_buku;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_psnstk`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_psnstk` (
  `kode_buku` varchar(32) NOT NULL,
  `no_stokmini` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kode_buku`,`no_stokmini`),
  KEY `no_stokmini` (`no_stokmini`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_psnstk`
--

INSERT INTO `tbl_buku_psnstk` (`kode_buku`, `no_stokmini`, `jumlah`) VALUES
('M13P713001', '001/STK-MN/SLO/IX/2019', 89),
('M13P713002', '001/STK-MN/SLO/IX/2019', 99),
('M13P713003', '001/STK-MN/SLO/IX/2019', 90),
('M13P713004', '001/STK-MN/SLO/IX/2019', 90),
('M13P713005', '001/STK-MN/SLO/IX/2019', 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_reqretur`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_reqretur` (
  `no_suratjalan` varchar(32) NOT NULL,
  `no_do` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `no_suratretur` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  `harga` int(10) unsigned DEFAULT NULL,
  `ket` varchar(21) NOT NULL,
  PRIMARY KEY (`no_suratjalan`,`no_do`,`kode_buku`,`no_suratretur`),
  KEY `no_suratretur` (`no_suratretur`),
  KEY `kode_buku` (`kode_buku`,`no_do`,`no_suratjalan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_reqretur`
--

INSERT INTO `tbl_buku_reqretur` (`no_suratjalan`, `no_do`, `kode_buku`, `no_suratretur`, `jumlah`, `harga`, `ket`) VALUES
('001/SJ-MDT/SLO/VIII/2019', '001/PSN/SLO/VIII/2019', 'M13H713001', '001/RTR-MDT/SLO/IX/2019', 8, 70000, ''),
('001/SJ-MDT/SLO/VIII/2019', '001/PSN/SLO/VIII/2019', 'M13H713002', '001/RTR-MDT/SLO/IX/2019', 6, 70000, ''),
('001/SJ-MDT/SLO/VIII/2019', '001/PSN/SLO/VIII/2019', 'M13H713003', '001/RTR-MDT/SLO/IX/2019', 4, 70000, ''),
('001/SJ-MDT/SLO/VIII/2019', '001/PSN/SLO/VIII/2019', 'M13H713004', '001/RTR-MDT/SLO/IX/2019', 8, 70000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_retur`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_retur` (
  `no_suratretur` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `no_do` varchar(32) NOT NULL,
  `no_suratjalan` varchar(32) NOT NULL,
  `kode_retur` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  `harga` int(10) unsigned DEFAULT NULL,
  `ket` varchar(21) NOT NULL,
  PRIMARY KEY (`no_suratretur`,`kode_buku`,`no_do`,`no_suratjalan`),
  KEY `no_suratretur` (`no_suratretur`,`no_suratjalan`,`no_do`,`kode_buku`),
  KEY `kode_retur` (`kode_retur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_buku_retur`
--
DROP TRIGGER IF EXISTS `Retur_kurang_sj`;
DELIMITER //
CREATE TRIGGER `Retur_kurang_sj` AFTER INSERT ON `tbl_buku_retur`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku_sj SET 
 retur = retur+NEW.jumlah
 WHERE tbl_buku_sj.kode_buku = NEW.kode_buku
 AND tbl_buku_sj.no_do = NEW.no_do
 AND tbl_buku_sj.no_suratjalan = NEW.no_suratjalan;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Retur_tambah_sj`;
DELIMITER //
CREATE TRIGGER `Retur_tambah_sj` AFTER DELETE ON `tbl_buku_retur`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku_sj SET 
 retur = retur-OLD.jumlah
 WHERE tbl_buku_sj.kode_buku = OLD.kode_buku
 AND tbl_buku_sj.no_do = OLD.no_do
 AND tbl_buku_sj.no_suratjalan = OLD.no_suratjalan;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_sj`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_sj` (
  `kode_buku` varchar(32) NOT NULL,
  `no_do` varchar(32) NOT NULL,
  `no_suratjalan` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  `retur` int(10) NOT NULL,
  `harga` int(10) unsigned DEFAULT NULL,
  `ket` varchar(21) NOT NULL,
  PRIMARY KEY (`kode_buku`,`no_do`,`no_suratjalan`),
  KEY `no_suratjalan` (`no_suratjalan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_sj`
--

INSERT INTO `tbl_buku_sj` (`kode_buku`, `no_do`, `no_suratjalan`, `jumlah`, `retur`, `harga`, `ket`) VALUES
('M13H713001', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13H713002', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13H713003', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13H713004', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13H713005', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13H713006', '001/PSN/SLO/VIII/2019', '001/SJ-MDT/SLO/VIII/2019', 15, 0, 70000, ''),
('M13P713001', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713001', '002/PSN/SLO/IX/2019', '001/SJ-MDT/SLO/IX/2019', 11, 0, 50000, 'stok_mini'),
('M13P713002', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713002', '002/PSN/SLO/IX/2019', '001/SJ-MDT/SLO/IX/2019', 11, 0, 50000, 'stok_mini'),
('M13P713002', '002/PSN/SLO/VIII/2019', '002/SJ-MDT/SLO/VIII/2019', 3, 0, 50000, ''),
('M13P713003', '002/PSN/SLO/IX/2019', '001/SJ-MDT/SLO/IX/2019', 11, 0, 50000, 'stok_mini'),
('M13P713003', '002/PSN/SLO/VIII/2019', '002/SJ-MDT/SLO/VIII/2019', 3, 0, 50000, ''),
('M13P713004', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713004', '002/PSN/SLO/IX/2019', '001/SJ-MDT/SLO/IX/2019', 11, 0, 50000, 'stok_mini'),
('M13P713004', '002/PSN/SLO/VIII/2019', '002/SJ-MDT/SLO/VIII/2019', 3, 0, 50000, ''),
('M13P713005', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713005', '002/PSN/SLO/VIII/2019', '002/SJ-MDT/SLO/VIII/2019', 3, 0, 50000, ''),
('M13P713006', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713007', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, ''),
('M13P713008', '001/PSN/SMG/VIII/2019', '001/SJ-MDT/SMG/VIII/2019', 5, 0, 50000, '');

--
-- Triggers `tbl_buku_sj`
--
DROP TRIGGER IF EXISTS `SjKurang_proses_Stok_StokReal_StokPesan_SisaKirim`;
DELIMITER //
CREATE TRIGGER `SjKurang_proses_Stok_StokReal_StokPesan_SisaKirim` AFTER DELETE ON `tbl_buku_sj`
 FOR EACH ROW BEGIN
IF OLD.ket = 'stok_real' THEN
 UPDATE tbl_buku, tbl_buku_do
 SET tbl_buku.stok_pesan=tbl_buku.stok_pesan+OLD.jumlah,
 tbl_buku.stok_real=tbl_buku.stok_real+OLD.jumlah,
 tbl_buku_do.sisa_kirim=tbl_buku_do.sisa_kirim+OLD.jumlah,
 tbl_buku_do.jumlah_kirim=tbl_buku_do.jumlah_kirim-OLD.jumlah
 WHERE tbl_buku.kode_buku = OLD.kode_buku
 AND tbl_buku_do.kode_buku = OLD.kode_buku
 AND tbl_buku_do.no_do = OLD.no_do;

ELSE IF OLD.ket = 'stok_mini' THEN
UPDATE tbl_stokmini, tbl_suratjalan, tbl_buku_do, tbl_do, tbl_pesanan, tbl_buku
SET tbl_stokmini.stok = tbl_stokmini.stok+ OLD.jumlah,
 tbl_buku.stok_pesan=tbl_buku.stok_pesan+ OLD.jumlah,
 tbl_buku.stok_mini=tbl_buku.stok_mini+ OLD.jumlah,
 tbl_buku_do.sisa_kirim=tbl_buku_do.sisa_kirim+ OLD.jumlah,
 tbl_buku_do.jumlah_kirim=tbl_buku_do.jumlah_kirim- OLD.jumlah
 WHERE tbl_buku.kode_buku = OLD.kode_buku
 AND tbl_buku_do.kode_buku = OLD.kode_buku
 AND tbl_stokmini.kode_buku = OLD.kode_buku
 AND tbl_buku_do.no_do = OLD.no_do
 AND tbl_suratjalan.no_suratjalan = OLD.no_suratjalan
 AND tbl_suratjalan.no_do = OLD.no_do
 AND tbl_suratjalan.no_do = tbl_do.no_do
 AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
 AND tbl_pesanan.kode_perwakilan = tbl_stokmini.kode_perwakilan;
END IF;
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `SjTambah_proses_Stok_StokReal_StokPesan_SisaKirim`;
DELIMITER //
CREATE TRIGGER `SjTambah_proses_Stok_StokReal_StokPesan_SisaKirim` AFTER INSERT ON `tbl_buku_sj`
 FOR EACH ROW BEGIN
IF NEW.ket = 'stok_real' THEN
 UPDATE tbl_buku, tbl_buku_do
 SET tbl_buku.stok_pesan=tbl_buku.stok_pesan-NEW.jumlah,
 tbl_buku.stok_real=tbl_buku.stok_real-NEW.jumlah,
 tbl_buku_do.sisa_kirim=tbl_buku_do.sisa_kirim-NEW.jumlah,
 tbl_buku_do.jumlah_kirim=tbl_buku_do.jumlah_kirim+NEW.jumlah
 WHERE tbl_buku.kode_buku = NEW.kode_buku
 AND tbl_buku_do.kode_buku = NEW.kode_buku
 AND tbl_buku_do.no_do = NEW.no_do;
ELSE IF NEW.ket= 'stok_mini' THEN
UPDATE tbl_stokmini, tbl_suratjalan, tbl_buku_do, tbl_do, tbl_pesanan, tbl_buku
SET tbl_stokmini.stok = tbl_stokmini.stok-NEW.jumlah,
 tbl_buku.stok_pesan=tbl_buku.stok_pesan-NEW.jumlah,
 tbl_buku.stok_mini=tbl_buku.stok_mini-NEW.jumlah,
 tbl_buku_do.sisa_kirim=tbl_buku_do.sisa_kirim-NEW.jumlah,
 tbl_buku_do.jumlah_kirim=tbl_buku_do.jumlah_kirim+NEW.jumlah
 WHERE tbl_buku.kode_buku = NEW.kode_buku
 AND tbl_buku_do.kode_buku = NEW.kode_buku
 AND tbl_stokmini.kode_buku = NEW.kode_buku
 AND tbl_buku_do.no_do = NEW.no_do
 AND tbl_suratjalan.no_suratjalan = NEW.no_suratjalan
 AND tbl_suratjalan.no_do = NEW.no_do
 AND tbl_suratjalan.no_do = tbl_do.no_do
 AND tbl_do.no_pesanan = tbl_pesanan.no_pesanan
 AND tbl_pesanan.kode_perwakilan = tbl_stokmini.kode_perwakilan;
END IF;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_stkmini`
--

CREATE TABLE IF NOT EXISTS `tbl_buku_stkmini` (
  `no_sj_stkmini` varchar(32) NOT NULL,
  `no_stokmini` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `jumlah` int(10) unsigned DEFAULT NULL,
  KEY `no_stokmini` (`no_stokmini`,`kode_buku`),
  KEY `no_sj_stkmini` (`no_sj_stkmini`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku_stkmini`
--

INSERT INTO `tbl_buku_stkmini` (`no_sj_stkmini`, `no_stokmini`, `kode_buku`, `jumlah`) VALUES
('001/SJSTK-MDT/SLO/IX/2019', '001/STK-MN/SLO/IX/2019', 'M13P713001', 89),
('001/SJSTK-MDT/SLO/IX/2019', '001/STK-MN/SLO/IX/2019', 'M13P713002', 99),
('001/SJSTK-MDT/SLO/IX/2019', '001/STK-MN/SLO/IX/2019', 'M13P713003', 90),
('001/SJSTK-MDT/SLO/IX/2019', '001/STK-MN/SLO/IX/2019', 'M13P713004', 90),
('001/SJSTK-MDT/SLO/IX/2019', '001/STK-MN/SLO/IX/2019', 'M13P713005', 90);

--
-- Triggers `tbl_buku_stkmini`
--
DROP TRIGGER IF EXISTS `Kurang_stokmini`;
DELIMITER //
CREATE TRIGGER `Kurang_stokmini` AFTER DELETE ON `tbl_buku_stkmini`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku
 SET stok_real = stok_real + OLD.jumlah
 WHERE tbl_buku.kode_buku = OLD.kode_buku;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Tambah_stokmini`;
DELIMITER //
CREATE TRIGGER `Tambah_stokmini` AFTER INSERT ON `tbl_buku_stkmini`
 FOR EACH ROW BEGIN
 UPDATE tbl_buku
 SET stok_real = stok_real - NEW.jumlah
 WHERE tbl_buku.kode_buku = NEW.kode_buku;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `kode_customer` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `nama_customer` varchar(60) NOT NULL,
  `alamat_customer` varchar(225) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `aktif` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_customer`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`kode_customer`, `kode_perwakilan`, `nama_customer`, `alamat_customer`, `no_telp`, `aktif`) VALUES
('CSTM_0001', 'KAPER_001', 'SMA N 1 SOLO', 'Solo', '0988908', 'Aktif'),
('CSTM_0002', 'KAPER_001', 'SMA N 34 SOLO', 'Solo', '0987890', 'Aktif'),
('CSTM_0003', 'KAPER_002', 'SD N 1 BANYAMANIK', 'Ungaran', '098789', 'Aktif'),
('CSTM_0004', 'KAPER_003', 'SMP MUHAMMADIYAH 3 SUMATRA', 'Sumatra', '098789', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cvrekanan`
--

CREATE TABLE IF NOT EXISTS `tbl_cvrekanan` (
  `kode_cv` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) DEFAULT NULL,
  `nama_cv` varchar(32) NOT NULL,
  `alamat_cv` varchar(225) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `aktif` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_cv`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cvrekanan`
--

INSERT INTO `tbl_cvrekanan` (`kode_cv`, `kode_perwakilan`, `nama_cv`, `alamat_cv`, `no_telp`, `aktif`) VALUES
('CV_0001', 'KAPER_001', 'CV. MEDIA AGUNG', 'Solo', '098789', 'Aktif'),
('CV_0002', 'KAPER_002', 'CV. MEDIASA', 'Semarang', '0789', 'Aktif'),
('CV_0003', 'KAPER_003', 'CV. MEDIANA', 'Sumatra', '09876789', 'Aktif'),
('Tanpa CV', NULL, 'Tanpa CV', 'Tanpa CV', '', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_datapesan`
--

CREATE TABLE IF NOT EXISTS `tbl_datapesan` (
  `no_pesanan` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `jumlah_beli` int(10) unsigned DEFAULT NULL,
  `harga` int(10) unsigned DEFAULT NULL,
  `ket` varchar(21) NOT NULL,
  PRIMARY KEY (`no_pesanan`,`kode_buku`),
  KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_datapesan`
--

INSERT INTO `tbl_datapesan` (`no_pesanan`, `kode_buku`, `jumlah_beli`, `harga`, `ket`) VALUES
('001/PSN/SLO/IX/2019', 'M13P713027', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713028', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713029', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713030', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713031', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713032', 11, 50000, ''),
('001/PSN/SLO/IX/2019', 'M13P713033', 11, 50000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713001', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713002', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713003', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713004', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713005', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713006', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713007', 32, 70000, ''),
('001/PSN/SLO/VIII/2019', 'M13H713008', 32, 70000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713001', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713002', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713004', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713005', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713006', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713007', 5, 50000, ''),
('001/PSN/SMG/VIII/2019', 'M13P713008', 5, 50000, ''),
('002/PSN/SLO/IX/2019', 'M13P713001', 11, 50000, 'stok_mini'),
('002/PSN/SLO/IX/2019', 'M13P713002', 11, 50000, 'stok_mini'),
('002/PSN/SLO/IX/2019', 'M13P713003', 11, 50000, 'stok_mini'),
('002/PSN/SLO/IX/2019', 'M13P713004', 11, 50000, 'stok_mini'),
('002/PSN/SLO/VIII/2019', 'M13P713001', 3, 50000, ''),
('002/PSN/SLO/VIII/2019', 'M13P713002', 3, 50000, ''),
('002/PSN/SLO/VIII/2019', 'M13P713003', 3, 50000, ''),
('002/PSN/SLO/VIII/2019', 'M13P713004', 3, 50000, ''),
('002/PSN/SLO/VIII/2019', 'M13P713005', 3, 50000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detpaket`
--

CREATE TABLE IF NOT EXISTS `tbl_detpaket` (
  `kode_paket` varchar(32) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  KEY `kode_paket` (`kode_paket`),
  KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_do`
--

CREATE TABLE IF NOT EXISTS `tbl_do` (
  `no_do` varchar(32) NOT NULL,
  `kode_admpusat` varchar(15) NOT NULL,
  `no_pesanan` varchar(32) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `kondisi` varchar(15) DEFAULT NULL,
  `stok` varchar(21) NOT NULL,
  PRIMARY KEY (`no_do`),
  KEY `no_pesanan` (`no_pesanan`),
  KEY `kode_admpusat` (`kode_admpusat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_do`
--

INSERT INTO `tbl_do` (`no_do`, `kode_admpusat`, `no_pesanan`, `tanggal`, `kondisi`, `stok`) VALUES
('001/PSN/SLO/IX/2019', 'PUSAT_0001', '001/PSN/SLO/IX/2019', '2019-09-23', 'Proses', ''),
('001/PSN/SLO/VIII/2019', 'PUSAT_0001', '001/PSN/SLO/VIII/2019', '2019-08-29', 'Proses', ''),
('001/PSN/SMG/VIII/2019', 'PUSAT_0001', '001/PSN/SMG/VIII/2019', '2019-08-30', 'Proses', ''),
('002/PSN/SLO/IX/2019', 'PUSAT_0001', '002/PSN/SLO/IX/2019', '2019-09-26', 'Proses', 'stok_mini'),
('002/PSN/SLO/VIII/2019', 'PUSAT_0001', '002/PSN/SLO/VIII/2019', '2019-08-30', 'Proses', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_do_stokmini`
--

CREATE TABLE IF NOT EXISTS `tbl_do_stokmini` (
  `no_do_stokmini` varchar(32) NOT NULL,
  `kode_admpusat` varchar(15) NOT NULL,
  `no_stokmini` varchar(32) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`no_do_stokmini`),
  KEY `no_stokmini` (`no_stokmini`),
  KEY `kode_admpusat` (`kode_admpusat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_do_stokmini`
--

INSERT INTO `tbl_do_stokmini` (`no_do_stokmini`, `kode_admpusat`, `no_stokmini`, `tanggal`) VALUES
('001/STK-MN/SLO/IX/2019', 'PUSAT_0001', '001/STK-MN/SLO/IX/2019', '2019-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faktur`
--

CREATE TABLE IF NOT EXISTS `tbl_faktur` (
  `no_faktur` varchar(32) NOT NULL,
  `kode_admkeuangan` varchar(15) NOT NULL,
  `no_suratjalan` varchar(32) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `harga_tahun` varchar(5) DEFAULT NULL,
  `tenggang` varchar(15) DEFAULT NULL,
  `bruto` int(10) unsigned DEFAULT NULL,
  `netto` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `no_suratjalan` (`no_suratjalan`),
  KEY `kode_admkeuangan` (`kode_admkeuangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faktur`
--

INSERT INTO `tbl_faktur` (`no_faktur`, `kode_admkeuangan`, `no_suratjalan`, `tanggal`, `harga_tahun`, `tenggang`, `bruto`, `netto`) VALUES
('001/FT-MDT/SLO/VIII/2019', 'KEU_0001', '001/SJ-MDT/SLO/VIII/2019', '2019-08-30', '2019', '2019-11-30', 8540000, 5124000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handlegudang`
--

CREATE TABLE IF NOT EXISTS `tbl_handlegudang` (
  `kode_handle` varchar(30) NOT NULL,
  `kode_admgudang` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  `kondisi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_handle`),
  KEY `kode_perwakilan` (`kode_perwakilan`),
  KEY `kode_admgudang` (`kode_admgudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_handlegudang`
--

INSERT INTO `tbl_handlegudang` (`kode_handle`, `kode_admgudang`, `kode_perwakilan`, `aktif`, `kondisi`) VALUES
('GDG_0001_KAPER_001', 'GDG_0001', 'KAPER_001', 'Aktif', 'Asli'),
('GDG_0001_KAPER_002', 'GDG_0001', 'KAPER_002', 'Aktif', 'Asli'),
('GDG_0001_KAPER_003', 'GDG_0001', 'KAPER_003', 'Aktif', 'Asli');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handlekeuangan`
--

CREATE TABLE IF NOT EXISTS `tbl_handlekeuangan` (
  `kode_handle` varchar(30) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `kode_admkeuangan` varchar(15) NOT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  `kondisi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_handle`),
  KEY `kode_admkeuangan` (`kode_admkeuangan`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_handlekeuangan`
--

INSERT INTO `tbl_handlekeuangan` (`kode_handle`, `kode_perwakilan`, `kode_admkeuangan`, `aktif`, `kondisi`) VALUES
('KEU_0001_KAPER_001', 'KAPER_001', 'KEU_0001', 'Aktif', 'Asli'),
('KEU_0001_KAPER_002', 'KAPER_002', 'KEU_0001', 'Aktif', 'Asli'),
('KEU_0001_KAPER_003', 'KAPER_003', 'KEU_0001', 'Aktif', 'Asli');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handlepemasaran`
--

CREATE TABLE IF NOT EXISTS `tbl_handlepemasaran` (
  `kode_handle` varchar(30) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `kode_admpusat` varchar(15) NOT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  `kondisi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_handle`),
  KEY `kode_admpusat` (`kode_admpusat`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_handlepemasaran`
--

INSERT INTO `tbl_handlepemasaran` (`kode_handle`, `kode_perwakilan`, `kode_admpusat`, `aktif`, `kondisi`) VALUES
('PUSAT_0001_KAPER_001', 'KAPER_001', 'PUSAT_0001', 'Aktif', 'Asli'),
('PUSAT_0001_KAPER_002', 'KAPER_002', 'PUSAT_0001', 'Aktif', 'Asli'),
('PUSAT_0001_KAPER_003', 'KAPER_003', 'PUSAT_0001', 'Aktif', 'Asli');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga_2019`
--

CREATE TABLE IF NOT EXISTS `tbl_harga_2019` (
  `kode_buku` varchar(32) NOT NULL,
  `harga_jawa` int(10) unsigned DEFAULT NULL,
  `harga_luar` int(10) unsigned DEFAULT NULL,
  KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_harga_2019`
--

INSERT INTO `tbl_harga_2019` (`kode_buku`, `harga_jawa`, `harga_luar`) VALUES
('M13H713001', 70000, 75000),
('M13H713002', 70000, 75000),
('M13H713003', 70000, 75000),
('M13H713004', 70000, 75000),
('M13H713005', 70000, 75000),
('M13H713006', 70000, 75000),
('M13H713007', 70000, 75000),
('M13H713008', 70000, 75000),
('M13H713025', 70000, 75000),
('M13H713026', 70000, 75000),
('M13H713027', 70000, 75000),
('M13H713028', 70000, 75000),
('M13H713029', 70000, 75000),
('M13H713030', 70000, 75000),
('M13H713031', 70000, 75000),
('M13H713032', 70000, 75000),
('M13H713033', 70000, 75000),
('M13P713001', 50000, 55000),
('M13P713002', 50000, 55000),
('M13P713003', 50000, 55000),
('M13P713004', 50000, 55000),
('M13P713005', 50000, 55000),
('M13P713006', 50000, 55000),
('M13P713007', 50000, 55000),
('M13P713008', 50000, 55000),
('M13P713025', 50000, 55000),
('M13P713026', 50000, 55000),
('M13P713027', 50000, 55000),
('M13P713028', 50000, 55000),
('M13P713029', 50000, 55000),
('M13P713030', 50000, 55000),
('M13P713031', 50000, 55000),
('M13P713032', 50000, 55000),
('M13P713033', 50000, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kas`
--

CREATE TABLE IF NOT EXISTS `tbl_kas` (
  `no_kas` varchar(32) NOT NULL,
  `kode_admkeuangan` varchar(15) NOT NULL,
  `bank` varchar(10) DEFAULT NULL,
  `nama_penyetor` varchar(32) DEFAULT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `terpakai` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`no_kas`),
  KEY `kode_admkeuangan` (`kode_admkeuangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kas`
--

INSERT INTO `tbl_kas` (`no_kas`, `kode_admkeuangan`, `bank`, `nama_penyetor`, `tanggal`, `total`, `terpakai`) VALUES
('10/IX/2019', 'KEU_0002', 'BRI', 'Yadi', '2019-09-28', '9000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kerjasama`
--

CREATE TABLE IF NOT EXISTS `tbl_kerjasama` (
  `kode_kerjasama` varchar(32) NOT NULL,
  `kode_perwakilan` varchar(15) DEFAULT NULL,
  `nama_kerjasama` varchar(32) DEFAULT NULL,
  `alamat_kerjasama` varchar(255) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_kerjasama`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kerjasama`
--

INSERT INTO `tbl_kerjasama` (`kode_kerjasama`, `kode_perwakilan`, `nama_kerjasama`, `alamat_kerjasama`, `aktif`) VALUES
('KJSM_0001', 'KAPER_001', 'MKKS SMA SOLO', 'Solo', 'Aktif'),
('KJSM_0002', 'KAPER_002', 'MKKS KOTA SEMARANG', 'Semarang', 'Aktif'),
('KJSM_0003', 'KAPER_003', 'KKKS SUMATRA', 'Sumatra', 'Aktif'),
('Tanpa Pengajuan', NULL, 'Tanpa Pengajuan', 'Tanpa Pengajuan', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `cookie_user` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `tanggal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cookie_user`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lpb`
--

CREATE TABLE IF NOT EXISTS `tbl_lpb` (
  `kode_lpb` varchar(32) NOT NULL,
  `kode_admgudang` varchar(15) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_lpb`),
  KEY `kode_admgudang` (`kode_admgudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lpb`
--

INSERT INTO `tbl_lpb` (`kode_lpb`, `kode_admgudang`, `tanggal`) VALUES
('001/LPB-MDT/IX/2019', 'GDG_0002', '2019-09-28'),
('002/LPB-MDT/IX/2019', 'GDG_0002', '2019-09-28'),
('003/LPB-MDT/IX/2019', 'GDG_0002', '2019-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marea`
--

CREATE TABLE IF NOT EXISTS `tbl_marea` (
  `kode_area` varchar(15) NOT NULL,
  `kode_nasional` varchar(15) NOT NULL,
  `nama_area` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_area`),
  KEY `kode_nasional` (`kode_nasional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_marea`
--

INSERT INTO `tbl_marea` (`kode_area`, `kode_nasional`, `nama_area`, `email`, `no_telp`, `area`, `aktif`) VALUES
('AREA_001', 'NAS_001', 'Rauf', 'rauf@gmail.com', '0897', 'Jateng', 'Aktif'),
('AREA_002', 'NAS_001', 'Aris', 'aris@gmail.com', '0868655', 'Sumatra', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mnasional`
--

CREATE TABLE IF NOT EXISTS `tbl_mnasional` (
  `kode_nasional` varchar(15) NOT NULL,
  `nama_nasional` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_nasional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mnasional`
--

INSERT INTO `tbl_mnasional` (`kode_nasional`, `nama_nasional`, `email`, `no_telp`, `aktif`) VALUES
('NAS_001', 'Bagiyo', 'bagiyo@gmail.com', '076789', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mou`
--

CREATE TABLE IF NOT EXISTS `tbl_mou` (
  `no_mou` varchar(32) NOT NULL,
  `kode_cv` varchar(15) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `fee` float DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`no_mou`),
  KEY `kode_cv` (`kode_cv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mou`
--

INSERT INTO `tbl_mou` (`no_mou`, `kode_cv`, `tanggal`, `fee`, `aktif`) VALUES
('001/MoU/SLO/VIII/2019', 'CV_0001', '2019-08-29', 2.5, 'Aktif'),
('001/MoU/SMG/VIII/2019', 'CV_0002', '2019-08-29', 2, 'Aktif'),
('001/MoU/SMTR/VIII/2019', 'CV_0003', '2019-08-29', 2.3, 'Aktif'),
('Tanpa CV', 'Tanpa CV', '2019-01-01', 0, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notaretur`
--

CREATE TABLE IF NOT EXISTS `tbl_notaretur` (
  `no_notaretur` varchar(32) NOT NULL,
  `kode_retur` varchar(32) NOT NULL,
  `tanggal` varchar(15) NOT NULL,
  `bruto` int(11) NOT NULL,
  `netto` int(11) NOT NULL,
  `fee` int(15) NOT NULL,
  PRIMARY KEY (`no_notaretur`),
  KEY `kode_retur` (`kode_retur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_notaretur`
--
DROP TRIGGER IF EXISTS `Add_notaretur`;
DELIMITER //
CREATE TRIGGER `Add_notaretur` AFTER INSERT ON `tbl_notaretur`
 FOR EACH ROW BEGIN
 UPDATE tbl_piutang, tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_faktur 
 SET tbl_piutang.no_notaretur=NEW.no_notaretur, 
 tbl_piutang.terbayar = tbl_piutang.terbayar + NEW.netto,
 tbl_piutang.fee = tbl_piutang.fee - NEW.fee,
 tbl_piutang.kurang = tbl_piutang.kurang - NEW.netto
 WHERE tbl_retur.kode_retur = NEW.kode_retur
 AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
 AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
 AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan
 AND tbl_faktur.no_faktur = tbl_piutang.no_faktur
 ;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Del_notaretur`;
DELIMITER //
CREATE TRIGGER `Del_notaretur` AFTER DELETE ON `tbl_notaretur`
 FOR EACH ROW BEGIN
 UPDATE tbl_piutang, tbl_retur, tbl_suratretur, tbl_suratjalan, tbl_faktur 
 SET  
 tbl_piutang.terbayar = tbl_piutang.terbayar - OLD.netto,
 tbl_piutang.fee = tbl_piutang.fee + OLD.fee,
 tbl_piutang.kurang = tbl_piutang.kurang + OLD.netto
 WHERE tbl_retur.kode_retur = OLD.kode_retur
 AND tbl_retur.no_suratretur = tbl_suratretur.no_suratretur
 AND tbl_suratretur.no_suratjalan = tbl_suratjalan.no_suratjalan
 AND tbl_suratjalan.no_suratjalan = tbl_faktur.no_suratjalan
 AND tbl_faktur.no_faktur = tbl_piutang.no_faktur
 ;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oc`
--

CREATE TABLE IF NOT EXISTS `tbl_oc` (
  `kode_oc` varchar(32) NOT NULL,
  `kode_admproduksi` varchar(15) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_oc`),
  KEY `kode_admproduksi` (`kode_admproduksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_oc`
--

INSERT INTO `tbl_oc` (`kode_oc`, `kode_admproduksi`, `tanggal`) VALUES
('001/OC-MDT/IX/2019', 'PROD_0001', '2019-09-28'),
('002/OC-MDT/IX/2019', 'PROD_0001', '2019-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE IF NOT EXISTS `tbl_paket` (
  `kode_paket` varchar(32) NOT NULL,
  `nama_paket` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kode_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `no_faktur` varchar(32) NOT NULL,
  `kode_piutang` varchar(32) NOT NULL,
  `no_kas` varchar(32) DEFAULT NULL,
  `total` varchar(10) DEFAULT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  KEY `no_kas` (`no_kas`),
  KEY `kode_piutang` (`kode_piutang`,`no_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_pembayaran`
--
DROP TRIGGER IF EXISTS `Pembayaran`;
DELIMITER //
CREATE TRIGGER `Pembayaran` AFTER INSERT ON `tbl_pembayaran`
 FOR EACH ROW BEGIN
 UPDATE tbl_piutang, tbl_kas SET 
 tbl_kas.terpakai = tbl_kas.terpakai+NEW.total,
 tbl_piutang.kurang = tbl_piutang.kurang - NEW.total,
 tbl_piutang.terbayar = tbl_piutang.terbayar + NEW.total
 WHERE tbl_kas.no_kas = NEW.no_kas 
 AND tbl_piutang.kode_piutang = NEW.kode_piutang;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Pembayaran_minus`;
DELIMITER //
CREATE TRIGGER `Pembayaran_minus` AFTER DELETE ON `tbl_pembayaran`
 FOR EACH ROW BEGIN
 UPDATE tbl_piutang, tbl_kas SET 
 tbl_kas.terpakai = tbl_kas.terpakai-OLD.total,
 tbl_piutang.kurang = tbl_piutang.kurang + OLD.total,
 tbl_piutang.terbayar = tbl_piutang.terbayar - OLD.total
 WHERE OLD.no_kas = tbl_kas.no_kas 
 AND tbl_piutang.kode_piutang = OLD.kode_piutang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerbit`
--

CREATE TABLE IF NOT EXISTS `tbl_penerbit` (
  `kode_penerbit` varchar(15) NOT NULL,
  `nama_penerbit` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kode_penerbit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penerbit`
--

INSERT INTO `tbl_penerbit` (`kode_penerbit`, `nama_penerbit`) VALUES
('PNB_0001', 'MDT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengajuan`
--

CREATE TABLE IF NOT EXISTS `tbl_pengajuan` (
  `no_pengajuan` varchar(32) NOT NULL,
  `kode_kerjasama` varchar(32) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `rabat` float DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`no_pengajuan`),
  KEY `kode_kerjasama` (`kode_kerjasama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`no_pengajuan`, `kode_kerjasama`, `tanggal`, `rabat`, `aktif`) VALUES
('001/KJSM/SLO/VIII/2019', 'KJSM_0001', '2019-08-29', 42, 'Aktif'),
('Tanpa Pengajuan', 'Tanpa Pengajuan', '2019-01-01', 40, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perwakilan`
--

CREATE TABLE IF NOT EXISTS `tbl_perwakilan` (
  `kode_perwakilan` varchar(15) NOT NULL,
  `kode_area` varchar(15) NOT NULL,
  `nama_kaper` varchar(32) DEFAULT NULL,
  `kode_wilayah` varchar(10) DEFAULT NULL,
  `alamat_perwakilan` varchar(32) DEFAULT NULL,
  `kawasan` varchar(10) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_perwakilan`),
  KEY `kode_area` (`kode_area`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perwakilan`
--

INSERT INTO `tbl_perwakilan` (`kode_perwakilan`, `kode_area`, `nama_kaper`, `kode_wilayah`, `alamat_perwakilan`, `kawasan`, `email`, `no_telp`, `aktif`) VALUES
('KAPER_001', 'AREA_001', 'Agus', 'SLO', 'Solo', 'jawa', 'agus@gmail.com', '0797', 'Aktif'),
('KAPER_002', 'AREA_001', 'Satrio', 'SMG', 'Semarang', 'jawa', 'satrio@gmail.com', '07968', 'Aktif'),
('KAPER_003', 'AREA_002', 'Darto', 'SMTR', 'Sumatra', 'luar', 'darto@gmail.com', '09789', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE IF NOT EXISTS `tbl_pesanan` (
  `no_pesanan` varchar(32) NOT NULL,
  `no_pengajuan` varchar(32) NOT NULL,
  `no_mou` varchar(32) NOT NULL,
  `kode_customer` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `kode_admper` varchar(15) NOT NULL,
  `kode_sales` varchar(15) NOT NULL,
  `tanggal` varchar(12) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `tipe_buku` varchar(10) NOT NULL,
  `jenjang` varchar(20) NOT NULL,
  `sumber_dana` varchar(20) NOT NULL,
  `nama_penerima` varchar(32) NOT NULL,
  `no_telp_penerima` varchar(15) NOT NULL,
  `alamat_penerima` varchar(255) NOT NULL,
  `tipe_pesan` varchar(255) NOT NULL,
  `proses` varchar(32) NOT NULL,
  `alasan` varchar(500) NOT NULL,
  `jenis_pembayaran` varchar(32) NOT NULL,
  `keterangan` varchar(155) NOT NULL,
  `stok` varchar(21) NOT NULL,
  PRIMARY KEY (`no_pesanan`),
  KEY `kode_sales` (`kode_sales`),
  KEY `kode_admper` (`kode_admper`),
  KEY `kode_perwakilan` (`kode_perwakilan`),
  KEY `kode_customer` (`kode_customer`),
  KEY `no_mou` (`no_mou`),
  KEY `no_pengajuan` (`no_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`no_pesanan`, `no_pengajuan`, `no_mou`, `kode_customer`, `kode_perwakilan`, `kode_admper`, `kode_sales`, `tanggal`, `tahun`, `tipe_buku`, `jenjang`, `sumber_dana`, `nama_penerima`, `no_telp_penerima`, `alamat_penerima`, `tipe_pesan`, `proses`, `alasan`, `jenis_pembayaran`, `keterangan`, `stok`) VALUES
('001/PSN/SLO/IX/2019', '001/KJSM/SLO/VIII/2019', '001/MoU/SLO/VIII/2019', 'CSTM_0001', 'KAPER_001', 'ADMPER_0001', 'SALES_0001', '2019-09-18', '2019', 'BUKU GURU', 'PG-MT-SD', 'BOS', 'Sardi', '0987654', 'Suyud', 'Jual', 'DO, Menunggu SJ', '-', 'online', 'Kirim aja', ''),
('001/PSN/SLO/VIII/2019', 'Tanpa Pengajuan', '001/MoU/SLO/VIII/2019', 'CSTM_0001', 'KAPER_001', 'ADMPER_0001', 'SALES_0001', '2019-08-29', '2019', 'MATERI', 'SD', 'BOS', 'Rahayu', '098789', 'Suyud', 'Jual', 'Proses SJ', '-', 'online', '', ''),
('001/PSN/SMG/VIII/2019', 'Tanpa Pengajuan', '001/MoU/SMG/VIII/2019', 'CSTM_0003', 'KAPER_002', 'ADMPER_0002', 'SALES_0003', '2019-08-30', '2019', 'BUKU GURU', 'PG-MT-SD', 'BOS', 'Surti', '07890', 'Sardi', 'Jual', 'Proses SJ', '-', 'offline', 'Lek dikirim', ''),
('002/PSN/SLO/IX/2019', '001/KJSM/SLO/VIII/2019', '001/MoU/SLO/VIII/2019', 'CSTM_0001', 'KAPER_001', 'ADMPER_0001', 'SALES_0001', '2019-09-26', '2019', 'BUKU GURU', 'PG-MT-SD', 'BOS', 'Rahayu', '098789', 'Sardi', 'Jual', 'Proses SJ', '-', 'online', 'uuuuu', 'stok_mini'),
('002/PSN/SLO/VIII/2019', '001/KJSM/SLO/VIII/2019', 'Tanpa CV', 'CSTM_0002', 'KAPER_001', 'ADMPER_0001', 'SALES_0002', '2019-08-30', '2019', 'BUKU GURU', 'PG-MT-SD', 'SISWA', 'Sarmi', '0987678', 'Salim', 'Jual', 'Proses SJ', '-', 'online', 'Baru', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesan_stokmini`
--

CREATE TABLE IF NOT EXISTS `tbl_pesan_stokmini` (
  `no_stokmini` varchar(32) NOT NULL,
  `kode_admper` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `alamat_kirim` varchar(155) NOT NULL,
  `keterangan` varchar(155) NOT NULL,
  PRIMARY KEY (`no_stokmini`),
  KEY `kode_perwakilan` (`kode_perwakilan`),
  KEY `kode_admper` (`kode_admper`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesan_stokmini`
--

INSERT INTO `tbl_pesan_stokmini` (`no_stokmini`, `kode_admper`, `kode_perwakilan`, `tanggal`, `alamat_kirim`, `keterangan`) VALUES
('001/STK-MN/SLO/IX/2019', 'ADMPER_0001', 'KAPER_001', '2019-09-19', 'Jayadi', 'Kirim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_piutang`
--

CREATE TABLE IF NOT EXISTS `tbl_piutang` (
  `kode_piutang` varchar(32) NOT NULL,
  `no_faktur` varchar(32) NOT NULL,
  `no_notaretur` varchar(32) DEFAULT NULL,
  `jumlah` int(15) unsigned DEFAULT NULL,
  `terbayar` int(15) unsigned DEFAULT NULL,
  `kurang` int(15) unsigned DEFAULT NULL,
  `fee` int(15) NOT NULL,
  `status_hutang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_piutang`,`no_faktur`),
  KEY `no_faktur` (`no_faktur`),
  KEY `no_notaretur` (`no_notaretur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_piutang`
--

INSERT INTO `tbl_piutang` (`kode_piutang`, `no_faktur`, `no_notaretur`, `jumlah`, `terbayar`, `kurang`, `fee`, `status_hutang`) VALUES
('001/FT-MDT/SLO/VIII/2019', '001/FT-MDT/SLO/VIII/2019', NULL, 5124000, 0, 5124000, 128100, 'Cicil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retur`
--

CREATE TABLE IF NOT EXISTS `tbl_retur` (
  `kode_retur` varchar(32) NOT NULL,
  `no_suratretur` varchar(32) NOT NULL,
  `kode_admgudang` varchar(15) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`kode_retur`),
  KEY `no_suratretur` (`no_suratretur`),
  KEY `kode_admgudang` (`kode_admgudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `kode_sales` varchar(15) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `nama_sales` varchar(32) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `aktif` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kode_sales`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`kode_sales`, `kode_perwakilan`, `nama_sales`, `no_telp`, `aktif`) VALUES
('SALES_0001', 'KAPER_001', 'Suyud', '09789', 'Aktif'),
('SALES_0002', 'KAPER_001', 'Salim', '07789', 'Aktif'),
('SALES_0003', 'KAPER_002', 'Sardi', '08789', 'Aktif'),
('SALES_0004', 'KAPER_002', 'Dinar', '08789', 'Aktif'),
('SALES_0005', 'KAPER_003', 'Marni', '07898', 'Aktif'),
('SALES_0006', 'KAPER_003', 'Mirna', '0767909', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sj_stok`
--

CREATE TABLE IF NOT EXISTS `tbl_sj_stok` (
  `no_sj_stkmini` varchar(32) NOT NULL,
  `kode_admgudang` varchar(15) NOT NULL,
  `no_do_stokmini` varchar(32) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `ekspedisi` varchar(15) DEFAULT NULL,
  `no_polisi` varchar(12) DEFAULT NULL,
  `nama_sopir` varchar(32) NOT NULL,
  `no_telp_sopir` varchar(15) NOT NULL,
  `ket` varchar(32) NOT NULL,
  PRIMARY KEY (`no_sj_stkmini`),
  KEY `kode_admgudang` (`kode_admgudang`),
  KEY `no_do_stokmini` (`no_do_stokmini`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sj_stok`
--

INSERT INTO `tbl_sj_stok` (`no_sj_stkmini`, `kode_admgudang`, `no_do_stokmini`, `tanggal`, `ekspedisi`, `no_polisi`, `nama_sopir`, `no_telp_sopir`, `ket`) VALUES
('001/SJSTK-MDT/SLO/IX/2019', 'GDG_0001', '001/STK-MN/SLO/IX/2019', '2019-09-26', 'KRM', 'H-9688-KJ', 'Sarfi', '098767890', 'Stok Mini Ditambah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stokmini`
--

CREATE TABLE IF NOT EXISTS `tbl_stokmini` (
  `kode_buku` varchar(32) NOT NULL,
  `kode_perwakilan` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  KEY `kode_buku` (`kode_buku`),
  KEY `kode_perwakilan` (`kode_perwakilan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stokmini`
--

INSERT INTO `tbl_stokmini` (`kode_buku`, `kode_perwakilan`, `stok`) VALUES
('M13P713001', 'KAPER_001', 78),
('M13P713002', 'KAPER_001', 88),
('M13P713003', 'KAPER_001', 79),
('M13P713004', 'KAPER_001', 79),
('M13P713005', 'KAPER_001', 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suratjalan`
--

CREATE TABLE IF NOT EXISTS `tbl_suratjalan` (
  `no_suratjalan` varchar(32) NOT NULL,
  `kode_admgudang` varchar(15) NOT NULL,
  `no_do` varchar(32) NOT NULL,
  `nama_sopir` varchar(32) DEFAULT NULL,
  `no_telp_sopir` varchar(15) DEFAULT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `no_polisi` varchar(15) DEFAULT NULL,
  `ekspedisi` varchar(32) DEFAULT NULL,
  `koli` int(12) unsigned DEFAULT NULL,
  `karung` int(12) unsigned DEFAULT NULL,
  `stok` varchar(21) NOT NULL,
  PRIMARY KEY (`no_suratjalan`),
  KEY `no_do` (`no_do`),
  KEY `kode_admgudang` (`kode_admgudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suratjalan`
--

INSERT INTO `tbl_suratjalan` (`no_suratjalan`, `kode_admgudang`, `no_do`, `nama_sopir`, `no_telp_sopir`, `tanggal`, `no_polisi`, `ekspedisi`, `koli`, `karung`, `stok`) VALUES
('001/SJ-MDT/SLO/IX/2019', 'GDG_0001', '002/PSN/SLO/IX/2019', 'Supri', '098789', '2019-09-26', 'H-8900-KL', 'KRM', 1, 1, 'stok_mini'),
('001/SJ-MDT/SLO/VIII/2019', 'GDG_0001', '001/PSN/SLO/VIII/2019', 'Supri', '089678', '2019-08-29', 'H-9868-DAH', 'KRM', 1, 1, ''),
('001/SJ-MDT/SMG/VIII/2019', 'GDG_0001', '001/PSN/SMG/VIII/2019', 'Supir', '098789', '2019-08-30', 'AD-8909-LOK', 'KRM', 1, 1, ''),
('002/SJ-MDT/SLO/VIII/2019', 'GDG_0001', '002/PSN/SLO/VIII/2019', 'Sulis', '09890', '2019-08-30', 'H-9009-KUJ', 'KRM', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suratretur`
--

CREATE TABLE IF NOT EXISTS `tbl_suratretur` (
  `no_suratretur` varchar(32) NOT NULL,
  `no_suratjalan` varchar(32) NOT NULL,
  `tanggal` varchar(12) DEFAULT NULL,
  `alasan` varchar(155) DEFAULT NULL,
  `keterangan` varchar(32) NOT NULL,
  PRIMARY KEY (`no_suratretur`),
  KEY `no_suratjalan` (`no_suratjalan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suratretur`
--

INSERT INTO `tbl_suratretur` (`no_suratretur`, `no_suratjalan`, `tanggal`, `alasan`, `keterangan`) VALUES
('001/RTR-MDT/SLO/IX/2019', '001/SJ-MDT/SLO/VIII/2019', '2019-09-13', 'Kebak kabeh', 'Menunggu Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `username` varchar(40) NOT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `hak_akses` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `pass`, `kode`, `hak_akses`) VALUES
('admgudang1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'GDG_0002', '4'),
('admgudang@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'GDG_0001', '4'),
('Admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '10'),
('admkeu1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'KEU_0002', '3'),
('admkeu@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'KEU_0001', '3'),
('admproduk@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PROD_0001', '5'),
('admpusat@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PUSAT_0001', '2'),
('admsemarang@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ADMPER_0002', '1'),
('admsolo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ADMPER_0001', '1'),
('admsumatra@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ADMPER_0003', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admper`
--
ALTER TABLE `tbl_admper`
  ADD CONSTRAINT `tbl_admper_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD CONSTRAINT `tbl_buku_ibfk_1` FOREIGN KEY (`kode_penerbit`) REFERENCES `tbl_penerbit` (`kode_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_do`
--
ALTER TABLE `tbl_buku_do`
  ADD CONSTRAINT `tbl_buku_do_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_do_ibfk_2` FOREIGN KEY (`no_do`) REFERENCES `tbl_do` (`no_do`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_lpb`
--
ALTER TABLE `tbl_buku_lpb`
  ADD CONSTRAINT `tbl_buku_lpb_ibfk_2` FOREIGN KEY (`kode_buku`, `kode_oc`) REFERENCES `tbl_buku_oc` (`kode_buku`, `kode_oc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_lpb_ibfk_3` FOREIGN KEY (`kode_lpb`) REFERENCES `tbl_lpb` (`kode_lpb`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_oc`
--
ALTER TABLE `tbl_buku_oc`
  ADD CONSTRAINT `tbl_buku_oc_ibfk_1` FOREIGN KEY (`kode_oc`) REFERENCES `tbl_oc` (`kode_oc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_oc_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_psnstk`
--
ALTER TABLE `tbl_buku_psnstk`
  ADD CONSTRAINT `tbl_buku_psnstk_ibfk_1` FOREIGN KEY (`no_stokmini`) REFERENCES `tbl_pesan_stokmini` (`no_stokmini`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_psnstk_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_reqretur`
--
ALTER TABLE `tbl_buku_reqretur`
  ADD CONSTRAINT `tbl_buku_reqretur_ibfk_1` FOREIGN KEY (`no_suratretur`) REFERENCES `tbl_suratretur` (`no_suratretur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_reqretur_ibfk_2` FOREIGN KEY (`kode_buku`, `no_do`, `no_suratjalan`) REFERENCES `tbl_buku_sj` (`kode_buku`, `no_do`, `no_suratjalan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_retur`
--
ALTER TABLE `tbl_buku_retur`
  ADD CONSTRAINT `tbl_buku_retur_ibfk_1` FOREIGN KEY (`no_suratretur`, `no_suratjalan`, `no_do`, `kode_buku`) REFERENCES `tbl_buku_reqretur` (`no_suratretur`, `no_suratjalan`, `no_do`, `kode_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_retur_ibfk_2` FOREIGN KEY (`kode_retur`) REFERENCES `tbl_retur` (`kode_retur`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_sj`
--
ALTER TABLE `tbl_buku_sj`
  ADD CONSTRAINT `tbl_buku_sj_ibfk_1` FOREIGN KEY (`no_suratjalan`) REFERENCES `tbl_suratjalan` (`no_suratjalan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_sj_ibfk_2` FOREIGN KEY (`kode_buku`, `no_do`) REFERENCES `tbl_buku_do` (`kode_buku`, `no_do`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_buku_stkmini`
--
ALTER TABLE `tbl_buku_stkmini`
  ADD CONSTRAINT `tbl_buku_stkmini_ibfk_1` FOREIGN KEY (`no_stokmini`, `kode_buku`) REFERENCES `tbl_buku_psnstk` (`no_stokmini`, `kode_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_stkmini_ibfk_2` FOREIGN KEY (`no_sj_stkmini`) REFERENCES `tbl_sj_stok` (`no_sj_stkmini`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `tbl_customer_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cvrekanan`
--
ALTER TABLE `tbl_cvrekanan`
  ADD CONSTRAINT `tbl_cvrekanan_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_datapesan`
--
ALTER TABLE `tbl_datapesan`
  ADD CONSTRAINT `tbl_datapesan_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_datapesan_ibfk_2` FOREIGN KEY (`no_pesanan`) REFERENCES `tbl_pesanan` (`no_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detpaket`
--
ALTER TABLE `tbl_detpaket`
  ADD CONSTRAINT `tbl_detpaket_ibfk_1` FOREIGN KEY (`kode_paket`) REFERENCES `tbl_paket` (`kode_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detpaket_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_do`
--
ALTER TABLE `tbl_do`
  ADD CONSTRAINT `tbl_do_ibfk_1` FOREIGN KEY (`no_pesanan`) REFERENCES `tbl_pesanan` (`no_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_do_ibfk_2` FOREIGN KEY (`kode_admpusat`) REFERENCES `tbl_admpusat` (`kode_admpusat`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_do_stokmini`
--
ALTER TABLE `tbl_do_stokmini`
  ADD CONSTRAINT `tbl_do_stokmini_ibfk_1` FOREIGN KEY (`no_stokmini`) REFERENCES `tbl_pesan_stokmini` (`no_stokmini`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_do_stokmini_ibfk_2` FOREIGN KEY (`kode_admpusat`) REFERENCES `tbl_admpusat` (`kode_admpusat`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_faktur`
--
ALTER TABLE `tbl_faktur`
  ADD CONSTRAINT `tbl_faktur_ibfk_1` FOREIGN KEY (`no_suratjalan`) REFERENCES `tbl_suratjalan` (`no_suratjalan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_faktur_ibfk_2` FOREIGN KEY (`kode_admkeuangan`) REFERENCES `tbl_admkeuangan` (`kode_admkeuangan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_handlegudang`
--
ALTER TABLE `tbl_handlegudang`
  ADD CONSTRAINT `tbl_handlegudang_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_handlegudang_ibfk_2` FOREIGN KEY (`kode_admgudang`) REFERENCES `tbl_admgudang` (`kode_admgudang`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_handlekeuangan`
--
ALTER TABLE `tbl_handlekeuangan`
  ADD CONSTRAINT `tbl_handlekeuangan_ibfk_1` FOREIGN KEY (`kode_admkeuangan`) REFERENCES `tbl_admkeuangan` (`kode_admkeuangan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_handlekeuangan_ibfk_2` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_handlepemasaran`
--
ALTER TABLE `tbl_handlepemasaran`
  ADD CONSTRAINT `tbl_handlepemasaran_ibfk_1` FOREIGN KEY (`kode_admpusat`) REFERENCES `tbl_admpusat` (`kode_admpusat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_handlepemasaran_ibfk_2` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_harga_2019`
--
ALTER TABLE `tbl_harga_2019`
  ADD CONSTRAINT `tbl_harga_2019_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kas`
--
ALTER TABLE `tbl_kas`
  ADD CONSTRAINT `tbl_kas_ibfk_1` FOREIGN KEY (`kode_admkeuangan`) REFERENCES `tbl_admkeuangan` (`kode_admkeuangan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kerjasama`
--
ALTER TABLE `tbl_kerjasama`
  ADD CONSTRAINT `tbl_kerjasama_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `tbl_login_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_lpb`
--
ALTER TABLE `tbl_lpb`
  ADD CONSTRAINT `tbl_lpb_ibfk_1` FOREIGN KEY (`kode_admgudang`) REFERENCES `tbl_admgudang` (`kode_admgudang`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_marea`
--
ALTER TABLE `tbl_marea`
  ADD CONSTRAINT `tbl_marea_ibfk_1` FOREIGN KEY (`kode_nasional`) REFERENCES `tbl_mnasional` (`kode_nasional`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mou`
--
ALTER TABLE `tbl_mou`
  ADD CONSTRAINT `tbl_mou_ibfk_1` FOREIGN KEY (`kode_cv`) REFERENCES `tbl_cvrekanan` (`kode_cv`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_notaretur`
--
ALTER TABLE `tbl_notaretur`
  ADD CONSTRAINT `tbl_notaretur_ibfk_1` FOREIGN KEY (`kode_retur`) REFERENCES `tbl_retur` (`kode_retur`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_oc`
--
ALTER TABLE `tbl_oc`
  ADD CONSTRAINT `tbl_oc_ibfk_1` FOREIGN KEY (`kode_admproduksi`) REFERENCES `tbl_admproduksi` (`kode_admproduksi`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`no_kas`) REFERENCES `tbl_kas` (`no_kas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pembayaran_ibfk_2` FOREIGN KEY (`kode_piutang`, `no_faktur`) REFERENCES `tbl_piutang` (`kode_piutang`, `no_faktur`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD CONSTRAINT `tbl_pengajuan_ibfk_1` FOREIGN KEY (`kode_kerjasama`) REFERENCES `tbl_kerjasama` (`kode_kerjasama`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_perwakilan`
--
ALTER TABLE `tbl_perwakilan`
  ADD CONSTRAINT `tbl_perwakilan_ibfk_1` FOREIGN KEY (`kode_area`) REFERENCES `tbl_marea` (`kode_area`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`kode_sales`) REFERENCES `tbl_sales` (`kode_sales`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`kode_admper`) REFERENCES `tbl_admper` (`kode_admper`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_3` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_4` FOREIGN KEY (`kode_customer`) REFERENCES `tbl_customer` (`kode_customer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_5` FOREIGN KEY (`no_mou`) REFERENCES `tbl_mou` (`no_mou`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_6` FOREIGN KEY (`no_pengajuan`) REFERENCES `tbl_pengajuan` (`no_pengajuan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pesan_stokmini`
--
ALTER TABLE `tbl_pesan_stokmini`
  ADD CONSTRAINT `tbl_pesan_stokmini_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesan_stokmini_ibfk_2` FOREIGN KEY (`kode_admper`) REFERENCES `tbl_admper` (`kode_admper`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_piutang`
--
ALTER TABLE `tbl_piutang`
  ADD CONSTRAINT `tbl_piutang_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `tbl_faktur` (`no_faktur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_piutang_ibfk_2` FOREIGN KEY (`no_notaretur`) REFERENCES `tbl_notaretur` (`no_notaretur`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_retur`
--
ALTER TABLE `tbl_retur`
  ADD CONSTRAINT `tbl_retur_ibfk_1` FOREIGN KEY (`no_suratretur`) REFERENCES `tbl_suratretur` (`no_suratretur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_retur_ibfk_2` FOREIGN KEY (`kode_admgudang`) REFERENCES `tbl_admgudang` (`kode_admgudang`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `tbl_sales_ibfk_1` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sj_stok`
--
ALTER TABLE `tbl_sj_stok`
  ADD CONSTRAINT `tbl_sj_stok_ibfk_2` FOREIGN KEY (`kode_admgudang`) REFERENCES `tbl_admgudang` (`kode_admgudang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sj_stok_ibfk_3` FOREIGN KEY (`no_do_stokmini`) REFERENCES `tbl_do_stokmini` (`no_do_stokmini`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_stokmini`
--
ALTER TABLE `tbl_stokmini`
  ADD CONSTRAINT `tbl_stokmini_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `tbl_buku` (`kode_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stokmini_ibfk_2` FOREIGN KEY (`kode_perwakilan`) REFERENCES `tbl_perwakilan` (`kode_perwakilan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_suratjalan`
--
ALTER TABLE `tbl_suratjalan`
  ADD CONSTRAINT `tbl_suratjalan_ibfk_1` FOREIGN KEY (`no_do`) REFERENCES `tbl_do` (`no_do`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_suratjalan_ibfk_2` FOREIGN KEY (`kode_admgudang`) REFERENCES `tbl_admgudang` (`kode_admgudang`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_suratretur`
--
ALTER TABLE `tbl_suratretur`
  ADD CONSTRAINT `tbl_suratretur_ibfk_1` FOREIGN KEY (`no_suratjalan`) REFERENCES `tbl_suratjalan` (`no_suratjalan`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
