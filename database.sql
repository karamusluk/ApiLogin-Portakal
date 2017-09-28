-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2017 at 04:49 PM
-- Server version: 5.5.57-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mustafa2_dgm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_IP`
--

CREATE TABLE `client_IP` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_IP`
--

INSERT INTO `client_IP` (`id`, `ip`, `type`) VALUES
(1, '178.247.188.124', 'default'),
(2, '138.197.138.136', 'default'),
(8, '91.93.54.227', 'default'),
(5, '127.0.0', 'range'),
(7, '178.247.106.118', 'default'),
(11, '91.93.54', 'range');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'google', '112254372229819109622', 'Mustafa', 'Culban', 'karamusluk@gmail.com', 'male', 'tr', 'https://lh4.googleusercontent.com/-Vcux9zPZGJ0/AAAAAAAAAAI/AAAAAAAAAI8/ke1wLW6MOyE/photo.jpg', 'https://plus.google.com/+MustafaCulban', '2017-08-09 15:09:48', '2017-08-25 14:22:46'),
(2, 'google', '112603211850252698573', 'Mustafa', 'Culban', 'mustafaculban1@gmail.com', '', 'tr', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'https://plus.google.com/112603211850252698573', '2017-08-09 16:39:37', '2017-08-22 15:28:50'),
(3, 'google', '117866089694561382582', 'Selim', 'karaÃ¼zÃ¼m', 'selim.karauzum@gmail.com', 'male', 'tr', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'https://plus.google.com/117866089694561382582', '2017-08-11 10:26:52', '2017-08-11 10:26:53'),
(4, 'google', '106407894522367701164', 'Rozerin', 'AktaÅŸ', 'rozerinaktas@gmail.com', '', 'en', 'https://lh5.googleusercontent.com/-GRc5MDNoV1s/AAAAAAAAAAI/AAAAAAAAB7E/iWik-E7Njbg/photo.jpg', 'https://plus.google.com/106407894522367701164', '2017-08-21 10:52:31', '2017-08-23 12:39:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_IP`
--
ALTER TABLE `client_IP`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_IP`
--
ALTER TABLE `client_IP`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
