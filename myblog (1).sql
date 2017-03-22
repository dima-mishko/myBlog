-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 22 2017 г., 10:08
-- Версия сервера: 5.5.25
-- Версия PHP: 5.5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `myblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(1) NOT NULL,
  `id_post` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_post`, `date`, `comment`) VALUES
(1, 1, 2, '2017-03-01', 'its 1 comments updates'),
(3, 3, 2, '2017-03-01', 'comments vasya))))))))))))))))))))'),
(4, 1, 2, '2017-03-03', 'asdlusfdoighfdsoiughfsdiu'),
(5, 2, 2, '2017-03-03', 'dimaasdfghjk');

-- --------------------------------------------------------

--
-- Структура таблицы `heshtegs`
--

CREATE TABLE IF NOT EXISTS `heshtegs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `heshTegs` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `heshtegs`
--

INSERT INTO `heshtegs` (`id`, `id_post`, `heshTegs`) VALUES
(4, 2, '2title'),
(5, 2, 'text'),
(6, 2, 'too'),
(7, 3, '1title'),
(8, 3, 'text'),
(9, 3, 'one'),
(10, 3, 'dima'),
(15, 5, '1title'),
(16, 5, 'text'),
(17, 5, 'one'),
(18, 5, 'vasya'),
(19, 6, '2title'),
(20, 6, 'text'),
(21, 6, 'too'),
(22, 6, 'vasya'),
(31, 1, 'asdf'),
(32, 1, 'qwertyuio'),
(33, 1, 'sdfsdf');

-- --------------------------------------------------------

--
-- Структура таблицы `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `date` date NOT NULL,
  `like` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`,`id_post`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `like`
--

INSERT INTO `like` (`id`, `id_user`, `id_post`, `date`, `like`) VALUES
(4, 2, 2, '2017-03-01', '0'),
(5, 3, 2, '2017-03-01', '0'),
(6, 3, 6, '2017-03-01', '0'),
(8, 2, 6, '2017-03-03', '0'),
(12, 1, 2, '2017-03-03', '0'),
(16, 1, 3, '2017-03-03', '0'),
(17, 2, 3, '2017-03-03', '0'),
(18, 2, 5, '2017-03-03', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(64) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `date`, `title`, `image`, `text`) VALUES
(1, '1', '2017-03-01', '1 title text admin', '/myBlog/images/qqq.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 1234567890'),
(2, '1', '2017-03-01', '2 title the text', '/myBlog/images/qqq.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. \r\nThis text was edited)))'),
(3, '2', '2017-03-01', '1 title text for dima', '/myBlog/images/www.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. '),
(5, '3', '2017-03-01', '1 title text for vasya', '/myBlog/images/vvv.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. '),
(6, '3', '2017-03-01', '2 title the text vasya', '/myBlog/images/vvv.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. ');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'admin'),
(2, 'bloger');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `hesh` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_status` (`id_status`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `hesh`, `email`, `id_status`) VALUES
(1, 'admin', '$2y$10$xkNjqtz5AWuTiKh/J8UWuOHGYCrsNiJKKBOj12/ueOhW0HGoqGrwS', 'admin@as.ss', 1),
(2, 'dima', '$2y$10$NeW9hNR59DMkjJGED0OKlOB6mtfPTpuyRIemYNII6iaxtfQVKkcra', 'dima@dim.di', 2),
(3, 'vasya', '$2y$10$iNgItxk0piEqEsS2sXBhLuACTENNmTdUNy6P.NnwEJZps0Sok.hom', 'vasya@va.va', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
