-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 10 2018 г., 23:52
-- Версия сервера: 5.6.14
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `homepage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `guestbook`
--

INSERT INTO `guestbook` (`id`, `username`, `email`, `homepage`, `message`, `browser`, `ip`, `created`) VALUES
(1, 'werwer', 'rawork@yandex.ru', 'http://www.test.ru', 'werwer wer wer wer', 'Chrome', 2130706433, '2018-01-10 17:48:07'),
(2, 'asd', 'rawork@yandex.ru', 'http://www.test.ru', 'retyy terg erg', 'Chrome', 2130706433, '2018-01-10 20:44:57'),
(3, 'ewyr', 'annette@mail.com', 'http://sdfsdf.ru', 'gasdg sdf sdf', 'Chrome', 2130706433, '2018-01-10 21:03:09'),
(4, 'sdfas dsfs', '343sdf@test.ru', 'http://sdfsdf.ru', 'fdsf sdf', 'Chrome', 2130706433, '2018-01-10 21:24:27'),
(5, 'fgs52', 'rawork@yandex.ru', 'http://www.test.ru', 'qew qwef wer', 'Chrome', 2130706433, '2018-01-10 21:45:24'),
(6, 'dfdfsg', 'rawork@yandex.ru', 'http://www.test.ru', 'dfgsdfg', 'Chrome', 2130706433, '2018-01-10 21:46:09'),
(7, 'dsfsf', 'ra45@yandex.ru', 'http://www.dfest.ru', 's sfdgsdfg sdgf', 'Chrome', 2130706433, '2018-01-10 21:48:44'),
(8, 'erte568578', 'ha3535@yandex.ru', 'http://www.rtrt.tu', 'ssdasdf', 'Chrome', 2130706433, '2018-01-10 21:57:10'),
(9, 'sfsdfsdf', 'sdfsdfsd@ree.we', 'http://sdfsdf.ru', 'sdf sfd sdf asdf asdf', 'Chrome', 2130706433, '2018-01-10 22:00:26'),
(10, 'sdfsdf', 'sdfsdf@test.ru', 'http://www.test.ru', 'dsfg sdfg dfg sdfg avDQNWRNWYN', 'Chrome', 2130706433, '2018-01-10 22:01:21'),
(11, 'dgsdgsdg', 'dgdsgdsfg@effer.er', 'http://dfgsdfg.we', 'safd dfsdf', 'Chrome', 2130706433, '2018-01-10 22:11:15'),
(12, 'df', 'rawork@yandex.ru', 'http://www.test.ru', 'dsfsfd', 'Chrome', 2130706433, '2018-01-10 22:16:14'),
(13, 'werwerwerwrwe', 'rawork@yandex.ru', 'http://www.test.ru', 'ewrwerwerwrewer', 'Chrome', 2130706433, '2018-01-10 22:55:26'),
(14, 'sdfsdf', 'rawork@yandex.ru', 'http://www.test.ru', 'sdfsdfsfsdf', 'Chrome', 2130706433, '2018-01-10 22:57:16'),
(15, '6456gdfgdsgsdfggf', 'rawork@yandex.ru', 'http://www.test.ru', 'kjkjkbbljb jjkbjk blkj bkjbjb lkjb jkb gsdsdf', 'Chrome', 2130706433, '2018-01-10 23:00:33');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
