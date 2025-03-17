-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 17. 12:52
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
(4, 'Tojás'),
(5, 'Rákféle'),
(6, 'Hal'),
(7, 'Szója'),
(8, 'Zeller'),
(9, 'Mustár'),
(10, 'Szezámmag'),
(11, 'NemVega'),
(12, 'NemVegán');

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
(3, 2, 3, 3, 3, 'Palacsinta', 'Egy tálban keverd össze a lisztet, a sót és a cukrot. Add hozzá a tojásokat, a tejet és a szódavizet, majd keverd simára a tésztát. Ha a tészta túl sűrű, adj hozzá még egy kevés tejet. Egy serpenyőben hevíts olajat, majd süss vékony palacsintákat a tésztát.', 'palacsinta.jpg'),
(4, 0, 2, 1, 4, 'Almaleves', 'Meghámozzuk az almát, kockákra vágjuk és beleteszük citromos vízbe. Megolvasztjuk a vajat, cukrot és fűszert teszünk bele. Hozzáadjuk az almát. Főzzük amíg nem puhil meg az alma. Leturmixoljuk és fogyaszthatjuk. ', 'almaleves.jpg'),
(5, 1, 2, 3, 5, 'Brokkolis sajtgolyó', 'A brokkolis sajtgolyó elkészítéséhez először a brokkolirózsákat kisebb darabokra vágjuk és egy aprítógépben morzsalékosra daráljuk. Ezt egy nagy keverőtálba rakjuk, hozzáadjuk a kétféle reszelt sajtot, a tojást és a fűszereket. Masszát gyúrunk belőle és 35 g-os golyókat formázunk.\r\n\r\nElőkészítünk egy panírpályát és megforgatjuk őket először a lisztben, majd a felvert tojásban, a zsemlemorzsában és újra a tojásban, majd megint a zsemlemorzsában. \r\n\r\nAz olajat egy lábasban 170-180 fokosra melegítjük, majd szép aranybarnára sütjük benne a fasírtokat, egyszerre 3-4 darabot. ', 'sajtgolyo.jpg'),
(6, 2, 3, 2, 6, 'Klasszikus francia omlett', 'A tojásokat egy mélyebb tálba ütjük. Villával jól felverjük úgy, hogy habos legyen - teljesen össze kell törni, nem szabad, hogy a fehérje egyben maradjon, mert kicsapódik sütéskor.\r\nA snidlinget apróra vágjuk, hozzáadjuk a tojáshoz, sózzuk, borsozzuk.\r\nA serpenyőt előmelegítjük. Ha már jó forró, akkor adjuk hozzá a vajat. Ha felolvadt és kicsit habos, de még nem barna, akkor beleöntjük a tojást.\r\nVárunk egy percet, míg kicsit megszilárdul, majd óvatosan huzigatni kezdjük, hogy mindenhol átsüljön, de krémes maradjon.\r\nA serpenyőt kicsit megbillentjük az egyik irányba, hogy a folyékony massza nagy része oda folyjon. Így tartjuk, majd ha már eléggé megszilárdult, a vékonyabb oldalt ráhajtjuk, ', 'omlett.jpg');

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
(3, 'Vacsora'),
(4, 'Desszert');

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
(2, 'anna@example.com', 'jelszo123', 'Kovács', 'Anna', '1998-05-15 00:00:00', '0670123456'),
(3, 'kovacstibor@pelda.hu', '$2y$10$xEzE08NdC84ChZbES7NS5.4ZZJ8uBJ.v4AhOKwaEAH409hZou/XPq', 'Kovács', 'Tibor', NULL, NULL),
(5, 'eszter@proba.com', '$2y$10$2Q9NGuV.PYyW3Jmbqyu9z.ICfW8ofIKwkNIc99DRJt8SHcAA9psku', 'Próba', 'Eszter', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

CREATE TABLE `hozzavalo` (
  `id` int(11) NOT NULL,
  `etelId` int(11) DEFAULT NULL,
  `nyersanyagId` int(11) DEFAULT NULL,
  `mennyiseg` double(11,0) DEFAULT NULL
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
(10, 3, 10, 20),
(11, 4, 10, 40),
(12, 1, 9, 2),
(13, 1, 11, 10),
(14, 2, 16, 300),
(15, 2, 10, 5),
(16, 4, 12, 40),
(17, 4, 14, 1200),
(18, 4, 13, 1),
(19, 4, 17, 250),
(20, 4, 18, 20),
(21, 4, 20, 2),
(22, 4, 15, 30),
(23, 6, 1, 3),
(24, 6, 9, 2),
(25, 6, 21, 75),
(26, 6, 19, 2),
(27, 6, 12, 10),
(28, 5, 22, 300),
(29, 5, 9, 2),
(30, 5, 24, 340),
(31, 5, 19, 2),
(32, 5, 11, 200),
(33, 5, 1, 5),
(34, 5, 3, 100),
(35, 5, 23, 150);

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
(11, 'olaj', 'ml'),
(12, 'vaj', 'g'),
(13, 'víz', 'l'),
(14, 'alma', 'g'),
(15, 'dió', 'g'),
(16, 'kávé', 'ml'),
(17, 'citrom', 'g'),
(18, 'keményítő', 'g'),
(19, 'bors', 'g'),
(20, 'habtejszín', 'dl'),
(21, 'snigling', 'g'),
(22, 'brokkoli', 'g'),
(23, 'zsemlemorzsa', 'g'),
(24, 'sajt', 'g');

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
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT a táblához `nyersanyag`
--
ALTER TABLE `nyersanyag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
