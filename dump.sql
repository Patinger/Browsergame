-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 14. Mai 2014 um 10:43
-- Server Version: 5.5.33
-- PHP-Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `arma_library`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`id`, `surname`, `name`, `birthdate`) VALUES
(1, 'Plutka', 'Björn', '1982-02-06'),
(2, 'Mustermann', 'Max', '1970-12-13');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `releaseDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `book`
--

INSERT INTO `book` (`id`, `id_author`, `title`, `pages`, `releaseDate`) VALUES
(2, 1, 'a', 123123, '2012-03-23'),
(7, 2, 'dsfsdf', 213, '2012-12-12');
