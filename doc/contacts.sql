-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 09:29 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `citys`
--

CREATE TABLE `citys` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `citys`
--

INSERT INTO `citys` (`id`, `name`) VALUES
(1, 'Exeter'),
(2, 'Bristol'),
(3, 'Plymouth'),
(4, 'London'),
(5, 'Liverpool');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `honorific_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `addr_1` varchar(255) DEFAULT NULL,
  `addr_2` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `postcode` varchar(10) NOT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `slug`, `honorific_id`, `first_name`, `last_name`, `birth_date`, `addr_1`, `addr_2`, `city_id`, `postcode`, `tel`, `email`, `status`, `created_at`, `deleted_at`) VALUES
(1, '', 1, 'Vinnie', 'Colaiuta', '0000-00-00', '', '', 1, 'EX4 4SB', '', 'vinnie@email.com', 1, '2018-05-29 19:52:30', NULL),
(2, '', 2, 'Cindy', 'Blackman', '0000-00-00', '', '', 2, 'EX4 4SB', '', 'cindy@blackman.com', 1, '2018-06-05 17:21:52', NULL),
(3, '', 1, 'Brian', 'Blade', '2008-06-01', 'foo', 'Dunkeswell Airfield', 1, 'EX1 2AB', '07778857722', 'brian@blade.com', 1, '2018-06-05 19:21:13', NULL),
(7, '', 0, 'Nate', 'Smith', '0000-00-00', 'foo', '', 1, 'EX4 4SB', '', 'nate@smith.com', 1, '2018-05-29 19:49:25', NULL),
(8, '', 0, 'Manu', 'Katche', '0000-00-00', '', '', 4, 'SW1', '', 'manu@katche.com', 1, '2018-05-29 19:50:19', NULL),
(9, '', 2, 'Karen', 'Carpenter', '0000-00-00', '', '', 3, 'PL2', '', 'karen@carpenter.com', 1, '2018-05-29 19:52:12', NULL),
(10, '', 0, 'Ringo', 'Starr', '0000-00-00', '', '', 5, 'L1', '', 'ringo@starr.com', 0, '2018-06-04 16:46:52', NULL),
(11, '', 1, 'Jack', 'DeJohnette', '0000-00-00', '', '', 4, 'SW1', '', 'jack@email.com', 1, '2018-05-29 19:57:50', NULL),
(13, '', 0, 'Gary', 'Novak', '0000-00-00', '', '', 1, 'EX4 4SB', '', 'gary@novak.com', 1, '2018-05-29 19:58:34', NULL),
(17, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 1, '2018-05-29 19:40:54', '2018-05-29 17:58:26'),
(18, '', 0, 'Ian', 'Paice', '0000-00-00', '', '', 3, 'PL2', '', 'ian@paice.com', 1, '2018-06-01 16:11:47', NULL),
(19, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 0, '2018-06-04 08:48:50', '2018-06-04 10:48:50'),
(20, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 1, '2018-05-29 19:40:54', '2018-05-29 18:45:10'),
(21, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 1, '2018-05-29 19:53:24', '2018-05-29 21:53:24'),
(22, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 1, '2018-05-29 19:40:54', '2018-05-29 18:45:18'),
(23, '', 0, 'wewer', 'woowoo', '0000-00-00', '', 'Dunkeswell Airfield', 1, 'EX4 4SB', '07778857722', 'werwer@novak.com', 1, '2018-05-29 19:40:54', '2018-05-29 18:44:56'),
(24, '', 0, 'Jojo', 'Mayer', '0000-00-00', '', '', 4, 'SW1', '', 'jojo@mayer.com', 1, '2018-06-05 13:20:09', '2018-06-05 15:20:09'),
(25, '', 0, 'Jojo', 'Mayer', '0000-00-00', '', '', 4, 'SW1', '', 'jojo@mayer.com', 1, '2018-06-05 12:38:10', NULL),
(26, '', 2, 'Tal', 'Winkenfeld', '0000-00-00', '', '', 2, 'BS1', '', 'tal@wink.com', 1, '2018-06-05 12:47:43', NULL),
(27, '', 0, 'sdfasdf', 'asdfasdf', '0000-00-00', '', '', 0, 'L1', '', 'asdas@asda.com', 0, '2018-06-05 13:21:05', '2018-06-05 15:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `honorifics`
--

CREATE TABLE `honorifics` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `honorifics`
--

INSERT INTO `honorifics` (`id`, `name`) VALUES
(1, 'Mr'),
(2, 'Ms'),
(3, 'Mrs'),
(4, 'Miss'),
(5, 'Dr'),
(6, 'Sir'),
(7, 'Professor'),
(8, 'Lord');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20180529171102);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '914S7VLevjb6JI9me0i0AO', 1268889823, 1528220656, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `honorifics`
--
ALTER TABLE `honorifics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citys`
--
ALTER TABLE `citys`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `honorifics`
--
ALTER TABLE `honorifics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
