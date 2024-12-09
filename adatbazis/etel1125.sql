-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 25. 12:26
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
-- Adatbázis: `etel`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allergen`
--

CREATE TABLE `allergen` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `erzekenyseg`
--

CREATE TABLE `erzekenyseg` (
  `id` int(11) NOT NULL,
  `etelId` int(11) DEFAULT NULL,
  `allergenId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
  `elkeszitese` varchar(255) DEFAULT NULL,
  `kep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etkezestipus`
--

CREATE TABLE `etkezestipus` (
  `id` int(11) NOT NULL,
  `tipus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jelszo` varchar(255) DEFAULT NULL,
  `teljesnev` varchar(255) DEFAULT NULL,
  `felhasznalonev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `email`, `jelszo`, `teljesnev`, `felhasznalonev`) VALUES
(1, 'kincseslilla@gmail.com', 'Lilla24', 'Kincses Lilla', 'Lili00'),
(2, 'bence1987@freemail.hu', 'abc123', 'Varga Bence', 'csokimogyi'),
(3, 'zsofikaa@citromail.hu', 'cirmicica12', 'Farkas Zsófi', 'Farkas_Zsofi'),
(4, 'markk.kovacs@gmail.com', 'avilaglegnehezebbjelszava', 'Kovács Márk', 'markkovacs'),
(5, 'regenmindenjobbvolt@hotmail.com', '1961.01.29', 'Kovács Piroska', 'Piroska néni'),
(6, 'adminadmin@gmail.com', 'admin', 'Admin Admin', 'admin');

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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyersanyag`
--

CREATE TABLE `nyersanyag` (
  `id` int(11) NOT NULL,
  `hozzavalonev` varchar(255) DEFAULT NULL,
  `mertekegyseg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapgyak`
--

CREATE TABLE `tapgyak` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
