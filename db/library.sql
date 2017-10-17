-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 17 okt 2017 kl 13:28
-- Serverversion: 10.1.19-MariaDB
-- PHP-version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `library`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `author_writes_book`
--

CREATE TABLE `author_writes_book` (
  `isbn10` varchar(10) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `books`
--

CREATE TABLE `books` (
  `isbn10` varchar(10) NOT NULL,
  `isbn13` varchar(13) NOT NULL DEFAULT 'NONE',
  `title` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `release_year` varchar(25) DEFAULT NULL,
  `borrower_social_secuirty_number` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `books`
--

INSERT INTO `books` (`isbn10`, `isbn13`, `title`, `language`, `release_year`, `borrower_social_secuirty_number`) VALUES
('0316029181', 'No isbn13', 'The last wish', NULL, NULL, NULL),
('0349004064', '9780349004068', 'Oryx and Crake', 'eng', '2013', NULL),
('0385721676', '9780385721677', 'Oryx & Crake', 'Margaret Atwood', NULL, NULL),
('1444707868', '9781444707861', 'It', 'eng', '2011', NULL),
('9100146072', '9789100146078', 'Lida', 'swe', '2015', NULL),
('9129691427', '9789129691429', 'En sekund i taget', 'swe', '2014', NULL),
('9137149261', '9789137149264', 'Viskande skuggor', 'swe', '', NULL),
('9175036460', '9789175036465', 'Störst av allt', 'swe', '2017', NULL),
('9175792001', '9789175792002', 'Sjuka själar', 'swe', '2016', NULL),
('917579246X', '9789175792460', 'I det sista regnet', 'swe', '', NULL),
('9191919191', '', 'Harry potter', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `history`
--

CREATE TABLE `history` (
  `social_security_number` varchar(13) NOT NULL,
  `isbn10` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `registered_books`
--

CREATE TABLE `registered_books` (
  `isbn10` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `social_security_number` varchar(13) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`social_security_number`, `first_name`, `last_name`) VALUES
('980919XXXX', 'Filip', 'Laos');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `author_writes_book`
--
ALTER TABLE `author_writes_book`
  ADD PRIMARY KEY (`isbn10`,`author_id`);

--
-- Index för tabell `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn10`);

--
-- Index för tabell `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`social_security_number`,`isbn10`,`date`);

--
-- Index för tabell `registered_books`
--
ALTER TABLE `registered_books`
  ADD PRIMARY KEY (`isbn10`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`social_security_number`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
