-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2012 at 06:57 PM
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

INSERT INTO `appsettings` (`settingcode`, `settingstring`, `description`, `settingvalue`, `lastupdate`, `lastupdateby`) VALUES
('name_separator', 'Name Separator', 'Separates portions of a name (e.g. last name from first name)', ',', '2012-07-29 02:39:59', 1),
('person_separator', 'Person Separator', 'In case of multiple name inputs, this character separates one name from another.', ';', '2012-07-29 02:40:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `authored`
--

CREATE TABLE IF NOT EXISTS `authored` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `illustrated`
--

CREATE TABLE IF NOT EXISTS `illustrated` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'administrator', 'cfd6b334a4d362a04ea16985af05d7ecc8f7f1641c08e1a1c54396aa37c7b282', 1, 1, 1, '2012-08-02 00:54:18', 0),
(2, 'chad', 'cfd6b334a4d362a04ea16985af05d7ecc8f7f1641c08e1a1c54396aa37c7b282', 1, 1, 1, '2012-08-02 00:54:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `printed`
--

CREATE TABLE IF NOT EXISTS `printed` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `printerid` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`printerid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `printerid` (`printerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`printerid`),
  UNIQUE KEY `printername` (`printername`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`personid`,`isbn`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pseudonyms`
--


-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE IF NOT EXISTS `published` (
  `isbn` varchar(13) NOT NULL,
  `publisherid` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`publisherid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `publisherid` (`publisherid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`publisherid`),
  UNIQUE KEY `publishername` (`publishername`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `translated`
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
-- Constraints for table `authored`
--
ALTER TABLE `authored`
  ADD CONSTRAINT `authored_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `authored_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `authored_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`);

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenres_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `bookgenres_ibfk_2` FOREIGN KEY (`genreid`) REFERENCES `genres` (`genreid`),
  ADD CONSTRAINT `bookgenres_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);

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
-- Constraints for table `edited`
--
ALTER TABLE `edited`
  ADD CONSTRAINT `edited_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `edited_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `edited_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`);

--
-- Constraints for table `genres`
--
ALTER TABLE `genres`
  ADD CONSTRAINT `genres_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `illustrated`
--
ALTER TABLE `illustrated`
  ADD CONSTRAINT `illustrated_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `illustrated_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `illustrated_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`);

--
-- Constraints for table `printed`
--
ALTER TABLE `printed`
  ADD CONSTRAINT `printed_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `printed_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `printed_ibfk_3` FOREIGN KEY (`printerid`) REFERENCES `printers` (`printerid`);

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `printers_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `pseudonyms`
--
ALTER TABLE `pseudonyms`
  ADD CONSTRAINT `pseudonyms_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `pseudonyms_ibfk_2` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`),
  ADD CONSTRAINT `pseudonyms_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);

--
-- Constraints for table `published`
--
ALTER TABLE `published`
  ADD CONSTRAINT `published_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `published_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `published_ibfk_3` FOREIGN KEY (`publisherid`) REFERENCES `publishers` (`publisherid`);

--
-- Constraints for table `publishers`
--
ALTER TABLE `publishers`
  ADD CONSTRAINT `publishers_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);

--
-- Constraints for table `translated`
--
ALTER TABLE `translated`
  ADD CONSTRAINT `translated_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`),
  ADD CONSTRAINT `translated_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `translated_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`);
