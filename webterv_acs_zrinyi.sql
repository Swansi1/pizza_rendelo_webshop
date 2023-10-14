-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2022. Ápr 13. 17:10
-- Kiszolgáló verziója: 10.1.48-MariaDB-0+deb9u2
-- PHP verzió: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webterv_acs_zrinyi`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vezeteknev` varchar(255) NOT NULL,
  `keresztnev` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `bemutatkozas` text NOT NULL,
  `kedvenc_pizza` text NOT NULL,
  `lakcim` text NOT NULL,
  `telefonszam` varchar(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `publicData` varchar(255) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `vezeteknev`, `keresztnev`, `password`, `birth`, `bemutatkozas`, `kedvenc_pizza`, `lakcim`, `telefonszam`, `admin`, `blocked`, `publicData`) VALUES
(2, 'email@email.com', 'asd', 'asd1', '', '2022-04-12', 'asd', 'asd', 'asd', 'asd', 0, 1, '[]'),
(3, 'asd@asd.com', 'asd1', 'asd', '$2y$10$llWF8eUTZgGDfTOU0ycod./1.6aO.mHq.MXlEwiHfAZ6XUttROS9W', '1986-04-19', 'asd', 'asd', 'asd', '06705586541', 1, 0, 'a:3:{i:0;s:5:\"email\";i:1;s:10:\"keresztnev\";i:2;s:10:\"vezeteknev\";}'),
(5, 'admin@admin.com', 'admin', 'admin', '$2y$10$k8He5WjbzXoJ/v0Ttm/GZ.Wnr4WILePR3NKWrJExXDsFfGsaQuBoW', '1990-01-06', 'Szia én vagyok az admin', 'Kedvenc pizzáim', 'Szeged, Nem kell tudni utca, 21', '06701111111', 1, 0, '[]');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosar`
--

CREATE TABLE `kosar` (
  `id` int(11) NOT NULL,
  `kinel` int(11) NOT NULL,
  `pizzaid` int(11) NOT NULL,
  `db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `kosar`
--

INSERT INTO `kosar` (`id`, `kinel`, `pizzaid`, `db`) VALUES
(4, 2, 1, 1),
(5, 2, 2, 1),
(6, 2, 3, 1),
(22, 5, 1, 4),
(23, 5, 2, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `kitol` int(11) NOT NULL,
  `kinek` int(11) NOT NULL,
  `mit` text NOT NULL,
  `mikor` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pizzak`
--

CREATE TABLE `pizzak` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `ar` int(11) NOT NULL,
  `hozzavalok` varchar(255) NOT NULL,
  `akcios` tinyint(1) NOT NULL DEFAULT '0',
  `kepurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `pizzak`
--

INSERT INTO `pizzak` (`id`, `nev`, `ar`, `hozzavalok`, `akcios`, `kepurl`) VALUES
(1, 'Sajtos Pizza', 1990, 'Sajt, paradicsomszósz, mozzarella, francia sajt', 0, '/img/sajtos.jpg'),
(2, 'Margarita Pizza', 1790, 'Paradicsomszósz, mozzarellasajt', 0, '/img/marghareta.jpg'),
(3, 'Itália Pizza', 2090, 'Paradicsomszósz, fokhagymás paradicsomkockák, mozzarella, rukkola', 1, '/img/italia.jpg'),
(4, 'Sonkás Pizza', 1990, 'Paradicsomszósz, sonka, sajt', 0, '/img/sonkas.jpg'),
(5, 'Sonka-kukorica Pizza', 2190, 'Paradicsomszósz, sonka, kukorica, sajt', 1, '/img/sajtos.jpg'),
(6, 'Hawaii Pizza', 1990, 'Paradicsomszósz, sonka, ananász, sajt', 0, '/img/hawaii.jpg'),
(7, 'Magyaros Pizza', 2290, 'Paradicsomszósz, sonka, szalámi, kolbász, bacon szalonna, csípős paprika, hagyma sajt', 1, '/img/magyaros.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(11) NOT NULL,
  `ki` int(11) NOT NULL,
  `mit` int(11) NOT NULL,
  `mennyit` int(11) NOT NULL,
  `mikor` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `rendelesek`
--

INSERT INTO `rendelesek` (`id`, `ki`, `mit`, `mennyit`, `mikor`) VALUES
(4, 5, 1, 4, '2022-04-13 17:06:38'),
(5, 5, 2, 1, '2022-04-13 17:06:38');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kosar`
--
ALTER TABLE `kosar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pizzaid` (`pizzaid`);

--
-- A tábla indexei `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `pizzak`
--
ALTER TABLE `pizzak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mit` (`mit`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT a táblához `kosar`
--
ALTER TABLE `kosar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT a táblához `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT a táblához `pizzak`
--
ALTER TABLE `pizzak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kosar`
--
ALTER TABLE `kosar`
  ADD CONSTRAINT `kosar_ibfk_1` FOREIGN KEY (`pizzaid`) REFERENCES `pizzak` (`id`);

--
-- Megkötések a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD CONSTRAINT `rendelesek_ibfk_1` FOREIGN KEY (`mit`) REFERENCES `pizzak` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
