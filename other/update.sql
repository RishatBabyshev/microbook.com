--
-- Структура таблицы `u_privilege`
--

CREATE TABLE IF NOT EXISTS `u_privilege` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `u_privilege`
--

INSERT INTO `u_privilege` (`id`, `name`) VALUES
(1, 'CREATE_USER'),
(2, 'EDIT_USER'),
(3, 'DELETE_USER'),
(4, 'CREATE_ARTICLE'),
(5, 'EDIT_ARTICLE'),
(6, 'DELETE_ARTICLE'),
(7, 'ADD_CATEGORY'),
(8, 'EDIT_CATEGORY'),
(9, 'DELETE_CATEGORY'),
(10, 'ADD_ROLE'),
(11, 'EDIT_ROLE'),
(12, 'DELETE_ROLE'),
(13, 'ADD_PRIVELEGE'),
(14, 'EDIT_PRIVELEGE'),
(15, 'DELETE_PRIVELEGE'),
(16, 'EDIT_GLOBAL_SETTINGS');

-- --------------------------------------------------------

--
-- Структура таблицы `u_role`
--

CREATE TABLE IF NOT EXISTS `u_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `u_role`
--

INSERT INTO `u_role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Структура таблицы `u_role_privilege`
--

CREATE TABLE IF NOT EXISTS `u_role_privilege` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `privilege_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `u_role_privilege`
--

INSERT INTO `u_role_privilege` (`id`, `role_id`, `privilege_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 2, 4),
(18, 2, 5),
(19, 2, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
