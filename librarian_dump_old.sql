-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2012 at 04:45 PM
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
-- Table structure for table `appsettings`
--

CREATE TABLE IF NOT EXISTS `appsettings` (
  `settingcode` varchar(50) NOT NULL,
  `classes` varchar(255) DEFAULT NULL,
  `settingstring` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `settingvalue` varchar(255) DEFAULT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`settingcode`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appsettings`
--

INSERT INTO `appsettings` (`settingcode`, `classes`, `settingstring`, `description`, `settingvalue`, `lastupdate`, `lastupdateby`) VALUES
('author_threshold', 'numeric', 'Display "et. al." when the number of authors exceeds', 'All the authors will still be saved. This just affects the display string. Values less than or equal to zero or blank will not collapse authors to "et. al.".', '', '2012-09-05 00:06:12', 2),
('name_separator', 'required', 'Name Separator', 'Separates portions of a name (e.g. last name from first name)', ',', '2012-08-28 15:31:11', 1),
('person_separator', 'required', 'Person Separator', 'In case of multiple name inputs, this character separates one name from another.', ';', '2012-08-28 15:31:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookcompanies`
--

CREATE TABLE IF NOT EXISTS `bookcompanies` (
  `companyid` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`companyid`),
  UNIQUE KEY `companyname` (`companyname`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `bookcompanies`
--

INSERT INTO `bookcompanies` (`companyid`, `companyname`, `lastupdate`, `lastupdateby`) VALUES
(6, 'Phoenix', '2012-09-02 01:19:01', 2),
(7, 'Harcourt Books', '2012-09-02 03:10:59', 2),
(8, 'HarperCollins', '2012-09-02 03:10:59', 2),
(9, 'Riverhead Books', '2012-09-02 03:39:57', 2),
(10, 'HarperTrophy', '2012-09-02 16:43:12', 2),
(11, 'Dell Laurel-Leaf', '2012-09-02 16:59:21', 2),
(12, 'HarperOne', '2012-09-02 17:05:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

CREATE TABLE IF NOT EXISTS `bookgenres` (
  `genreid` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`genreid`,`isbn`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookgenres`
--


-- --------------------------------------------------------

--
-- Table structure for table `bookparticipants`
--

CREATE TABLE IF NOT EXISTS `bookparticipants` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  `isauthor` tinyint(1) DEFAULT '0',
  `iseditor` tinyint(1) DEFAULT '0',
  `istranslator` tinyint(1) DEFAULT '0',
  `isillustrator` tinyint(1) DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookparticipants`
--

INSERT INTO `bookparticipants` (`isbn`, `personid`, `isauthor`, `iseditor`, `istranslator`, `isillustrator`, `lastupdate`, `lastupdateby`) VALUES
('0064471047', 92, 1, 0, 0, 0, '2012-09-02 16:47:03', 2),
('0064471047', 93, 0, 0, 0, 1, '2012-09-02 16:47:03', 2),
('0064471055', 92, 1, 0, 0, 0, '2012-09-02 16:59:21', 2),
('0064471055', 93, 0, 0, 0, 1, '2012-09-02 16:59:21', 2),
('0064471063', 92, 1, 0, 0, 0, '2012-09-02 16:47:03', 2),
('0064471063', 93, 0, 0, 0, 1, '2012-09-02 16:47:03', 2),
('0064471071', 92, 1, 0, 0, 0, '2012-09-02 16:59:21', 2),
('0064471071', 93, 0, 0, 0, 1, '2012-09-02 16:59:21', 2),
('0064471098', 92, 1, 0, 0, 0, '2012-09-02 16:59:22', 2),
('0064471098', 93, 0, 0, 0, 1, '2012-09-02 16:59:22', 2),
('0064471101', 92, 1, 0, 0, 0, '2012-09-02 16:43:12', 2),
('0064471101', 93, 0, 0, 0, 1, '2012-09-02 16:43:12', 2),
('0156013053', 84, 1, 0, 0, 0, '2012-09-02 03:10:59', 2),
('0156013053', 85, 0, 0, 1, 0, '2012-09-02 03:10:59', 2),
('0440237688', 94, 1, 0, 0, 0, '2012-09-02 16:59:21', 2),
('0553377868', 84, 1, 0, 0, 0, '2012-09-02 03:10:59', 2),
('0553377868', 86, 0, 0, 1, 0, '2012-09-02 03:10:59', 2),
('9780062001719', 91, 1, 0, 0, 0, '2012-09-02 03:48:59', 2),
('9780062509598', 95, 1, 0, 0, 0, '2012-09-02 17:05:17', 2),
('9780062509598', 96, 0, 0, 1, 0, '2012-09-02 17:05:17', 2),
('9780062509598', 97, 0, 0, 1, 0, '2012-09-02 17:05:17', 2),
('9780062509598', 98, 0, 0, 1, 0, '2012-09-02 17:05:17', 2),
('9780062509598', 99, 0, 0, 1, 0, '2012-09-02 17:05:17', 2),
('9780156032834', 84, 1, 0, 0, 0, '2012-09-02 03:33:25', 2),
('9780156032834', 87, 0, 0, 1, 0, '2012-09-02 03:33:25', 2),
('9781407221441', 83, 1, 0, 0, 0, '2012-09-02 01:19:01', 2),
('9781594489501', 88, 1, 0, 0, 0, '2012-09-02 03:39:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookpersons`
--

CREATE TABLE IF NOT EXISTS `bookpersons` (
  `personid` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`personid`),
  UNIQUE KEY `uniqueNames` (`lastname`,`firstname`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `bookpersons`
--

INSERT INTO `bookpersons` (`personid`, `lastname`, `firstname`, `lastupdate`, `lastupdateby`) VALUES
(83, 'Yeats', 'William Butler', '2012-09-02 01:19:01', 2),
(84, 'Perez-Reverte', 'Arturo', '2012-09-02 03:10:59', 2),
(85, 'Peden', 'Margaret Sayers', '2012-09-02 03:10:59', 2),
(86, 'Costa', 'Margaret Jull', '2012-09-02 03:10:59', 2),
(87, 'Soto', 'Sonia', '2012-09-02 03:33:25', 2),
(88, 'Hosseini', 'Khaled', '2012-09-02 03:39:57', 2),
(91, 'Huxley', 'Aldous', '2012-09-02 03:48:59', 2),
(92, 'Lewis', 'Clive Staples', '2012-09-02 16:43:11', 2),
(93, 'Baynes', 'Pauline', '2012-09-02 16:43:11', 2),
(94, 'Lowry', 'Lois', '2012-09-02 16:59:21', 2),
(95, 'Rumi', '', '2012-09-02 17:05:17', 2),
(96, 'Barks', 'Coleman', '2012-09-02 17:05:17', 2),
(97, 'Nicholson', 'Reynold', '2012-09-02 17:05:17', 2),
(98, 'Arberry', 'A.J.', '2012-09-02 17:05:17', 2),
(99, 'Moyne', 'John', '2012-09-02 17:05:17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `year`, `lastupdate`, `lastupdateby`) VALUES
('0064471047', 'Lion, the Witch and the Wardrobe, The', 1950, '2012-09-02 16:47:02', 2),
('0064471055', 'Prince Caspian', 1951, '2012-09-02 16:59:21', 2),
('0064471063', 'Horse and His Boy, The', 1954, '2012-09-02 16:47:03', 2),
('0064471071', 'Voyage of the Dawn Treader, The', 1952, '2012-09-02 16:59:21', 2),
('0064471098', 'Silver Chair, The', 1953, '2012-09-02 16:59:22', 2),
('0064471101', 'Magician''s Nephew, The', 1995, '2012-09-02 16:43:11', 2),
('0156013053', 'Nautical Chart, The', 2001, '2012-09-02 03:10:58', 2),
('0440237688', 'Giver, The', 1993, '2012-09-02 16:59:21', 2),
('0553377868', 'Flanders Panel, The', 1990, '2012-09-02 03:10:59', 2),
('9780062001719', 'Brave New World', 2004, '2012-09-02 03:48:59', 2),
('9780062509598', 'Essential Rumi, The', 2004, '2012-09-02 17:05:17', 2),
('9780156032834', 'Club Dumas, The', 1996, '2012-09-02 03:33:25', 2),
('9781407221441', 'Selected Poems', 2010, '2012-09-02 01:19:01', 2),
('9781594489501', 'Thousand Splendid Suns, A', 2007, '2012-09-02 03:39:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `genreid` int(11) NOT NULL AUTO_INCREMENT,
  `genrename` varchar(20) DEFAULT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`genreid`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `genres`
--


-- --------------------------------------------------------

--
-- Table structure for table `imprints`
--

CREATE TABLE IF NOT EXISTS `imprints` (
  `mothercompany` int(11) NOT NULL DEFAULT '0',
  `imprintcompany` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`mothercompany`,`imprintcompany`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `imprintcompany` (`imprintcompany`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imprints`
--


-- --------------------------------------------------------

--
-- Table structure for table `leafmakers`
--

CREATE TABLE IF NOT EXISTS `leafmakers` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `companyid` int(11) NOT NULL DEFAULT '0',
  `ispublisher` tinyint(1) NOT NULL DEFAULT '0',
  `isprinter` tinyint(1) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`companyid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `companyid` (`companyid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leafmakers`
--

INSERT INTO `leafmakers` (`isbn`, `companyid`, `ispublisher`, `isprinter`, `lastupdate`, `lastupdateby`) VALUES
('0064471047', 10, 1, 0, '2012-09-02 16:47:03', 2),
('0064471055', 10, 1, 0, '2012-09-02 16:59:21', 2),
('0064471063', 10, 1, 0, '2012-09-02 16:47:03', 2),
('0064471071', 10, 1, 0, '2012-09-02 16:59:22', 2),
('0064471098', 10, 1, 0, '2012-09-02 16:59:22', 2),
('0064471101', 10, 1, 0, '2012-09-02 16:43:12', 2),
('0156013053', 7, 1, 1, '2012-09-02 03:31:10', 2),
('0440237688', 11, 1, 0, '2012-09-02 16:59:21', 2),
('0553377868', 8, 1, 1, '2012-09-02 03:11:00', 2),
('9780062001719', 8, 0, 0, '2012-09-02 03:48:59', 2),
('9780062509598', 12, 1, 0, '2012-09-02 17:05:18', 2),
('9781407221441', 6, 1, 1, '2012-09-02 01:19:01', 2),
('9781594489501', 9, 1, 1, '2012-09-02 03:39:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE IF NOT EXISTS `librarians` (
  `librarianid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `canread` tinyint(1) NOT NULL,
  `canwrite` tinyint(1) NOT NULL,
  `canexec` tinyint(1) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`librarianid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`librarianid`, `username`, `password`, `canread`, `canwrite`, `canexec`, `lastupdate`, `lastupdateby`) VALUES
(1, 'admin', '447978d02df9334482902891a0c2936f95ddebd627e957007a70ed46ac5f6b03', 1, 1, 1, '2012-08-18 11:39:07', 0),
(2, 'chad', 'cfd6b334a4d362a04ea16985af05d7ecc8f7f1641c08e1a1c54396aa37c7b282', 1, 1, 1, '2012-08-19 15:20:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pseudonyms`
--

CREATE TABLE IF NOT EXISTS `pseudonyms` (
  `personid` int(11) NOT NULL DEFAULT '0',
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `pseudolast` varchar(255) NOT NULL,
  `pseudofirst` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`personid`,`isbn`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pseudonyms`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `appsettings`
--
ALTER TABLE `appsettings`
  ADD CONSTRAINT `appsettings_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `bookcompanies`
--
ALTER TABLE `bookcompanies`
  ADD CONSTRAINT `bookcompanies_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenres_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `bookgenres_ibfk_2` FOREIGN KEY (`genreid`) REFERENCES `genres` (`genreid`),
  ADD CONSTRAINT `bookgenres_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);

--
-- Constraints for table `bookparticipants`
--
ALTER TABLE `bookparticipants`
  ADD CONSTRAINT `bookparticipants_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `bookparticipants_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `bookparticipants_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`);

--
-- Constraints for table `bookpersons`
--
ALTER TABLE `bookpersons`
  ADD CONSTRAINT `bookpersons_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `genres`
--
ALTER TABLE `genres`
  ADD CONSTRAINT `genres_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `imprints`
--
ALTER TABLE `imprints`
  ADD CONSTRAINT `imprints_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `imprints_ibfk_2` FOREIGN KEY (`mothercompany`) REFERENCES `bookcompanies` (`companyid`),
  ADD CONSTRAINT `imprints_ibfk_3` FOREIGN KEY (`imprintcompany`) REFERENCES `bookcompanies` (`companyid`);

--
-- Constraints for table `leafmakers`
--
ALTER TABLE `leafmakers`
  ADD CONSTRAINT `leafmakers_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `leafmakers_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `leafmakers_ibfk_3` FOREIGN KEY (`companyid`) REFERENCES `bookcompanies` (`companyid`);

--
-- Constraints for table `pseudonyms`
--
ALTER TABLE `pseudonyms`
  ADD CONSTRAINT `pseudonyms_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `pseudonyms_ibfk_2` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`),
  ADD CONSTRAINT `pseudonyms_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);
