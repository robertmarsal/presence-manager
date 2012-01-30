-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 24-01-2012 a les 13:41:11
-- Versió del servidor: 5.1.58
-- Versió de PHP : 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `presence`
--

USE presence;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Bolcant dades de la taula `presence_activity`
--

INSERT INTO `presence_activity` (`id`, `userid`, `action`, `timestamp`) VALUES
(1, '2', 'checkin', 1295791260),
(2, '2', 'checkout', 1295910180);

-- --------------------------------------------------------

--
-- Estructura de la taula `presence_users`
--

CREATE TABLE IF NOT EXISTS `presence_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(200) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(300) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Bolcant dades de la taula `presence_users`
--

INSERT INTO `presence_users` (`id`, `email`, `password`, `role`, `firstname`, `lastname`) VALUES
(1, 'robertboloc@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'admin', 'Robert', 'Boloc'),
(2, 'monica.figuerola@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Monica', 'Figuerola'),
(3, 'mikael.bloomkvist@urv.cat', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Mikael', 'Bloomkvist'),
(4, 'charles.babbage@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Charles', 'Babbage'),
(5, 'manuel.blum@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Manuels', 'Blum'),
(6, 'crayseymour@caltech.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Seymour', 'Cray'),
(7, 'blangefors@millenium.se', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Borje', 'Langefors'),
(8, 'lluisdomenech@mtn.org', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Llui', 'Domenech i Montaner'),
(9, 'housemd@plainsboro.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Greg', 'House');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
