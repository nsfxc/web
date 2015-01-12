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
-- Database: `cooking`
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


-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
  `name` varchar(100) NOT NULL,
  `catalog` enum('vegetable','meat','dairy','condiment','fruit','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

