-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 22 jan 2023 om 15:36
-- Serverversie: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP-versie: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artwebshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `biditems`
--

CREATE TABLE `biditems` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `current_offer` float DEFAULT NULL,
  `artist_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `biditems`
--

INSERT INTO `biditems` (`id`, `title`, `image_url`, `current_offer`, `artist_name`, `user_id`, `created_datetime`, `deadline`) VALUES
(54, 'The Bathers', 'https://www.artic.edu/iiif/2/2e166f7c-a959-d686-eeb0-a63a52a4d368/full/843,/0/default.jpg', 90, 'Paul Cezanne\r\nFrench, 1839-1906', 36, '2023-01-22 14:42:10', '2023-01-22 15:42:10'),
(55, 'Auvers, Panoramic View', 'https://www.artic.edu/iiif/2/90bc0cec-0d4e-9af5-3912-52a082a428e5/full/843,/0/default.jpg', 9000, 'Paul Cezanne\r\nFrench, 1839-1906', 36, '2023-01-22 16:08:14', '2023-01-22 17:08:14');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `created_datetime`, `password`) VALUES
(36, 'Guest', 'Guest@gmail.com', '2023-01-22 14:41:43', '$2y$10$MKM1.shExMlh3BPiG2FHEuQ.9f9MCc3RzKFQ2v5C82gImuaxJp8Ja');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `biditems`
--
ALTER TABLE `biditems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `biditems`
--
ALTER TABLE `biditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `biditems`
--
ALTER TABLE `biditems`
  ADD CONSTRAINT `biditems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
