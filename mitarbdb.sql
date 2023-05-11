-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Jan 2023 um 10:07
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mitarbdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abteilung`
--

CREATE TABLE `abteilung` (
  `Abteilungsnr.` int(255) NOT NULL,
  `Abteilung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `abteilung`
--

INSERT INTO `abteilung` (`Abteilungsnr.`, `Abteilung`) VALUES
(1, 'Einkauf'),
(2, 'Verkauf'),
(3, 'Versand'),
(4, 'Lohnbuchhaltung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `Personal-Nr.` int(255) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Vorname` varchar(255) NOT NULL,
  `Straße` varchar(255) NOT NULL,
  `Haus-Nr.` int(255) UNSIGNED NOT NULL,
  `PLZ` int(255) UNSIGNED NOT NULL,
  `Abteilungsnr.` int(255) UNSIGNED NOT NULL,
  `Resturlaub` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`Personal-Nr.`, `Name`, `Vorname`, `Straße`, `Haus-Nr.`, `PLZ`, `Abteilungsnr.`, `Resturlaub`) VALUES
(1, 'Winkler', 'Rainer', 'Altschauerberg', 8, 91448, 2, 22),
(2, 'Frosch', 'Walther', 'Jahnstraße', 61, 90522, 1, 3),
(3, 'Stark', 'Arya', 'Schneeweg', 12, 90122, 4, 28),
(4, 'Stark', 'Eddard', 'Schneeweg ', 12, 90122, 3, 24),
(5, 'Maus', 'Micky', 'Hauptstraße', 1, 90235, 3, 12),
(6, 'Maus', 'Minnie', 'Hauptstraße', 1, 90235, 4, 11),
(7, 'Grundig', 'Maximilian', 'Amalienstraße ', 2, 90762, 2, 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orte`
--

CREATE TABLE `orte` (
  `PLZ` int(255) NOT NULL,
  `Wohnort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `orte`
--

INSERT INTO `orte` (`PLZ`, `Wohnort`) VALUES
(90122, 'Winterfell'),
(90235, 'Entenhausen'),
(90522, 'Oberasbach'),
(90762, 'Fürth'),
(91448, 'Emskirchen');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abteilung`
--
ALTER TABLE `abteilung`
  ADD PRIMARY KEY (`Abteilungsnr.`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`Personal-Nr.`),
  ADD KEY `PLZ` (`PLZ`),
  ADD KEY `Abteilungsnr.` (`Abteilungsnr.`);

--
-- Indizes für die Tabelle `orte`
--
ALTER TABLE `orte`
  ADD PRIMARY KEY (`PLZ`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `Personal-Nr.` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
