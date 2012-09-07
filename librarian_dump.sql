-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2012 at 05:57 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bookcompanies`
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
-- Table structure for table `bookparticipants`
--

CREATE TABLE IF NOT EXISTS `bookparticipants` (
  `isbn` varchar(13) NOT NULL DEFAULT '',
  `personid` int(11) NOT NULL DEFAULT '0',
  `roleid` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`isbn`,`personid`,`roleid`),
  KEY `lastupdateby` (`lastupdateby`),
  KEY `personid` (`personid`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookparticipants`
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
  `year` int(11) NOT NULL,
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


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) DEFAULT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateby` int(11) NOT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `rolename` (`rolename`),
  KEY `lastupdateby` (`lastupdateby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `rolename`, `lastupdate`, `lastupdateby`) VALUES
(5, 'Author', '2012-09-07 23:52:53', 2),
(6, 'Illustrator', '2012-09-07 23:52:53', 2),
(7, 'Editor', '2012-09-07 23:52:53', 2),
(8, 'Translator', '2012-09-07 23:52:53', 2);

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
  ADD CONSTRAINT `bookparticipants_ibfk_3` FOREIGN KEY (`personid`) REFERENCES `bookpersons` (`personid`),
  ADD CONSTRAINT `bookparticipants_ibfk_4` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`);

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

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`lastupdateby`) REFERENCES `librarians` (`librarianid`);
