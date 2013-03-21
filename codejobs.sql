/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : codejobs

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2013-03-21 13:39:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `muu_ads`
-- ----------------------------
DROP TABLE IF EXISTS `muu_ads`;
CREATE TABLE `muu_ads` (
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
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_ads_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_ads
-- ----------------------------
INSERT INTO `muu_ads` VALUES ('1', '1', 'Anuncio 2', 'Top', 'www/lib/files/images/ads/1084b_45a3e-banner2.png', 'http://www.google.com', '', '0', '1339030862', '1341450062', '5000', '0', 'Deleted');
INSERT INTO `muu_ads` VALUES ('2', '1', 'ddasdasdad', 'Right', 'www/lib/files/images/ads/988b3_soldiercorp-logo-new.png', 'http://soldiercorp.net', 'soldiercorp.net.net.net', '0', '1358364443', '1360783643', '5000', '1', 'Active');

-- ----------------------------
-- Table structure for `muu_applications`
-- ----------------------------
DROP TABLE IF EXISTS `muu_applications`;
CREATE TABLE `muu_applications` (
  `ID_Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Slug` varchar(45) NOT NULL,
  `CPanel` tinyint(1) NOT NULL DEFAULT '1',
  `Adding` tinyint(1) NOT NULL,
  `BeDefault` tinyint(1) NOT NULL DEFAULT '1',
  `Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Application`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_applications
-- ----------------------------
INSERT INTO `muu_applications` VALUES ('1', 'Ads', 'ads', '1', '1', '0', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('2', 'Applications', 'applications', '1', '1', '0', '0', 'Inactive');
INSERT INTO `muu_applications` VALUES ('3', 'Blog', 'blog', '1', '1', '1', '1', 'Active');
INSERT INTO `muu_applications` VALUES ('4', 'Comments', 'comments', '1', '0', '0', '1', 'Active');
INSERT INTO `muu_applications` VALUES ('5', 'Configuration', 'configuration', '1', '0', '0', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('6', 'Feedback', 'feedback', '1', '0', '0', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('7', 'Forums', 'forums', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('8', 'Gallery', 'gallery', '1', '1', '1', '1', 'Active');
INSERT INTO `muu_applications` VALUES ('9', 'Bookmarks', 'bookmarks', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('10', 'Messages', 'messages', '1', '1', '0', '0', 'Inactive');
INSERT INTO `muu_applications` VALUES ('11', 'Pages', 'pages', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('12', 'Polls', 'polls', '1', '1', '0', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('13', 'Support', 'support', '1', '1', '0', '0', 'Inactive');
INSERT INTO `muu_applications` VALUES ('14', 'Users', 'users', '1', '1', '0', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('15', 'Videos', 'videos', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('16', 'Works', 'works', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('17', 'Codes', 'codes', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('18', 'Jobs', 'jobs', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('19', 'Multimedia', 'multimedia', '1', '1', '1', '0', 'Active');
INSERT INTO `muu_applications` VALUES ('20', 'Workshop', 'workshop', '1', '0', '1', '0', 'Active');

-- ----------------------------
-- Table structure for `muu_blog`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_blog
-- ----------------------------
INSERT INTO `muu_blog` VALUES ('1', '1', 'Nuevo blog de prueba', 'nuevo-blog-de-prueba', '<p>qweadzasdsdfsdfsdfsdf</p>\r\n', 'php, pdo, mysql, conexion, base datos', 'admin', '1357692854', '1361208893', 'Martes, 08 de Enero de 2013', '2013', '01', '08', '5', '', '', '', '', '', '', '0', '0', 'Spanish', '', '0', '050F1EAD86', 'Active');
INSERT INTO `muu_blog` VALUES ('2', '1', 'probando el blog', 'probando-el-blog', '<p>probandu</p>\r\n', 'testing, php', 'admin', '1361208696', '0', 'Lunes, 18 de Febrero de 2013', '2013', '02', '18', '2', '', '', '', '', '', '', '0', '0', 'Spanish', '', '0', 'E0349ACEC8', 'Active');

-- ----------------------------
-- Table structure for `muu_bookmarks`
-- ----------------------------
DROP TABLE IF EXISTS `muu_bookmarks`;
CREATE TABLE `muu_bookmarks` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_bookmarks
-- ----------------------------
INSERT INTO `muu_bookmarks` VALUES ('1', '1', 'How to create a Debian .deb package', 'how-to-create-a-debian-deb-package', 'http://blog.serverdensity.com/2010/02/05/how-to-create-a-debian-deb-package/', 'A few weeks ago we announced that the agent for our server monitoring application, Server Density, was available as a Debian or Red Hat package, with associated repositories. Over my next few posts I will be outlining how we created our Linux-based packages and repositories, and what our steps are going to be to improve these processes in the future.', 'linux, debian, ubuntu, ror', 'codejobs', '6', '0', '0', '0', 'English', '1332738072', '0', 'Active');
INSERT INTO `muu_bookmarks` VALUES ('2', '1', 'Guardar en disco con HTML5 y Javascript: SessionStorage y LocalStorage', 'guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localstorage', 'http://www.cristalab.com/tutoriales/guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localst', 'Si hay algo que siempre se extrañó de HTML es en alguna forma de almacenar datos, que ayude al usuario a una mejor movilidad mientras navega nuestras páginas.', 'ror, html5, javascript, sessionstorage, localstorage', 'codejobs', '22', '0', '1', '0', 'Spanish', '1332738072', '0', 'Active');
INSERT INTO `muu_bookmarks` VALUES ('3', '1', 'Migrating Rails&RJS From Prototype To JQuery', 'migrating-rails-rjs-from-prototype-to-jquery', 'http://dzone.com/snippets/migrating-railsrjs-prototype', 'I was changing prototype to jsquery in my Rails app. To make my AJAX+RJS stuff work I tried jrails gem. For some reason AJAX responses were rendedered to whole page, instead of evaluating the returned JS. So i did the hack. I took this piece of jrails and put it in my /lib folder.', 'rails, ror, rjs, jquery', 'codejobs', '17', '0', '0', '0', 'English', '1337738320', '0', 'Active');
INSERT INTO `muu_bookmarks` VALUES ('4', '1', 'Capistrano: Deploy Rails Twice To The Same Machine', 'capistrano-deploy-rails-twice-to-the-same-machine', 'http://dzone.com/snippets/capistrano-deploy-rails-twice', 'Capistrano is oriented so it deploys to the same directory on several machines. This means you can\'t deploy to two different locations on the same machine. The following recipe in Capfile will allow you to duplicate your main rails app in a second directory. You can schedule it to run automatically with every deploy or just do it manually. I included database migrations by default. Remove the shared config line if you don\'t have it.', 'capistrano, ror, rails', 'codejobs', '41', '1', '0', '0', 'English', '1337738320', '0', 'Active');

-- ----------------------------
-- Table structure for `muu_codes`
-- ----------------------------
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
  `Modified_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Dislikes` mediumint(8) NOT NULL DEFAULT '0',
  `Reported` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_codes
-- ----------------------------
INSERT INTO `muu_codes` VALUES ('1', '1', 'Mi primera página web', 'Forma de incrustar un archivo CSS.', 'mi-primera-pagina-web', 'CSS, HTML', 'admin', '1343549198', '0', 'Sunday, 29 de July de 2012', '2', '1', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('2', '1', 'Mostrar información en PHP', null, 'mostrar-informacion-en-php', 'PHP', 'admin', '1342473272', '0', 'Monday, 16 de Julio de 2012', '2', '0', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('3', '1', 'My first webpage', null, 'my-first-webpage', 'CSS, HTML', 'admin', '1343549249', '0', 'Sunday, 29 de July de 2012', '3', '0', '0', '0', 'English', 'Active');
INSERT INTO `muu_codes` VALUES ('6', '1', 'coffeescript', 'coffeescript compiled', 'coffeescript', 'HTML, Javascript', 'admin', '1363746085', '0', 'Martes, 19 de Marzo de 2013', '0', '0', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('7', '1', 'prueba de nuevo', 'descripción nueva', 'prueba-de-nuevo', 'PHP', 'admin', '1363747785', '0', 'Martes, 19 de Marzo de 2013', '0', '0', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('8', '1', 'otro codigo', 'descripcion otro codigo', 'otro-codigo', 'Text plain', 'admin', '1363747874', '0', 'Martes, 19 de Marzo de 2013', '0', '0', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('9', '1', 'nuevamente otr codigo', 'mas codigos', 'nuevamente-otr-codigo', 'Text plain', 'admin', '1363747926', '1363755679', 'Martes, 19 de Marzo de 2013', '0', '0', '0', '0', 'Spanish', 'Active');
INSERT INTO `muu_codes` VALUES ('10', '1', 'prueba numero 20', 'codigo 20', 'prueba-numero-20', 'Text plain', 'admin', '1363748037', '0', 'Martes, 19 de Marzo de 2013', '0', '0', '0', '0', 'Spanish', 'Active');

-- ----------------------------
-- Table structure for `muu_codes_files`
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_codes_files
-- ----------------------------
INSERT INTO `muu_codes_files` VALUES ('1', '1', 'pagina.html', '6', '<!DOCTYPE html>\r\n<html lang=\"es\">\r\n<head>\r\n  <meta charset=\"utf-8\" />\r\n  <title>Título de la página</title>\r\n  <link href=\"estilo.css\" />\r\n</head>\r\n<body>\r\n  Esta es mi primera página web.\r\n</body>\r\n</html>');
INSERT INTO `muu_codes_files` VALUES ('2', '1', 'estilo.css', '7', '/* Estilo del cuerpo */\r\n\r\nbody {\r\n  background-color: lightyellow;\r\n  margin: 10px;\r\n}');
INSERT INTO `muu_codes_files` VALUES ('3', '2', 'info.php', '4', '<?php\r\n // La siguiente línea muestra información\r\n phpinfo();\r\n?>');
INSERT INTO `muu_codes_files` VALUES ('4', '3', 'page.html', '6', '<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n  <meta charset=\"utf-8\" />\r\n  <title>Title\'s webpage</title>\r\n  <link href=\"estilo.css\" />\r\n</head>\r\n<body>\r\n  This is my first webpage.\r\n</body>\r\n</html>');
INSERT INTO `muu_codes_files` VALUES ('5', '3', 'style.css', '7', '/* Body\'s style */\r\n\r\nbody {\r\n  background-color: lightyellow;\r\n  margin: 10px;\r\n}');
INSERT INTO `muu_codes_files` VALUES ('6', '6', 'coffee.coffee.js', '5', '// Generated by CoffeeScript 1.6.2\r\n(function() {\r\n  var mifuncion, variable;\r\n\r\n  variable = true;\r\n\r\n  mifuncion = function() {\r\n    return mivariable;\r\n  };\r\n\r\n}).call(this);\r\n');
INSERT INTO `muu_codes_files` VALUES ('7', '6', 'index.html', '6', '<html>\r\n  <body>\r\n    <header>\r\n      soldier\r\n    </header>\r\n  </body>\r\n</html>');
INSERT INTO `muu_codes_files` VALUES ('8', '7', 'soldier.php', '4', '<?php\r\n	echo \\\'soldier.php\\\';\r\n?>');
INSERT INTO `muu_codes_files` VALUES ('9', '8', 'archivo', '1', 'archivo sin extension');
INSERT INTO `muu_codes_files` VALUES ('10', '9', 'textoplano', '1', 'hi, edited post!');
INSERT INTO `muu_codes_files` VALUES ('11', '10', 'plano text', '1', 'planotext.phpgpfpf');

-- ----------------------------
-- Table structure for `muu_codes_syntax`
-- ----------------------------
DROP TABLE IF EXISTS `muu_codes_syntax`;
CREATE TABLE `muu_codes_syntax` (
  `ID_Syntax` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `MIME` varchar(50) NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `Extension` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Syntax`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_codes_syntax
-- ----------------------------
INSERT INTO `muu_codes_syntax` VALUES ('1', 'Text plain', 'text/plain', '', '');
INSERT INTO `muu_codes_syntax` VALUES ('2', 'JSON', 'application/json', 'javascript', 'json');
INSERT INTO `muu_codes_syntax` VALUES ('3', 'C++', 'text/x-c++src', 'clike', 'cpp');
INSERT INTO `muu_codes_syntax` VALUES ('4', 'PHP', 'application/x-httpd-php', 'php', 'php');
INSERT INTO `muu_codes_syntax` VALUES ('5', 'Javascript', 'text/javascript', 'javascript', 'js');
INSERT INTO `muu_codes_syntax` VALUES ('6', 'HTML', 'text/html', 'htmlmixed', 'html');
INSERT INTO `muu_codes_syntax` VALUES ('7', 'CSS', 'text/css', 'css', 'css');

-- ----------------------------
-- Table structure for `muu_comments`
-- ----------------------------
DROP TABLE IF EXISTS `muu_comments`;
CREATE TABLE `muu_comments` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_comments
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_configuration`
-- ----------------------------
DROP TABLE IF EXISTS `muu_configuration`;
CREATE TABLE `muu_configuration` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_configuration
-- ----------------------------
INSERT INTO `muu_configuration` VALUES ('1', 'Codejobs', 'Knowledge makes us free!', 'El conocimiento nos hace libres!', 'Connaissance nous rend libres!', 'Conhecimento nos torna livres!', 'La conoscenza ci rende liberi!', 'http://localhost/codejobs', 'es', 'Spanish', 'newcodejobs', 'Active', 'blog', 'MarkitUp', '<iframe width=\"850\" height=\"420\" src=\"http://www.youtube.com/embed/aLlcRw9vEjM\" frameborder=\"0\" allowfullscreen></iframe>', '1', 'El Sitio Web esta en mantenimiento', 'User', 'azapedia@gmail.com', 'carlos@codejobs.biz', 'Active');

-- ----------------------------
-- Table structure for `muu_courses_categories`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_categories`;
CREATE TABLE `muu_courses_categories` (
  `ID_Category` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Courses` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(10) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_enrollments`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_enrollments`;
CREATE TABLE `muu_courses_enrollments` (
  `ID_Enrollment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Enrollment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_enrollments
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_help`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_help`;
CREATE TABLE `muu_courses_help` (
  `ID_Help` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Topic` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Help`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_help
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_lessons`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_lessons`;
CREATE TABLE `muu_courses_lessons` (
  `ID_Lesson` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Lesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_lessons
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_material`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_material`;
CREATE TABLE `muu_courses_material` (
  `ID_Material` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_material
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_resources`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_resources`;
CREATE TABLE `muu_courses_resources` (
  `ID_Resource` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `URL` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_resources
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_roles`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_roles`;
CREATE TABLE `muu_courses_roles` (
  `ID_Role` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Role` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_roles
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_students`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_students`;
CREATE TABLE `muu_courses_students` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_students
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_students_archive`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_students_archive`;
CREATE TABLE `muu_courses_students_archive` (
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_students_archive
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tests`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tests`;
CREATE TABLE `muu_courses_tests` (
  `ID_Test` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Score` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tests
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tests_answers`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tests_answers`;
CREATE TABLE `muu_courses_tests_answers` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tests_answers
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tests_questions`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tests_questions`;
CREATE TABLE `muu_courses_tests_questions` (
  `ID_Question` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Question` varchar(255) NOT NULL,
  `Value` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Audio` varchar(150) NOT NULL,
  `Image` varchar(150) NOT NULL,
  `Video` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tests_questions
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tutors`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tutors`;
CREATE TABLE `muu_courses_tutors` (
  `ID_Tutor` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Schooling` varchar(100) NOT NULL,
  `Curriculum` text NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Tutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tutors
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tutors_alerts`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tutors_alerts`;
CREATE TABLE `muu_courses_tutors_alerts` (
  `ID_Alert` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subject` varchar(250) NOT NULL,
  `Alert` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Alert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tutors_alerts
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_courses_tutors_messages`
-- ----------------------------
DROP TABLE IF EXISTS `muu_courses_tutors_messages`;
CREATE TABLE `muu_courses_tutors_messages` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_courses_tutors_messages
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_dislikes`
-- ----------------------------
DROP TABLE IF EXISTS `muu_dislikes`;
CREATE TABLE `muu_dislikes` (
  `ID_Dislike` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Dislike`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_dislikes
-- ----------------------------
INSERT INTO `muu_dislikes` VALUES ('1', '1', '10', '2', '1338350663');
INSERT INTO `muu_dislikes` VALUES ('2', '1', '10', '12', '1358021226');

-- ----------------------------
-- Table structure for `muu_events`
-- ----------------------------
DROP TABLE IF EXISTS `muu_events`;
CREATE TABLE `muu_events` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_events
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `muu_feedback`;
CREATE TABLE `muu_feedback` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_feedback
-- ----------------------------
INSERT INTO `muu_feedback` VALUES ('1', 'Carlos Santana Roldán', 'carlos@milkzoft.com', 'MilkZoft', '1223423', 'Colima', 'Hola como estas', 'adasdasd', '1337647712', 'Miércoles, 13 de Junio de 2012', 'Deleted');

-- ----------------------------
-- Table structure for `muu_forums`
-- ----------------------------
DROP TABLE IF EXISTS `muu_forums`;
CREATE TABLE `muu_forums` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_forums
-- ----------------------------
INSERT INTO `muu_forums` VALUES ('3', 'Probando la teoria del slug', 'probando-la-teoria-del-slug', 'testeando la edición', '0', '0', '0', '', 'Spanish', 'Deleted');
INSERT INTO `muu_forums` VALUES ('4', 'Probando foros', 'probando-foros', 'funcional?', '0', '0', '0', '', 'Spanish', 'Deleted');
INSERT INTO `muu_forums` VALUES ('5', 'Probando papelera', 'probando-papelera', 'asdsda', '0', '0', '0', '', 'Spanish', 'Deleted');
INSERT INTO `muu_forums` VALUES ('6', 'Foro de prueba', 'foro-de-prueba', 'Es para testear', '0', '0', '0', '', 'Spanish', 'Active');

-- ----------------------------
-- Table structure for `muu_forums_posts`
-- ----------------------------
DROP TABLE IF EXISTS `muu_forums_posts`;
CREATE TABLE `muu_forums_posts` (
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
  `Last_Reply` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Author` varchar(50) NOT NULL,
  `Total_Comments` int(10) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Hour` varchar(15) NOT NULL DEFAULT '00:00:00',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Topic` tinyint(1) NOT NULL DEFAULT '0',
  `Tags` varchar(150) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Forum` (`ID_Forum`),
  CONSTRAINT `muu_forums_posts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_forums_posts
-- ----------------------------
INSERT INTO `muu_forums_posts` VALUES ('1', '1', '3', '0', 'Probando la teoria del slug', ':)', '', '<p>asereje a deje tu dejebere</p><p>asereje a deje tu dejebere<br></p><p>asereje a deje tu dejebereasereje a deje tu dejebere<br></p><p>asereje a deje tu dejebere<br></p>', 'admin', 'http://localhost:8088/codejobs/www/lib/files/images/users/www/lib/files/images/works/ee907_wowscrnshot-030912-223712.jpg', '1360349309', '1360349321', '', '0', 'Viernes, 08 de Febrero de 2013', '00:00:00', '0', '0', 'asd', 'Spanish', 'Active');
INSERT INTO `muu_forums_posts` VALUES ('2', '1', '0', '1', '', '', '', '<p>estos son comentarios?</p>', 'admin', 'http://localhost:8088/codejobs/www/lib/files/images/users/www/lib/files/images/works/ee907_wowscrnshot-030912-223712.jpg', '1360349321', '0', '', '0', 'Viernes, 08 de Febrero de 2013', '00:00:00', '0', '0', '', 'Spanish', 'Active');
INSERT INTO `muu_forums_posts` VALUES ('3', '1', '3', '0', 'Probando la teoria del slug', 'testeando', 'testeando', '<pre class=\"prettyprint\">', 'admin', 'http://localhost:8088/codejobs/www/lib/files/images/users/www/lib/files/images/works/ee907_wowscrnshot-030912-223712.jpg', '1360350400', '1360350400', '', '0', 'Viernes, 08 de Febrero de 2013', '00:00:00', '0', '0', 'muchas, cosas', 'Spanish', 'Active');

-- ----------------------------
-- Table structure for `muu_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `muu_gallery`;
CREATE TABLE `muu_gallery` (
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
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_gallery_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_gallery_themes`
-- ----------------------------
DROP TABLE IF EXISTS `muu_gallery_themes`;
CREATE TABLE `muu_gallery_themes` (
  `ID_Gallery_Theme` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Slug` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Gallery_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_gallery_themes
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_inbox`
-- ----------------------------
DROP TABLE IF EXISTS `muu_inbox`;
CREATE TABLE `muu_inbox` (
  `ID_Inbox` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Receiver` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Sender` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`ID_Inbox`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_inbox
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `muu_jobs`;
CREATE TABLE `muu_jobs` (
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
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_jobs
-- ----------------------------
INSERT INTO `muu_jobs` VALUES ('1', '1', 'Desarrollador web', 'Alta Villa', 'desarrollador-web', 'admin', 'México', 'Colima', '', '150', 'USD', 'Half Time', 'php, html5, cs', 'Php, Jobs, HTML', 'villita@tuvilla.com', 'Spanish', '1362071126', '0', '1364663126', 'Active');
INSERT INTO `muu_jobs` VALUES ('2', '1', 'Prueba 2', 'Codejobs', 'prueba-2', 'admin', 'México', 'Aguascalientes', '', '130', 'USD', 'Full Time', 'Es sencishito', 'html, css', 'codejobs@codejobs.com', 'Spanish', '1362538406', '0', '1365130406', 'Active');

-- ----------------------------
-- Table structure for `muu_learning`
-- ----------------------------
DROP TABLE IF EXISTS `muu_learning`;
CREATE TABLE `muu_learning` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_learning
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_likes`
-- ----------------------------
DROP TABLE IF EXISTS `muu_likes`;
CREATE TABLE `muu_likes` (
  `ID_Like` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Like`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_likes
-- ----------------------------
INSERT INTO `muu_likes` VALUES ('1', '1', '10', '3', '1338350239');
INSERT INTO `muu_likes` VALUES ('2', '1', '10', '4', '1338350263');

-- ----------------------------
-- Table structure for `muu_logs`
-- ----------------------------
DROP TABLE IF EXISTS `muu_logs`;
CREATE TABLE `muu_logs` (
  `ID_Log` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Table_Name` varchar(50) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Query` text NOT NULL,
  `Start_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Log`),
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_logs_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_multimedia`
-- ----------------------------
DROP TABLE IF EXISTS `muu_multimedia`;
CREATE TABLE `muu_multimedia` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_multimedia
-- ----------------------------
INSERT INTO `muu_multimedia` VALUES ('1', '1', 'logosoldiercorp.png', 'www/lib/files/images/a69c2c8f7be63f5.png', null, null, null, 'images', '6157', 'admin', '1357692368', '0', 'Active');
INSERT INTO `muu_multimedia` VALUES ('2', '1', 'APPLICACIONES_MINT.txt', 'www/lib/files/documents/b594db2bd9eb881.txt', null, null, null, 'documents', '246', 'admin', '1358350393', '0', 'Active');
INSERT INTO `muu_multimedia` VALUES ('3', '1', 'ic_menu_answer_call.png', 'www/lib/files/images/e5f3c45c940e24b.png', null, null, null, 'images', '6417', 'admin', '1358350393', '0', 'Active');
INSERT INTO `muu_multimedia` VALUES ('4', '1', 'NS2_Biosphere_1680x1050_by_Th3Juic3.jpg', 'www/lib/files/images/21099f7e686bae3.jpg', null, null, null, 'images', '664624', 'admin', '1358350393', '0', 'Active');
INSERT INTO `muu_multimedia` VALUES ('5', '1', 'Copia de robot.jpg', 'www/lib/files/images/16c74df00858304.jpg', null, null, null, 'images', '41408', 'admin', '1358350393', '0', 'Active');

-- ----------------------------
-- Table structure for `muu_mural`
-- ----------------------------
DROP TABLE IF EXISTS `muu_mural`;
CREATE TABLE `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_mural
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_pages`
-- ----------------------------
DROP TABLE IF EXISTS `muu_pages`;
CREATE TABLE `muu_pages` (
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
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_pages_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_pages
-- ----------------------------
INSERT INTO `muu_pages` VALUES ('1', '1', '0', 'Publicidad', 'publicidad', '<p>Publicidad</p>', '0', 'Spanish', '0', '1337745419', 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_pages` VALUES ('2', '1', '0', 'Aviso Legal', 'aviso-legal', '<p>Aviso Legal</p>', '0', 'Spanish', '0', '1337746393', 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_pages` VALUES ('3', '1', '0', 'Condiciones de uso', 'condiciones-de-uso', '<p>Condiciones de uso</p>', '0', 'Spanish', '0', '1337746409', 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_pages` VALUES ('4', '1', '0', 'Acerca de Codejobs', 'acerca-de-codejobs', '<p>Acerca de Codejobs</p>', '0', 'Spanish', '0', '1337746606', 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_pages` VALUES ('5', '1', '0', 'Live', 'live', '<div id=\"tweet-container\" class=\"span12\">\r\n        <div id=\"tweets\"></div>\r\n        <script id=\"tweet-template\" type=\"text/x-handlebars-template\">\r\n          <div class=\"tweet\">\r\n            <blockquote class=\"twitter-tweet\">\r\n              <div class=\"vcard author\">\r\n                <a rel=\"nofollow\" target=\"_blank\" class=\"screen-name url\" href=\"https://twitter.com/{{user.screen_name}}\">\r\n                  <span class=\"avatar\">\r\n                    <img src=\"{{user.profile_image_url}}\" class=\"photo\">\r\n                  </span>\r\n                  <span class=\"fn\">{{user.name}}</span>\r\n                </a>\r\n                <a rel=\"nofollow\" target=\"_blank\" class=\"nickname\" href=\"https://twitter.com/{{user.screen_name}}\"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class=\"entry-content\">\r\n                <p class=\"entry-title\">{{text}}</p>\r\n              </div>\r\n              <div class=\"footer\">\r\n                <a rel=\"nofollow\" target=\"_blank\" class=\"view-details\" href=\"https://twitter.com/{{user.screen_name}}/status/{{id_str}}\">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', '0', 'Spanish', '0', '1337746606', 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');

-- ----------------------------
-- Table structure for `muu_polls`
-- ----------------------------
DROP TABLE IF EXISTS `muu_polls`;
CREATE TABLE `muu_polls` (
  `ID_Poll` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(255) NOT NULL,
  `Type` varchar(10) DEFAULT 'Simple',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Poll`),
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_polls_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_polls
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_polls_answers`
-- ----------------------------
DROP TABLE IF EXISTS `muu_polls_answers`;
CREATE TABLE `muu_polls_answers` (
  `ID_Answer` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL,
  `Votes` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Answer`),
  KEY `ID_Poll` (`ID_Poll`),
  CONSTRAINT `muu_polls_answers_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_polls_answers
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_polls_ips`
-- ----------------------------
DROP TABLE IF EXISTS `muu_polls_ips`;
CREATE TABLE `muu_polls_ips` (
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Poll` (`ID_Poll`),
  CONSTRAINT `muu_polls_ips_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_polls_ips
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_privileges`
-- ----------------------------
DROP TABLE IF EXISTS `muu_privileges`;
CREATE TABLE `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_privileges
-- ----------------------------
INSERT INTO `muu_privileges` VALUES ('1', 'Super Admin');
INSERT INTO `muu_privileges` VALUES ('2', 'Admin');
INSERT INTO `muu_privileges` VALUES ('3', 'Moderator');
INSERT INTO `muu_privileges` VALUES ('4', 'Member');

-- ----------------------------
-- Table structure for `muu_resumes`
-- ----------------------------
DROP TABLE IF EXISTS `muu_resumes`;
CREATE TABLE `muu_resumes` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_resumes
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_comments_applications`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_comments_applications`;
CREATE TABLE `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_comments_applications
-- ----------------------------
INSERT INTO `muu_re_comments_applications` VALUES ('1', '3', '1', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('2', '3', '2', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('3', '3', '3', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('4', '3', '4', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('5', '3', '5', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('6', '3', '6', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('7', '3', '7', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('8', '3', '8', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('9', '3', '9', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('10', '3', '10', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('11', '3', '11', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('12', '3', '12', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('13', '3', '13', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('14', '3', '14', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('15', '3', '15', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('16', '3', '16', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('17', '3', '17', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('18', '3', '18', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('19', '3', '19', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('20', '3', '20', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('21', '3', '21', '11');
INSERT INTO `muu_re_comments_applications` VALUES ('22', '3', '22', '10');
INSERT INTO `muu_re_comments_applications` VALUES ('23', '3', '23', '10');
INSERT INTO `muu_re_comments_applications` VALUES ('24', '3', '24', '10');

-- ----------------------------
-- Table structure for `muu_re_companies_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_companies_jobs`;
CREATE TABLE `muu_re_companies_jobs` (
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Job` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_re_companies_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_courses_course_categories`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_courses_course_categories`;
CREATE TABLE `muu_re_courses_course_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_courses_course_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_courses_lesson_course`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_courses_lesson_course`;
CREATE TABLE `muu_re_courses_lesson_course` (
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_courses_lesson_course
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_courses_tests_question_answer`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_courses_tests_question_answer`;
CREATE TABLE `muu_re_courses_tests_question_answer` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Answer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_courses_tests_question_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_permissions_privileges`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_permissions_privileges`;
CREATE TABLE `muu_re_permissions_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Adding` tinyint(1) NOT NULL DEFAULT '0',
  `Deleting` tinyint(1) NOT NULL DEFAULT '0',
  `Editing` tinyint(1) NOT NULL DEFAULT '0',
  `Viewing` tinyint(1) NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_Application` (`ID_Application`),
  CONSTRAINT `muu_re_permissions_privileges_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `muu_re_permissions_privileges_ibfk_2` FOREIGN KEY (`ID_Application`) REFERENCES `muu_applications` (`ID_Application`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_permissions_privileges
-- ----------------------------
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '1', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '2', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '3', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '5', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '6', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '7', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '8', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '9', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '10', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '11', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '12', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '13', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '14', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '15', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '16', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '1', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '2', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '3', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '5', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '6', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '7', '0', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '8', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '9', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '10', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '11', '1', '0', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '12', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '13', '1', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '14', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '15', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '16', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '1', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '2', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '3', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '5', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '6', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '7', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '8', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '9', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '10', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '11', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '12', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '13', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '14', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '15', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '16', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '1', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '2', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '3', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '5', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '6', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '7', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '8', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '9', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '10', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '11', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '12', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '13', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '14', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '15', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '16', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '17', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '17', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '17', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '17', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '18', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('2', '18', '1', '1', '1', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('3', '18', '1', '0', '0', '1');
INSERT INTO `muu_re_permissions_privileges` VALUES ('4', '18', '0', '0', '0', '0');
INSERT INTO `muu_re_permissions_privileges` VALUES ('1', '19', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `muu_re_privileges_users`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_privileges_users`;
CREATE TABLE `muu_re_privileges_users` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_re_privileges_users_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `muu_re_privileges_users_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_privileges_users
-- ----------------------------
INSERT INTO `muu_re_privileges_users` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `muu_re_users_companies`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_users_companies`;
CREATE TABLE `muu_re_users_companies` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_re_users_companies
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_users_events`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_users_events`;
CREATE TABLE `muu_re_users_events` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Event` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_re_users_events
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_re_users_followers`
-- ----------------------------
DROP TABLE IF EXISTS `muu_re_users_followers`;
CREATE TABLE `muu_re_users_followers` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User_Follower` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_re_users_followers
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_search`
-- ----------------------------
DROP TABLE IF EXISTS `muu_search`;
CREATE TABLE `muu_search` (
  `ID_Search` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Term` varchar(255) NOT NULL,
  `Counter` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Search` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_Search`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_search
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_support`
-- ----------------------------
DROP TABLE IF EXISTS `muu_support`;
CREATE TABLE `muu_support` (
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
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_support_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_support
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `muu_tokens`;
CREATE TABLE `muu_tokens` (
  `ID_Token` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Token` varchar(40) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Token`),
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_tokens
-- ----------------------------
INSERT INTO `muu_tokens` VALUES ('1', '1', '756d9920d7eca6a6794c2c1e703ec7c84739e986', 'Recover', '1337732698', '1337819098', 'Inactive');

-- ----------------------------
-- Table structure for `muu_tutorials`
-- ----------------------------
DROP TABLE IF EXISTS `muu_tutorials`;
CREATE TABLE `muu_tutorials` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_tutorials
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_users`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users`;
CREATE TABLE `muu_users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_users
-- ----------------------------
INSERT INTO `muu_users` VALUES ('1', '1', 'admin', 'b9223847e1566884893656e84798ff39cea2b8c4', 'carlos@milkzoft.com', '', 'default.png', '0,0,90,90', '98', '80', '', '0', '1', '0', '0', '0', '16', '0', '0', '0', '0', '1', '1337647712', 'BC958D3C97', 'Carlos Santana Roldán', '', '18', '', '', '', '', '0', 'M', 'Single', '', '', '', '', '', '', '', '', '', '', 'Active');
INSERT INTO `muu_users` VALUES ('2', '4', 'tester', 'e53e0171e0fa33c534981aab0be760bfed2959f1', 'tester@milkzoft.com', '', 'default.png', '0,0,90,90', '0', '50', '', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1347453332', 'C3F4E6E123', '', '', '18', '', '', '', '', '', 'M', 'Single', '', '', '', '', '', '', '', '', '', '', 'Active');

-- ----------------------------
-- Table structure for `muu_users_cv_education`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users_cv_education`;
CREATE TABLE `muu_users_cv_education` (
  `ID_School` int(11) NOT NULL,
  `ID_User` mediumint(8) NOT NULL,
  `School` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Degree` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Period_From` int(11) DEFAULT NULL,
  `Period_To` int(11) DEFAULT NULL,
  `Description` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_School`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of muu_users_cv_education
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_users_cv_experiences`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users_cv_experiences`;
CREATE TABLE `muu_users_cv_experiences` (
  `ID_Experience` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) NOT NULL,
  `Company` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Job_Title` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Location` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Period_From` int(11) DEFAULT NULL,
  `Period_To` int(11) DEFAULT NULL,
  `Description` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_Experience`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of muu_users_cv_experiences
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_users_cv_extract`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users_cv_extract`;
CREATE TABLE `muu_users_cv_extract` (
  `ID_Extract` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL,
  `Extract` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `Last_Updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Extract`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of muu_users_cv_extract
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_users_online`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users_online`;
CREATE TABLE `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_users_online
-- ----------------------------
INSERT INTO `muu_users_online` VALUES ('admin', '1363894486');

-- ----------------------------
-- Table structure for `muu_users_online_anonymous`
-- ----------------------------
DROP TABLE IF EXISTS `muu_users_online_anonymous`;
CREATE TABLE `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_users_online_anonymous
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_vacancy`
-- ----------------------------
DROP TABLE IF EXISTS `muu_vacancy`;
CREATE TABLE `muu_vacancy` (
  `ID_Vacancy` smallint(8) NOT NULL AUTO_INCREMENT,
  `ID_Job` smallint(8) NOT NULL,
  `ID_User` smallint(8) NOT NULL,
  `Message` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Vacancy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muu_vacancy
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_videos`
-- ----------------------------
DROP TABLE IF EXISTS `muu_videos`;
CREATE TABLE `muu_videos` (
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
  KEY `ID_User` (`ID_User`),
  CONSTRAINT `muu_videos_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_videos
-- ----------------------------
INSERT INTO `muu_videos` VALUES ('1', '1', 'jhP6vVc7Yts', 'Taller de CodeIgniter por www.codejobs.biz', 'taller-de-codeigniter-por-www-codejobs-biz', 'Taller de CodeIgniter por www.codejobs.biz', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('2', '1', 'JtUCr-m8BSo', 'Introducción al Responsive Design por www.codejobs.biz', 'introduccion-al-responsive-design-por-www-codejobs-biz', 'Introducción al Responsive Design por www.codejobs.biz', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('3', '1', 'SXHsN5GhdA0', 'Proyecto CANDI 3: Cómo crear un correo electro?nico en GMail', 'proyecto-candi-3-como-crear-un-correo-electro-nico-en-gmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en GMail', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('4', '1', 't1BrjyAf3XE', 'Proyecto CANDI 2: Cómo crear una cuenta de correo electro?nico en Hotmail', 'proyecto-candi-2-como-crear-una-cuenta-de-correo-electro-nico-en-hotmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en Hotmail', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('5', '1', 'djg8B0TPh60', 'Proyecto CANDI 1: Instalacioón de Ubuntu 12.04 [www.codejobs.biz]', 'proyecto-candi-1-instalacion-de-ubuntu-12-04-www-codejobs-biz', 'Explicación sencilla de cómo instalar Ubuntu 12.04 en tu computadora.', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('6', '1', 'JhHz0vyngN4', 'Presentación del Proyecto CANDI', 'presentacion-del-proyecto-candi', 'Presentación del Proyecto CANDI', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('7', '1', 'XBYw9eWNd7c', 'Taller de Introducción a ZanPHP por www.codejobs.biz', 'taller-de-introduccion-a-zanphp-por-www-codejobs-biz', 'Taller de Introduccio?n a ZanPHP por www.codejobs.biz', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('8', '1', '-Wb0XcYjIxU', 'Introducción a las Bases de Datos NoSQL', 'introducci-n-a-las-bases-de-datos-nosql', '', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');
INSERT INTO `muu_videos` VALUES ('9', '1', 'nN9NQRSG7iU', 'Taller de Github por www.codejobs.biz', 'taller-de-github-por-www-codejobs-biz', 'Taller de Github por www.codejobs.biz', '', 'YouTube', '', '0', '1337743070', 'Wednesday, 23 de Mayo de 2012', 'Active');

-- ----------------------------
-- Table structure for `muu_works`
-- ----------------------------
DROP TABLE IF EXISTS `muu_works`;
CREATE TABLE `muu_works` (
  `ID_Work` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Preview1` varchar(200) NOT NULL,
  `Preview2` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Work`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_works
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_workshop`
-- ----------------------------
DROP TABLE IF EXISTS `muu_workshop`;
CREATE TABLE `muu_workshop` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_workshop
-- ----------------------------

-- ----------------------------
-- Table structure for `muu_world`
-- ----------------------------
DROP TABLE IF EXISTS `muu_world`;
CREATE TABLE `muu_world` (
  `Continent` varchar(20) NOT NULL,
  `Code` varchar(5) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  KEY `District` (`District`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of muu_world
-- ----------------------------
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Buenos Aires', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Catamarca', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Chaco', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Chubut', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Córdoba', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Corrientes', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Distrito Federal', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Entre Rios', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Formosa', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Jujuy', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'La Rioja', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Mendoza', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Misiones', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Neuquén', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Salta', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'San Juan', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'San Luis', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Santa Fé', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Santiago del Estero', '');
INSERT INTO `muu_world` VALUES ('America', 'ARG', 'Argentina', 'Tucumán', '');
INSERT INTO `muu_world` VALUES ('America', 'BLZ', 'Belize', 'Belize City', '');
INSERT INTO `muu_world` VALUES ('America', 'BLZ', 'Belize', 'Cayo', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Chuquisaca', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Cochabamba', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'La Paz', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Oruro', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Potosí', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Santa Cruz', '');
INSERT INTO `muu_world` VALUES ('America', 'BOL', 'Bolivia', 'Tarija', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Acre', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Alagoas', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Amapá', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Amazonas', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Bahia', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Ceará', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Distrito Federal', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Espírito Santo', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Goiás', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Maranhão', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Mato Grosso', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Mato Grosso do Sul', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Minas Gerais', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Pará', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Paraíba', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Paraná', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Pernambuco', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Piauí', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Rio de Janeiro', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Rio Grande do Norte', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Rio Grande do Sul', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Rondônia', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Roraima', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Santa Catarina', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'São Paulo', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Sergipe', '');
INSERT INTO `muu_world` VALUES ('America', 'BRA', 'Brazil', 'Tocantins', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Alberta', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'British Colombia', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Manitoba', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Newfoundland', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Nova Scotia', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Ontario', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Québec', '');
INSERT INTO `muu_world` VALUES ('America', 'CAN', 'Canada', 'Saskatchewan', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Antofagasta', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Atacama', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Bíobío', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Coquimbo', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'La Araucanía', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Los Lagos', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Magallanes', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Maule', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Santiago', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Tarapacá', '');
INSERT INTO `muu_world` VALUES ('America', 'CHL', 'Chile', 'Valparaíso', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Antioquia', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Atlántico', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Bolívar', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Boyacá', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Caldas', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Caquetá', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Cauca', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Cesar', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Córdoba', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Cundinamarca', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Huila', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'La Guajira', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Magdalena', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Meta', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Norte de Santander', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Quindío', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Risaralda', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Santafé de Bogotá', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Santander', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Sucre', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Tolima', '');
INSERT INTO `muu_world` VALUES ('America', 'COL', 'Colombia', 'Valle', '');
INSERT INTO `muu_world` VALUES ('America', 'CRI', 'Costa Rica', 'San Jos', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Ciego de Ávila', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Cienfuegos', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Granma', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Guantánamo', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Holguín', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'La Habana', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Las Tunas', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Matanzas', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Pinar del Río', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Santiago de Cuba', '');
INSERT INTO `muu_world` VALUES ('America', 'CUB', 'Cuba', 'Villa Clara', '');
INSERT INTO `muu_world` VALUES ('America', 'CYM', 'Cayman Islands', 'Grand Cayman', '');
INSERT INTO `muu_world` VALUES ('America', 'DMA', 'Dominica', 'St George', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'Distrito Nacional', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'Duarte', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'La Romana', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'Puerto Plata', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'San Pedro de Macorís', '');
INSERT INTO `muu_world` VALUES ('America', 'DOM', 'Dominican Republic', 'Santiago', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Azuay', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Chimborazo', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'El Oro', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Esmeraldas', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Guayas', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Imbabura', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Loja', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Los Río', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Manabí', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Pichincha', '');
INSERT INTO `muu_world` VALUES ('America', 'ECU', 'Ecuador', 'Tungurahua', '');
INSERT INTO `muu_world` VALUES ('America', 'SLV', 'El Salvador', 'La Libertad', '');
INSERT INTO `muu_world` VALUES ('America', 'SLV', 'El Salvador', 'San Miguel', '');
INSERT INTO `muu_world` VALUES ('America', 'SLV', 'El Salvador', 'San Salvador', '');
INSERT INTO `muu_world` VALUES ('America', 'SLV', 'El Salvador', 'Santa Ana', '');
INSERT INTO `muu_world` VALUES ('America', 'GTM', 'Guatemala', 'Guatemala', '');
INSERT INTO `muu_world` VALUES ('America', 'GTM', 'Guatemala', 'Quetzaltenango', '');
INSERT INTO `muu_world` VALUES ('America', 'HND', 'Honduras', 'Atlántida', '');
INSERT INTO `muu_world` VALUES ('America', 'HND', 'Honduras', 'Cortés', '');
INSERT INTO `muu_world` VALUES ('America', 'HND', 'Honduras', 'Distrito Central', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Aguascalientes', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Baja California', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Baja California Sur', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Campeche', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Chiapas', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Chihuahua', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Coahuila de Zaragoza', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Colima', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Distrito Federal', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Durango', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Guanajuato', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Guerrero', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Hidalgo', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Jalisco', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'México', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Michoacán de Ocampo', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Morelos', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Nayarit', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Nuevo León', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Oaxaca', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Puebla', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Querétaro', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Querétaro de Arteaga', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Quintana Roo', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'San Luis Potosí', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Sinaloa', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Sonora', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Tabasco', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Tamaulipas', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Veracruz', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Yucatán', '');
INSERT INTO `muu_world` VALUES ('America', 'MEX', 'Mexico', 'Zacatecas', '');
INSERT INTO `muu_world` VALUES ('America', 'NIC', 'Nicaragua', 'Chinandega', '');
INSERT INTO `muu_world` VALUES ('America', 'NIC', 'Nicaragua', 'León', '');
INSERT INTO `muu_world` VALUES ('America', 'NIC', 'Nicaragua', 'Managua', '');
INSERT INTO `muu_world` VALUES ('America', 'NIC', 'Nicaragua', 'Masaya', '');
INSERT INTO `muu_world` VALUES ('America', 'PAN', 'Panama', 'Panamá', '');
INSERT INTO `muu_world` VALUES ('America', 'PAN', 'Panama', 'San Miguelito', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Ancash', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Arequipa', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Ayacucho', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Cajamarca', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Callao', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Cusco', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Huánuco', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Ica', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Junín', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'La Libertad', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Lambayeque', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Lima', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Loreto', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Piura', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Puno', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Tacna', '');
INSERT INTO `muu_world` VALUES ('America', 'PER', 'Peru', 'Ucayali', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Arecibo', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Bayamón', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Caguas', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Carolina', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Guaynabo', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Ponce', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'San Juan', '');
INSERT INTO `muu_world` VALUES ('America', 'PRI', 'Puerto Rico', 'Toa Baja', '');
INSERT INTO `muu_world` VALUES ('America', 'PRY', 'Paraguay', 'Alto Paraná', '');
INSERT INTO `muu_world` VALUES ('America', 'PRY', 'Paraguay', 'Asunción', '');
INSERT INTO `muu_world` VALUES ('America', 'PRY', 'Paraguay', 'Central', '');
INSERT INTO `muu_world` VALUES ('America', 'URY', 'Uruguay', 'Montevideo', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Alabama', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Alaska', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Arizona', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Arkansas', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'California', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Colorado', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Connecticut', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'District of Columbia', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Florida', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Georgia', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Hawaii', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Idaho', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Illinois', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Indiana', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Iowa', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Kansas', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Kentucky', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Louisiana', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Maryland', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Massachusetts', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Michigan', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Minnesota', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Mississippi', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Missouri', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Montana', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Nebraska', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Nevada', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'New Hampshire', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'New Jersey', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'New Mexico', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'New York', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'North Carolina', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Ohio', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Oklahoma', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Oregon', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Pennsylvania', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Rhode Island', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'South Carolina', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'South Dakota', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Tennessee', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Texas', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Utah', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Virginia', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Washington', '');
INSERT INTO `muu_world` VALUES ('America', 'USA', 'United States', 'Wisconsin', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Anzoátegui', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Apure', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Aragua', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Barinas', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Bolívar', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Carabobo', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Distrito Federal', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Falcón', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Guárico', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Lara', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Mérida', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Miranda', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Monagas', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Portuguesa', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Sucre', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Táchira', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Trujillo', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Yaracuy', '');
INSERT INTO `muu_world` VALUES ('America', 'VEN', 'Venezuela', 'Zulia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'Antwerpen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'Bryssel', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'East Flanderi', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'Hainaut', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'Namur', '');
INSERT INTO `muu_world` VALUES ('Europe', 'BEL', 'Belgium', 'West Flanderi', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Alsace', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Aquitaine', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Auvergne', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Basse-Normandie', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Bourgogne', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Bretagne', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Centre', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Limousin', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Lorraine', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Pays de la Loire', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Picardie', '');
INSERT INTO `muu_world` VALUES ('Europe', 'FRA', 'France', 'Rhône-Alpes', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Anhalt Sachsen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Baijeri', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Berliini', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Brandenburg', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Bremen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Hamburg', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Hessen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Mecklenburg-Vorpomme', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Niedersachsen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Nordrhein-Westfalen', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Rheinland-Pfalz', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Saarland', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Saksi', '');
INSERT INTO `muu_world` VALUES ('Europe', 'DEU', 'Germany', 'Schleswig-Holstein', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Abruzzit', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Apulia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Calabria', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Campania', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Emilia-Romagna', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Friuli-Venezia Giuli', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Latium', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Liguria', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Lombardia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Marche', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Piemonte', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Sardinia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Sisilia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Toscana', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Umbria', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ITA', 'Italy', 'Veneto', '');
INSERT INTO `muu_world` VALUES ('Europe', 'PRT', 'Portugal', 'Braga', '');
INSERT INTO `muu_world` VALUES ('Europe', 'PRT', 'Portugal', 'Coímbra', '');
INSERT INTO `muu_world` VALUES ('Europe', 'PRT', 'Portugal', 'Lisboa', '');
INSERT INTO `muu_world` VALUES ('Europe', 'PRT', 'Portugal', 'Porto', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Andalusia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Aragonia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Asturia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Balears', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Baskimaa', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Canary Islands', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Cantabria', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Castilla and León', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Extremadura', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Galicia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Katalonia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'La Rioja', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Madrid', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Murcia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Navarra', '');
INSERT INTO `muu_world` VALUES ('Europe', 'ESP', 'Spain', 'Valencia', '');
INSERT INTO `muu_world` VALUES ('Europe', 'CHE', 'Switzerland', 'Bern', '');
INSERT INTO `muu_world` VALUES ('Europe', 'CHE', 'Switzerland', 'Geneve', '');
INSERT INTO `muu_world` VALUES ('Europe', 'CHE', 'Switzerland', 'Vaud', '');
INSERT INTO `muu_world` VALUES ('Europe', 'GBR', 'United Kingdom', 'England', '');
INSERT INTO `muu_world` VALUES ('Europe', 'GBR', 'United Kingdom', 'Jersey', '');
INSERT INTO `muu_world` VALUES ('Europe', 'GBR', 'United Kingdom', 'North Ireland', '');
INSERT INTO `muu_world` VALUES ('Europe', 'GBR', 'United Kingdom', 'Scotland', '');
INSERT INTO `muu_world` VALUES ('Europe', 'GBR', 'United Kingdom', 'Wales', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'Capital Region', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'New South Wales', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'Queensland', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'South Australia', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'Tasmania', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'Victoria', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'AUS', 'Australia', 'West Australia', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'NZL', 'New Zealand', 'Auckland', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'NZL', 'New Zealand', 'Canterbury', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'NZL', 'New Zealand', 'Dunedin', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'NZL', 'New Zealand', 'Hamilton', '');
INSERT INTO `muu_world` VALUES ('Oceania', 'NZL', 'New Zealand', 'Wellington', '');
