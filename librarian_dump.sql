-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2012 at 07:46 PM
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

INSERT INTO `authored` (`isbn`, `personid`) VALUES
('0451527984', 4),
('0451528050', 4),
('9780061561795', 1),
('9780061789694', 2),
('9780062001719', 1),
('9781407221441', 3);

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
  PRIMARY KEY (`personid`),
  UNIQUE KEY `uniqueNames` (`lastname`,`firstname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bookpersons`
--

INSERT INTO `bookpersons` (`personid`, `lastname`, `firstname`) VALUES
(1, 'Huxley', 'Aldous'),
(2, 'Winterburn', 'Emily'),
(3, 'Yeats', 'William Butler'),
(4, 'Alighieri', 'Dante');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`) VALUES
('9780061561795', 'Island'),
('9780062001719', 'Brave New World'),
('9780061789694', 'Stargazer''s Guide, The'),
('0451528050', 'Paradiso, The'),
('9781407221441', 'W.B. Yeats Selected Poems'),
('0451527984', 'Inferno, The');

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
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`librarianid`),
  UNIQUE KEY `username` (`username`)
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

INSERT INTO `printed` (`isbn`, `printerid`) VALUES
('0451527984', 3),
('0451528050', 3),
('9780061561795', 1),
('9780061789694', 1),
('9780062001719', 1),
('9781407221441', 2);

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
  `printerid` int(11) NOT NULL AUTO_INCREMENT,
  `printername` varchar(255) NOT NULL,
  PRIMARY KEY (`printerid`),
  UNIQUE KEY `printername` (`printername`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`printerid`, `printername`) VALUES
(1, 'HarperPerennial'),
(2, 'Phoenix'),
(3, 'Penguin');

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
  `year` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`publisherid`),
  KEY `publisherid` (`publisherid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `published`
--

INSERT INTO `published` (`isbn`, `publisherid`, `year`) VALUES
('9780061561795', 1, 2009),
('9780062001719', 1, 2010),
('9780061789694', 1, 2008),
('0451528050', 3, 2002),
('9781407221441', 2, 2010),
('0451527984', 3, 2002);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisherid` int(11) NOT NULL AUTO_INCREMENT,
  `publishername` varchar(255) NOT NULL,
  PRIMARY KEY (`publisherid`),
  UNIQUE KEY `publishername` (`publishername`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisherid`, `publishername`) VALUES
(1, 'HarperPerennial'),
(2, 'Phoenix'),
(3, 'Signet Classic');

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

