-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 25. 11:05
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mutasd-mid-van`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allergen`
--

CREATE TABLE `allergen` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `allergen`
--

INSERT INTO `allergen` (`id`, `nev`) VALUES
(1, 'Glutén'),
(2, 'Tej'),
(3, 'Diófélék'),
(4, 'Tojás');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `erzekenyseg`
--

CREATE TABLE `erzekenyseg` (
  `id` int(11) NOT NULL,
  `etelId` int(11) DEFAULT NULL,
  `allergenId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `erzekenyseg`
--

INSERT INTO `erzekenyseg` (`id`, `etelId`, `allergenId`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 3, 1),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etel`
--

CREATE TABLE `etel` (
  `id` int(11) NOT NULL,
  `felhasznaloId` int(11) DEFAULT NULL,
  `etkezesId` int(11) DEFAULT NULL,
  `tapgyakId` int(11) DEFAULT NULL,
  `erzekenyseg` int(11) DEFAULT NULL,
  `etelnev` varchar(255) DEFAULT NULL,
  `elkeszitese` varchar(700) DEFAULT NULL,
  `kep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `etel`
--

INSERT INTO `etel` (`id`, `felhasznaloId`, `etkezesId`, `tapgyakId`, `erzekenyseg`, `etelnev`, `elkeszitese`, `kep`) VALUES
(1, 1, 1, 1, 1, 'Rántotta', 'Tojás felverése és megsütése', 'rantotta.jpg'),
(2, 1, 2, 2, 2, 'Tejeskávé', 'Tej és kávé összekeverése', 'tejeskave.jpg'),
(3, 2, 3, 3, 3, 'Palacsinta', 'Egy tálban keverd össze a lisztet, a sót és a cukrot. Add hozzá a tojásokat, a tejet és a szódavizet, majd keverd simára a tésztát. Ha a tészta túl sűrű, adj hozzá még egy kevés tejet. Egy serpenyőben hevíts olajat, majd süss vékony palacsintákat a tésztát.', 'palacsinta.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etkezestipus`
--

CREATE TABLE `etkezestipus` (
  `id` int(11) NOT NULL,
  `tipus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `etkezestipus`
--

INSERT INTO `etkezestipus` (`id`, `tipus`) VALUES
(1, 'Reggeli'),
(2, 'Ebéd'),
(3, 'Vacsora');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jelszo` varchar(255) DEFAULT NULL,
  `vezeteknev` varchar(255) DEFAULT NULL,
  `keresztnev` varchar(255) DEFAULT NULL,
  `szuletesiido` datetime DEFAULT NULL,
  `telefonszam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `email`, `jelszo`, `vezeteknev`, `keresztnev`, `szuletesiido`, `telefonszam`) VALUES
(1, 'teszt@example.com', 'teszt123', 'Teszt', 'Felhasználó', '2000-01-01 00:00:00', '0612345678'),
(2, 'anna@example.com', 'jelszo123', 'Kovács', 'Anna', '1998-05-15 00:00:00', '0670123456');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

CREATE TABLE `hozzavalo` (
  `id` int(11) NOT NULL,
  `etelId` int(11) DEFAULT NULL,
  `nyersanyagId` int(11) DEFAULT NULL,
  `mennyiseg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `hozzavalo`
--

INSERT INTO `hozzavalo` (`id`, `etelId`, `nyersanyagId`, `mennyiseg`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 200),
(5, 3, 3, 200),
(6, 3, 1, 2),
(7, 3, 2, 300),
(8, 3, 5, 100),
(9, 3, 9, 1),
(10, 3, 10, 20);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyersanyag`
--

CREATE TABLE `nyersanyag` (
  `id` int(11) NOT NULL,
  `hozzavalonev` varchar(255) DEFAULT NULL,
  `mertekegyseg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `nyersanyag`
--

INSERT INTO `nyersanyag` (`id`, `hozzavalonev`, `mertekegyseg`) VALUES
(1, 'tojás', 'darab'),
(2, 'tej', 'ml'),
(3, 'liszt', 'g'),
(4, 'mogyorókrém', 'g'),
(5, 'szódavíz', 'ml'),
(9, 'só', 'g'),
(10, 'cukor', 'g'),
(11, 'olaj', 'ml');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapgyak`
--

CREATE TABLE `tapgyak` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tapgyak`
--

INSERT INTO `tapgyak` (`id`, `nev`) VALUES
(1, 'Napi egyszer'),
(2, 'Napi kétszer'),
(3, 'Napi háromszor');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allergen`
--
ALTER TABLE `allergen`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `erzekenyseg`
--
ALTER TABLE `erzekenyseg`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `etel`
--
ALTER TABLE `etel`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `etkezestipus`
--
ALTER TABLE `etkezestipus`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hozzavalo`
--
ALTER TABLE `hozzavalo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `nyersanyag`
--
ALTER TABLE `nyersanyag`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tapgyak`
--
ALTER TABLE `tapgyak`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `nyersanyag`
--
ALTER TABLE `nyersanyag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
