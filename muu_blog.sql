-- Adminer 3.6.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `muu_blog`;
CREATE TABLE `muu_blog` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Tags` varchar(250) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Modified_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Day` varchar(2) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Image_Mural` varchar(250) NOT NULL,
  `Image_Thumbnail` varchar(250) NOT NULL,
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Image_Original` varchar(250) NOT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Display_Bio` tinyint(1) NOT NULL DEFAULT '0', ------------------ SE DEBE AGREGAR ESTA COLUMNA ---------------------
  `Pwd` varchar(40) NOT NULL,
  `Buffer` tinyint(1) NOT NULL DEFAULT '1',
  `Code` varchar(10) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2013-05-08 18:32:54
