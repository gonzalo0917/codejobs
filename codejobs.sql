-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2013 at 02:23 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codejobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `muu_ads`
--

CREATE TABLE IF NOT EXISTS `muu_ads` (
  `ID_Ad` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Position` varchar(15) NOT NULL DEFAULT 'Right',
  `Banner` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Code` text NOT NULL,
  `Clicks` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `End_Date` int(11) NOT NULL DEFAULT '0',
  `Time` mediumint(8) NOT NULL DEFAULT '5000',
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ad`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `muu_ads`
--

INSERT INTO `muu_ads` (`ID_Ad`, `ID_User`, `Title`, `Position`, `Banner`, `URL`, `Code`, `Clicks`, `Start_Date`, `End_Date`, `Time`, `Principal`, `Situation`) VALUES
(1, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/1084b_45a3e-banner2.png', 'http://www.google.com', '', 0, 1339030862, 1341450062, 5000, 0, 'Deleted'),
(2, 1, 'ddasdasdad', 'Right', 'www/lib/files/images/ads/988b3_soldiercorp-logo-new.png', 'http://soldiercorp.net', 'soldiercorp.net.net.net', 0, 1358364443, 1360783643, 5000, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_applications`
--

CREATE TABLE IF NOT EXISTS `muu_applications` (
  `ID_Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Slug` varchar(45) NOT NULL,
  `CPanel` tinyint(1) NOT NULL DEFAULT '1',
  `Adding` tinyint(1) NOT NULL,
  `BeDefault` tinyint(1) NOT NULL DEFAULT '1',
  `Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Application`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `muu_applications`
--

INSERT INTO `muu_applications` (`ID_Application`, `Title`, `Slug`, `CPanel`, `Adding`, `BeDefault`, `Comments`, `Situation`) VALUES
(1, 'Ads', 'ads', 1, 1, 0, 0, 'Active'),
(2, 'Applications', 'applications', 1, 1, 0, 0, 'Inactive'),
(3, 'Blog', 'blog', 1, 1, 1, 1, 'Active'),
(4, 'Comments', 'comments', 1, 0, 0, 1, 'Active'),
(5, 'Configuration', 'configuration', 1, 0, 0, 0, 'Active'),
(6, 'Feedback', 'feedback', 1, 0, 0, 0, 'Active'),
(7, 'Forums', 'forums', 1, 1, 1, 0, 'Active'),
(8, 'Gallery', 'gallery', 1, 1, 1, 1, 'Active'),
(9, 'Bookmarks', 'bookmarks', 1, 1, 1, 0, 'Active'),
(10, 'Messages', 'messages', 1, 1, 0, 0, 'Inactive'),
(11, 'Pages', 'pages', 1, 1, 1, 0, 'Active'),
(12, 'Polls', 'polls', 1, 1, 0, 0, 'Active'),
(13, 'Support', 'support', 1, 1, 0, 0, 'Inactive'),
(14, 'Users', 'users', 1, 1, 0, 0, 'Active'),
(15, 'Videos', 'videos', 1, 1, 1, 0, 'Active'),
(16, 'Works', 'works', 1, 1, 1, 0, 'Active'),
(17, 'Codes', 'codes', 1, 1, 1, 0, 'Active'),
(18, 'Jobs', 'jobs', 1, 1, 1, 0, 'Active'),
(19, 'Multimedia', 'multimedia', 1, 1, 1, 0, 'Active'),
(20, 'Workshop', 'workshop', 1, 0, 1, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_blog`
--

CREATE TABLE IF NOT EXISTS `muu_blog` (
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
  `Image_Mural` varchar(250) DEFAULT NULL,
  `Image_Thumbnail` varchar(250) DEFAULT NULL,
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Image_Large` varchar(250) NOT NULL,
  `Image_Original` varchar(250) DEFAULT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Pwd` varchar(40) NOT NULL,
  `Buffer` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `Code` varchar(10) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `muu_blog`
--

INSERT INTO `muu_blog` (`ID_Post`, `ID_User`, `Title`, `Slug`, `Content`, `Tags`, `Author`, `Start_Date`, `Modified_Date`, `Text_Date`, `Year`, `Month`, `Day`, `Views`, `Image_Mural`, `Image_Thumbnail`, `Image_Small`, `Image_Medium`, `Image_Original`, `Comments`, `Enable_Comments`, `Language`, `Pwd`, `Buffer`, `Code`, `Situation`) VALUES
(1, 1, 'Nuevo marcador de prueba', 'nuevo-marcador-de-prueba', 'qweadzasdsdfsdfsdfsdf', 'php, pdo, mysql, conexion, base datos', 'admin', 1357692854, 0, 'Martes, 08 de Enero de 2013', '2013', '01', '08', 2, '', '', '', '', '', 0, 1, 'Spanish', '', 1, '38570CA356', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_bookmarks`
--

CREATE TABLE IF NOT EXISTS `muu_bookmarks` (
  `ID_Bookmark` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `Slug` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Tags` varchar(200) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Views` mediumint(8) NOT NULL DEFAULT '0',
  `Likes` mediumint(8) NOT NULL DEFAULT '0',
  `Dislikes` mediumint(8) NOT NULL DEFAULT '0',
  `Reported` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Modified_Date` int(11) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Bookmark`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `muu_bookmarks`
--

INSERT INTO `muu_bookmarks` (`ID_Bookmark`, `ID_User`, `Title`, `Slug`, `URL`, `Description`, `Tags`, `Author`, `Views`, `Likes`, `Dislikes`, `Reported`, `Language`, `Start_Date`, `Modified_Date`, `Situation`) VALUES
(1, 1, 'How to create a Debian .deb package', 'how-to-create-a-debian-deb-package', 'http://blog.serverdensity.com/2010/02/05/how-to-create-a-debian-deb-package/', 'A few weeks ago we announced that the agent for our server monitoring application, Server Density, was available as a Debian or Red Hat package, with associated repositories. Over my next few posts I will be outlining how we created our Linux-based packages and repositories, and what our steps are going to be to improve these processes in the future.', 'linux, debian, ubuntu, ror', 'codejobs', 6, 0, 0, 0, 'English', 1332738072, 0, 'Active'),
(2, 1, 'Guardar en disco con HTML5 y Javascript: SessionStorage y LocalStorage', 'guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localstorage', 'http://www.cristalab.com/tutoriales/guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localst', 'Si hay algo que siempre se extrañó de HTML es en alguna forma de almacenar datos, que ayude al usuario a una mejor movilidad mientras navega nuestras páginas.', 'ror, html5, javascript, sessionstorage, localstorage', 'codejobs', 22, 0, 1, 0, 'Spanish', 1332738072, 0, 'Active'),
(3, 1, 'Migrating Rails&RJS From Prototype To JQuery', 'migrating-rails-rjs-from-prototype-to-jquery', 'http://dzone.com/snippets/migrating-railsrjs-prototype', 'I was changing prototype to jsquery in my Rails app. To make my AJAX+RJS stuff work I tried jrails gem. For some reason AJAX responses were rendedered to whole page, instead of evaluating the returned JS. So i did the hack. I took this piece of jrails and put it in my /lib folder.', 'rails, ror, rjs, jquery', 'codejobs', 17, 0, 0, 0, 'English', 1337738320, 0, 'Active'),
(4, 1, 'Capistrano: Deploy Rails Twice To The Same Machine', 'capistrano-deploy-rails-twice-to-the-same-machine', 'http://dzone.com/snippets/capistrano-deploy-rails-twice', 'Capistrano is oriented so it deploys to the same directory on several machines. This means you can''t deploy to two different locations on the same machine. The following recipe in Capfile will allow you to duplicate your main rails app in a second directory. You can schedule it to run automatically with every deploy or just do it manually. I included database migrations by default. Remove the shared config line if you don''t have it.', 'capistrano, ror, rails', 'codejobs', 38, 1, 0, 0, 'English', 1337738320, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_codes`
--

CREATE TABLE IF NOT EXISTS `muu_codes` (
  `ID_Code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Description` text,
  `Slug` varchar(150) NOT NULL,
  `Languages` varchar(100) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Dislikes` mediumint(8) NOT NULL DEFAULT '0',
  `Reported` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `muu_codes`
--

INSERT INTO `muu_codes` (`ID_Code`, `ID_User`, `Title`, `Description`, `Slug`, `Languages`, `Author`, `Start_Date`, `Modified_Date`, `Text_Date`, `Views`, `Likes`, `Dislikes`, `Reported`, `Language`, `Situation`) VALUES
(1, 1, 'Mi primera página web', 'Forma de incrustar un archivo CSS.', 'mi-primera-pagina-web', 'CSS, HTML', 'admin', 1343549198, 0, 'Sunday, 29 de July de 2012', 1, 1, 0, 0, 'Spanish', 'Active'),
(2, 1, 'Mostrar información en PHP', NULL, 'mostrar-informacion-en-php', 'PHP', 'admin', 1342473272, 0, 'Monday, 16 de Julio de 2012', 2, 0, 0, 0, 'Spanish', 'Active'),
(3, 1, 'My first webpage', NULL, 'my-first-webpage', 'CSS, HTML', 'admin', 1343549249, 0, 'Sunday, 29 de July de 2012', 1, 0, 0, 0, 'English', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_codes_files`
--

CREATE TABLE IF NOT EXISTS `muu_codes_files` (
  `ID_File` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Code` int(11) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ID_Syntax` int(11) NOT NULL,
  `Code` text NOT NULL,
  PRIMARY KEY (`ID_File`),
  KEY `ID_Code` (`ID_Code`),
  KEY `ID_Syntax` (`ID_Syntax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `muu_codes_files`
--

INSERT INTO `muu_codes_files` (`ID_File`, `ID_Code`, `Name`, `ID_Syntax`, `Code`) VALUES
(1, 1, 'pagina.html', 6, '<!DOCTYPE html>\r\n<html lang="es">\r\n<head>\r\n  <meta charset="utf-8" />\r\n  <title>Título de la página</title>\r\n  <link href="estilo.css" />\r\n</head>\r\n<body>\r\n  Esta es mi primera página web.\r\n</body>\r\n</html>'),
(2, 1, 'estilo.css', 7, '/* Estilo del cuerpo */\r\n\r\nbody {\r\n  background-color: lightyellow;\r\n  margin: 10px;\r\n}'),
(3, 2, 'info.php', 4, '<?php\r\n // La siguiente línea muestra información\r\n phpinfo();\r\n?>'),
(4, 3, 'page.html', 6, '<!DOCTYPE html>\r\n<html lang="en">\r\n<head>\r\n  <meta charset="utf-8" />\r\n  <title>Title''s webpage</title>\r\n  <link href="estilo.css" />\r\n</head>\r\n<body>\r\n  This is my first webpage.\r\n</body>\r\n</html>'),
(5, 3, 'style.css', 7, '/* Body''s style */\r\n\r\nbody {\r\n  background-color: lightyellow;\r\n  margin: 10px;\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `muu_codes_syntax`
--

CREATE TABLE IF NOT EXISTS `muu_codes_syntax` (
  `ID_Syntax` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `MIME` varchar(50) NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `Extension` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Syntax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `muu_codes_syntax`
--

INSERT INTO `muu_codes_syntax` (`ID_Syntax`, `Name`, `MIME`, `Filename`, `Extension`) VALUES
(1, 'Text plain', 'text/plain', '', ''),
(2, 'JSON', 'application/json', 'javascript', 'json'),
(3, 'C++', 'text/x-c++src', 'clike', 'cpp'),
(4, 'PHP', 'application/x-httpd-php', 'php', 'php'),
(5, 'Javascript', 'text/javascript', 'javascript', 'js'),
(6, 'HTML', 'text/html', 'htmlmixed', 'html'),
(7, 'CSS', 'text/css', 'css', 'css');

-- --------------------------------------------------------

--
-- Table structure for table `muu_comments`
--

CREATE TABLE IF NOT EXISTS `muu_comments` (
  `ID_Comment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comment` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Avatar` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Comment`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_configuration`
--

CREATE TABLE IF NOT EXISTS `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `Slogan_Italian` varchar(100) NOT NULL,
  `URL` varchar(60) NOT NULL,
  `Lang` varchar(2) NOT NULL DEFAULT 'en',
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Theme` varchar(25) NOT NULL DEFAULT 'ZanPHP',
  `Validation` varchar(15) NOT NULL DEFAULT 'Super Admin',
  `Application` varchar(30) NOT NULL DEFAULT 'Blog',
  `Editor` varchar(15) NOT NULL DEFAULT 'MarkitUp',
  `TV` text NOT NULL,
  `Enable_Chat` tinyint(1) NOT NULL,
  `Message` text NOT NULL,
  `Activation` varchar(10) NOT NULL DEFAULT 'Nobody',
  `Email_Recieve` varchar(50) NOT NULL,
  `Email_Send` varchar(50) NOT NULL DEFAULT '@domain.com',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `muu_configuration`
--

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `Slogan_Italian`, `URL`, `Lang`, `Language`, `Theme`, `Validation`, `Application`, `Editor`, `TV`, `Enable_Chat`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `Situation`) VALUES
(1, 'Codejobs', 'Knowledge makes us free!', 'El conocimiento nos hace libres!', 'Connaissance nous rend libres!', 'Conhecimento nos torna livres!', 'La conoscenza ci rende liberi!', 'http://localhost/codejobs', 'es', 'Spanish', 'newcodejobs', 'Active', 'blog', 'MarkitUp', '<iframe width="850" height="420" src="http://www.youtube.com/embed/aLlcRw9vEjM" frameborder="0" allowfullscreen></iframe>', 1, 'El Sitio Web esta en mantenimiento', 'User', 'azapedia@gmail.com', 'carlos@codejobs.biz', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_categories`
--

CREATE TABLE IF NOT EXISTS `muu_courses_categories` (
  `ID_Category` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Courses` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(10) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_enrollments`
--

CREATE TABLE IF NOT EXISTS `muu_courses_enrollments` (
  `ID_Enrollment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Enrollment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_help`
--

CREATE TABLE IF NOT EXISTS `muu_courses_help` (
  `ID_Help` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Topic` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Help`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_lessons`
--

CREATE TABLE IF NOT EXISTS `muu_courses_lessons` (
  `ID_Lesson` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Lesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_material`
--

CREATE TABLE IF NOT EXISTS `muu_courses_material` (
  `ID_Material` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_resources`
--

CREATE TABLE IF NOT EXISTS `muu_courses_resources` (
  `ID_Resource` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `URL` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_roles`
--

CREATE TABLE IF NOT EXISTS `muu_courses_roles` (
  `ID_Role` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Role` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_students`
--

CREATE TABLE IF NOT EXISTS `muu_courses_students` (
  `ID_Student` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Enrollment` varchar(9) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(80) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Presentation` varchar(255) NOT NULL,
  `Courses` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Code` varchar(10) NOT NULL,
  `Privileges` varchar(15) NOT NULL DEFAULT 'Student',
  PRIMARY KEY (`ID_Student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_students_archive`
--

CREATE TABLE IF NOT EXISTS `muu_courses_students_archive` (
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tests`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests` (
  `ID_Test` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Score` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tests_answers`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests_answers` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tests_questions`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests_questions` (
  `ID_Question` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Question` varchar(255) NOT NULL,
  `Value` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Audio` varchar(150) NOT NULL,
  `Image` varchar(150) NOT NULL,
  `Video` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tutors`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors` (
  `ID_Tutor` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Schooling` varchar(100) NOT NULL,
  `Curriculum` text NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Tutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tutors_alerts`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors_alerts` (
  `ID_Alert` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subject` varchar(250) NOT NULL,
  `Alert` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Alert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tutors_messages`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors_messages` (
  `ID_Message` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subject` varchar(250) NOT NULL,
  `Message` text NOT NULL,
  `File` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_dislikes`
--

CREATE TABLE IF NOT EXISTS `muu_dislikes` (
  `ID_Dislike` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Dislike`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `muu_dislikes`
--

INSERT INTO `muu_dislikes` (`ID_Dislike`, `ID_User`, `ID_Application`, `ID_Record`, `Start_Date`) VALUES
(1, 1, 10, 2, 1338350663),
(2, 1, 10, 12, 1358021226);

-- --------------------------------------------------------

--
-- Table structure for table `muu_events`
--

CREATE TABLE IF NOT EXISTS `muu_events` (
  `ID_Event` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(250) NOT NULL,
  `Place` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Time_Zone` varchar(50) NOT NULL,
  `Repeat_Event` varchar(50) NOT NULL,
  `Alert` varchar(50) NOT NULL,
  `Calendar` varchar(100) NOT NULL,
  `URL` varchar(150) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID_Event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_feedback`
--

CREATE TABLE IF NOT EXISTS `muu_feedback` (
  `ID_Feedback` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Phone` varchar(16) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Message` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(60) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`ID_Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `muu_feedback`
--

INSERT INTO `muu_feedback` (`ID_Feedback`, `Name`, `Email`, `Company`, `Phone`, `City`, `Subject`, `Message`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 'Carlos Santana Roldán', 'carlos@milkzoft.com', 'MilkZoft', '1223423', 'Colima', 'Hola como estas', 'adasdasd', 1337647712, 'Miércoles, 13 de Junio de 2012', 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `muu_forums`
--

CREATE TABLE IF NOT EXISTS `muu_forums` (
  `ID_Forum` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(120) NOT NULL,
  `Slug` varchar(120) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Reply` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Date` varchar(50) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Forum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `muu_forums`
--

-- --------------------------------------------------------

--
-- Table structure for table `muu_forums_posts`
--

CREATE TABLE IF NOT EXISTS `muu_forums_posts` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Forum_Name` varchar(100) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Avatar` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Hour` varchar(15) NOT NULL DEFAULT '00:00:00',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Topic` tinyint(1) NOT NULL DEFAULT '0',
  `Tags` varchar(150) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Forum` (`ID_Forum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_gallery`
--

CREATE TABLE IF NOT EXISTS `muu_gallery` (
  `ID_Image` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Small` varchar(255) NOT NULL,
  `Medium` varchar(255) NOT NULL,
  `Original` varchar(255) NOT NULL,
  `Album` varchar(50) NOT NULL DEFAULT 'None',
  `Album_Slug` varchar(150) NOT NULL DEFAULT 'None',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(50) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Image`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_gallery_themes`
--

CREATE TABLE IF NOT EXISTS `muu_gallery_themes` (
  `ID_Gallery_Theme` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Slug` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Gallery_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_inbox`
--

CREATE TABLE IF NOT EXISTS `muu_inbox` (
  `ID_Inbox` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Receiver` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Sender` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`ID_Inbox`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_jobs`
--

CREATE TABLE IF NOT EXISTS `muu_jobs` (
  `ID_Job` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Address1` varchar(250) NOT NULL,
  `Address2` varchar(250) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Company` varchar(150) NOT NULL,
  `Company_Information` text NOT NULL,
  `Country` varchar(80) NOT NULL,
  `City` varchar(80) NOT NULL,
  `Salary` varchar(25) NOT NULL,
  `Salary_Currency` varchar(3) NOT NULL,
  `Allocation_Time` varchar(50) NOT NULL,
  `Requirements` text NOT NULL,
  `Technologies` varchar(250) NOT NULL,
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `muu_jobs`
--

INSERT INTO `muu_jobs` (`ID_Job`, `ID_User`, `Title`, `Slug`, `Author`, `Address1`, `Address2`, `Phone`, `Email`, `Company`, `Company_Information`, `Country`, `City`, `Salary`, `Salary_Currency`, `Allocation_Time`, `Requirements`, `Technologies`, `Language`, `Start_Date`, `Modified_Date`, `End_Date`, `Situation`) VALUES
(11, 3, 'Entrada con autor', 'entrada-con-autor', 'Soldier', 'direccion emprsa', 'dsfsdfsd', 'fsdfsf', 'soldier@email.com', 'Microsoft', 'Teradata is the world?s largest company focused on analytic data solutions through integrated data warehousing, big data analytics, and business applications. Only Teradata gives organizations the advantage to transform data across the organization into actionable insights empowering leaders to think boldly and act decisively for the best decisions possible. Visit teradata.com. ', 'Chile', 'hgdfg', '155', 'USD', 'Half Time', 'Buscamos en desarrollador front-end con amplia experiencia en maquetado para colaborar con nuestro equipo de desarrollo. Todas nuestras implementaciones involucran sitios responsivos o adaptativos, html5 y jquery en varios niveles de complejidad. Tu tarea consistirá en convertir un PSD en un sitio increíble, no mediocre, generado con un código limpio, documentado y ordenado. Buscamos alguien con un alto grado de precisión, eficiencia y un ojo exquisito para el detalle.\r\n------\r\nNuestro equipo de diseño entrega trabajos fabulosos, mismos que delegan muy pocos problemas para nuestros maquetados, además siempre trabajamos en conjunto para lograr los mejores acuerdos (somos una sola empresa).\r\n\r\nLo que ofrecemos:\r\n\r\nSalario mensual inicial de 15k-20k, con base en aptitudes y evaluación.\r\n\r\nUn equipo internacional (En México, Bélgica y Holanda) que cree, confía y te apoya siempre.\r\n\r\nContratación por nómina mixta, con prestaciones de ley.\r\n\r\nPrestaciones adicionales con base en desempeño', 'css, php, etc, tgd', 'Spanish', 1358078124, 0, 1360670124, 'Active'),
(12, 3, 'Empleo prueba', 'empleo-prueba', 'Soldier', 'prolongacion independencia', 'direccion opcional empresa', '7351214628', 'soldier@email.com', 'Google', 'We generate Social Leads for your business in the Cloud. Venddo is one of the @Wayra Startups in Mexico.\r\nWe monitor and detect needs and possible prospects analyzing realtime twitter streams and power users. Our solution allows you to customize the profile of your customers and delivers a personalized list of prospects with detailed information about the prospects like graphs, history and consumer profile.', 'Alemania', 'ciudadadad', '13000', 'MXN', 'Full Time', 'Estamos desarrollando un conjunto de herramientas que ayudan a las empresas a generar más clientes, visibilidad y posicionamiento de marca en Redes Sociales.\r\n------\r\nDesarrollamos en Ruby on Rails principalmente, pero también tenemos desarrollo en PHP (CodeIgniter y puro). Nos apasiona el desarrollo y siempre estamos en búsqueda de lo último de las tecnologías de desarrollo para Web y Móviles. ', 'css, php, etc', 'Spanish', 1358077824, 0, 1360669824, 'Active'),
(13, 3, 'Programador PHP', 'programador-php', 'Soldier', 'Morelos', 'Cuautla', '1227489', 'soldiercrp@gmail.com', 'SoldierCorp', 'Empresa dedicada al desarrollo constante de aplicaciones en un entorno web y mobile.', 'México', 'Cuautla', '8000', 'MXN', 'Full Time', 'Programación Orientada a Objetos en PHP\r\nManejar al menos un Framework', 'php, framework, poo', 'Spanish', 1358077257, 0, 1360669257, 'Active'),
(14, 3, 'Empleo numero 4', 'empleo-numero-4', 'Soldier', 'Direccion de la empresa 4', '', '123123123', 'correo4@email.com', 'Empresa 4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Alemania', 'Alemania', '3000', 'EUR', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'lorem, eum, php, css, tech', 'Spanish', 1358078801, 0, 1360670801, 'Active'),
(15, 3, 'Empleo Numero 5', 'empleo-numero-5', 'Soldier', 'Dirección de la empresa 5', '', '5345345', 'correo5@email.com', 'Empresa 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Chile', 'Chile', '5000', 'USD', 'Half Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'facere, html, 5, iure', 'Spanish', 1358078856, 0, 1360670856, 'Active'),
(16, 3, 'Empresa 6', 'empresa-6', 'Soldier', 'Direccion de la empresa 6', '', '3535354', 'correo6@email.com', 'Empresa 6', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Estados Unidos', 'Seatle', '8000', 'USD', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'seatle, ab, porro', 'Spanish', 1358078912, 0, 1360670912, 'Active'),
(17, 3, 'Empresa 7', 'empresa-7', 'Soldier', 'Direccion de la empresa 7', '', '45646456', 'correo7@email.com', 'Empresa 7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Francia', 'Franciados', '50000', 'EUR', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'francia, sint, veniam, iure, eum', 'Spanish', 1358078987, 0, 1360670987, 'Active'),
(18, 3, 'Empresa 8', 'empresa-8', 'Soldier', 'Direccion de la empresa 9', '', '5667867867', 'correo8@email.com', 'Empresa 9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Italia', 'Palermo', '4900', 'EUR', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'elit, amet, css, lorem', 'Spanish', 1358079040, 0, 1360671040, 'Active'),
(19, 3, 'Empresa 9', 'empresa-9', 'Soldier', 'Direccion de la empresa 9', '', '686678', 'correo9@email.com', 'Empresa 9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Suiza', 'suizasd', '6700', 'USD', 'Half Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'segui, molestiae, sint, css, php, html', 'Spanish', 1358079110, 0, 1360671110, 'Active'),
(20, 3, 'Empresa 10', 'empresa-10', 'Soldier', 'Direccion de la empresa 10', '', '3453534534', 'correo10@email.com', 'Empresa 10', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'México', 'Morelos', '10000', 'MXN', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'mex, aum, mor, ipsum', 'Spanish', 1358079169, 0, 1360671169, 'Active'),
(21, 3, 'Empleo 11', 'empleo-11', 'Soldier', 'Direccion de la empresa 5', '', '345345', 'correo5@email.com', 'Empresa 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'Canada', 'Vancouver', '8000', 'USD', 'Full Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius mollitia dolorum minima sint veniam blanditiis accusantium eum tenetur doloremque porro sequi molestiae reprehenderit ab facere rem nostrum animi enim iure.', 'eur, ab, 5, choice', 'Spanish', 1358079348, 0, 1360671348, 'Active'),
(22, 3, 'TITULO EMPLEO', 'titulo-empleo', 'Soldier', 'prolongacion independencia', 'address 2 temporal', '345345', 'soldiercrp@gmail.com', 'SoldierCorp', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita libero maiores placeat sint laborum quisquam vero eligendi doloribus consequuntur reprehenderit non dolor dicta asperiores! Placeat error animi ducimus odio culpa!', 'Argentina', 'Vancouver', '4444', 'USD', 'Half Time', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita libero maiores placeat sint laborum quisquam vero eligendi doloribus consequuntur reprehenderit non dolor dicta asperiores! Placeat error animi ducimus odio culpa!', 'css, php, etc, tgd', 'Spanish', 1358108801, 0, 1360700801, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_learning`
--

CREATE TABLE IF NOT EXISTS `muu_learning` (
  `ID_Course` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Information` text NOT NULL,
  `Objetive` text NOT NULL,
  `To_People` text NOT NULL,
  `Requeriments` text NOT NULL,
  `Duration` smallint(5) NOT NULL,
  `Price1` varchar(20) NOT NULL,
  `Price2` varchar(20) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_likes`
--

CREATE TABLE IF NOT EXISTS `muu_likes` (
  `ID_Like` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Like`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `muu_likes`
--

INSERT INTO `muu_likes` (`ID_Like`, `ID_User`, `ID_Application`, `ID_Record`, `Start_Date`) VALUES
(1, 1, 10, 3, 1338350239),
(2, 1, 10, 4, 1338350263);

-- --------------------------------------------------------

--
-- Table structure for table `muu_logs`
--

CREATE TABLE IF NOT EXISTS `muu_logs` (
  `ID_Log` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Table_Name` varchar(50) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Query` text NOT NULL,
  `Start_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Log`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_multimedia`
--

CREATE TABLE IF NOT EXISTS `muu_multimedia` (
  `ID_File` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Filename` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `Medium` varchar(255) DEFAULT NULL,
  `Small` varchar(255) DEFAULT NULL,
  `Thumbnail` varchar(255) DEFAULT NULL,
  `Category` varchar(20) NOT NULL DEFAULT 'Images',
  `Size` int(11) unsigned NOT NULL DEFAULT '0',
  `Author` varchar(100) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(20) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_File`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `muu_multimedia`
--

INSERT INTO `muu_multimedia` (`ID_File`, `ID_User`, `Filename`, `URL`, `Medium`, `Small`, `Thumbnail`, `Category`, `Size`, `Author`, `Start_Date`, `Downloads`, `Situation`) VALUES
(1, 1, 'logosoldiercorp.png', 'www/lib/files/images/a69c2c8f7be63f5.png', NULL, NULL, NULL, 'images', 6157, 'admin', 1357692368, 0, 'Active'),
(2, 1, 'APPLICACIONES_MINT.txt', 'www/lib/files/documents/b594db2bd9eb881.txt', NULL, NULL, NULL, 'documents', 246, 'admin', 1358350393, 0, 'Active'),
(3, 1, 'ic_menu_answer_call.png', 'www/lib/files/images/e5f3c45c940e24b.png', NULL, NULL, NULL, 'images', 6417, 'admin', 1358350393, 0, 'Active'),
(4, 1, 'NS2_Biosphere_1680x1050_by_Th3Juic3.jpg', 'www/lib/files/images/21099f7e686bae3.jpg', NULL, NULL, NULL, 'images', 664624, 'admin', 1358350393, 0, 'Active'),
(5, 1, 'Copia de robot.jpg', 'www/lib/files/images/16c74df00858304.jpg', NULL, NULL, NULL, 'images', 41408, 'admin', 1358350393, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_mural`
--

CREATE TABLE IF NOT EXISTS `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_pages`
--

CREATE TABLE IF NOT EXISTS `muu_pages` (
  `ID_Page` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Translation` mediumint(8) NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL,
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Page`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `muu_pages`
--

INSERT INTO `muu_pages` (`ID_Page`, `ID_User`, `ID_Translation`, `Title`, `Slug`, `Content`, `Views`, `Language`, `Principal`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 0, 'Publicidad', 'publicidad', '<p>Publicidad</p>', 0, 'Spanish', 0, 1337745419, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(2, 1, 0, 'Aviso Legal', 'aviso-legal', '<p>Aviso Legal</p>', 0, 'Spanish', 0, 1337746393, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(3, 1, 0, 'Condiciones de uso', 'condiciones-de-uso', '<p>Condiciones de uso</p>', 0, 'Spanish', 0, 1337746409, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(4, 1, 0, 'Acerca de Codejobs', 'acerca-de-codejobs', '<p>Acerca de Codejobs</p>', 0, 'Spanish', 0, 1337746606, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(5, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 0, 'Spanish', 0, 1337746606, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_polls`
--

CREATE TABLE IF NOT EXISTS `muu_polls` (
  `ID_Poll` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(255) NOT NULL,
  `Type` varchar(10) DEFAULT 'Simple',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Poll`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_polls_answers`
--

CREATE TABLE IF NOT EXISTS `muu_polls_answers` (
  `ID_Answer` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL,
  `Votes` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Answer`),
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_polls_ips`
--

CREATE TABLE IF NOT EXISTS `muu_polls_ips` (
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `muu_privileges`
--

INSERT INTO `muu_privileges` (`ID_Privilege`, `Privilege`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `muu_resumes`
--

CREATE TABLE IF NOT EXISTS `muu_resumes` (
  `ID_Resume` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Elementary_School` varchar(250) NOT NULL,
  `Middle_School` varchar(250) NOT NULL,
  `High_School` varchar(250) NOT NULL,
  `Collegue_University` varchar(250) NOT NULL,
  `Master` varchar(250) NOT NULL,
  `Doctorate` varchar(250) NOT NULL,
  `Languages` varchar(250) NOT NULL,
  `Employment` text NOT NULL,
  `Skills` text NOT NULL,
  `Courses` text NOT NULL,
  `Conferences` text NOT NULL,
  `Articles` text NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Update` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Resume`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_comments_applications`
--

CREATE TABLE IF NOT EXISTS `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `muu_re_comments_applications`
--

INSERT INTO `muu_re_comments_applications` (`ID_Comment2Application`, `ID_Application`, `ID_Comment`, `ID_Record`) VALUES
(1, 3, 1, 11),
(2, 3, 2, 11),
(3, 3, 3, 11),
(4, 3, 4, 11),
(5, 3, 5, 11),
(6, 3, 6, 11),
(7, 3, 7, 11),
(8, 3, 8, 11),
(9, 3, 9, 11),
(10, 3, 10, 11),
(11, 3, 11, 11),
(12, 3, 12, 11),
(13, 3, 13, 11),
(14, 3, 14, 11),
(15, 3, 15, 11),
(16, 3, 16, 11),
(17, 3, 17, 11),
(18, 3, 18, 11),
(19, 3, 19, 11),
(20, 3, 20, 11),
(21, 3, 21, 11),
(22, 3, 22, 10),
(23, 3, 23, 10),
(24, 3, 24, 10);

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_companies_jobs`
--

CREATE TABLE IF NOT EXISTS `muu_re_companies_jobs` (
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Job` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_course_categories`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_course_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_lesson_course`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_lesson_course` (
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_tests_question_answer`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_tests_question_answer` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Answer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_permissions_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_re_permissions_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Adding` tinyint(1) NOT NULL DEFAULT '0',
  `Deleting` tinyint(1) NOT NULL DEFAULT '0',
  `Editing` tinyint(1) NOT NULL DEFAULT '0',
  `Viewing` tinyint(1) NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_Application` (`ID_Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muu_re_permissions_privileges`
--

INSERT INTO `muu_re_permissions_privileges` (`ID_Privilege`, `ID_Application`, `Adding`, `Deleting`, `Editing`, `Viewing`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(1, 10, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 14, 1, 1, 1, 1),
(1, 15, 1, 1, 1, 1),
(1, 16, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0),
(2, 3, 1, 1, 1, 1),
(2, 5, 0, 0, 0, 0),
(2, 6, 0, 0, 0, 0),
(2, 7, 0, 0, 0, 1),
(2, 8, 1, 1, 1, 1),
(2, 9, 1, 1, 1, 1),
(2, 10, 1, 1, 1, 1),
(2, 11, 1, 0, 1, 1),
(2, 12, 1, 1, 1, 1),
(2, 13, 1, 0, 0, 0),
(2, 14, 1, 1, 1, 1),
(2, 15, 1, 1, 1, 1),
(2, 16, 1, 1, 1, 1),
(3, 1, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0),
(3, 3, 1, 0, 0, 1),
(3, 5, 0, 0, 0, 0),
(3, 6, 0, 0, 0, 0),
(3, 7, 0, 0, 0, 0),
(3, 8, 1, 0, 0, 1),
(3, 9, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0),
(3, 11, 1, 0, 0, 1),
(3, 12, 0, 0, 0, 0),
(3, 13, 0, 0, 0, 0),
(3, 14, 0, 0, 0, 0),
(3, 15, 0, 0, 0, 0),
(3, 16, 1, 0, 0, 1),
(4, 1, 0, 0, 0, 0),
(4, 2, 0, 0, 0, 0),
(4, 3, 0, 0, 0, 0),
(4, 5, 0, 0, 0, 0),
(4, 6, 0, 0, 0, 0),
(4, 7, 0, 0, 0, 0),
(4, 8, 0, 0, 0, 0),
(4, 9, 0, 0, 0, 0),
(4, 10, 0, 0, 0, 0),
(4, 11, 0, 0, 0, 0),
(4, 12, 0, 0, 0, 0),
(4, 13, 0, 0, 0, 0),
(4, 14, 0, 0, 0, 0),
(4, 15, 0, 0, 0, 0),
(4, 16, 0, 0, 0, 0),
(1, 17, 1, 1, 1, 1),
(2, 17, 1, 1, 1, 1),
(3, 17, 1, 0, 0, 1),
(4, 17, 0, 0, 0, 0),
(1, 18, 1, 1, 1, 1),
(2, 18, 1, 1, 1, 1),
(3, 18, 1, 0, 0, 1),
(4, 18, 0, 0, 0, 0),
(1, 19, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_privileges_users`
--

CREATE TABLE IF NOT EXISTS `muu_re_privileges_users` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muu_re_privileges_users`
--

INSERT INTO `muu_re_privileges_users` (`ID_Privilege`, `ID_User`) VALUES
(1, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_users_companies`
--

CREATE TABLE IF NOT EXISTS `muu_re_users_companies` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_users_events`
--

CREATE TABLE IF NOT EXISTS `muu_re_users_events` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Event` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_users_followers`
--

CREATE TABLE IF NOT EXISTS `muu_re_users_followers` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User_Follower` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE muu_search (
ID_Search mediumint(8) unsigned default null auto_increment,
Term varchar(255) not null,
Counter mediumint(8) unsigned default '0' not null,
Last_Search datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (ID_Search)
) ENGINE=InnoDB;

--
-- Table structure for table `muu_support`
--

CREATE TABLE IF NOT EXISTS `muu_support` (
  `ID_Ticket` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ticket`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_tokens`
--

CREATE TABLE IF NOT EXISTS `muu_tokens` (
  `ID_Token` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Token` varchar(40) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Token`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `muu_tokens`
--

INSERT INTO `muu_tokens` (`ID_Token`, `ID_User`, `Token`, `Action`, `Start_Date`, `End_Date`, `Situation`) VALUES
(1, 1, '756d9920d7eca6a6794c2c1e703ec7c84739e986', 'Recover', 1337732698, 1337819098, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `muu_tutorials`
--

CREATE TABLE IF NOT EXISTS `muu_tutorials` (
  `ID_Tutorial` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Tutorial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_users`
--

CREATE TABLE IF NOT EXISTS `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Privilege` mediumint(8) NOT NULL DEFAULT '4',
  `Username` varchar(30) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Avatar` varchar(200) NOT NULL DEFAULT 'default.png',
  `Avatar_Coordinate` varchar(20) NOT NULL DEFAULT '0,0,90,90',
  `Credits` mediumint(8) NOT NULL DEFAULT '0',
  `Recommendation` mediumint(8) NOT NULL DEFAULT '50',
  `Sign` text NOT NULL,
  `Messages` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Recieve_Messages` tinyint(1) NOT NULL DEFAULT '1',
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Posts` mediumint(8) NOT NULL DEFAULT '0',
  `Bookmarks` mediumint(8) NOT NULL DEFAULT '0',
  `Codes` mediumint(8) NOT NULL DEFAULT '0',
  `Jobs` mediumint(8) NOT NULL DEFAULT '0',
  `Followers` mediumint(8) NOT NULL DEFAULT '0',
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Description` varchar(150) NOT NULL DEFAULT '',
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
  `Google` varchar(150) NOT NULL,
  `Viadeo` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `muu_users`
--

INSERT INTO `muu_users` (`ID_User`, `ID_Privilege`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Avatar_Coordinate`, `Credits`, `Recommendation`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Comments`, `Posts`, `Bookmarks`, `Codes`, `Jobs`, `Followers`, `Subscribed`, `Start_Date`, `Code`, `Name`, `Description`, `Age`, `Title`, `Address`, `Zip`, `Phone`, `Mobile`, `Gender`, `Relationship`, `Birthday`, `Country`, `District`, `City`, `Technologies`, `Twitter`, `Facebook`, `Linkedin`, `Google`, `Viadeo`, `Situation`) VALUES
(1, 1, 'admin', 'b9223847e1566884893656e84798ff39cea2b8c4', 'carlos@milkzoft.com', '', 'default.png', '0,0,90,90', 95, 75, '', 0, 1, 0, 0, 0, 15, 0, 0, 0, 0, 1, 1337647712, 'BC958D3C97', 'Carlos Santana Roldán', '', 18, '', '', '', '', '0', 'M', 'Single', '', '', '', '', '', '', '', '', '', '', 'Active'),
(2, 4, 'tester', 'e53e0171e0fa33c534981aab0be760bfed2959f1', 'tester@milkzoft.com', '', 'default.png', '0,0,90,90', 0, 50, '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1347453332, 'C3F4E6E123', '', '', 18, '', '', '', '', '', 'M', 'Single', '', '', '', '', '', '', '', '', '', '', 'Active'),
(3, 1, 'Soldier', '2b4f2eda0f53ea99ad419d155803f8ea15bc25aa', 'soldiercrp@gmail.com', '', 'default.png', '0,0,90,90', 0, 50, '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1358076919, 'BA7C114E6E', '', '', 18, '', '', '', '', '', 'M', 'Single', '', '', '', '', '', '', '', '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_users_online`
--

CREATE TABLE IF NOT EXISTS `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muu_users_online`
--

INSERT INTO `muu_users_online` (`User`, `Start_Date`) VALUES
('admin', 1358365923);

-- --------------------------------------------------------

--
-- Table structure for table `muu_users_online_anonymous`
--

CREATE TABLE IF NOT EXISTS `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_videos`
--

CREATE TABLE IF NOT EXISTS `muu_videos` (
  `ID_Video` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_YouTube` varchar(20) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Server` varchar(25) NOT NULL DEFAULT 'YouTube',
  `Duration` varchar(10) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Video`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `muu_videos`
--

INSERT INTO `muu_videos` (`ID_Video`, `ID_User`, `ID_YouTube`, `Title`, `Slug`, `Description`, `URL`, `Server`, `Duration`, `Views`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 'jhP6vVc7Yts', 'Taller de CodeIgniter por www.codejobs.biz', 'taller-de-codeigniter-por-www-codejobs-biz', 'Taller de CodeIgniter por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(2, 1, 'JtUCr-m8BSo', 'Introducción al Responsive Design por www.codejobs.biz', 'introduccion-al-responsive-design-por-www-codejobs-biz', 'Introducción al Responsive Design por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(3, 1, 'SXHsN5GhdA0', 'Proyecto CANDI 3: Cómo crear un correo electro?nico en GMail', 'proyecto-candi-3-como-crear-un-correo-electro-nico-en-gmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en GMail', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(4, 1, 't1BrjyAf3XE', 'Proyecto CANDI 2: Cómo crear una cuenta de correo electro?nico en Hotmail', 'proyecto-candi-2-como-crear-una-cuenta-de-correo-electro-nico-en-hotmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en Hotmail', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(5, 1, 'djg8B0TPh60', 'Proyecto CANDI 1: Instalacioón de Ubuntu 12.04 [www.codejobs.biz]', 'proyecto-candi-1-instalacion-de-ubuntu-12-04-www-codejobs-biz', 'Explicación sencilla de cómo instalar Ubuntu 12.04 en tu computadora.', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(6, 1, 'JhHz0vyngN4', 'Presentación del Proyecto CANDI', 'presentacion-del-proyecto-candi', 'Presentación del Proyecto CANDI', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(7, 1, 'XBYw9eWNd7c', 'Taller de Introducción a ZanPHP por www.codejobs.biz', 'taller-de-introduccion-a-zanphp-por-www-codejobs-biz', 'Taller de Introduccio?n a ZanPHP por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(8, 1, '-Wb0XcYjIxU', 'Introducción a las Bases de Datos NoSQL', 'introducci-n-a-las-bases-de-datos-nosql', '', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(9, 1, 'nN9NQRSG7iU', 'Taller de Github por www.codejobs.biz', 'taller-de-github-por-www-codejobs-biz', 'Taller de Github por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_works`
--

CREATE TABLE IF NOT EXISTS `muu_works` (
  `ID_Work` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Preview1` varchar(200) NOT NULL,
  `Preview2` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Work`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_workshop`
--

CREATE TABLE IF NOT EXISTS `muu_workshop` (
  `ID_Workshop` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Topics` text NOT NULL,
  `Description` text NOT NULL,
  `File` varchar(250) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Skype` varchar(30) DEFAULT NULL,
  `Gtalk` varchar(30) DEFAULT NULL,
  `Facebook` varchar(30) DEFAULT NULL,
  `Twitter` varchar(30) DEFAULT NULL,
  `Proposal_Day` varchar(60) NOT NULL,
  `Proposal_Time` varchar(10) NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Situation` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Workshop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_world`
--

CREATE TABLE IF NOT EXISTS `muu_world` (
  `Continent` varchar(20) NOT NULL,
  `Code` varchar(5) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  KEY `District` (`District`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muu_world`
--

INSERT INTO `muu_world` (`Continent`, `Code`, `Country`, `District`, `Town`) VALUES
('America', 'ARG', 'Argentina', 'Buenos Aires', ''),
('America', 'ARG', 'Argentina', 'Catamarca', ''),
('America', 'ARG', 'Argentina', 'Chaco', ''),
('America', 'ARG', 'Argentina', 'Chubut', ''),
('America', 'ARG', 'Argentina', 'Córdoba', ''),
('America', 'ARG', 'Argentina', 'Corrientes', ''),
('America', 'ARG', 'Argentina', 'Distrito Federal', ''),
('America', 'ARG', 'Argentina', 'Entre Rios', ''),
('America', 'ARG', 'Argentina', 'Formosa', ''),
('America', 'ARG', 'Argentina', 'Jujuy', ''),
('America', 'ARG', 'Argentina', 'La Rioja', ''),
('America', 'ARG', 'Argentina', 'Mendoza', ''),
('America', 'ARG', 'Argentina', 'Misiones', ''),
('America', 'ARG', 'Argentina', 'Neuquén', ''),
('America', 'ARG', 'Argentina', 'Salta', ''),
('America', 'ARG', 'Argentina', 'San Juan', ''),
('America', 'ARG', 'Argentina', 'San Luis', ''),
('America', 'ARG', 'Argentina', 'Santa Fé', ''),
('America', 'ARG', 'Argentina', 'Santiago del Estero', ''),
('America', 'ARG', 'Argentina', 'Tucumán', ''),
('America', 'BLZ', 'Belize', 'Belize City', ''),
('America', 'BLZ', 'Belize', 'Cayo', ''),
('America', 'BOL', 'Bolivia', 'Chuquisaca', ''),
('America', 'BOL', 'Bolivia', 'Cochabamba', ''),
('America', 'BOL', 'Bolivia', 'La Paz', ''),
('America', 'BOL', 'Bolivia', 'Oruro', ''),
('America', 'BOL', 'Bolivia', 'Potosí', ''),
('America', 'BOL', 'Bolivia', 'Santa Cruz', ''),
('America', 'BOL', 'Bolivia', 'Tarija', ''),
('America', 'BRA', 'Brazil', 'Acre', ''),
('America', 'BRA', 'Brazil', 'Alagoas', ''),
('America', 'BRA', 'Brazil', 'Amapá', ''),
('America', 'BRA', 'Brazil', 'Amazonas', ''),
('America', 'BRA', 'Brazil', 'Bahia', ''),
('America', 'BRA', 'Brazil', 'Ceará', ''),
('America', 'BRA', 'Brazil', 'Distrito Federal', ''),
('America', 'BRA', 'Brazil', 'Espírito Santo', ''),
('America', 'BRA', 'Brazil', 'Goiás', ''),
('America', 'BRA', 'Brazil', 'Maranhão', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso do Sul', ''),
('America', 'BRA', 'Brazil', 'Minas Gerais', ''),
('America', 'BRA', 'Brazil', 'Pará', ''),
('America', 'BRA', 'Brazil', 'Paraíba', ''),
('America', 'BRA', 'Brazil', 'Paraná', ''),
('America', 'BRA', 'Brazil', 'Pernambuco', ''),
('America', 'BRA', 'Brazil', 'Piauí', ''),
('America', 'BRA', 'Brazil', 'Rio de Janeiro', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Norte', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Sul', ''),
('America', 'BRA', 'Brazil', 'Rondônia', ''),
('America', 'BRA', 'Brazil', 'Roraima', ''),
('America', 'BRA', 'Brazil', 'Santa Catarina', ''),
('America', 'BRA', 'Brazil', 'São Paulo', ''),
('America', 'BRA', 'Brazil', 'Sergipe', ''),
('America', 'BRA', 'Brazil', 'Tocantins', ''),
('America', 'CAN', 'Canada', 'Alberta', ''),
('America', 'CAN', 'Canada', 'British Colombia', ''),
('America', 'CAN', 'Canada', 'Manitoba', ''),
('America', 'CAN', 'Canada', 'Newfoundland', ''),
('America', 'CAN', 'Canada', 'Nova Scotia', ''),
('America', 'CAN', 'Canada', 'Ontario', ''),
('America', 'CAN', 'Canada', 'Québec', ''),
('America', 'CAN', 'Canada', 'Saskatchewan', ''),
('America', 'CHL', 'Chile', 'Antofagasta', ''),
('America', 'CHL', 'Chile', 'Atacama', ''),
('America', 'CHL', 'Chile', 'Bíobío', ''),
('America', 'CHL', 'Chile', 'Coquimbo', ''),
('America', 'CHL', 'Chile', 'La Araucanía', ''),
('America', 'CHL', 'Chile', 'Los Lagos', ''),
('America', 'CHL', 'Chile', 'Magallanes', ''),
('America', 'CHL', 'Chile', 'Maule', ''),
('America', 'CHL', 'Chile', 'Santiago', ''),
('America', 'CHL', 'Chile', 'Tarapacá', ''),
('America', 'CHL', 'Chile', 'Valparaíso', ''),
('America', 'COL', 'Colombia', 'Antioquia', ''),
('America', 'COL', 'Colombia', 'Atlántico', ''),
('America', 'COL', 'Colombia', 'Bolívar', ''),
('America', 'COL', 'Colombia', 'Boyacá', ''),
('America', 'COL', 'Colombia', 'Caldas', ''),
('America', 'COL', 'Colombia', 'Caquetá', ''),
('America', 'COL', 'Colombia', 'Cauca', ''),
('America', 'COL', 'Colombia', 'Cesar', ''),
('America', 'COL', 'Colombia', 'Córdoba', ''),
('America', 'COL', 'Colombia', 'Cundinamarca', ''),
('America', 'COL', 'Colombia', 'Huila', ''),
('America', 'COL', 'Colombia', 'La Guajira', ''),
('America', 'COL', 'Colombia', 'Magdalena', ''),
('America', 'COL', 'Colombia', 'Meta', ''),
('America', 'COL', 'Colombia', 'Norte de Santander', ''),
('America', 'COL', 'Colombia', 'Quindío', ''),
('America', 'COL', 'Colombia', 'Risaralda', ''),
('America', 'COL', 'Colombia', 'Santafé de Bogotá', ''),
('America', 'COL', 'Colombia', 'Santander', ''),
('America', 'COL', 'Colombia', 'Sucre', ''),
('America', 'COL', 'Colombia', 'Tolima', ''),
('America', 'COL', 'Colombia', 'Valle', ''),
('America', 'CRI', 'Costa Rica', 'San Jos', ''),
('America', 'CUB', 'Cuba', 'Ciego de Ávila', ''),
('America', 'CUB', 'Cuba', 'Cienfuegos', ''),
('America', 'CUB', 'Cuba', 'Granma', ''),
('America', 'CUB', 'Cuba', 'Guantánamo', ''),
('America', 'CUB', 'Cuba', 'Holguín', ''),
('America', 'CUB', 'Cuba', 'La Habana', ''),
('America', 'CUB', 'Cuba', 'Las Tunas', ''),
('America', 'CUB', 'Cuba', 'Matanzas', ''),
('America', 'CUB', 'Cuba', 'Pinar del Río', ''),
('America', 'CUB', 'Cuba', 'Santiago de Cuba', ''),
('America', 'CUB', 'Cuba', 'Villa Clara', ''),
('America', 'CYM', 'Cayman Islands', 'Grand Cayman', ''),
('America', 'DMA', 'Dominica', 'St George', ''),
('America', 'DOM', 'Dominican Republic', 'Distrito Nacional', ''),
('America', 'DOM', 'Dominican Republic', 'Duarte', ''),
('America', 'DOM', 'Dominican Republic', 'La Romana', ''),
('America', 'DOM', 'Dominican Republic', 'Puerto Plata', ''),
('America', 'DOM', 'Dominican Republic', 'San Pedro de Macorís', ''),
('America', 'DOM', 'Dominican Republic', 'Santiago', ''),
('America', 'ECU', 'Ecuador', 'Azuay', ''),
('America', 'ECU', 'Ecuador', 'Chimborazo', ''),
('America', 'ECU', 'Ecuador', 'El Oro', ''),
('America', 'ECU', 'Ecuador', 'Esmeraldas', ''),
('America', 'ECU', 'Ecuador', 'Guayas', ''),
('America', 'ECU', 'Ecuador', 'Imbabura', ''),
('America', 'ECU', 'Ecuador', 'Loja', ''),
('America', 'ECU', 'Ecuador', 'Los Río', ''),
('America', 'ECU', 'Ecuador', 'Manabí', ''),
('America', 'ECU', 'Ecuador', 'Pichincha', ''),
('America', 'ECU', 'Ecuador', 'Tungurahua', ''),
('America', 'SLV', 'El Salvador', 'La Libertad', ''),
('America', 'SLV', 'El Salvador', 'San Miguel', ''),
('America', 'SLV', 'El Salvador', 'San Salvador', ''),
('America', 'SLV', 'El Salvador', 'Santa Ana', ''),
('America', 'GTM', 'Guatemala', 'Guatemala', ''),
('America', 'GTM', 'Guatemala', 'Quetzaltenango', ''),
('America', 'HND', 'Honduras', 'Atlántida', ''),
('America', 'HND', 'Honduras', 'Cortés', ''),
('America', 'HND', 'Honduras', 'Distrito Central', ''),
('America', 'MEX', 'Mexico', 'Aguascalientes', ''),
('America', 'MEX', 'Mexico', 'Baja California', ''),
('America', 'MEX', 'Mexico', 'Baja California Sur', ''),
('America', 'MEX', 'Mexico', 'Campeche', ''),
('America', 'MEX', 'Mexico', 'Chiapas', ''),
('America', 'MEX', 'Mexico', 'Chihuahua', ''),
('America', 'MEX', 'Mexico', 'Coahuila de Zaragoza', ''),
('America', 'MEX', 'Mexico', 'Colima', ''),
('America', 'MEX', 'Mexico', 'Distrito Federal', ''),
('America', 'MEX', 'Mexico', 'Durango', ''),
('America', 'MEX', 'Mexico', 'Guanajuato', ''),
('America', 'MEX', 'Mexico', 'Guerrero', ''),
('America', 'MEX', 'Mexico', 'Hidalgo', ''),
('America', 'MEX', 'Mexico', 'Jalisco', ''),
('America', 'MEX', 'Mexico', 'México', ''),
('America', 'MEX', 'Mexico', 'Michoacán de Ocampo', ''),
('America', 'MEX', 'Mexico', 'Morelos', ''),
('America', 'MEX', 'Mexico', 'Nayarit', ''),
('America', 'MEX', 'Mexico', 'Nuevo León', ''),
('America', 'MEX', 'Mexico', 'Oaxaca', ''),
('America', 'MEX', 'Mexico', 'Puebla', ''),
('America', 'MEX', 'Mexico', 'Querétaro', ''),
('America', 'MEX', 'Mexico', 'Querétaro de Arteaga', ''),
('America', 'MEX', 'Mexico', 'Quintana Roo', ''),
('America', 'MEX', 'Mexico', 'San Luis Potosí', ''),
('America', 'MEX', 'Mexico', 'Sinaloa', ''),
('America', 'MEX', 'Mexico', 'Sonora', ''),
('America', 'MEX', 'Mexico', 'Tabasco', ''),
('America', 'MEX', 'Mexico', 'Tamaulipas', ''),
('America', 'MEX', 'Mexico', 'Veracruz', ''),
('America', 'MEX', 'Mexico', 'Yucatán', ''),
('America', 'MEX', 'Mexico', 'Zacatecas', ''),
('America', 'NIC', 'Nicaragua', 'Chinandega', ''),
('America', 'NIC', 'Nicaragua', 'León', ''),
('America', 'NIC', 'Nicaragua', 'Managua', ''),
('America', 'NIC', 'Nicaragua', 'Masaya', ''),
('America', 'PAN', 'Panama', 'Panamá', ''),
('America', 'PAN', 'Panama', 'San Miguelito', ''),
('America', 'PER', 'Peru', 'Ancash', ''),
('America', 'PER', 'Peru', 'Arequipa', ''),
('America', 'PER', 'Peru', 'Ayacucho', ''),
('America', 'PER', 'Peru', 'Cajamarca', ''),
('America', 'PER', 'Peru', 'Callao', ''),
('America', 'PER', 'Peru', 'Cusco', ''),
('America', 'PER', 'Peru', 'Huánuco', ''),
('America', 'PER', 'Peru', 'Ica', ''),
('America', 'PER', 'Peru', 'Junín', ''),
('America', 'PER', 'Peru', 'La Libertad', ''),
('America', 'PER', 'Peru', 'Lambayeque', ''),
('America', 'PER', 'Peru', 'Lima', ''),
('America', 'PER', 'Peru', 'Loreto', ''),
('America', 'PER', 'Peru', 'Piura', ''),
('America', 'PER', 'Peru', 'Puno', ''),
('America', 'PER', 'Peru', 'Tacna', ''),
('America', 'PER', 'Peru', 'Ucayali', ''),
('America', 'PRI', 'Puerto Rico', 'Arecibo', ''),
('America', 'PRI', 'Puerto Rico', 'Bayamón', ''),
('America', 'PRI', 'Puerto Rico', 'Caguas', ''),
('America', 'PRI', 'Puerto Rico', 'Carolina', ''),
('America', 'PRI', 'Puerto Rico', 'Guaynabo', ''),
('America', 'PRI', 'Puerto Rico', 'Ponce', ''),
('America', 'PRI', 'Puerto Rico', 'San Juan', ''),
('America', 'PRI', 'Puerto Rico', 'Toa Baja', ''),
('America', 'PRY', 'Paraguay', 'Alto Paraná', ''),
('America', 'PRY', 'Paraguay', 'Asunción', ''),
('America', 'PRY', 'Paraguay', 'Central', ''),
('America', 'URY', 'Uruguay', 'Montevideo', ''),
('America', 'USA', 'United States', 'Alabama', ''),
('America', 'USA', 'United States', 'Alaska', ''),
('America', 'USA', 'United States', 'Arizona', ''),
('America', 'USA', 'United States', 'Arkansas', ''),
('America', 'USA', 'United States', 'California', ''),
('America', 'USA', 'United States', 'Colorado', ''),
('America', 'USA', 'United States', 'Connecticut', ''),
('America', 'USA', 'United States', 'District of Columbia', ''),
('America', 'USA', 'United States', 'Florida', ''),
('America', 'USA', 'United States', 'Georgia', ''),
('America', 'USA', 'United States', 'Hawaii', ''),
('America', 'USA', 'United States', 'Idaho', ''),
('America', 'USA', 'United States', 'Illinois', ''),
('America', 'USA', 'United States', 'Indiana', ''),
('America', 'USA', 'United States', 'Iowa', ''),
('America', 'USA', 'United States', 'Kansas', ''),
('America', 'USA', 'United States', 'Kentucky', ''),
('America', 'USA', 'United States', 'Louisiana', ''),
('America', 'USA', 'United States', 'Maryland', ''),
('America', 'USA', 'United States', 'Massachusetts', ''),
('America', 'USA', 'United States', 'Michigan', ''),
('America', 'USA', 'United States', 'Minnesota', ''),
('America', 'USA', 'United States', 'Mississippi', ''),
('America', 'USA', 'United States', 'Missouri', ''),
('America', 'USA', 'United States', 'Montana', ''),
('America', 'USA', 'United States', 'Nebraska', ''),
('America', 'USA', 'United States', 'Nevada', ''),
('America', 'USA', 'United States', 'New Hampshire', ''),
('America', 'USA', 'United States', 'New Jersey', ''),
('America', 'USA', 'United States', 'New Mexico', ''),
('America', 'USA', 'United States', 'New York', ''),
('America', 'USA', 'United States', 'North Carolina', ''),
('America', 'USA', 'United States', 'Ohio', ''),
('America', 'USA', 'United States', 'Oklahoma', ''),
('America', 'USA', 'United States', 'Oregon', ''),
('America', 'USA', 'United States', 'Pennsylvania', ''),
('America', 'USA', 'United States', 'Rhode Island', ''),
('America', 'USA', 'United States', 'South Carolina', ''),
('America', 'USA', 'United States', 'South Dakota', ''),
('America', 'USA', 'United States', 'Tennessee', ''),
('America', 'USA', 'United States', 'Texas', ''),
('America', 'USA', 'United States', 'Utah', ''),
('America', 'USA', 'United States', 'Virginia', ''),
('America', 'USA', 'United States', 'Washington', ''),
('America', 'USA', 'United States', 'Wisconsin', ''),
('America', 'VEN', 'Venezuela', 'Anzoátegui', ''),
('America', 'VEN', 'Venezuela', 'Apure', ''),
('America', 'VEN', 'Venezuela', 'Aragua', ''),
('America', 'VEN', 'Venezuela', 'Barinas', ''),
('America', 'VEN', 'Venezuela', 'Bolívar', ''),
('America', 'VEN', 'Venezuela', 'Carabobo', ''),
('America', 'VEN', 'Venezuela', 'Distrito Federal', ''),
('America', 'VEN', 'Venezuela', 'Falcón', ''),
('America', 'VEN', 'Venezuela', 'Guárico', ''),
('America', 'VEN', 'Venezuela', 'Lara', ''),
('America', 'VEN', 'Venezuela', 'Mérida', ''),
('America', 'VEN', 'Venezuela', 'Miranda', ''),
('America', 'VEN', 'Venezuela', 'Monagas', ''),
('America', 'VEN', 'Venezuela', 'Portuguesa', ''),
('America', 'VEN', 'Venezuela', 'Sucre', ''),
('America', 'VEN', 'Venezuela', 'Táchira', ''),
('America', 'VEN', 'Venezuela', 'Trujillo', ''),
('America', 'VEN', 'Venezuela', 'Yaracuy', ''),
('America', 'VEN', 'Venezuela', 'Zulia', ''),
('Europe', 'BEL', 'Belgium', 'Antwerpen', ''),
('Europe', 'BEL', 'Belgium', 'Bryssel', ''),
('Europe', 'BEL', 'Belgium', 'East Flanderi', ''),
('Europe', 'BEL', 'Belgium', 'Hainaut', ''),
('Europe', 'BEL', 'Belgium', 'Namur', ''),
('Europe', 'BEL', 'Belgium', 'West Flanderi', ''),
('Europe', 'FRA', 'France', 'Alsace', ''),
('Europe', 'FRA', 'France', 'Aquitaine', ''),
('Europe', 'FRA', 'France', 'Auvergne', ''),
('Europe', 'FRA', 'France', 'Basse-Normandie', ''),
('Europe', 'FRA', 'France', 'Bourgogne', ''),
('Europe', 'FRA', 'France', 'Bretagne', ''),
('Europe', 'FRA', 'France', 'Centre', ''),
('Europe', 'FRA', 'France', 'Limousin', ''),
('Europe', 'FRA', 'France', 'Lorraine', ''),
('Europe', 'FRA', 'France', 'Pays de la Loire', ''),
('Europe', 'FRA', 'France', 'Picardie', ''),
('Europe', 'FRA', 'France', 'Rhône-Alpes', ''),
('Europe', 'DEU', 'Germany', 'Anhalt Sachsen', ''),
('Europe', 'DEU', 'Germany', 'Baijeri', ''),
('Europe', 'DEU', 'Germany', 'Berliini', ''),
('Europe', 'DEU', 'Germany', 'Brandenburg', ''),
('Europe', 'DEU', 'Germany', 'Bremen', ''),
('Europe', 'DEU', 'Germany', 'Hamburg', ''),
('Europe', 'DEU', 'Germany', 'Hessen', ''),
('Europe', 'DEU', 'Germany', 'Mecklenburg-Vorpomme', ''),
('Europe', 'DEU', 'Germany', 'Niedersachsen', ''),
('Europe', 'DEU', 'Germany', 'Nordrhein-Westfalen', ''),
('Europe', 'DEU', 'Germany', 'Rheinland-Pfalz', ''),
('Europe', 'DEU', 'Germany', 'Saarland', ''),
('Europe', 'DEU', 'Germany', 'Saksi', ''),
('Europe', 'DEU', 'Germany', 'Schleswig-Holstein', ''),
('Europe', 'ITA', 'Italy', 'Abruzzit', ''),
('Europe', 'ITA', 'Italy', 'Apulia', ''),
('Europe', 'ITA', 'Italy', 'Calabria', ''),
('Europe', 'ITA', 'Italy', 'Campania', ''),
('Europe', 'ITA', 'Italy', 'Emilia-Romagna', ''),
('Europe', 'ITA', 'Italy', 'Friuli-Venezia Giuli', ''),
('Europe', 'ITA', 'Italy', 'Latium', ''),
('Europe', 'ITA', 'Italy', 'Liguria', ''),
('Europe', 'ITA', 'Italy', 'Lombardia', ''),
('Europe', 'ITA', 'Italy', 'Marche', ''),
('Europe', 'ITA', 'Italy', 'Piemonte', ''),
('Europe', 'ITA', 'Italy', 'Sardinia', ''),
('Europe', 'ITA', 'Italy', 'Sisilia', ''),
('Europe', 'ITA', 'Italy', 'Toscana', ''),
('Europe', 'ITA', 'Italy', 'Umbria', ''),
('Europe', 'ITA', 'Italy', 'Veneto', ''),
('Europe', 'PRT', 'Portugal', 'Braga', ''),
('Europe', 'PRT', 'Portugal', 'Coímbra', ''),
('Europe', 'PRT', 'Portugal', 'Lisboa', ''),
('Europe', 'PRT', 'Portugal', 'Porto', ''),
('Europe', 'ESP', 'Spain', 'Andalusia', ''),
('Europe', 'ESP', 'Spain', 'Aragonia', ''),
('Europe', 'ESP', 'Spain', 'Asturia', ''),
('Europe', 'ESP', 'Spain', 'Balears', ''),
('Europe', 'ESP', 'Spain', 'Baskimaa', ''),
('Europe', 'ESP', 'Spain', 'Canary Islands', ''),
('Europe', 'ESP', 'Spain', 'Cantabria', ''),
('Europe', 'ESP', 'Spain', 'Castilla and León', ''),
('Europe', 'ESP', 'Spain', 'Extremadura', ''),
('Europe', 'ESP', 'Spain', 'Galicia', ''),
('Europe', 'ESP', 'Spain', 'Katalonia', ''),
('Europe', 'ESP', 'Spain', 'La Rioja', ''),
('Europe', 'ESP', 'Spain', 'Madrid', ''),
('Europe', 'ESP', 'Spain', 'Murcia', ''),
('Europe', 'ESP', 'Spain', 'Navarra', ''),
('Europe', 'ESP', 'Spain', 'Valencia', ''),
('Europe', 'CHE', 'Switzerland', 'Bern', ''),
('Europe', 'CHE', 'Switzerland', 'Geneve', ''),
('Europe', 'CHE', 'Switzerland', 'Vaud', ''),
('Europe', 'GBR', 'United Kingdom', 'England', ''),
('Europe', 'GBR', 'United Kingdom', 'Jersey', ''),
('Europe', 'GBR', 'United Kingdom', 'North Ireland', ''),
('Europe', 'GBR', 'United Kingdom', 'Scotland', ''),
('Europe', 'GBR', 'United Kingdom', 'Wales', ''),
('Oceania', 'AUS', 'Australia', 'Capital Region', ''),
('Oceania', 'AUS', 'Australia', 'New South Wales', ''),
('Oceania', 'AUS', 'Australia', 'Queensland', ''),
('Oceania', 'AUS', 'Australia', 'South Australia', ''),
('Oceania', 'AUS', 'Australia', 'Tasmania', ''),
('Oceania', 'AUS', 'Australia', 'Victoria', ''),
('Oceania', 'AUS', 'Australia', 'West Australia', ''),
('Oceania', 'NZL', 'New Zealand', 'Auckland', ''),
('Oceania', 'NZL', 'New Zealand', 'Canterbury', ''),
('Oceania', 'NZL', 'New Zealand', 'Dunedin', ''),
('Oceania', 'NZL', 'New Zealand', 'Hamilton', ''),
('Oceania', 'NZL', 'New Zealand', 'Wellington', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `muu_ads`
--
ALTER TABLE `muu_ads`
  ADD CONSTRAINT `muu_ads_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_codes_files`
--
ALTER TABLE `muu_codes_files`
  ADD CONSTRAINT `muu_codes_files_ibfk_1` FOREIGN KEY (`ID_Code`) REFERENCES `muu_codes` (`ID_Code`),
  ADD CONSTRAINT `muu_codes_files_ibfk_2` FOREIGN KEY (`ID_Syntax`) REFERENCES `muu_codes_syntax` (`ID_Syntax`);

--
-- Constraints for table `muu_forums_posts`
--
ALTER TABLE `muu_forums_posts`
  ADD CONSTRAINT `muu_forums_posts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_gallery`
--
ALTER TABLE `muu_gallery`
  ADD CONSTRAINT `muu_gallery_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_logs`
--
ALTER TABLE `muu_logs`
  ADD CONSTRAINT `muu_logs_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_pages`
--
ALTER TABLE `muu_pages`
  ADD CONSTRAINT `muu_pages_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_polls`
--
ALTER TABLE `muu_polls`
  ADD CONSTRAINT `muu_polls_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_polls_answers`
--
ALTER TABLE `muu_polls_answers`
  ADD CONSTRAINT `muu_polls_answers_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_polls_ips`
--
ALTER TABLE `muu_polls_ips`
  ADD CONSTRAINT `muu_polls_ips_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_re_permissions_privileges`
--
ALTER TABLE `muu_re_permissions_privileges`
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_2` FOREIGN KEY (`ID_Application`) REFERENCES `muu_applications` (`ID_Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_re_privileges_users`
--
ALTER TABLE `muu_re_privileges_users`
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_support`
--
ALTER TABLE `muu_support`
  ADD CONSTRAINT `muu_support_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_tokens`
--
ALTER TABLE `muu_tokens`
  ADD CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_videos`
--
ALTER TABLE `muu_videos`
  ADD CONSTRAINT `muu_videos_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
