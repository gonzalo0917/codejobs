-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-04-2013 a las 04:39:18
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
  `Company` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Country` varchar(80) NOT NULL,
  `City` varchar(80) NOT NULL,
  `City_Slug` varchar(80) NOT NULL,
  `Salary` varchar(25) NOT NULL,
  `Salary_Currency` varchar(3) NOT NULL,
  `Allocation_Time` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Tags` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Type_Url` varchar(250) NOT NULL,
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  `Counter` smallint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
