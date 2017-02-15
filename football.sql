-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2017 at 09:54 PM
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
  `archivo_repositorio` int(5) NOT NULL COMMENT 'Para agrupar los archivos'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `archivos`
--

INSERT INTO `archivos` (`archivo_id`, `archivo_data`, `archivo_repositorio`) VALUES
(1, 'data', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `equipo_id` int(11) NOT NULL,
  `equipo_nombre` varchar(200) NOT NULL,
  `equipo_bandera` text COMMENT 'informacion en json del archivo de imagen de la bandera del equipo'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipos`
--

INSERT INTO `equipos` (`equipo_id`, `equipo_nombre`, `equipo_bandera`) VALUES
(1, 'PARANA FC', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `equipos_view`
--
CREATE TABLE IF NOT EXISTS `equipos_view` (
`equipo_id` int(11)
,`equipo_nombre` varchar(200)
,`equipo_bandera` text
,`jugador_id` int(11)
,`jugador_nombre` varchar(200)
,`jugador_apellido` varchar(200)
,`jugador_altura` int(5)
,`jugador_peso` int(5)
,`jugador_pierna` tinyint(1)
,`jugador_notas` text
,`jugador_equipo` int(11)
,`jugador_posicion` set('PO','DFC','LAT','LIB','MD','MC','MI','MP','DC','SD','EXT')
,`jugador_numero` int(3)
,`repositorio_id` int(11)
,`archivo` int(11)
,`tabla` varchar(200)
,`objeto` int(11)
,`archivo_id` int(11)
,`archivo_data` text
,`archivo_repositorio` int(5)
);

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
  `jugador_equipo` int(11) NOT NULL,
  `jugador_posicion` set('PO','DFC','LAT','LIB','MD','MC','MI','MP','DC','SD','EXT') NOT NULL COMMENT '''PO'',''DFC'',''LAT'',''LIB'',''MD'',''MC'',''MI'',''MP'',''DC'',''SD'',''EXT''',
  `jugador_numero` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jugadores`
--

INSERT INTO `jugadores` (`jugador_id`, `jugador_nombre`, `jugador_apellido`, `jugador_altura`, `jugador_peso`, `jugador_pierna`, `jugador_notas`, `jugador_equipo`, `jugador_posicion`, `jugador_numero`) VALUES
(1, 'Gabriel', 'Macus', 170, 61, 1, NULL, 1, 'DFC', 11),
(2, 'Gabriel', 'Macus', 170, 61, 1, NULL, 1, 'DFC', 12);

-- --------------------------------------------------------

--
-- Table structure for table `repositorio`
--

CREATE TABLE IF NOT EXISTS `repositorio` (
  `repositorio_id` int(11) NOT NULL,
  `archivo` int(11) NOT NULL,
  `tabla` varchar(200) NOT NULL,
  `objeto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repositorio`
--

INSERT INTO `repositorio` (`repositorio_id`, `archivo`, `tabla`, `objeto`) VALUES
(1, 1, 'equipos', 1);

-- --------------------------------------------------------

--
-- Structure for view `equipos_view`
--
DROP TABLE IF EXISTS `equipos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `equipos_view` AS select `equipos`.`equipo_id` AS `equipo_id`,`equipos`.`equipo_nombre` AS `equipo_nombre`,`equipos`.`equipo_bandera` AS `equipo_bandera`,`jugadores`.`jugador_id` AS `jugador_id`,`jugadores`.`jugador_nombre` AS `jugador_nombre`,`jugadores`.`jugador_apellido` AS `jugador_apellido`,`jugadores`.`jugador_altura` AS `jugador_altura`,`jugadores`.`jugador_peso` AS `jugador_peso`,`jugadores`.`jugador_pierna` AS `jugador_pierna`,`jugadores`.`jugador_notas` AS `jugador_notas`,`jugadores`.`jugador_equipo` AS `jugador_equipo`,`jugadores`.`jugador_posicion` AS `jugador_posicion`,`jugadores`.`jugador_numero` AS `jugador_numero`,`repositorio`.`repositorio_id` AS `repositorio_id`,`repositorio`.`archivo` AS `archivo`,`repositorio`.`tabla` AS `tabla`,`repositorio`.`objeto` AS `objeto`,`archivos`.`archivo_id` AS `archivo_id`,`archivos`.`archivo_data` AS `archivo_data`,`archivos`.`archivo_repositorio` AS `archivo_repositorio` from (((`equipos` left join `jugadores` on((`equipos`.`equipo_id` = `jugadores`.`jugador_equipo`))) left join `repositorio` on(((`repositorio`.`objeto` = `equipos`.`equipo_id`) and (`repositorio`.`tabla` = 'equipos')))) left join `archivos` on((`archivos`.`archivo_id` = `repositorio`.`archivo`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`archivo_id`);

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
-- Indexes for table `repositorio`
--
ALTER TABLE `repositorio`
  ADD PRIMARY KEY (`repositorio_id`),
  ADD KEY `archivo` (`archivo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivos`
--
ALTER TABLE `archivos`
  MODIFY `archivo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipos`
--
ALTER TABLE `equipos`
  MODIFY `equipo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `jugador_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `repositorio`
--
ALTER TABLE `repositorio`
  MODIFY `repositorio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`jugador_equipo`) REFERENCES `equipos` (`equipo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repositorio`
--
ALTER TABLE `repositorio`
  ADD CONSTRAINT `repositorio_ibfk_1` FOREIGN KEY (`archivo`) REFERENCES `archivos` (`archivo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
