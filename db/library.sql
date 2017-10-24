-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 24 okt 2017 kl 09:39
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

--
-- Dumpning av Data i tabell `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'JK Rowling'),
(2, 'Allende, Isabel, 1942-'),
(3, 'Fellowes, Julian'),
(4, 'Andersen, H. C.'),
(5, 'Brown, Dan, 1964-'),
(7, 'Lundell, Joakim'),
(8, 'Frisk, Viktor'),
(9, 'Forni, Michaela'),
(10, 'Brown, Brené'),
(11, 'Lynard, Marita'),
(12, 'Hägglund, Maggan'),
(13, 'Sigrell, Bo'),
(14, 'Hellsten, Tommy'),
(15, 'Erikson, Thomas'),
(16, 'Skogholm, Lena'),
(17, 'Hansen, Anders'),
(18, 'Ehdin Anandala, Sanna'),
(19, 'Johansson, Martina'),
(20, 'Enders, Giulia'),
(21, 'Perlmutter, David'),
(22, 'Nertby Aurell, Lina'),
(23, 'Litsfeldt, Lars-Erik'),
(24, 'Frenkiel, David'),
(25, 'Olsson, Nina'),
(26, 'Johansson, Elisabeth'),
(27, 'Lundin, Mia'),
(28, 'Bradford Taylor, Barbara'),
(29, 'Follett, Ken'),
(30, 'Milbourne, Anna'),
(31, ''),
(32, 'Biro, Val'),
(33, 'Tamas, Gellert');

-- --------------------------------------------------------

--
-- Tabellstruktur `author_writes_book`
--

CREATE TABLE `author_writes_book` (
  `isbn10` varchar(10) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `author_writes_book`
--

INSERT INTO `author_writes_book` (`isbn10`, `author_id`) VALUES
('9100123196', 0),
('9100167428', 29),
('9113077244', 0),
('9127132315', 33),
('9137149946', 0),
('9137150863', 0),
('9137151320', 0),
('9163612879', 0),
('9163614987', 0),
('9163915553', 0),
('9172991380', 0),
('9173631094', 0),
('9173874647', 0),
('9173875465', 0),
('9174245546', 0),
('9174245686', 0),
('9174245902', 0),
('9175037254', 0),
('9175792508', 33),
('9176176738', 32),
('9176179214', 0),
('9176630773', 30),
('9187503557', 31),
('918832303X', 0),
('9188429288', 0),
('9188479080', 0),
('9188529223', 0),
('9191919191', 1),
('NONE', 0);

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
('9100123196', '9789100123192', 'Da Vinci-koden', 'swe', '2009', NULL),
('9100146072', '9789100146078', 'Lida', 'swe', '2015', NULL),
('9100167428', '9789100167424', 'Den eviga elden', 'swe', '', NULL),
('9113050818', '9789113050812', 'Femtio nyanser av honom', 'swe', '2014', NULL),
('9113077244', '9789113077246', 'Green kitchen at home : enkel och hälsosam vegetarisk mat att njuta av varje dag', 'swe', '', NULL),
('9113079298', '9789113079295', 'Den japanske älskaren', 'swe', '', NULL),
('9127132315', '9789127132313', 'En hel sekund i livet : reportage från Prag till Kairo, 1989-2011', 'swe', '2011', NULL),
('9129691427', '9789129691429', 'En sekund i taget', 'swe', '2014', NULL),
('9137149261', '9789137149264', 'Viskande skuggor', 'swe', '', NULL),
('9137149946', '9789137149943', 'Min superkraft! : så har jag lärt mig älska min struliga adhd', 'swe', '', NULL),
('9137150677', '9789137150673', 'Allt eller inget', 'swe', '', NULL),
('9137150863', '9789137150864', 'Monster', 'swe', '', NULL),
('9137151320', '9789137151328', 'Charmen med tarmen : allt om ett av kroppens mest underskattade organ', 'swe', '', NULL),
('9150928406', '9789150928402', 'Krigets vindar över Cavendon Hall', 'swe', '', NULL),
('9163612879', '9789163612879', 'Hotet mot din hjärna : den överraskande och skrämmande sanningen om hur vete, kolhydrater och socker', 'swe', '2016', NULL),
('9163614987', '9789163614989', 'Magstarkt : en bok om tarmfloran och magens nervsystem', 'swe', '', NULL),
('9163915553', '9789163915550', 'Bemötandekoden : konsten att förstå sig på människor och få ett bättre (arbets)liv', 'swe', '2016', NULL),
('9171955038', '9789171955036', 'Bibeln', 'swe', '1999', NULL),
('9172991380', '9789172991385', 'Sagor', 'swe', '2004', NULL),
('9173631094', '9789173631099', 'Hjärnstark : hur motion och träning stärker din hjärna', 'swe', '2017', NULL),
('9173872822', '9789173872829', 'Drunkna inte i dina känslor : en överlevnadsbok för sensitivt begåvade', 'swe', '2013', NULL),
('9173874647', '9789173874649', 'Våga vara operfekt', 'swe', '2016', NULL),
('9173875465', '9789173875462', 'Resa sig stark', 'swe', '2017', NULL),
('9174245546', '9789174245547', 'Mat som läker : 140 recept som håller dig pigg, frisk och dämpar inflammationer', 'swe', '2015', NULL),
('9174245686', '9789174245684', 'Food pharmacy : en berättelse om tarmfloror, goda bakterier, forskning och antiinflammatorisk mat : ', 'swe', '2016', NULL),
('9174245902', '9789174245905', 'Mat för hormonell balans', 'swe', '2016', NULL),
('9174246178', '9789174246179', 'Nya kickstarter med Ulrika : [LCHF, Detox, 5:2, GI]', 'swe', '2016', NULL),
('9174610457', '9789174610451', 'Narcissism : jag, mig och mitt', 'swe', '2011', NULL),
('9175036460', '9789175036465', 'Störst av allt', 'swe', '2017', NULL),
('9175037254', '9789175037257', 'Omgiven av idioter : hur man förstår dem som inte går att förstå', 'swe', '', NULL),
('9175792001', '9789175792002', 'Sjuka själar', 'swe', '2016', NULL),
('917579246X', '9789175792460', 'I det sista regnet', 'swe', '', NULL),
('9175792508', '9789175792507', 'Det svenska hatet : en berättelse om vår tid', 'swe', '', NULL),
('9176176738', '9789176176733', 'Bröderna Grimms älskade sagor', 'swe', '[2016]', NULL),
('9176179214', '9789176179215', 'Bowls of goodness : smakrika, vegetariska, fulla av näring', 'swe', '', NULL),
('9176454568', '9789176454565', 'Den lilla sjöjungfrun [Elektronisk resurs]', 'swe', '2015', NULL),
('9176455335', '9789176455333', 'Tummelisa [Elektronisk resurs]', 'swe', '2015', NULL),
('9176630773', '9789176630778', 'Illustrerade sagor av H.C. Andersen', 'swe', '2016', NULL),
('9177710193', '9789177710196', 'Jag kommer hem till jul', 'swe', '', NULL),
('9187503557', '9789187503559', 'Illustrerade klassiska sagor', 'swe', 'cop. 2015', NULL),
('9188261468', '9789188261465', 'Belgravia', 'swe', '', NULL),
('918832303X', '9789188323033', 'Självkänsla : när introverta och extroverta möts', 'swe', '2016', NULL),
('9188429288', '9789188429285', 'Låt bönor förändra ditt liv', 'swe', '', NULL),
('9188479080', '9789188479082', 'Bowls : nya nyttiga snabbmaten : kyckling & biff, fisk & skaldjur, vego, smoothies, hälsoglass', 'swe', '2017', NULL),
('9188529223', '9789188529220', 'Jag är inte perfekt, tyvärr : om ångest, oro och konsten att vara snäll mot sig själv', 'swe', '', NULL),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
