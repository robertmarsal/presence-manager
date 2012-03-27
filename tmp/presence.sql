-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-03-2012 a las 12:02:52
-- Versión del servidor: 5.1.61
-- Versión de PHP: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `presence`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presence_activity`
--

CREATE TABLE IF NOT EXISTS `presence_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(250) COLLATE utf8_bin NOT NULL,
  `action` varchar(50) COLLATE utf8_bin NOT NULL,
  `timestamp` int(15) NOT NULL,
  `computed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `presence_activity`
--

INSERT INTO `presence_activity` (`id`, `userid`, `action`, `timestamp`, `computed`) VALUES
(1, '2', 'checkin', 1329120346, 1),
(2, '2', 'checkout', 1329152549, 1),
(13, '2', 'checkin', 1329296424, 1),
(14, '2', 'checkout', 1329321624, 1),
(15, '2', 'checkin', 1329375624, 1),
(16, '2', 'checkout', 1329411624, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presence_intervals`
--

CREATE TABLE IF NOT EXISTS `presence_intervals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `timestart` int(15) NOT NULL,
  `timestop` int(15) NOT NULL,
  `timediff` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `y` int(11) NOT NULL,
  `m` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) NOT NULL,
  `s` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `presence_intervals`
--

INSERT INTO `presence_intervals` (`id`, `userid`, `timestart`, `timestop`, `timediff`, `week`, `month`, `year`, `y`, `m`, `d`, `h`, `i`, `s`) VALUES
(15, 2, 1329375624, 1329411624, 36000, 7, 2, 2012, 0, 0, 0, 10, 0, 0),
(14, 2, 1329296424, 1329321624, 25200, 7, 2, 2012, 0, 0, 0, 7, 0, 0),
(13, 2, 1329120346, 1329152549, 32203, 7, 2, 2012, 0, 0, 0, 8, 56, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presence_users`
--

CREATE TABLE IF NOT EXISTS `presence_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(200) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(300) COLLATE utf8_bin NOT NULL,
  `position` varchar(200) COLLATE utf8_bin NOT NULL,
  `mac` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `presence_users`
--

INSERT INTO `presence_users` (`id`, `email`, `password`, `role`, `firstname`, `lastname`, `position`, `mac`) VALUES
(1, 'robertboloc@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'admin', 'Robert', 'Boloc', 'User Experience Expert', ''),
(2, 'monica.figuerola@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Monica', 'Figuerola', 'Mobile Visual Director', '7d:61:93:2d:c2:01'),
(3, 'mikael.bloomkvist@urv.cat', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Mikael', 'Bloomkvist', 'Junior Content Producer', ''),
(4, 'charles.babbage@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Charles', 'Babbage', 'Front End Design', ''),
(5, 'manuel.blum@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Manuels', 'Blum', 'User Centered Design', ''),
(6, 'crayseymour@caltech.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Seymour', 'Cray', 'Human Factors Architect', ''),
(7, 'blangefors@millenium.se', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Borje', 'Langefors', 'Interaction Designer', ''),
(8, 'lluisdomenech@mtn.org', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Llui', 'Domenech i Montaner', 'User Experience Developer', ''),
(9, 'housemd@plainsboro.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'Greg', 'House', 'Interaction Guru', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
