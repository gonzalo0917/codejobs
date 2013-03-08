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
