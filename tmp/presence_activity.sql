-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Temps de generació: 30-12-2011 a les 20:22:00
-- Versió del servidor: 5.5.16
-- Versió de PHP : 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `presence`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `presence_activity`
--

CREATE TABLE IF NOT EXISTS `presence_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(250) COLLATE utf8_bin NOT NULL,
  `action` varchar(50) COLLATE utf8_bin NOT NULL,
  `timestamp` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Bolcant dades de la taula `presence_activity`
--

INSERT INTO `presence_activity` (`id`, `userid`, `action`, `timestamp`) VALUES
(1, '2', 'success', 1325080875),
(2, '2', 'warning', 1325088330),
(3, '3', 'success', 1325167235),
(4, '6', 'important', 1325145718),
(5, '5', 'success', 1325145718),
(6, '7', 'success', 1325145715),
(7, '8', 'success', 1325088330),
(8, '9', 'success', 1325088335),
(9, '4', 'success', 1325148718),
(10, '3', 'important', 1325080875),
(11, '6', 'important', 1325080875),
(12, '5', 'important', 1325080875),
(13, '7', 'important', 1325080875),
(14, '8', 'important', 1325080875),
(15, '9', 'important', 1325145718),
(16, '4', 'important', 1325145718);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
