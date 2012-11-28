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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `muu_forums`
--

INSERT INTO `muu_forums` (`ID_Forum`, `Title`, `Slug`, `Description`, `Topics`, `Replies`, `Last_Reply`, `Last_Date`, `Language`, `Situation`) VALUES
(1, 'PHP', 'php', 'Foro de PHP', 0, 0, 0, '', 'Spanish', 'Active'),
(2, 'Diseño Web', 'diseno-web', 'Foro de Diseño Web', 0, 0, 0, '', 'Spanish', 'Active');

CREATE TABLE IF NOT EXISTS `muu_forums_posts` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Hour` varchar(15) NOT NULL DEFAULT '00:00:00',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Topic` tinyint(1) NOT NULL DEFAULT '0',
  `Tags` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Forum` (`ID_Forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `muu_forums_posts`
--

INSERT INTO `muu_forums_posts` (`ID_Post`, `ID_User`, `ID_Forum`, `ID_Parent`, `Title`, `Slug`, `Content`, `Author`, `Start_Date`, `Text_Date`, `Hour`, `Visits`, `Topic`, `Tags`, `Situation`) VALUES
(1, 1, 1, 0, 'Prueba 1', 'prueba-1', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eleifend tellus quis nisi placerat viverra. Sed non nisl ipsum. Donec quis turpis non lacus aliquet convallis sit amet sit amet diam. Sed massa ligula, viverra vel tristique non, auctor sit amet nibh. Morbi tincidunt ultricies tortor, quis feugiat nulla tincidunt non. Quisque accumsan, tortor at imperdiet hendrerit, metus velit tempor purus, vitae luctus ante diam et lacus. Suspendisse potenti. Morbi in augue vel justo iaculis varius. Sed vitae tortor lectus. Quisque suscipit ultricies sagittis. Vestibulum scelerisque convallis erat, quis pulvinar eros vulputate in. Pellentesque eu ipsum nisl, quis vulputate lectus.\r\n</p>\r\n<p>\r\nVivamus tristique, mi ornare gravida elementum, justo quam tincidunt ante, at sollicitudin lectus erat quis libero. Nam non risus odio, vitae dapibus sem. Ut vitae nibh justo, non consequat risus. Vestibulum condimentum varius ante et tempor. Donec id magna arcu. Aliquam dapibus tristique nulla, nec tincidunt nisl eleifend nec. Nam luctus lorem et ipsum blandit luctus. Nulla lacinia urna vitae turpis suscipit vel dignissim eros imperdiet. Phasellus eleifend, ipsum non condimentum facilisis, lacus urna tempus magna, eu accumsan tellus est sit amet mauris. Nam ut dictum nunc. Duis et ligula mauris. Etiam pulvinar metus nunc, sit amet auctor nulla. Duis tincidunt convallis turpis, id feugiat libero euismod eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur a lorem vitae arcu pretium fermentum. Curabitur varius varius est, ut posuere lectus malesuada vitae.\r\n</p>\r\n<p>\r\nSed eu eros ligula, id feugiat enim. Aliquam pulvinar porta nisi, quis vestibulum ipsum fermentum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam in felis nulla, vitae bibendum nulla. Morbi consequat laoreet neque nec facilisis. Nulla facilisi. Nam elementum scelerisque turpis, nec ullamcorper diam ornare feugiat. Aenean leo felis, condimentum id hendrerit condimentum, placerat vitae nibh. Quisque eu lacus ipsum, nec dapibus neque. Donec auctor tempor nulla, sed iaculis diam imperdiet vel. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Etiam convallis lorem nec libero commodo hendrerit. Etiam eu ante nibh. Cras dapibus ullamcorper eleifend. Sed rhoncus hendrerit lectus placerat gravida.\r\n</p>\r\n<p>\r\nQuisque tempor nisi vitae metus mollis tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor mattis nibh luctus varius sed ut lacus. Vestibulum sit amet est arcu. Aliquam nec sagittis ante. Donec mollis tincidunt tellus, a blandit tortor commodo ut. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum gravida elit quis metus egestas vitae aliquam purus luctus. In hac habitasse platea dictumst. Praesent rhoncus risus a elit convallis tempor.\r\n</p>\r\n<p>\r\nCurabitur eget mi elit. Morbi porttitor lectus in turpis pharetra condimentum. Mauris pretium laoreet magna, in fermentum augue tincidunt egestas. Nam aliquam lacinia pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris semper urna venenatis erat hendrerit lobortis. Phasellus in dui tellus. In nec imperdiet ante. Mauris sed dui ut neque molestie hendrerit ut quis leo. Integer ultrices diam vel risus viverra at consectetur neque pretium. Sed est lorem, aliquam eu fermentum at, fringilla et arcu. Integer consectetur venenatis justo ac imperdiet. Morbi eleifend libero sit amet risus faucibus in sollicitudin lorem consequat. Fusce id quam et sem interdum ultricies. Donec feugiat ultrices justo nec bibendum. Praesent sit amet semper sem.\r\n</p>', 'CodeJobs', 1353106114, 'Lunes', '00:00:00', 0, 0, 'php, programación', 'Active'),
(2, 1, 1, 1, 'Re: Prueba 1', 'Respuesta 1', 'Test', 'Ramón', 1353106115, '', '00:00:00', 0, 0, '', 'Active'),
(3, 1, 1, 1, 'Nuevo post', 'nuevo-post', 'Lalala', 'CodeJobs', 1353106119, '', '00:00:00', 0, 0, '', 'Active');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `muu_forums_posts`
--
ALTER TABLE `muu_forums_posts`
  ADD CONSTRAINT `muu_forums_posts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;
