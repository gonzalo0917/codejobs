-- Adminer 3.2.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `muu_applications` (`ID_Application`, `Title`, `Slug`, `CPanel`, `Adding`, `BeDefault`, `Comments`, `Situation`) VALUES
(17,	'Codes',	'codes',	1,	1,	1,	0,	'Active');

DROP TABLE IF EXISTS `muu_codes`;
CREATE TABLE `muu_codes` (
  `ID_Code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Description` text,
  `Slug` varchar(150) NOT NULL,
  `Languages` varchar(100) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Dislikes` mediumint(8) NOT NULL DEFAULT '0',
  `Reported` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_codes_files`;
CREATE TABLE `muu_codes_files` (
  `ID_File` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Code` int(11) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ID_Syntax` int(11) NOT NULL,
  `Code` text NOT NULL,
  PRIMARY KEY (`ID_File`),
  KEY `ID_Code` (`ID_Code`),
  KEY `ID_Syntax` (`ID_Syntax`),
  CONSTRAINT `muu_codes_files_ibfk_1` FOREIGN KEY (`ID_Code`) REFERENCES `muu_codes` (`ID_Code`),
  CONSTRAINT `muu_codes_files_ibfk_2` FOREIGN KEY (`ID_Syntax`) REFERENCES `muu_codes_syntax` (`ID_Syntax`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_codes_syntax`;
CREATE TABLE `muu_codes_syntax` (
  `ID_Syntax` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `MIME` varchar(50) NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `Extension` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Syntax`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `muu_codes_syntax` (`ID_Syntax`, `Name`, `MIME`, `Filename`, `Extension`) VALUES
(1,	'Text plain',	'text/plain',	'',	''),
(2,	'JSON',	'application/json',	'javascript',	'json'),
(3,	'C++',	'text/x-c++src',	'clike',	'cpp'),
(4,	'PHP',	'application/x-httpd-php',	'php',	'php'),
(5,	'Javascript',	'text/javascript',	'javascript',	'js'),
(6,	'HTML',	'text/html',	'htmlmixed',	'html'),
(7,	'CSS',	'text/css',	'css',	'css');

INSERT INTO `muu_re_permissions_privileges` (`ID_Privilege`, `ID_Application`, `Adding`, `Deleting`, `Editing`, `Viewing`) VALUES
(1,	17,	1,	1,	1,	1),
(2,	17,	1,	1,	1,	1),
(3,	17,	1,	0,	0,	1),
(4,	17,	0,	0,	0,	0);

-- 2012-09-01 10:40:42
