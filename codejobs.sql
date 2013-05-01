DROP TABLE IF EXISTS `muu_ads`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muu_applications`
--

DROP TABLE IF EXISTS `muu_applications`;
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
(18, 'Multimedia', 'multimedia', 1, 1, 1, 0, 'Active'),
(19, 'Proposals', 'workshop', 1, 0, 1, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_blog`
--

DROP TABLE IF EXISTS `muu_blog`;
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
  `Image_Mural` varchar(250) NOT NULL,
  `Image_Thumbnail` varchar(250) NOT NULL,
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Image_Original` varchar(250) NOT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Pwd` varchar(40) NOT NULL,
  `Buffer` tinyint(1) NOT NULL DEFAULT '1',
  `Code` varchar(10) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_bookmarks`;
CREATE TABLE IF NOT EXISTS `muu_bookmarks` (
  `ID_Bookmark` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `Slug` varchar(200) NOT NULL,
  `URL` varchar(255) NOT NULL,
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
  `Buffer` tinyint(1) NOT NULL DEFAULT '1',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Bookmark`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `muu_codes`;
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
  `Buffer` tinyint(1) NOT NULL DEFAULT '1',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `muu_codes_files`;
CREATE TABLE IF NOT EXISTS `muu_codes_files` (
  `ID_File` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Code` int(11) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ID_Syntax` int(11) NOT NULL,
  `Code` text NOT NULL,
  PRIMARY KEY (`ID_File`),
  KEY `ID_Code` (`ID_Code`),
  KEY `ID_Syntax` (`ID_Syntax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_codes_syntax`;
CREATE TABLE IF NOT EXISTS `muu_codes_syntax` (
  `ID_Syntax` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `MIME` varchar(50) NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `Extension` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Syntax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `muu_codes_syntax`
--

INSERT INTO `muu_codes_syntax` (`ID_Syntax`, `Name`, `MIME`, `Filename`, `Extension`) VALUES
(1, 'Text Plain', 'text/plain', '', ''),
(2, 'JSON', 'application/json', 'javascript', 'json'),
(3, 'C++', 'text/x-c++src', 'clike', 'cpp'),
(4, 'PHP', 'application/x-httpd-php', 'php', 'php'),
(5, 'Javascript', 'text/javascript', 'javascript', 'js'),
(6, 'HTML', 'text/html', 'htmlmixed', 'html'),
(7, 'CSS', 'text/css', 'css', 'css'),
(8, 'Coffeescript', 'text/x-coffeescript', 'coffeescript', 'coffee'),
(9, 'Groovy', 'text/x-groovy', 'groovy', 'groovy'),
(10, 'Java', 'text/x-java', 'clike', 'java'),
(11, 'Less', 'text/x-less', 'lesscss', 'less'),
(12, 'MySQL', 'text/x-mysql', 'mysql', 'sql'),
(13, 'Perl', 'text/x-perl', 'perl', 'perl'),
(14, 'Oracle PL/SQL', 'text/x-plsql', 'plsql', 'pls'),
(15, 'Python', 'text/x-python', 'python', 'py'),
(16, 'Ruby', 'text/x-ruby', 'ruby', 'rb'),
(17, 'VB.NET', 'text/vbscript', 'vbscript', 'vb'),
(18, 'XML', 'application/xml', 'xml', 'xml'),
(19, 'Yaml', 'text/x-yaml', 'yaml', 'yaml'),
(20, 'CSharp', 'text/x-csharp', 'charp', 'cs'),
(21, 'C', 'text/x-csrc', 'clike', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `muu_comments`
--

DROP TABLE IF EXISTS `muu_comments`;
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


DROP TABLE IF EXISTS `muu_configuration`;
CREATE TABLE IF NOT EXISTS `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `Slogan_Italian` varchar(150) NOT NULL,
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
  `TV` varchar(100) NOT NULL,
  `Enable_Chat` tinyint(1) NOT NULL DEFAULT '1',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `muu_configuration`
--

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `Slogan_Italian`, `URL`, `Lang`, `Language`, `Theme`, `Validation`, `Application`, `Editor`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `TV`, `Enable_Chat`, `Situation`) VALUES
(1, 'Codejobs', 'Knowledge makes us free!', '¡El conocimiento nos hace libres!', 'Connaissance nous rend libres!', 'Conhecimento nos torna livres!', 'La conoscenza ci rende liberi!', 'http://localhost/codejobs', 'es', 'Spanish', 'newcodejobs', 'Active', 'blog', 'MarkItUp', 'El Sitio Web esta en mantenimiento', 'User', 'azapedia@gmail.com', 'codejobs@codejobs.biz', 'http://www.youtube.com/embed/nsPly37h9os', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_categories`
--

DROP TABLE IF EXISTS `muu_courses_categories`;
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

DROP TABLE IF EXISTS `muu_courses_enrollments`;
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

DROP TABLE IF EXISTS `muu_courses_help`;
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

DROP TABLE IF EXISTS `muu_courses_lessons`;
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

DROP TABLE IF EXISTS `muu_courses_material`;
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

DROP TABLE IF EXISTS `muu_courses_resources`;
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

DROP TABLE IF EXISTS `muu_courses_roles`;
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

DROP TABLE IF EXISTS `muu_courses_students`;
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

DROP TABLE IF EXISTS `muu_courses_students_archive`;
CREATE TABLE IF NOT EXISTS `muu_courses_students_archive` (
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tests`
--

DROP TABLE IF EXISTS `muu_courses_tests`;
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

DROP TABLE IF EXISTS `muu_courses_tests_answers`;
CREATE TABLE IF NOT EXISTS `muu_courses_tests_answers` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_courses_tests_questions`
--

DROP TABLE IF EXISTS `muu_courses_tests_questions`;
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

DROP TABLE IF EXISTS `muu_courses_tutors`;
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

DROP TABLE IF EXISTS `muu_courses_tutors_alerts`;
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

DROP TABLE IF EXISTS `muu_courses_tutors_messages`;
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

DROP TABLE IF EXISTS `muu_dislikes`;
CREATE TABLE IF NOT EXISTS `muu_dislikes` (
  `ID_Dislike` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Dislike`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


--
-- Table structure for table `muu_events`
--

DROP TABLE IF EXISTS `muu_events`;
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

DROP TABLE IF EXISTS `muu_feedback`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_forums`;
CREATE TABLE IF NOT EXISTS `muu_forums` (
  `ID_Forum` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(120) NOT NULL,
  `Slug` varchar(120) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Reply` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Date` varchar(50) NOT NULL,
  `Total_Posts` int(10) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `muu_forums`
--

INSERT INTO `muu_forums` (`ID_Forum`, `Title`, `Slug`, `Description`, `Topics`, `Replies`, `Last_Reply`, `Last_Date`, `Language`, `Situation`) VALUES
(1, 'Programación', 'programacion', 'aasdasdsadasdasdasdasd', 0, 0, 0, '', 'Spanish', 'Active'),
(2, 'PHP', 'php', 'SADSADSADASD', 0, 0, 0, '', 'Spanish', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `muu_forums_posts`
--

DROP TABLE IF EXISTS `muu_forums_posts`;
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
  KEY `ID_Forum` (`ID_Forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `muu_gallery`;
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


DROP TABLE IF EXISTS `muu_inbox`;
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

DROP TABLE IF EXISTS `muu_jobs`;
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
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Modified_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  `Counter` smallint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


DROP TABLE IF EXISTS `muu_learning`;
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

DROP TABLE IF EXISTS `muu_likes`;
CREATE TABLE IF NOT EXISTS `muu_likes` (
  `ID_Like` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Like`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `muu_logs`;
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

DROP TABLE IF EXISTS `muu_multimedia`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_mural`
--

DROP TABLE IF EXISTS `muu_mural`;
CREATE TABLE IF NOT EXISTS `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------
--
-- Table structure for table `muu_newsletters`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_pages`
--

DROP TABLE IF EXISTS `muu_pages`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muu_pages`
--

INSERT INTO `muu_pages` (`ID_Page`, `ID_User`, `ID_Translation`, `Title`, `Slug`, `Content`, `Views`, `Language`, `Principal`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 0, 'Publicidad', 'publicidad', '<h2>Publicidad</h2> \r\n\r\n<p>En CodeJobs te ofrecemos 3 formas de poder promocionar tu empresa, startup, blog o negocio.</p>\r\n\r\n<h3>Paquete básico</h3>\r\n\r\n<p><strong>Costo:</strong> $18 USD/mes</p>\r\n\r\n<p><strong>Incluye:</strong></p>\r\n\r\n<ul>\r\n<li>Logotipo de 100x31px en la sección de <a href=\\"http://www.codejobs.biz/tv\\">CodeJobs TV!</a>, dónde cada sábado hacemos talleres en vivo sobre diferentes tecnologías.</li>\r\n<li>10 tweets al mes en la cuenta oficial de @<a href=\\"http://www.twitter.com/codejobs\\">codejobs</a> (ustedes deciden la fecha y hora que quieran que publiquemos cada tweet).</li>\r\n<li>5 publicaciones en nuestra página de <a href=\\"http://www.facebook.com/codejobs\\">Facebook</a>.</li>\r\n</ul>\r\n\r\n<h3>Paquete recomendado</h3>\r\n\r\n<p><strong>Costo:</strong> $30 USD/mes</p>\r\n\r\n<p><strong>Incluye:</strong></p>\r\n\r\n<ul>\r\n<li>Logotipo de 100x31px en la sección de CodeJobs TV!, dónde cada sábado hacemos talleres en vivo sobre diferentes tecnologías.</li>\r\n<li>12 tweets al mes en la cuenta oficial de @codejobs (ustedes deciden la fecha y hora que quieran que publiquemos cada tweet).</li>\r\n<li>5 tweets en nuestras cuentas específicas (@<a href=\\"http://www.twitter.com/codejobsphp\\">CodeJobsPHP</a>, @<a href=\\"http://www.twitter.com/codejobspython\\">CodeJobsPython</a>, @<a href=\\"http://www.twitter.com/codejobsrails\\">CodeJobsRails</a>, @<a href=\\"http://www.twitter.com/codejobsjava\\">CodeJobsJava</a> y @<a href=\\"http://www.twitter.com/codejobsandroid\\">CodeJobsAndroid</a>).</li>\r\n<li>5 publicaciones en nuestra página de Facebook.</li>\r\n</ul>\r\n\r\n<p><strong>NOTA:</strong> La ventaja de publicar en nuestras cuentas específicas es que los programadores están filtrados y segmentados por tecnología lo cual hace más fácil la tarea de conseguir a algún programador de una tecnología específica.</p>\r\n\r\n<h3>Paquete premium</h3>\r\n\r\n<p><strong>Costo:</strong> $60 USD/mes</p>\r\n\r\n<ul>\r\n<li>Logotipo de 100x31px en la sección de CodeJobs TV!, dónde cada sábado hacemos talleres en vivo sobre diferentes tecnologías.</li>\r\n<li>Logotipo de 250x100px en nuestra página principal y en todas sus secciones www.codejobs.biz (incluyendo todos los idiomas: español, inglés, portugués, francés e italiano).</li>\r\n<li>15 tweets al mes en la cuenta oficial de @codejobs (ustedes deciden la fecha y hora que quieran que publiquemos cada tweet).</li>\r\n<li>10 tweets en nuestras cuentas específicas (@<a href=\\"http://www.twitter.com/codejobsphp\\">CodeJobsPHP</a>, @<a href=\\"http://www.twitter.com/codejobspython\\">CodeJobsPython</a>, @<a href=\\"http://www.twitter.com/codejobsrails\\">CodeJobsRails</a>, @<a href=\\"http://www.twitter.com/codejobsjava\\">CodeJobsJava</a> y @<a href=\\"http://www.twitter.com/codejobsandroid\\">CodeJobsAndroid</a>).</li>\r\n<li>10 publicaciones en nuestra página de Facebook</li>\r\n</ul>\r\n\r\n<h3>Estadísticas</h3>\r\n\r\n<p><strong><a href=\\"http://www.twitter.com/codejobs\\" target=\\"_blank\\">Twitter</a>:</strong> la comunidad actualmente consta de más de 43,000 followers y tiene un promedio de 150 seguidores diarios.</p>\r\n\r\n<p><strong><a href=\\"http://www.youtube.com/codejobs\\" target=\\"_blank\\">Canal de Youtube</a>:</strong> dónde quedan grabados nuestros talleres (dónde recomendamos a los patrocinadores) tiene actualmente más de 6,500 suscritos y tenemos un promedio de 45 suscritos diarios</p>\r\n\r\n<p><strong><a href=\\"http://www.facebook.com/codejobs\\" target=\\"_blank\\">Facebook</a>:</strong> nuestra cuenta de Facebook actualmente consta de más de 2500 likes y tenemos un promedio de 25 likes diarios</p>\r\n\r\n<p>Actualmente los principales países que nos visitan son: México, España, Estados Unidos, Brasil, Venezuela, El Salvador, Argentina, Chile, Colombia, Ecuador, Canadá y Francia.</p>\r\n\r\n<h3>Pagos</h3>\r\n\r\n<p>Los pagos se pueden hacer mediante transferencia bancaria, depósito bancario o utilizando PayPal.</p>\r\n\r\n<p>Para contrataciones ó más información favor de visitar nuestra sección de <a href=\\"http://www.codejobs.biz/es/feedback\\">contacto</a>.</p>', 2078, 'Spanish', 0, 1355941374, 'Miércoles, 19 de Diciembre de 2012', 'Active'),
(2, 1, 0, 'Links', 'links', '<h1>Sitios Web Recomendados</h1>\r\n\r\n<p>\r\n<strong><a href="http://www.milkzoft.com" target="_blank">MilkZoft</a></strong>\r\nEmpresa de Desarrollo de Software\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://www.zanphp.com" target="_blank">ZanPHP</a></strong>\r\nPHP5 Framework\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://www.anpstudio.com" target="_blank">Themes Wordpress en Español</a></strong>\r\nDesarrollo de themes para Wordpress con soporte en español\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://juliochinchilla.com/" target="_blank">Julio Chinchilla</a></strong>\r\nIngeniería en Sistemas y Desarrollo Multimedia\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://guillermocerezo.com" target="_blank">Guillermo Cerezo Somera</a></strong> \r\nDesarrollo de aplicaciones Web\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://afinandocodigo.wordpress.com/" target="_blank">Algo con que empezar</a></strong> \r\nAfinando Código\r\n</p>\r\n\r\n<p>\r\n<strong><a href="http://www.strikegeek.org/" target="_blank">StrikeGeek</a></strong> \r\nTutoriales De Seguridad y Programación\r\n</p>\r\n\r\n<p>Tienes un blog o página Web de tecnología o de programación y te gustaría intercambiar enlaces con <a href="http://www.codejobs.biz">www.codejobs.biz</a>, ponte en contácto con nosotros <a href="http://www.codejobs.biz/es/feedback">aquí</a>.</p>', 1230, 'Spanish', 0, 1357242445, 'Jueves, 03 de Enero de 2013', 'Active'),
(3, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 1019, 'Spanish', 0, 0, '', 'Active'),
(4, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 159, 'English', 0, 0, '', 'Active'),
(5, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 67, 'French', 0, 1352144315, '', 'Active'),
(6, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 71, 'Portuguese', 0, 0, '', 'Active'),
(7, 1, 0, 'Live', 'live', '<div id="tweet-container" class="span12">\r\n        <div id="tweets"></div>\r\n        <script id="tweet-template" type="text/x-handlebars-template">\r\n          <div class="tweet">\r\n            <blockquote class="twitter-tweet">\r\n              <div class="vcard author">\r\n                <a rel="nofollow" target="_blank" class="screen-name url" href="https://twitter.com/{{user.screen_name}}">\r\n                  <span class="avatar">\r\n                    <img src="{{user.profile_image_url}}" class="photo">\r\n                  </span>\r\n                  <span class="fn">{{user.name}}</span>\r\n                </a>\r\n                <a rel="nofollow" target="_blank" class="nickname" href="https://twitter.com/{{user.screen_name}}"><span>@{{user.screen_name}}</span></a>\r\n              </div>\r\n              <div class="entry-content">\r\n                <p class="entry-title">{{text}}</p>\r\n              </div>\r\n              <div class="footer">\r\n                <a rel="nofollow" target="_blank" class="view-details" href="https://twitter.com/{{user.screen_name}}/status/{{id_str}}">{{created_at}}</a>\r\n              </div>\r\n            </blockquote>\r\n          </div>\r\n        </script>\r\n      </div>', 58, 'Italian', 0, 0, '', 'Active');


DROP TABLE IF EXISTS `muu_polls`;
CREATE TABLE IF NOT EXISTS `muu_polls` (
  `ID_Poll` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(255) NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Poll`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `muu_polls_answers`;
CREATE TABLE IF NOT EXISTS `muu_polls_answers` (
  `ID_Answer` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL,
  `Votes` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Answer`),
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_polls_ips`;
CREATE TABLE IF NOT EXISTS `muu_polls_ips` (
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `muu_privileges`;
CREATE TABLE IF NOT EXISTS `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `muu_privileges` (`ID_Privilege`, `Privilege`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Member');


DROP TABLE IF EXISTS `muu_resumes`;
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


DROP TABLE IF EXISTS `muu_re_comments_applications`;
CREATE TABLE IF NOT EXISTS `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_re_companies_jobs`;
CREATE TABLE IF NOT EXISTS `muu_re_companies_jobs` (
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Job` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_course_categories`
--

DROP TABLE IF EXISTS `muu_re_courses_course_categories`;
CREATE TABLE IF NOT EXISTS `muu_re_courses_course_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_lesson_course`
--

DROP TABLE IF EXISTS `muu_re_courses_lesson_course`;
CREATE TABLE IF NOT EXISTS `muu_re_courses_lesson_course` (
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_courses_tests_question_answer`
--

DROP TABLE IF EXISTS `muu_re_courses_tests_question_answer`;
CREATE TABLE IF NOT EXISTS `muu_re_courses_tests_question_answer` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Answer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_permissions_privileges`
--

DROP TABLE IF EXISTS `muu_re_permissions_privileges`;
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
(1, 19, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_privileges_users`
--

DROP TABLE IF EXISTS `muu_re_privileges_users`;
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
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(4, 32),
(4, 33),
(4, 34),
(4, 35),
(4, 36),
(4, 37),
(4, 38),
(4, 39),
(4, 40),
(4, 41),
(4, 42),
(4, 43),
(4, 44),
(4, 45),
(4, 46),
(4, 47),
(4, 48),
(4, 49),
(4, 50),
(4, 51),
(4, 52),
(4, 53),
(4, 54),
(4, 55),
(4, 56),
(4, 57),
(4, 58),
(4, 59),
(4, 60),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(4, 66),
(4, 67),
(4, 68),
(4, 69),
(4, 70),
(4, 71),
(4, 72),
(4, 73),
(4, 74),
(4, 75),
(4, 76),
(4, 77),
(4, 78),
(4, 79),
(4, 80),
(4, 81),
(4, 82),
(4, 83),
(4, 84),
(4, 85),
(4, 86),
(4, 87),
(4, 88),
(4, 89),
(4, 90),
(4, 91),
(4, 92),
(4, 93),
(4, 94),
(4, 95),
(4, 96),
(4, 97),
(4, 98),
(4, 99),
(4, 100),
(4, 101),
(4, 102),
(4, 103),
(4, 104),
(4, 105),
(4, 106),
(4, 107),
(4, 108),
(4, 109),
(4, 110),
(4, 111),
(4, 112),
(4, 113),
(4, 114),
(4, 115),
(4, 116),
(4, 117),
(4, 119),
(4, 120),
(4, 121),
(4, 122),
(4, 123),
(4, 124),
(4, 125),
(4, 126),
(4, 127),
(4, 128),
(4, 129),
(4, 130),
(4, 131),
(4, 132),
(4, 133),
(4, 134),
(4, 135),
(4, 136),
(4, 137),
(4, 138),
(4, 139),
(4, 140),
(4, 141),
(4, 142),
(4, 143),
(4, 144),
(4, 145),
(4, 146),
(4, 147),
(4, 148),
(4, 149),
(4, 150),
(4, 151),
(4, 152),
(4, 153),
(4, 154),
(4, 155),
(4, 156),
(4, 157),
(4, 158),
(4, 159),
(4, 160),
(4, 161),
(4, 162),
(4, 163),
(4, 164),
(4, 165),
(4, 166),
(4, 167),
(4, 168),
(4, 169),
(4, 170),
(4, 171),
(4, 172),
(4, 173),
(4, 174),
(4, 175),
(4, 176),
(4, 177),
(4, 178),
(4, 179),
(4, 180),
(4, 181),
(4, 182),
(4, 183),
(4, 184),
(4, 185),
(4, 186),
(4, 187),
(4, 188),
(4, 189),
(4, 190),
(4, 191),
(4, 192),
(4, 193),
(4, 194),
(4, 195),
(4, 196),
(4, 197),
(4, 198),
(4, 199),
(4, 200),
(4, 201),
(4, 202),
(4, 203),
(4, 204),
(4, 205),
(4, 206),
(4, 207),
(4, 208),
(4, 209),
(4, 210),
(4, 211),
(4, 212),
(4, 213),
(4, 214),
(4, 215),
(4, 216),
(4, 217),
(4, 218),
(4, 219),
(4, 220),
(4, 221),
(4, 222),
(4, 223),
(4, 224),
(4, 225),
(4, 226),
(4, 227),
(4, 228),
(4, 229),
(4, 230),
(4, 231),
(4, 232),
(4, 233),
(4, 234),
(4, 235),
(4, 236),
(4, 237),
(4, 238),
(4, 239),
(4, 240),
(4, 241),
(4, 242),
(4, 243),
(4, 244),
(4, 245),
(4, 246),
(4, 247),
(4, 248),
(4, 249),
(4, 250),
(4, 251),
(4, 252),
(4, 253),
(4, 254),
(4, 255),
(4, 256),
(4, 257),
(4, 258),
(4, 259),
(4, 260),
(4, 261),
(4, 262),
(4, 263),
(4, 264),
(4, 265),
(4, 266),
(4, 267),
(4, 268),
(4, 269),
(4, 270),
(4, 271),
(4, 272),
(4, 273),
(4, 274),
(4, 275),
(4, 276),
(4, 277),
(4, 278),
(4, 279),
(4, 280),
(4, 281),
(4, 282),
(4, 283),
(4, 284),
(4, 285),
(4, 286),
(4, 287),
(4, 288),
(4, 289),
(4, 290),
(4, 291),
(4, 292),
(4, 293),
(4, 294),
(4, 295),
(4, 296),
(4, 297),
(4, 298),
(4, 299),
(4, 300),
(4, 301),
(4, 302),
(4, 303),
(4, 304),
(4, 305),
(4, 306),
(4, 307),
(4, 308),
(4, 309),
(4, 310),
(4, 311),
(4, 312),
(4, 313),
(4, 314),
(4, 315),
(4, 316),
(4, 317),
(4, 318),
(4, 319),
(4, 320),
(4, 321),
(4, 322),
(4, 323),
(4, 324),
(4, 325),
(4, 326),
(4, 327),
(4, 328),
(4, 329),
(4, 330),
(4, 331),
(4, 332),
(4, 333),
(4, 334),
(4, 335),
(4, 336),
(4, 337),
(4, 338),
(4, 339),
(4, 340),
(4, 341),
(4, 342),
(4, 343),
(4, 344),
(4, 345),
(4, 346),
(4, 347),
(4, 348);

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_users_companies`
--

DROP TABLE IF EXISTS `muu_re_users_companies`;
CREATE TABLE IF NOT EXISTS `muu_re_users_companies` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_re_users_events`
--

DROP TABLE IF EXISTS `muu_re_users_events`;
CREATE TABLE IF NOT EXISTS `muu_re_users_events` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Event` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `muu_search`
--

DROP TABLE IF EXISTS `muu_search`;
CREATE TABLE IF NOT EXISTS `muu_search` (
  `ID_Search` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Term` varchar(255) NOT NULL,
  `Counter` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `Last_Search` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_Search`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Table structure for table `muu_tokens`
--

DROP TABLE IF EXISTS `muu_tokens`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_users`;
CREATE TABLE IF NOT EXISTS `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Privilege` mediumint(8) NOT NULL DEFAULT '4',
  `ID_Service` varchar(30) NOT NULL DEFAULT '0',
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
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Followers` mediumint(8) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
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
  `Google` varchar(150) NOT NULL,
  `Viadeo` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `muu_users` (`ID_User`, `ID_Privilege`, `ID_Service`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Avatar_Coordinate`, `Credits`, `Recommendation`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Comments`, `Posts`, `Bookmarks`, `Codes`, `Jobs`, `Subscribed`, `Followers`, `Start_Date`, `Code`, `Name`, `Age`, `Title`, `Address`, `Zip`, `Phone`, `Mobile`, `Gender`, `Relationship`, `Birthday`, `Country`, `District`, `City`, `Technologies`, `Twitter`, `Facebook`, `Linkedin`, `Google`, `Viadeo`, `Situation`) VALUES
(1, 1, '', 'admin', 'b9223847e1566884893656e84798ff39cea2b8c4', 'azapedia@gmail.com', 'http://www.codejobs.biz', 'default.png', '0,0,90,90', 1246, 2093, '', 0, 1, 0, 0, 0, 390, 42, 17, 0, 0, 0, 0, '', 'Carlos Santana Roldán', 18, '', '', '', '2323423423', '23412313123', 'M', 'Single', '04/01/1980', 'Mexico', 'Colima', 'Colima', '', '', '', '', '', '', 'Active');

DROP TABLE IF EXISTS `muu_users_cv_education`;
CREATE TABLE IF NOT EXISTS `muu_users_cv_education` (
  `ID_School` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) NOT NULL,
  `School` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Degree` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Period_From` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Period_To` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Description` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_School`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_users_cv_experiences`;
CREATE TABLE IF NOT EXISTS `muu_users_cv_experiences` (
  `ID_Experience` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) NOT NULL,
  `Company` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Job_Title` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Location` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Period_From` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Period_To` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Description` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_Experience`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `muu_users_cv_skills`;
CREATE TABLE IF NOT EXISTS `muu_users_cv_skills` (
  `ID_Skills` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned DEFAULT NULL,
  `Skills` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID_Skills`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_users_cv_summary`;
CREATE TABLE IF NOT EXISTS `muu_users_cv_summary` (
  `ID_Summary` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL,
  `Summary` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Last_Updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Summary`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

DROP TABLE IF EXISTS `muu_users_online`;
CREATE TABLE IF NOT EXISTS `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `muu_users_online_anonymous`;
CREATE TABLE IF NOT EXISTS `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `muu_users_services`;
CREATE TABLE IF NOT EXISTS `muu_users_services` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Service` varchar(30) NOT NULL,
  `Service` varchar(15) NOT NULL DEFAULT 'Facebook'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `muu_vacancy`;
CREATE TABLE IF NOT EXISTS `muu_vacancy` (
  `ID_Vacancy` smallint(8) NOT NULL AUTO_INCREMENT,
  `Job_Name` varchar(250) NOT NULL,
  `ID_Job` smallint(8) NOT NULL,
  `Job_Author` varchar(250) NOT NULL,
  `ID_UserVacancy` smallint(8) NOT NULL,
  `Vacancy` varchar(250) NOT NULL,
  `Vacancy_Email` varchar(250) NOT NULL,
  `Cv` varchar(250) NOT NULL,
  `Message` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Vacancy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

DROP TABLE IF EXISTS `muu_videos`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `muu_works`;
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
-- Table structure for table `muu_workshop`
--

DROP TABLE IF EXISTS `muu_workshop`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `muu_world`;
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
('America', 'USA', 'United Situations', 'Alabama', ''),
('America', 'USA', 'United Situations', 'Alaska', ''),
('America', 'USA', 'United Situations', 'Arizona', ''),
('America', 'USA', 'United Situations', 'Arkansas', ''),
('America', 'USA', 'United Situations', 'California', ''),
('America', 'USA', 'United Situations', 'Colorado', ''),
('America', 'USA', 'United Situations', 'Connecticut', ''),
('America', 'USA', 'United Situations', 'District of Columbia', ''),
('America', 'USA', 'United Situations', 'Florida', ''),
('America', 'USA', 'United Situations', 'Georgia', ''),
('America', 'USA', 'United Situations', 'Hawaii', ''),
('America', 'USA', 'United Situations', 'Idaho', ''),
('America', 'USA', 'United Situations', 'Illinois', ''),
('America', 'USA', 'United Situations', 'Indiana', ''),
('America', 'USA', 'United Situations', 'Iowa', ''),
('America', 'USA', 'United Situations', 'Kansas', ''),
('America', 'USA', 'United Situations', 'Kentucky', ''),
('America', 'USA', 'United Situations', 'Louisiana', ''),
('America', 'USA', 'United Situations', 'Maryland', ''),
('America', 'USA', 'United Situations', 'Massachusetts', ''),
('America', 'USA', 'United Situations', 'Michigan', ''),
('America', 'USA', 'United Situations', 'Minnesota', ''),
('America', 'USA', 'United Situations', 'Mississippi', ''),
('America', 'USA', 'United Situations', 'Missouri', ''),
('America', 'USA', 'United Situations', 'Montana', ''),
('America', 'USA', 'United Situations', 'Nebraska', ''),
('America', 'USA', 'United Situations', 'Nevada', ''),
('America', 'USA', 'United Situations', 'New Hampshire', ''),
('America', 'USA', 'United Situations', 'New Jersey', ''),
('America', 'USA', 'United Situations', 'New Mexico', ''),
('America', 'USA', 'United Situations', 'New York', ''),
('America', 'USA', 'United Situations', 'North Carolina', ''),
('America', 'USA', 'United Situations', 'Ohio', ''),
('America', 'USA', 'United Situations', 'Oklahoma', ''),
('America', 'USA', 'United Situations', 'Oregon', ''),
('America', 'USA', 'United Situations', 'Pennsylvania', ''),
('America', 'USA', 'United Situations', 'Rhode Island', ''),
('America', 'USA', 'United Situations', 'South Carolina', ''),
('America', 'USA', 'United Situations', 'South Dakota', ''),
('America', 'USA', 'United Situations', 'Tennessee', ''),
('America', 'USA', 'United Situations', 'Texas', ''),
('America', 'USA', 'United Situations', 'Utah', ''),
('America', 'USA', 'United Situations', 'Virginia', ''),
('America', 'USA', 'United Situations', 'Washington', ''),
('America', 'USA', 'United Situations', 'Wisconsin', ''),
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
-- Constraints for table `muu_tokens`
--
ALTER TABLE `muu_tokens`
  ADD CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muu_videos`
--
ALTER TABLE `muu_videos`
  ADD CONSTRAINT `muu_videos_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;
