-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2015 at 07:19 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `date`, `text`, `status`) VALUES
(1, 'Елизавета', '2015-04-14', 'Москва может соединиться с Золотым кольцом, что сейчас и есть. Очень интересно и перспективно для Москвы и регионов, это конечно, и Большой театр, обеспечить безопасность людей, это самое главное и немного истории.', 0),
(2, 'Виталий', '2015-04-16', 'Считаю, что необходимо улучшить информированность граждан о туристических объектах и создать специальный сайт. На нём поместить интерактивную карту с разбивкой по районам Москвы (инфографику). Перевести сайт на 4-5 иностранных языков и распространить ссылки на этот ресурс в Интернете. Это простимулирует как самих москвичей для посещения туристических объектов города, так и иногородних и иностранных туристов. www.mpress.ru.', 0),
(3, 'Модератор', '2015-04-23', 'Есть предложение обустроить долину реки Сетунь для отдыха на всем протяжении от МКАД до впадения в Москву-реку. Обустройство должно включать в себя строительство пешеходных и велосипедных дорожек вдоль всей реки, строительство пешеходных мостов, озеленение, установку скамеек, спортивных сооружений.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
