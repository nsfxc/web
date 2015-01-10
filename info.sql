-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2014 at 02:27 
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `info`
--

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE IF NOT EXISTS `recette` (
  `Ingred` blob NOT NULL,
  `methode` blob NOT NULL,
  `occasion` text NOT NULL,
  `time` text NOT NULL,
  `favori` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `lg` varchar(10) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lg`, `pw`, `email`) VALUES
(2, 'e', '676e6f35cfc173f73fea9fe27699cf8185397f0c', 'we'),
(3, 'a', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'ae'),
(4, 'sdf', '9a6747fc6259aa374ab4e1bb03074b6ec672cf99', 'sdfa');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
  `name` varchar(100) NOT NULL,
  `catalog` enum('vegetable','meat','dairy','condiment','fruit','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`name`, `catalog`) VALUES
('tomate', 'vegetable'),
('potato', 'vegetable'),
('lamb', 'meat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
 ADD KEY `favori` (`favori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
