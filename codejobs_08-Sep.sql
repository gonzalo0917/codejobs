-- Adminer 3.2.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `muu_codes` (`ID_Code`, `ID_User`, `Title`, `Description`, `Slug`, `Languages`, `Author`, `Start_Date`, `Text_Date`, `Views`, `Likes`, `Dislikes`, `Reported`, `Language`, `Situation`) VALUES
(1,	1,	'Mi primera página web',	'Probando las descripciones',	'mi-primera-pagina-web',	'CSS, HTML',	'admin',	1343549198,	'Sunday, 29 de July de 2012',	2,	1,	0,	0,	'Spanish',	'Active'),
(2,	1,	'Mostrar información en PHP',	NULL,	'mostrar-informacion-en-php',	'PHP',	'admin',	1342473272,	'Monday, 16 de Julio de 2012',	3,	0,	0,	0,	'Spanish',	'Active'),
(3,	1,	'My first webpage',	NULL,	'my-first-webpage',	'CSS, HTML',	'admin',	1343549249,	'Sunday, 29 de July de 2012',	4,	0,	0,	0,	'English',	'Active'),
(4,	1,	'Hola mundo en C++',	'Este es un saludo de programación',	'hola-mundo-en-c',	'C++',	'admin',	1347106897,	'SÃ¡bado, 08 de Septiembre de 2012',	4,	0,	0,	0,	'Spanish',	'Active'),
(5,	1,	'Mensajes en javascript',	'Aquí mostramos la forma de desplegar mensajes en una página web mediante javascript. ?php echo \"hola\"; ?',	'mensajes-en-javascript',	'HTML, Javascript',	'admin',	1347109928,	'SÃ¡bado, 08 de Septiembre de 2012',	1,	0,	0,	0,	'Spanish',	'Active'),
(6,	1,	'Mostrar la fecha actual en Javascript',	'Probando...',	'mostrar-la-fecha-actual-en-javascript',	'Javascript',	'admin',	1347114837,	'SÃ¡bado, 08 de Septiembre de 2012',	4,	0,	0,	0,	'Spanish',	'Active'),
(7,	1,	'Probando aplicación de códigos',	'Esta será una descripción muy difícil por incluir tildes y eñes =P',	'probando-aplicacion-de-codigos',	'CSS',	'admin',	1347113616,	'SÃ¡bado, 08 de Septiembre de 2012',	1,	0,	0,	0,	'Spanish',	'Pending'),
(8,	1,	'Algo en C--',	'No sé que puede ser :S',	'algo-en-c',	'Text plain',	'admin',	1347113725,	'SÃ¡bado, 08 de Septiembre de 2012',	2,	0,	0,	0,	'Spanish',	'Deleted'),
(9,	1,	'Pruebaaaa',	'sestsa es un aprueba',	'pruebaaaa',	'Text plain',	'admin',	1347136026,	'SÃ¡bado, 08 de Septiembre de 2012',	0,	0,	0,	0,	'Spanish',	'Active'),
(10,	1,	'wiwalweirsrse sdf',	'werew sf sdgr',	'wiwalweirsrse-sdf',	'Text plain',	'admin',	1347136072,	'SÃ¡bado, 08 de Septiembre de 2012',	0,	0,	0,	0,	'Spanish',	'Active'),
(11,	1,	'qqqqqqqqqqq',	'qwer f fsdsd',	'qqqqqqqqqqq',	'Text plain',	'admin',	1347136149,	'SÃ¡bado, 08 de Septiembre de 2012',	0,	0,	0,	0,	'Spanish',	'Active'),
(12,	1,	'Consola en Javascript',	'',	'consola-en-javascript',	'Javascript',	'admin',	1347138365,	'SÃ¡bado, 08 de Septiembre de 2012',	0,	0,	0,	0,	'Spanish',	'Active');

DROP TABLE IF EXISTS `muu_users`;
CREATE TABLE `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Privilege` mediumint(8) NOT NULL DEFAULT '4',
  `Username` varchar(30) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Avatar` varchar(200) NOT NULL DEFAULT 'default.png',
  `Credits` mediumint(8) NOT NULL DEFAULT '0',
  `Recommendation` mediumint(8) NOT NULL DEFAULT '50',
  `Sign` text NOT NULL,
  `Messages` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Recieve_Messages` tinyint(1) NOT NULL DEFAULT '1',
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Bookmarks` mediumint(8) NOT NULL DEFAULT '0',
  `Codes` mediumint(8) NOT NULL DEFAULT '0',
  `Tutorials` mediumint(8) NOT NULL DEFAULT '0',
  `Jobs` mediumint(8) NOT NULL DEFAULT '0',
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Age` smallint(2) NOT NULL DEFAULT '18',
  `Title` varchar(200) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `Gender` varchar(1) NOT NULL DEFAULT 'M',
  `Relationship` varchar(30) NOT NULL DEFAULT 'Single',
  `Birthday` varchar(10) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Technologies` varchar(255) NOT NULL,
  `Twitter` varchar(150) NOT NULL,
  `Facebook` varchar(150) NOT NULL,
  `Linkedin` varchar(150) NOT NULL,
  `Viadeo` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `muu_users` (`ID_User`, `ID_Privilege`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Credits`, `Recommendation`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Comments`, `Bookmarks`, `Codes`, `Tutorials`, `Jobs`, `Subscribed`, `Start_Date`, `Code`, `CURP`, `RFC`, `Name`, `Age`, `Title`, `Address`, `Zip`, `Phone`, `Mobile`, `Gender`, `Relationship`, `Birthday`, `Country`, `District`, `City`, `Technologies`, `Twitter`, `Facebook`, `Linkedin`, `Viadeo`, `Situation`) VALUES
(1,	1,	'admin',	'b9223847e1566884893656e84798ff39cea2b8c4',	'carlos@milkzoft.com',	'',	'default.png',	72,	137,	'',	0,	1,	0,	0,	0,	1,	5,	0,	0,	1,	1337647712,	'BC958D3C97',	'',	'',	'Carlos Santana Roldán',	18,	'',	'',	'',	'',	'0',	'M',	'Single',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'Active');

-- 2012-09-08 17:19:49
