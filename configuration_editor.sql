-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `muu_configuration`;
CREATE TABLE `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `URL` varchar(60) NOT NULL,
  `Lang` varchar(2) NOT NULL DEFAULT 'en',
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Theme` varchar(25) NOT NULL DEFAULT 'ZanPHP',
  `Validation` varchar(15) NOT NULL DEFAULT 'Super Admin',
  `Application` varchar(30) NOT NULL DEFAULT 'Blog',
  `Editor` varchar(15) NOT NULL DEFAULT 'Redactor',
  `Message` text NOT NULL,
  `Activation` varchar(10) NOT NULL DEFAULT 'Nobody',
  `Email_Recieve` varchar(50) NOT NULL,
  `Email_Send` varchar(50) NOT NULL DEFAULT '@domain.com',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `URL`, `Lang`, `Language`, `Theme`, `Validation`, `Application`, `Editor`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `Situation`) VALUES
(1,	'Codejobs',	'Knowledge makes us free!',	'El conocimiento nos hace libres!',	'Connaissance nous rend libres!',	'Conhecimento nos torna livres!',	'http://localhost/codejobs',	'es',	'Spanish',	'newcodejobs',	'Active',	'blog',	'Redactor',	'El Sitio Web esta en mantenimiento',	'User',	'azapedia@gmail.com',	'carlos@codejobs.biz',	'Active');

-- 2012-10-05 17:37:56
