-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 01 sep 2016 kl 20:59
-- Serverversion: 5.7.9
-- PHP-version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `slim-api-test`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` char(33) NOT NULL,
  `project_id` char(33) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `groups`
--

INSERT INTO `groups` (`id`, `project_id`, `name`, `description`) VALUES
('0406f973708511e696f55c260a4bf91a', '39d0597c707b11e696f55c260a4bf91a', 'Group 1', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` char(33) NOT NULL,
  `user_id` char(33) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `name`, `description`) VALUES
('39d0597c707b11e696f55c260a4bf91a', '92c62483707a11e696f55c260a4bf91a', 'Project 1', ''),
('5d0513c7707d11e696f55c260a4bf91a', '962c63e5707a11e696f55c260a4bf91a', 'Project 2', ''),
('feb7c87c708011e696f55c260a4bf91a', '92c62483707a11e696f55c260a4bf91a', 'Project 3', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(33) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`) VALUES
('92c62483707a11e696f55c260a4bf91a', 'Anders', 'Andersson'),
('962c63e5707a11e696f55c260a4bf91a', 'Test', 'Testsson');

-- --------------------------------------------------------

--
-- Tabellstruktur `users_in_projects`
--

DROP TABLE IF EXISTS `users_in_projects`;
CREATE TABLE IF NOT EXISTS `users_in_projects` (
  `user_id` char(33) NOT NULL,
  `project_id` char(33) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users_in_projects`
--

INSERT INTO `users_in_projects` (`user_id`, `project_id`) VALUES
('962c63e5707a11e696f55c260a4bf91a', 'feb7c87c708011e696f55c260a4bf91a'),
('92c62483707a11e696f55c260a4bf91a', '39d0597c707b11e696f55c260a4bf91a'),
('92c62483707a11e696f55c260a4bf91a', 'feb7c87c708011e696f55c260a4bf91a'),
('962c63e5707a11e696f55c260a4bf91a', '5d0513c7707d11e696f55c260a4bf91a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
