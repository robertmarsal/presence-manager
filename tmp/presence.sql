-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-07-2012 a las 14:42:29
-- Versión del servidor: 5.5.24
-- Versión de PHP: 5.3.10-1ubuntu3.2

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presence_auth`
--

CREATE TABLE IF NOT EXISTS `presence_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `timeexpires` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `presence_auth`
--

INSERT INTO `presence_auth` (`id`, `userid`, `token`, `timeexpires`) VALUES
(15, 2, 'e973e8aae09e618f0be5bb496277edf23fa0d3aa', 1340705850);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `presence_intervals`
--

INSERT INTO `presence_intervals` (`id`, `userid`, `timestart`, `timestop`, `timediff`, `week`, `month`, `year`, `y`, `m`, `d`, `h`, `i`, `s`) VALUES
(1, 2, 1329120346, 1329152549, 32203, 7, 2, 2012, 0, 0, 0, 8, 56, 43),
(2, 2, 1329296424, 1329321624, 25200, 7, 2, 2012, 0, 0, 0, 7, 0, 0),
(3, 2, 1329375624, 1329411624, 36000, 7, 2, 2012, 0, 0, 0, 10, 0, 0),
(8, 3, 1329120346, 1329152549, 32203, 7, 2, 2012, 0, 0, 0, 8, 56, 43),
(7, 1, 1329120346, 1329152549, 32203, 7, 2, 2012, 0, 0, 0, 8, 56, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presence_users`
--

CREATE TABLE IF NOT EXISTS `presence_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` char(40) COLLATE utf8_bin NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(200) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(300) COLLATE utf8_bin NOT NULL,
  `position` varchar(200) COLLATE utf8_bin NOT NULL,
  `UUID` char(40) COLLATE utf8_bin NOT NULL,
  `mac` char(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `presence_users`
--

INSERT INTO `presence_users` (`id`, `identifier`, `password`, `role`, `firstname`, `lastname`, `position`, `UUID`, `mac`) VALUES
(1, 'robertboloc@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'admin', 'Robert', 'Boloc', 'User Experience Expert', '', '0'),
(2, 'monica.figuerola@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Monica', 'Figuerola', 'Mobile Visual Director', 'ab6a761f4f3423853867191aa308e477bd30daeb', '6ba56b91581a7e8479d3bab090de363d8acf7093'),
(3, 'mikael.bloomkvist@urv.cat', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Mikael', 'Bloomkvist', 'Junior Content Producer', '', '0'),
(4, 'charles.babbage@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Charles', 'Babbage', 'Front End Design', '', '0'),
(13, 'sdasd', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'asdaasdasd', 'asda', 'sdasd', '', ''),
(6, 'crayseymour@caltech.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Seymour', 'Cray', 'Human Factors Architect', '', '0'),
(7, 'blangefors@millenium.se', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Borje', 'Langefors', 'Interaction Designer', '', '0'),
(8, 'lluisdomenech@mtn.org', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Llui', 'Domenech i Montaner', 'User Experience Developer', '', '0'),
(9, 'housemd@plainsboro.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Greg', 'House', 'Interaction Guru', '', '0'),
(10, 'mb@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Michael', 'Boone', 'Lead Anchor', '', '0'),
(66, 'asdas', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 'Langa', 'Band', 'asd', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
