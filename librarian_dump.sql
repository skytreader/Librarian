-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2012 at 09:25 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `librarian`
--

-- --------------------------------------------------------

--
-- Table structure for table `authored`
--

CREATE TABLE IF NOT EXISTS `authored` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`personid`),
  KEY `personid` (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authored`
--


-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

CREATE TABLE IF NOT EXISTS `bookgenres` (
  `genreid` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(13) NOT NULL DEFAULT '',
  PRIMARY KEY (`genreid`,`isbn`),
  KEY `isbn` (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookgenres`
--


-- --------------------------------------------------------

--
-- Table structure for table `bookpersons`
--

CREATE TABLE IF NOT EXISTS `bookpersons` (
  `personid` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  PRIMARY KEY (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bookpersons`
--


-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--


-- --------------------------------------------------------

--
-- Table structure for table `edited`
--

CREATE TABLE IF NOT EXISTS `edited` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`personid`),
  KEY `personid` (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edited`
--


-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `genreid` int(11) NOT NULL AUTO_INCREMENT,
  `genrename` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`genreid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `genres`
--


-- --------------------------------------------------------

--
-- Table structure for table `illustrated`
--

CREATE TABLE IF NOT EXISTS `illustrated` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`personid`),
  KEY `personid` (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `illustrated`
--


-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE IF NOT EXISTS `librarians` (
  `librarianid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`librarianid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`librarianid`, `username`, `password`) VALUES
(1, 'chad', 'cfd6b334a4d362a04ea16985af05d7ecc8f7f1641c08e1a1c54396aa37c7b282');

-- --------------------------------------------------------

--
-- Table structure for table `printed`
--

CREATE TABLE IF NOT EXISTS `printed` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `printerid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`printerid`),
  KEY `printerid` (`printerid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printed`
--


-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
  `printerid` int(11) NOT NULL AUTO_INCREMENT,
  `printername` varchar(255) NOT NULL,
  PRIMARY KEY (`printerid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `printers`
--


-- --------------------------------------------------------

--
-- Table structure for table `pseudonyms`
--

CREATE TABLE IF NOT EXISTS `pseudonyms` (
  `personid` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `pseudolast` varchar(255) NOT NULL,
  `pseudofirst` varchar(255) NOT NULL,
  PRIMARY KEY (`personid`,`isbn`),
  KEY `isbn` (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pseudonyms`
--


-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE IF NOT EXISTS `published` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `publisherid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`publisherid`),
  KEY `publisherid` (`publisherid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `published`
--


-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisherid` int(11) NOT NULL AUTO_INCREMENT,
  `publishername` varchar(255) NOT NULL,
  PRIMARY KEY (`publisherid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `publishers`
--


-- --------------------------------------------------------

--
-- Table structure for table `translated`
--

CREATE TABLE IF NOT EXISTS `translated` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`personid`),
  KEY `personid` (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `translated`
--

