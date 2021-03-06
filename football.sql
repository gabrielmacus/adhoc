-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2017 at 03:03 AM
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
-- Table structure for table `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
  `archivo_id` int(11) NOT NULL,
  `archivo_data` text NOT NULL COMMENT 'json con informacion del archivo',
  `archivo_repositorio` int(5) NOT NULL COMMENT 'Para agrupar los archivos',
  `archivo_descripcion` text,
  `archivo_titulo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `archivos`
--

INSERT INTO `archivos` (`archivo_id`, `archivo_data`, `archivo_repositorio`, `archivo_descripcion`, `archivo_titulo`) VALUES
(6, '{"name":"1487797534_7up.jpg","type":"image/jpeg","error":0,"size":606453,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/22/02/2017/1487797534_7up.jpg/o_1487797534_7up.jpg"},"folder":"/httpdocs/imagenes/22/02/2017/1487797534_7up.jpg","date":1487797545}', 1, NULL, NULL),
(9, '{"name":"1487797688_google-fb4.jpg","type":"image/jpeg","error":0,"size":80014,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/22/02/2017/1487797688_google-fb4.jpg/o_1487797688_google-fb4.jpg"},"folder":"/httpdocs/imagenes/22/02/2017/1487797688_google-fb4.jpg","date":1487797691}', 1, NULL, NULL),
(10, '{"name":"1487797691_ITF.jpg","type":"image/jpeg","error":0,"size":177334,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/22/02/2017/1487797691_ITF.jpg/o_1487797691_ITF.jpg"},"folder":"/httpdocs/imagenes/22/02/2017/1487797691_ITF.jpg","date":1487797695}', 1, NULL, NULL),
(11, '{"name":"1487868969_1487868882029121783206.jpg","type":"image/jpeg","error":0,"size":3875221,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/23/02/2017/1487868969_1487868882029121783206.jpg/o_1487868969_1487868882029121783206.jpg"},"folder":"/httpdocs/imagenes/23/02/2017/1487868969_1487868882029121783206.jpg","date":1487869032}', 1, NULL, NULL),
(12, '{"name":"1487869256_gm.txt","type":"text/plain","error":0,"size":44,"o":{"completeUrl":"http://electrostyleinformatica.com/archivos/23/02/2017/1487869256_gm.txt/o_1487869256_gm.txt"},"folder":"/httpdocs/archivos/23/02/2017/1487869256_gm.txt","date":1487869257}', 3, NULL, NULL),
(14, '{"name":"1487874053_demo.docx","type":"application/octet-stream","error":0,"size":1311881,"o":{"completeUrl":"http://electrostyleinformatica.com/archivos/23/02/2017/1487874053_demo.docx/o_1487874053_demo.docx"},"folder":"/httpdocs/archivos/23/02/2017/1487874053_demo.docx","date":1487874075}', 3, NULL, NULL),
(16, '{"name":"1487875164_AlumnosLunes.xlsx","type":"application/octet-stream","error":0,"size":3768,"o":{"completeUrl":"http://electrostyleinformatica.com/archivos/23/02/2017/1487875164_AlumnosLunes.xlsx/o_1487875164_AlumnosLunes.xlsx"},"folder":"/httpdocs/archivos/23/02/2017/1487875164_AlumnosLunes.xlsx","date":1487875165}', 3, NULL, NULL),
(17, '{"name":"1487875555_present.odp","type":"application/vnd.oasis.opendocument.presentation","error":0,"size":12538,"o":{"completeUrl":"http://electrostyleinformatica.com/archivos/23/02/2017/1487875555_present.odp/o_1487875555_present.odp"},"folder":"/httpdocs/archivos/23/02/2017/1487875555_present.odp","date":1487875556}', 3, NULL, NULL),
(18, '{"name":"1487875556_pres.pptx","type":"application/octet-stream","error":0,"size":333192,"o":{"completeUrl":"http://electrostyleinformatica.com/archivos/23/02/2017/1487875556_pres.pptx/o_1487875556_pres.pptx"},"folder":"/httpdocs/archivos/23/02/2017/1487875556_pres.pptx","date":1487875562}', 3, NULL, NULL),
(21, '{"name":"1487880441_Gustavo Cerati - Avenida Alcorta - Amor amarillo - 1993.mp3","type":"audio/mp3","error":0,"size":4545624,"o":{"completeUrl":"http://electrostyleinformatica.com/audios/23/02/2017/1487880441_Gustavo Cerati - Avenida Alcorta - Amor amarillo - 1993.mp3/o_1487880441_Gustavo Cerati - Avenida Alcorta - Amor amarillo - 1993.mp3"},"folder":"/httpdocs/audios/23/02/2017/1487880441_Gustavo Cerati - Avenida Alcorta - Amor amarillo - 1993.mp3","date":1487880514}', 4, NULL, NULL),
(22, '{"name":"1487881305_Gustavo Cerati-La excepcion.mp3","type":"audio/mp3","error":0,"size":4036681,"o":{"completeUrl":"http://electrostyleinformatica.com/audios/23/02/2017/1487881305_Gustavo Cerati-La excepcion.mp3/o_1487881305_Gustavo Cerati-La excepcion.mp3"},"folder":"/httpdocs/audios/23/02/2017/1487881305_Gustavo Cerati-La excepcion.mp3","date":1487881368}', 4, NULL, NULL),
(23, '{"name":"1487883740_lastfmapi.png","type":"image/png","error":0,"size":205600,"o":{"completeUrl":"http://electrostyleinformatica.com/audios/23/02/2017/1487883740_lastfmapi.png/o_1487883740_lastfmapi.png"},"folder":"/httpdocs/audios/23/02/2017/1487883740_lastfmapi.png","date":1487883745}', 4, NULL, NULL),
(24, '{"name":"1487895960_Chrysanthemum.jpg","type":"image/jpeg","error":0,"size":879394,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/24/02/2017/1487895960_Chrysanthemum.jpg/o_1487895960_Chrysanthemum.jpg"},"folder":"/httpdocs/imagenes/24/02/2017/1487895960_Chrysanthemum.jpg","date":1487895974}', 1, NULL, NULL),
(25, '{"name":"1487896855_a.jpg","type":"image/jpeg","error":0,"size":11235,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/24/02/2017/1487896855_a.jpg/o_1487896855_a.jpg"},"folder":"/httpdocs/imagenes/24/02/2017/1487896855_a.jpg","date":1487896856}', 1, NULL, NULL),
(28, '{"name":"1487897437_Drag_Drop.png","type":"image/png","error":0,"size":25205,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/24/02/2017/1487897437_Drag_Drop.png/o_1487897437_Drag_Drop.png"},"folder":"/httpdocs/imagenes/24/02/2017/1487897437_Drag_Drop.png","originalName":"Drag_Drop.png","date":1487897438}', 1, NULL, NULL),
(29, '{"name":"1487908879_09.jpg","type":"image/jpeg","error":0,"size":186061,"o":{"completeUrl":"http://electrostyleinformatica.com/imagenes/24/02/2017/1487908879_09.jpg/o_1487908879_09.jpg"},"folder":"/httpdocs/imagenes/24/02/2017/1487908879_09.jpg","originalName":"09.jpg","date":1487908883}', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `archivos_objetos`
--

CREATE TABLE IF NOT EXISTS `archivos_objetos` (
  `repositorio_id` int(11) NOT NULL,
  `archivo` int(11) NOT NULL,
  `tabla` varchar(200) NOT NULL,
  `objeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `equipo_id` int(11) NOT NULL,
  `equipo_nombre` varchar(200) NOT NULL,
  `equipo_bandera` text COMMENT 'informacion en json del archivo de imagen de la bandera del equipo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jugadores`
--

CREATE TABLE IF NOT EXISTS `jugadores` (
  `jugador_id` int(11) NOT NULL,
  `jugador_nombre` varchar(200) NOT NULL,
  `jugador_apellido` varchar(200) NOT NULL,
  `jugador_altura` int(5) NOT NULL,
  `jugador_peso` int(5) NOT NULL,
  `jugador_pierna` tinyint(1) NOT NULL COMMENT '1=derecha 0=izquierda',
  `jugador_notas` text,
  `jugador_equipo` int(11) DEFAULT NULL,
  `jugador_posicion` set('1','2','3','4','5','6','7','8','9','10','11') NOT NULL COMMENT '''PO'',''DFC'',''LAT'',''LIB'',''MD'',''MC'',''MI'',''MP'',''DC'',''SD'',''EXT''',
  `jugador_numero` int(3) NOT NULL,
  `jugador_perfil` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repositorios`
--

INSERT INTO `repositorios` (`repositorio`, `pass`, `user`, `server`, `dns`, `dir`, `dateformat`, `root_dir`, `formats`, `nombre`) VALUES
(1, 'sercan02', 'sub697_26', '184.154.92.174', 'http://electrostyleinformatica.com', '/imagenes', '/d/m/Y', '/httpdocs', 'rar,svg,mp4,mp3,avi', 'Imagenes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`archivo_id`);

--
-- Indexes for table `archivos_objetos`
--
ALTER TABLE `archivos_objetos`
  ADD PRIMARY KEY (`repositorio_id`),
  ADD KEY `archivo` (`archivo`);

--
-- Indexes for table `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`equipo_id`);

--
-- Indexes for table `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`jugador_id`),
  ADD KEY `jugador_equipo` (`jugador_equipo`),
  ADD KEY `jugador_posicion` (`jugador_posicion`);

--
-- Indexes for table `repositorios`
--
ALTER TABLE `repositorios`
  ADD PRIMARY KEY (`repositorio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivos`
--
ALTER TABLE `archivos`
  MODIFY `archivo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `archivos_objetos`
--
ALTER TABLE `archivos_objetos`
  MODIFY `repositorio_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipos`
--
ALTER TABLE `equipos`
  MODIFY `equipo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `jugador_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repositorios`
--
ALTER TABLE `repositorios`
  MODIFY `repositorio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `archivos_objetos`
--
ALTER TABLE `archivos_objetos`
  ADD CONSTRAINT `archivos_objetos_ibfk_1` FOREIGN KEY (`archivo`) REFERENCES `archivos` (`archivo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`jugador_equipo`) REFERENCES `equipos` (`equipo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
