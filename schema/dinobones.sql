-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2012 at 12:19 PM
-- Server version: 5.1.57
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bradlet`
--

-- --------------------------------------------------------

--
-- Table structure for table `dinobones`
--

CREATE TABLE IF NOT EXISTS `dinobones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `rate_count` int(11) NOT NULL,
  `rate_total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;
