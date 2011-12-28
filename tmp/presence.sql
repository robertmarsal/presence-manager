-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Temps de generació: 28-12-2011 a les 19:31:35
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
CREATE DATABASE `presence` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `presence`;

-- --------------------------------------------------------

--
-- Estructura de la taula `presence_admin_activity`
--

CREATE TABLE IF NOT EXISTS `presence_admin_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(250) COLLATE utf8_bin NOT NULL,
  `action` varchar(50) COLLATE utf8_bin NOT NULL,
  `timestamp` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Bolcant dades de la taula `presence_admin_activity`
--

INSERT INTO `presence_admin_activity` (`id`, `userid`, `action`, `timestamp`) VALUES
(1, 'monica.figuerola@gmail.com', 'success', 1325080875),
(2, 'monica.figuerola@gmail.com', 'warning', 1325088330),
(3, 'mikael.bloomkvist@urv.cat', 'success', 1325167235),
(4, 'crayseymour@caltech.com', 'important', 1325145718),
(5, 'manuel.blum@hotmail.com', 'success', 1325145718),
(6, 'blangefors@millenium.se', 'success', 1325145715),
(7, 'lluisdomenech@mtn.org', 'success', 1325088330),
(8, 'housemd@plainsboro.com', 'success', 1325088335),
(9, 'charles.babbage@gmail.com', 'success', 1325148718),
(10, 'mikael.bloomkvist@urv.cat', 'important', 1325080875),
(11, 'crayseymour@caltech.com', 'important', 1325080875),
(12, 'manuel.blum@hotmail.com', 'important', 1325080875),
(13, 'blangefors@millenium.se', 'important', 1325080875),
(14, 'lluisdomenech@mtn.org', 'important', 1325080875),
(15, 'housemd@plainsboro.com', 'important', 1325145718),
(16, 'charlecharles.babbage@gmail.coms.babbage@gmail.com', 'important', 1325145718);

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
(5, 'manuel.blum@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Manuel', 'Blum'),
(6, 'crayseymour@caltech.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Seymour', 'Cray'),
(7, 'blangefors@millenium.se', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Börje', 'Langefors'),
(8, 'lluisdomenech@mtn.org', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Lluís', 'Domènech i Montaner'),
(9, 'housemd@plainsboro.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Greg', 'House');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
