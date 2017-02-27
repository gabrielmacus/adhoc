-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2017 at 01:40 AM
-- Server version: 10.1.6-MariaDB
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football`
--

-- --------------------------------------------------------

--
-- Table structure for table `repositorios`
--

CREATE TABLE IF NOT EXISTS `repositorios` (
  `repositorio` int(11) NOT NULL,
  `pass` varchar(200) NOT NULL DEFAULT 'sercan02',
  `user` varchar(200) NOT NULL DEFAULT 'sub697_26',
  `server` varchar(200) NOT NULL DEFAULT '184.154.92.174',
  `dns` varchar(200) NOT NULL DEFAULT 'http://electrostyleinformatica.com',
  `dir` varchar(200) NOT NULL,
  `dateformat` varchar(200) DEFAULT '/d/m/Y',
  `root_dir` varchar(200) NOT NULL DEFAULT '/httpdocs',
  `formats` text NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `sizes` text,
  `panelSize` varchar(100) NOT NULL DEFAULT '400,300'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repositorios`
--

INSERT INTO `repositorios` (`repositorio`, `pass`, `user`, `server`, `dns`, `dir`, `dateformat`, `root_dir`, `formats`, `nombre`, `sizes`, `panelSize`) VALUES
(1, 'sercan02', 'sub697_26', '184.154.92.174', 'http://electrostyleinformatica.com', '/imagenes', '/d/m/Y', '/httpdocs', 'rar,svg,mp4,mp3,avi', 'Imagenes', NULL, '400,300'),
(2, 'sercan02', 'sub697_26', '184.154.92.174', 'http://electrostyleinformatica.com', '/img', '/d/m/Y', '/httpdocs', 'jpg,gif,exe,zip,rar', 'IMG', '417,300', '400,300'),
(3, 'sercan02', 'sub697_26', '184.154.92.174', 'http://electrostyleinformatica.com', '/imagenes chicas', '/d/m/Y', '/httpdocs', 'jpg,gif,png', 'Imagenes chicas', '120,120', '400,300'),
(4, 'sercan02', 'sub697_26', '184.154.92.174', 'http://electrostyleinformatica.com', '/prueba', '/d/m/Y', '/httpdocs', 'jpg', 'Prueba', '500,300', '400,300');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `repositorios`
--
ALTER TABLE `repositorios`
  ADD PRIMARY KEY (`repositorio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `repositorios`
--
ALTER TABLE `repositorios`
  MODIFY `repositorio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
