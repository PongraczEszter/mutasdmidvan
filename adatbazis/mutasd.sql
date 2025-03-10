-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 10. 13:06
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
-- Adatbázis: `mutasd`
--

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
(3, 2, 3, 3, 3, 'Palacsinta', 'Egy tálban keverd össze a lisztet, a sót és a cukrot. Add hozzá a tojásokat, a tejet és a szódavizet, majd keverd simára a tésztát. Ha a tészta túl sűrű, adj hozzá még egy kevés tejet. Egy serpenyőben hevíts olajat, majd süss vékony palacsintákat a tésztát.', 'palacsinta.jpg'),
(4, 0, 2, 1, NULL, 'Almaleves', 'Meghámozzuk az almát, kockákra vágjuk és beleteszük citromos vízbe. Megolvasztjuk a vajat, cukrot és fűszert teszünk bele. Hozzáadjuk az almát. Főzzük amíg nem puhil meg az alma. Leturmixoljuk és fogyaszthatjuk. ', 'almaleves.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `etel`
--
ALTER TABLE `etel`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
