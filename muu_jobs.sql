-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-01-2013 a las 22:37:26
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `codejobs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_jobs`
--

CREATE TABLE IF NOT EXISTS `muu_jobs` (
  `ID_Job` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Company` varchar(150) NOT NULL,
  `Company_Information` text NOT NULL,
  `Location` varchar(250) NOT NULL,
  `Salary` varchar(25) NOT NULL,
  `Allocation_Time` varchar(50) NOT NULL,
  `Requirements` text NOT NULL,
  `Experience` text NOT NULL,
  `Activities` text NOT NULL,
  `Profile` text NOT NULL,
  `Technologies` varchar(250) NOT NULL,
  `Additional_Information` text NOT NULL,
  `Company_Contact` text NOT NULL,
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Duration` int(11) unsigned NOT NULL DEFAULT '86400',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `muu_jobs`
--

INSERT INTO `muu_jobs` (`ID_Job`, `ID_User`, `Title`, `Slug`, `Email`, `Company`, `Company_Information`, `Location`, `Salary`, `Allocation_Time`, `Requirements`, `Experience`, `Activities`, `Profile`, `Technologies`, `Additional_Information`, `Company_Contact`, `Language`, `Duration`, `Start_Date`, `Modified_Date`, `End_Date`, `Situation`) VALUES
(1, 1, 'Desarrollo php', 'desarrollador-php', 'codejobs.com', 'Codejobs', 'Abc', 'colima', '1200', 'full time', 'php\r\nhtml\r\nmysql', 'cualquier cosa', 'desarrollar una página', 'php senior', 'php, html, css', 'lo que sea', '3121293412\r\n', 'Spanish', 86400, 0, 0, 0, 'Active'),
(2, 1, 'testing 1', 'testing-1', 'aas@hotmail.com', 'codejobs', 'empresa de software', 'colima', '5000', 'Full Time', 'saber php', 'mucha', 'programar', 'php senior', 'asd', 'no', '123212', 'Spanish', 86400, 1357333510, 0, 1357419910, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
