CREATE TABLE `felhasznalo` (
  `id` int PRIMARY KEY,
  `email` varchar(255),
  `jelszo` varchar(255),
  `vezeteknev` varchar(255),
  `keresztnev` varchar(255),
  `szuletesiido` datetime,
  `telefonszam` varchar(255)
);

CREATE TABLE `etel` (
  `id` int PRIMARY KEY,
  `felhasznaloId` int,
  `etkezesId` int,
  `tapgyakId` int,
  `erzekenyseg` int,
  `etelnev` varchar(255),
  `elkeszitese` varchar(255),
  `kep` varchar(255)
);

CREATE TABLE `etkezestipus` (
  `id` int PRIMARY KEY,
  `tipus` varchar(255)
);

CREATE TABLE `allergen` (
  `id` int PRIMARY KEY,
  `nev` varchar(255)
);

CREATE TABLE `tapgyak` (
  `id` int PRIMARY KEY,
  `nev` varchar(255)
);

CREATE TABLE `erzekenyseg` (
  `id` int PRIMARY KEY,
  `etelId` int,
  `allergenId` int
);

CREATE TABLE `nyersanyag` (
  `id` int PRIMARY KEY,
  `hozzavalonev` varchar(255),
  `mertekegyseg` varchar(255)
);

CREATE TABLE `hozzavalo` (
  `id` int PRIMARY KEY,
  `etelId` int,
  `nyersanyagId` int,
  `mennyiseg` int
);

ALTER TABLE `felhasznalo` ADD FOREIGN KEY (`id`) REFERENCES `etel` (`felhasznaloId`);
ALTER TABLE `etkezestipus` ADD FOREIGN KEY (`id`) REFERENCES `etel` (`etkezesId`);
ALTER TABLE `etel` ADD FOREIGN KEY (`id`) REFERENCES `hozzavalo` (`etelId`);
ALTER TABLE `erzekenyseg` ADD FOREIGN KEY (`id`) REFERENCES `etel` (`id`);
ALTER TABLE `nyersanyag` ADD FOREIGN KEY (`id`) REFERENCES `hozzavalo` (`nyersanyagId`);
ALTER TABLE `tapgyak` ADD FOREIGN KEY (`id`) REFERENCES `etel` (`tapgyakId`);
ALTER TABLE `allergen` ADD FOREIGN KEY (`id`) REFERENCES `erzekenyseg` (`allergenId`);
