-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 02 sep 2016 kl 13:32
-- Serverversion: 5.7.11
-- PHP-version: 5.6.19

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

CREATE TABLE `groups` (
  `id` char(33) NOT NULL,
  `project_id` char(33) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `groups`
--

INSERT INTO `groups` (`id`, `project_id`, `name`, `description`) VALUES
('0406f973708511e696f55c260a4bf91a', '39d0597c707b11e696f55c260a4bf91a', 'Group 1', ''),
('28d1361570f611e6801400ffa023d50f', 'feb7c87c708011e696f55c260a4bf91a', 'My new group', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `projects`
--

CREATE TABLE `projects` (
  `id` char(33) NOT NULL,
  `user_id` char(33) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL
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

CREATE TABLE `users` (
  `id` char(33) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL
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

CREATE TABLE `users_in_projects` (
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

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
