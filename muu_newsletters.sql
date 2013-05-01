-- Adminer 3.6.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `muu_newsletters`;
CREATE TABLE `muu_newsletters` (
  `ID_Newsletter` mediumint(8) unsigned NOT NULL,
  `ID_User` mediumint(8) unsigned NOT NULL,
  `Title` varchar(250) NOT NULL,
  `Message` text NOT NULL,
  `File` varchar(250) DEFAULT NULL,
  `To_Group` smallint(6) DEFAULT NULL,
  `To_Users` text,
  `Create_Date` int(11) NOT NULL,
  `Send_Date` int(11) DEFAULT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2013-04-30 19:53:33
