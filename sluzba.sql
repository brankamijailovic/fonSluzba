-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2018 at 07:24 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sluzba`
--
CREATE DATABASE IF NOT EXISTS `sluzba` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `sluzba`;

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE IF NOT EXISTS `predmet` (
  `predmetID` int(11) NOT NULL AUTO_INCREMENT,
  `nazivPredmeta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`predmetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`predmetID`, `nazivPredmeta`) VALUES
(1, 'ITEH'),
(2, 'Projektovanje softvera'),
(3, 'Multimediji'),
(4, 'Baze podataka'),
(5, 'POIS');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE IF NOT EXISTS `prijava` (
  `predmetID` int(11) NOT NULL,
  `brojIndeksa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rokID` int(11) NOT NULL,
  `sluzbenikID` int(11) NOT NULL,
  `ocena` int(11) NOT NULL DEFAULT '5',
  `datumPrijave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`predmetID`,`brojIndeksa`,`rokID`),
  KEY `rokID` (`rokID`),
  KEY `brojIndeksa` (`brojIndeksa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`predmetID`, `brojIndeksa`, `rokID`, `sluzbenikID`, `ocena`, `datumPrijave`) VALUES
(1, '133/2014', 1, 1, 10, '2018-02-16 15:07:57'),
(2, '133/2014', 2, 2, 7, '2018-02-16 18:01:19'),
(2, '88/2014', 1, 2, 5, '2018-02-16 15:07:57'),
(3, '195/2014', 2, 2, 5, '2018-02-16 19:12:34'),
(4, '23/2014', 4, 2, 5, '2018-02-16 19:12:41'),
(5, '133/2014', 2, 2, 5, '2018-02-16 19:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `rok`
--

CREATE TABLE IF NOT EXISTS `rok` (
  `rokID` int(11) NOT NULL AUTO_INCREMENT,
  `nazivRoka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skolskaGodina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rokID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rok`
--

INSERT INTO `rok` (`rokID`, `nazivRoka`, `skolskaGodina`) VALUES
(1, 'Februarski rok', '2017/2018'),
(2, 'Junski rok', '2017/2018'),
(3, 'Julski rok', '2017/2018'),
(4, 'Septembarski rok', '2017/2018');

-- --------------------------------------------------------

--
-- Table structure for table `sluzbenik`
--

CREATE TABLE IF NOT EXISTS `sluzbenik` (
  `sluzbenikID` int(11) NOT NULL AUTO_INCREMENT,
  `imePrezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uloga` int(11) NOT NULL,
  PRIMARY KEY (`sluzbenikID`),
  KEY `uloga` (`uloga`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sluzbenik`
--

INSERT INTO `sluzbenik` (`sluzbenikID`, `imePrezime`, `username`, `password`, `uloga`) VALUES
(1, 'Slobodan Dimitrijevic', 'boba', 'boba', 1),
(2, 'Admin', 'admin', 'admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `brojIndeksa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imePrezimeStudenta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brojTelefona` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datumRodjenja` date NOT NULL,
  PRIMARY KEY (`brojIndeksa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`brojIndeksa`, `imePrezimeStudenta`, `brojTelefona`, `datumRodjenja`) VALUES
('06/2014', 'Filip Mandjusic', '065 666 4366', '1995-02-14'),
('133/2014', 'Sara Rackovic', '064 32 88 490', '1995-06-03'),
('195/2014', 'Mladen Milikic', '065 44 34 222', '1995-08-17'),
('23/2014', 'Milica Radovic', '065 3322 235', '1995-02-12'),
('88/2014', 'Milena Milikic', '064 212 4432', '1995-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE IF NOT EXISTS `uloga` (
  `ulogaID` int(11) NOT NULL AUTO_INCREMENT,
  `nazivUloge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ulogaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`ulogaID`, `nazivUloge`) VALUES
(1, 'Obican sluzbenik'),
(2, 'Administrator');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `prijava_ibfk_3` FOREIGN KEY (`brojIndeksa`) REFERENCES `student` (`brojIndeksa`),
  ADD CONSTRAINT `prijava_ibfk_1` FOREIGN KEY (`predmetID`) REFERENCES `predmet` (`predmetID`),
  ADD CONSTRAINT `prijava_ibfk_2` FOREIGN KEY (`rokID`) REFERENCES `rok` (`rokID`);

--
-- Constraints for table `sluzbenik`
--
ALTER TABLE `sluzbenik`
  ADD CONSTRAINT `sluzbenik_ibfk_1` FOREIGN KEY (`uloga`) REFERENCES `uloga` (`ulogaID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
