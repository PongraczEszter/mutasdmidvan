-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 02. 12:13
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
CREATE DATABASE IF NOT EXISTS `mutasd` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `mutasd`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allergen`
--

DROP TABLE IF EXISTS `allergen`;
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

DROP TABLE IF EXISTS `erzekenyseg`;
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
(4, 3, 3),
(5, 8, 1),
(6, 13, 1),
(7, 1, 12),
(8, 1, 12),
(9, 3, 12),
(10, 5, 12),
(11, 6, 12),
(12, 7, 12),
(13, 7, 11),
(14, 17, 12),
(15, 20, 12),
(16, 20, 11),
(17, 22, 11),
(18, 22, 12),
(19, 24, 11),
(20, 24, 12);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etel`
--

DROP TABLE IF EXISTS `etel`;
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
(6, 2, 3, 2, 6, 'Klasszikus francia omlett', 'A tojásokat egy mélyebb tálba ütjük. Villával jól felverjük úgy, hogy habos legyen - teljesen össze kell törni, nem szabad, hogy a fehérje egyben maradjon, mert kicsapódik sütéskor.\r\nA snidlinget apróra vágjuk, hozzáadjuk a tojáshoz, sózzuk, borsozzuk.\r\nA serpenyőt előmelegítjük. Ha már jó forró, akkor adjuk hozzá a vajat. Ha felolvadt és kicsit habos, de még nem barna, akkor beleöntjük a tojást.\r\nVárunk egy percet, míg kicsit megszilárdul, majd óvatosan huzigatni kezdjük, hogy mindenhol átsüljön, de krémes maradjon.\r\nA serpenyőt kicsit megbillentjük az egyik irányba, hogy a folyékony massza nagy része oda folyjon. Így tartjuk, majd ha már eléggé megszilárdult, a vékonyabb oldalt ráhajtjuk, ', 'omlett.jpg'),
(7, 1, 2, 1, 7, 'Töltött cukkini air fryerben', 'A cukkiniket hosszában félbevágjuk, majd egy kanál segítségével kikanalazzuk a magos részét és megsózzuk. A darált húsban elkeverjük a finomra vágott vöröshagymát és a reszelt fokhagymát, az aprított petrezselymet, a daráltpaprika-krémet, sózzuk, borsozzuk, hozzáadjuk a tojást, a fűszerpaprikát és a köményt, majd az egészet összekeverjük, és a tölteléket a cukkinik közepébe kanalazzuk. Vékonyan lekenjük a tetejét az olajjal, és betesszük 18 percre a 180 fokos air fryerbe.', 'toltott.jpg'),
(8, 1, 4, 1, 8, 'Churros', 'A vizet, a vajat, a cukrot és a sót tegyük egy kis lábasba. Közepes lángon forraljuk fel.\r\n\r\nAdjuk hozzá a lisztet, közben folyamatosan kevergessük. 1-2 perc után, ha a homogén massza már elválik az edény falától, húzzuk le a tűzről.\r\n\r\nPárszor forgassuk át, hogy hűljön a tészta, ha már nem tűzforró, akkor egyesével keverjük bele a tojásokat. A homogén tésztát töltsük át egy csillagcsővel ellátott habzsákba.\r\n\r\nKészítsünk elő egy serpenyőt, öntsünk bele bő olajat, majd melegítsük fel 170 fokosra. Körülbelül 10 cm hosszú rudakat nyomjunk a forró olajba. 2-3 perc alatt aranybarnára sülnek.\r\n\r\nTegyük őket papírtörlővel bélelt tányérra, hogy a papír felszívja a felesleges olajat. Még melegen for', 'churros.jpg'),
(9, 1, 1, 1, 9, 'Gluténmentes kakaós csiga', 'A gluténmentes kakaós csigához langyos tejet összekeverjük a mézzel és belemorzsoljuk az élesztőt.\r\nEgy keverőtálba kimérjük a lisztkeveréket, hozzáadjuk a cukrot, a tojássárgáját, az olvasztott margarint és a felfuttatott élesztőt, majd egynemű tésztát gyúrunk.\r\nA tésztát lefedjük folpackkal és szobahőmérsékleten 45 percet pihentetjük.\r\nRizsliszttel megszórt felületen óvatosan átgyúrjuk a tésztát és kb. 2 mm vastag téglalapot nyújtunk belőle. A tészta tetejére egyenletesen hideg margarint reszelünk, majd hajtogatjuk: balról, jobbról, lentről és fentről.\r\nA tésztát megfordítjuk, és kb. 2 mm vastag téglalappá gyúrjuk.\r\nA kinyújtott tésztát megkenjünk olvasztott margarinnal, megszórjuk a kakaó', 'csiga.jpg'),
(10, 1, 2, 2, 10, 'Vegán spenótfőzelék', 'A kókuszolajat felforrósítjuk, majd üvegesre pároljuk rajta az aprított hagymát és fokhagymát. Ízesítjük garam masalával, sóval-borssal.\r\nAmikor már üveges és kicsit pirult a hagyma, hozzáadjuk a spenótot. Használhatunk frisset, fagyasztottat, vágottat vagy püréset is, de ha fagyasztottat használunk, előtte olvasszuk ki. Pároljuk a spenótot kb. 5 percig, közben folyamatosan kevergetve, nehogy leégjen.\r\nEkkor jöhet bele a köretnek sütött burgonyából kb. 150 gramm, valamint a kókusztej. Sűrítéshez persze használhatunk sima főtt burgonyát vagy keményítőt is, de ez a megoldás okosan kombinálja a köretet a sűrítéssel.\r\nTurmixoljuk az egészet teljesen krémesre, ha szükséges, adjunk hozzá kevés viz', 'spenot.jpg'),
(11, 1, 1, 3, 11, 'Zabkása', 'Személyenként 3-4 ek zabpelyhet önts fel annyi vízzel, hogy bőven ellepje. Főzd 5 percig, majd lefedve hagyd állni 10 percig.', 'zabkasa.jpg'),
(12, 1, 2, 1, 12, 'Csilis bab', 'A chilis bab elkészítéséhez a karikára vágott vöröshagymát olajon megpirítjuk, majd a zúzott fokhagymát is hozzápirítjuk 10 másodpercig. Rászórjuk a pirospaprikát, és felengedjük 1/2 dl vízzel.\r\nHozzáadjuk a darált húst és fehéredésig pirítjuk. A paradicsompürét vízzel hígítjuk, ráöntjük a darált húsra, megsózzuk, megborsozzuk, és csilipaprikával ízesítjük.\r\nAmikor a hús megpuhult, hozzákeverjük a leszűrt babot és a kukoricát, és 5-10 perc alatt összeforraljuk. A csilis babot forrón kínáljuk.', 'chilis.jpg'),
(13, 1, 1, 1, 13, 'Bundás kenyér', 'Tegyük fel az olajat lassan melegedni egy serpenyőben.\r\nSzeleteljük fel a kenyeret ízlés szerinti vastagságúakra. A kenyér nagyságához megfelelő edényben verjük fel a tojásokat a tejszínnel és a sóval.\r\nMártsuk bele mindkét oldalát a tojásba. A vastagabb szeleteket hagyjuk tovább benne, majd tegyük félre kissé lecsöpögni.\r\n170-180°C közötti hőmérsékleten érdemes sütni a bundáskenyeret, így nem fogja nagyon megszívni magát olajjal, és nem is ég meg hirtelen. Süssük pár percig mindkét oldalát, amíg szép aranybarna lesz.\r\nAz elkészült bundáskenyereket szedjük ki, és csepegtessük le egyből papírtörlőn.', 'kenyer.jpg'),
(14, 1, 4, 1, 14, 'Császármorzsa', 'A tojást elkeverjük az 1 dl tejjel, hozzáadjuk a cukrot, sót, reszelt citromhéjat és annyi búzadarát, hogy palacsintatészta-szerűen folyós legyen.\r\nKb. 1 óráig állni hagyjuk, néha megkeverjük, majd egy teflon vagy kerámiabevonatos edényben felolvasztjuk a kb. fél-egy evőkanálnyi vajat, és beleöntjük a masszát.\r\nAddig keverjük, sütjük, míg morzsáira nem esik szét, közben szórhatunk rá mazsolát is. Tálaláskor baracklekvárral kínáljuk.', 'csaszarmorzsa.jpg'),
(15, 1, 2, 2, 15, 'Chilis sütőtökkrémleves', 'A chilis sütőtökkrémleves elkészítésének első lépéseként az olajat közepes-magas hőmérsékleten felhevítjük egy fazékban, és megpirítjuk rajta a megtisztított és kb. 1,5 cm-es kockákra vágott sütőtököt, nagyjából 8 perc alatt. Az idő leteltével hozzáadjuk a félfőre vágott vöröshagymát, a szeletelt fokhagymát, a rozmaringleveleket, a mustárt, a reszelt gyömbért, a cukrot és a chilit, és még 2 percig pirítjuk. Ezt követően felöntjük az alaplével, és 15 perc alatt készre főzzük, majd beleöntjük a kókusztejet és homogénre turmixoljuk. Még 2 percig forraljuk és el is készültünk. Tálalásnál, betétként pirított tökmagot szórunk rá. ', 'sutotok.jpg'),
(16, 1, 1, 1, 16, 'Tejbegríz', 'Felforraljuk a tejet, majd belerakjuk a búzadarát és a cukrot. Közepes lángon, állandó kevergetés mellett főzzük, amíg besűrűsödik.\r\nA tetejét megszórjuk kakaóporral vagy csokidarabokat teszünk rá, de finom üresen is.', 'tejbegriz.jpg'),
(17, 2, 1, 1, 17, 'Brokkolis rántotta', 'A brokkolis rántotta elkészítéséhez a tojást, a rózsáira szedett brokkolit és a megtisztított fokhagymát egy konyhai aprítógépbe tesszük, megsózzuk, majd az egészet alaposan összezúzzuk.\r\n\r\nOlajat hevítünk egy serpenyőben, és kb. 2 perc alatt megsütjük benne a brokkolis tojást. A koktélparadicsomokat felkarikázzuk, és a rántotta tetejére helyezzük, hogy még mutatósabb legyen ez a villámgyors reggeli, ami egy jó kis vacsorának is megfelel. Friss kenyérrel tálaljuk.', 'brokkolis.jpg'),
(18, 2, 4, 1, 18, 'Banános smoothie', 'Az elkészítés első lépéseként egy turmixgépbe tesszük a banánokat, a mogyoróvajat, felöntjük a növényi tejjel, belecsorgatjuk a mézet és megszórjuk fahéjjal. Az egészet krémesre turmixoljuk, majd pohárba vagy elviteles palackba töltjük, és elkortyoljuk. ', 'bananos.jpg'),
(19, 2, 1, 2, 19, 'Könnyű joghurtos reggeli, eperrel', '\r\nAz epret megmossuk, lecsepegtetjük és felszeleteljük. A joghurthoz hozzákeverjük a mézet. Egy pohár aljába helyezünk néhány gerezd epret, rászórjuk egy kevés kukoricapelyhet, majd ismét epret. Rétegezzük egymás után, majd ráöntjük a tetejére a mézes joghurtot. Végül néhány szem eperrel díszítjük.', 'joghurt.jpg'),
(20, 2, 2, 1, 20, 'Sütőtökös fusilli baconnel', 'A bacont felcsíkozzuk és egy nagy serpenyőben, közepesen erős hőfokon kb. 7 perc alatt kisütjük a zsírját, aztán kivesszük és félretesszük. A visszamaradt zsíron kb. 5 perc alatt lepirítjuk a finomra vágott vöröshagymát, fokhagymát és a kb. 1 cm-es kockákra vágott sütőtököt. Felöntjük 600 ml vízzel, ízesítjük sóval és gyömbérrel, majd közepesen erős hőfokon kb. 15 perc alatt puhára főzzük a sütőtököt. Ha a víz nagyon elpárolog, akkor pótoljuk. ', 'fusilli.jpg'),
(21, 2, 4, 1, 21, 'Vegán császármorzsa almával', 'A vegán császármorzsa elkészítéséhez a megmosott mazsolát a rumba áztatjuk. A tálba szitált lisztet elvegyítjük a sütőporral. Hozzáadjuk a cukrot, majd robotgép habverőjével alacsony fokozaton belekeverjük a szójaitalt és a szódát.\r\nA meghámozott almákat a magház eltávolítása után nagyon vékonyan felszeleteljük, és a szeleteket a tésztamasszába forgatjuk.\r\nEgy nagy serpenyőben vagy palacsintasütőben felforrósítunk 2 ek margarint. Egyenletesen rátöltjük az almás tésztamasszát, és közepes tűzön hagyjuk megszilárdulni. Ezután két villa segítségével nagy darabokra szabdaljuk, majd a darabokat átfordítjuk. A maradék margarint a serpenyőbe tesszük és habzásig melegítjük. A nagy smarnidarabokat öss', 'almascsaszar.jpg'),
(22, 1, 2, 1, 22, 'Parmezános csirke spenótos kelkáposztával', 'A csirkemelleket készítsük elő: sózzuk, borsozzuk és szórjuk meg oregánóval. A hagymát és a fokhagymát aprítsuk fel. \r\nEgy nagy serpenyőben közepes lángon olvasszuk fel a vaj nagyobbik részét, és tegyünk hozzá egy keveset a szárított paradicsom olajából. Tegyük rá a csirkemelleket, és mindkét oldalukat pirítsuk addig, amíg egy kicsit megbarnulnak. Arra figyeljünk, hogy a belsejük ne maradjon nyers. Ha kész, tegyük félre. \r\n\r\nA szószhoz tegyük a maradék vajat a serpenyőbe, tegyük rá a hagymát, a fokhagymát, morzsoljuk rá az oregánót, majd adjuk hozzá a szárított paradicsomot. Lassan öntsük hozzá az alaplevet, a tejszínt, majd a végén a parmezánt, és kevergessük, amíg egynemű nem lesz. Ízlés s', 'parmezanos.jpg'),
(23, 1, 1, 1, 23, 'Klasszikus briós', 'Egy keverőtálba öntsük a tejet, a vizet, a cukrot, a sót, az élesztőt és tojássárgáját, majd keverjük össze. Adjuk hozzá a finomlisztet, és dagasszuk ki simává. Ezután adjuk hozzá a puha vajat is, amivel dagasszuk ki teljesen a tésztát.\r\nA tészta állaga akkor jó, ha puha, de nem ragadós állagú. Egy enyhén kiolajozott tálban kelesszük légmentesen letakarva nagyjából 1,5 órát.\r\nMiután szépen megkelt, szedjük szét 6 egyforma méretűre, és formázzunk belőle golyókat.\r\nSodorjuk a tésztákat nagyjából 30-35cm hosszúságú fonalakra, amiket tekerjünk fel csiga alakúra, a végét hajtsuk a briósforma alá.\r\nEzáltal kissé ki is fog magasodni a forma, de ne legyen túl csúcsos, mert el fog dőlni sülés közben.', 'brios.jpg'),
(24, 1, 2, 1, 24, 'Tepsis csirke', 'A fűszereket és az átpasszírozott fokhagymát keverjük össze a liszttel egy keverőtálban. Forgassuk meg benne a csirkecombokat, majd tegyük egy olajozott tepsibe.\r\nA vöröshagymákat szeleteljük fel, és tegyük a csirkékre. Ezután mehet rá a reszelt sajt, majd a tejfölt keverjük össze az olajjal, és borítsuk be vele az egészet.\r\nAlufóliával fedjük le, és 70 percig 200 fokon süssük.', 'tepsiscsirke.jpg'),
(25, 1, 4, 1, 25, 'Almás pite falatkák', 'A kitekert leveles tésztát 8-10 egyforma méretű háromszögre vágjuk, és megkenjük a megolvasztott vaj kétharmadával.\r\nEzután meghintjük az őrölt fahéjjal elvegyített barna cukor háromnegyedével. Az almát megmossuk, kimagozzuk, majd vékony szeletekre vágjuk, és elrendezzük a háromszögeken.\r\nFeltekerjük mindet, és kifliket formázzunk belőlük. A falatkákat sütőpapírral bélelt tepsibe tesszük, megkenjük mindet a maradék olvasztott vajjal, és megszórjuk a megmaradt fahéjas barna cukorral.\r\nVégül 200 fokra előmelegített sütőben kb. 15 perc alatt aranyszínűre sütjük a kifliket.', 'almaspite.jpg'),
(26, 1, 1, 2, 26, 'Sajtos melegszendvics', 'A kenyérszeletek mindkét oldalát megkenjük vajjal. A sajtot vékony szeletekre vágjuk, vagy lereszeljük.\r\nEgy tapadásmentes serpenyőt közepes lángon felhevítünk, majd ha már elég forró, beledobunk egy evőkanálnyi vajat. Amint elolvad, beletesszük a kenyérszeleteket.\r\nKét percig pirítjuk a kenyérszeleteket, majd megfordítjuk az egyiket, rátesszük a sajtot, és a tetejére teszünk egy másik szelet kenyeret úgy, hogy a pirított fele kerüljön a sajtra. Egy lapos szűrőlapáttal óvatosan lenyomkodjuk a szendvicset, majd másfél percig sütjük. Megfordítjuk a kenyeret, újra kicsit összenyomjuk, és másfél percig sütjük.', 'melegszendvics.jpg'),
(27, 1, 4, 1, 27, 'Karamellizált körte', 'A karamellizált körte első lépéseként a cukrot egy magas falú serpenyőben gesztenyeszínűre karamellizáljuk, majd belerakjuk a megpucolt, felezett, magházától megszabadított körtéket vágási felülettel lefelé és 1 percig pirítjuk a karamellben. Felöntjük a fehérborral és a vízzel, ízesítjük a fahéjjal, a szegfűszeggel, a csillagánizzsal, a vaníliával, sóval, a citrom reszelt héjával és kifacsart levével, és alacsony hőmérsékleten megpároljuk a körtéket. A legvégén hozzáadjuk a vajat, óvatosan elkeverjük és ebben a lében hagyjuk kihűlni a körtét, de akár így forrón is lehet már fogyasztani. ', 'korte.jpg'),
(28, 1, 2, 1, 28, 'Lángos', 'Az élesztőt elkeverjük a cukorral, egy teáskanál liszttel, és felöntjük langyos tejjel. Tíz perc alatt felfut. Egy tálba beleszitáljuk a lisztet, hozzáöntjük a sót, a felfutott élesztőt és a vizet. Alaposan kidagasztjuk, amíg sima és fényes lesz a tészta. Fontos, mert nyújtásnál így nem fog szakadni.\r\nLetakarjuk, és duplájára kelesztjük, nagyjából egy óra alatt.\r\nSzedjük egyenlő darabokra a tésztát, formázzuk ki, majd pihentessük 10 percig. Tegyük fel melegedni az olajat, és mikor már forró, kezdjük el olajos kézzel nyújtani a tésztát, hogy ne ragadjon a kezünkhöz. Süssük meg mindkét oldalát aranybarnára, majd csepegtessük le.\r\nÍzlés szerint tálaljuk.', 'langos.jpg'),
(29, 1, 3, 1, 29, 'Diétás francia saláta', 'A diétás franciasaláta első lépéseként a franciasaláta-alapot pár percre forrásban lévő vízbe dobjuk, majd leszűrjük és kihűtjük. A zöld almát meghámozzuk, kivágjuk a magházát és a csemegeuborkákkal együtt akkora kockákra vágjuk, mint amekkora a többi zöldség. Az összes zöldséget és az almát egy tálba rakjuk, majd mehet hozzá a citromlé, a kefir, a mustár, az olaj, só, bors és egy kevés eritrit. Az egészet összekeverjük, és habár akár azonnal fogyasztható, jól áll neki 1-2 óra hűtőben való pihentetés. ', 'francia.jpg'),
(30, 1, 2, 3, 30, 'Vöröslencse hummusz', 'A lencsét öblítsük át folyó víznél, majd fedő alatt, alacsony hőfokon, enyhén sós vízben főzzük puhára. Ez kb. 15 percet vesz igénybe.\r\n\r\nSzűrjük le, és 15 percig hagyjuk hűlni. Tegyük egy késes aprítóba a tahinivel, a citromlével, a fokhagymával és az ízesítőkkel együtt, és pürésítsük krémesre. Időnként állítsuk le a motort, és kaparásszuk le a tartály oldalára felragadt nagyobb darabokat. \r\n\r\nA folyékonyabb állaghoz járó motor mellett adjunk hozzá egy kevés hideg vizet, egyszerre csak 1 evőkanálnyit (de nem kötelező).\r\n\r\nAzonnal fogyaszthatjuk, a maradékot pedig hűtőben tároljuk. Chipsekhez vagy zöldségekhez mártogatósként, kenyérre kenve szendvicskrémként fogyasszuk.', 'humusz.jpg'),
(31, 1, 1, 2, 31, 'Roppanos csokis granola', 'Tegyük a magvakat aprítógépbe, és néhány másodperc alatt zúzzuk őket nagyobb darabokra.\r\n\r\nEgy nagyobb tálban keverjük össze a száraz hozzávalókat (a csoki kivételével). Egy kisebb edényben olvasszuk fel a kókuszolajat, keverjük hozzá a juharszirupot és a vaníliakivonatot, majd öntsük őket a zabos keverékre. Alaposan keverjük össze.\r\n\r\nBorítsuk egy sütőpapírral bélelt tepsibe, egyengessük el, és tegyük 170 fokra előmelegített sütőbe. Süssük 10-15 percig, vegyük ki, keverjük át, majd tegyük vissza újabb 10-15 percre.\r\n\r\nHagyjuk a tepsiben teljesen kihűlni, keverjük hozzá a csokidarabokat is, és légmentesen záródó edényben tároljuk.', 'granola.jpg'),
(32, 1, 2, 2, 32, 'Gyömbéres sárgarépa krémleves', 'Készítsd el a zöldségalaplevet.\r\nEgy nagy lábasban, egy evőkanál olívaolajon kezdd el alacsony lángon pirítani a hagymát.\r\nVágd fel a répát negyed karikákra, és dobd rá a hagymára. Vedd fel a lángot közepesre, és 15 percig pirítsd. Nem kell folyamatosan kevergetni, elég, ha félpercenként keversz rajta egyet. Ha szükségesnek érzed, adj még hozzá egy kevés olívaolajat. Kb. félúton adj hozzá jókora csipet sót, egy teáskanál barna cukrot, az apróra vágott gyömbért és a fokhagymát.\r\nHa a répák jól átsültek, öntsd fel a levest a zöldségalaplével. Ha felforrt, vedd le a lángot alacsonyra, és kissé félrebillentett fedő alatt főzd 15-20 percig. A répának puhának kell lennie, de nem pépesen szétmállón', 'repaleves.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etkezestipus`
--

DROP TABLE IF EXISTS `etkezestipus`;
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

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jelszo` varchar(255) DEFAULT NULL,
  `vezeteknev` varchar(255) DEFAULT NULL,
  `keresztnev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `email`, `jelszo`, `vezeteknev`, `keresztnev`) VALUES
(1, 'teszt@example.com', 'teszt123', 'Teszt', 'Felhasználó'),
(2, 'anna@example.com', 'jelszo123', 'Kovács', 'Anna'),
(3, 'kovacstibor@pelda.hu', '$2y$10$xEzE08NdC84ChZbES7NS5.4ZZJ8uBJ.v4AhOKwaEAH409hZou/XPq', 'Kovács', 'Tibor'),
(5, 'eszter@proba.com', '$2y$10$2Q9NGuV.PYyW3Jmbqyu9z.ICfW8ofIKwkNIc99DRJt8SHcAA9psku', 'Próba', 'Eszter'),
(6, 'terikekonyhaja@email.com', '$2y$10$7xHZ.5aIKIrUnPBmY1W8e.vr1z3KnCQkqfa0GZBucokNvQhpt1pOW', 'Teri', 'Néni');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

DROP TABLE IF EXISTS `hozzavalo`;
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
(18, 4, 13, 100),
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
(35, 5, 23, 150),
(36, 7, 25, 2),
(37, 7, 26, 500),
(38, 7, 27, 2),
(39, 7, 28, 12),
(40, 7, 1, 1),
(41, 7, 29, 2),
(42, 7, 9, 2),
(43, 7, 30, 100),
(44, 7, 31, 1),
(45, 7, 19, 2),
(46, 7, 32, 15),
(47, 7, 11, 8),
(48, 8, 3, 110),
(49, 8, 12, 50),
(50, 8, 13, 12),
(51, 8, 10, 30),
(52, 8, 9, 2),
(53, 8, 1, 2),
(54, 8, 11, 150),
(55, 8, 33, 10),
(56, 9, 34, 250),
(57, 9, 10, 50),
(58, 9, 35, 9),
(59, 9, 2, 8),
(60, 9, 13, 8),
(61, 9, 12, 75),
(62, 9, 1, 2),
(63, 9, 37, 25),
(64, 9, 38, 40),
(65, 9, 39, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyersanyag`
--

DROP TABLE IF EXISTS `nyersanyag`;
CREATE TABLE `nyersanyag` (
  `id` int(11) NOT NULL,
  `hozzavalonev` varchar(255) DEFAULT NULL,
  `mertekegyseg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `nyersanyag`
--

INSERT INTO `nyersanyag` (`id`, `hozzavalonev`, `mertekegyseg`) VALUES
(1, 'tojás', 'db'),
(2, 'tej', 'ml'),
(3, 'liszt', 'g'),
(4, 'mogyorókrém', 'g'),
(5, 'szódavíz', 'ml'),
(9, 'só', 'g'),
(10, 'cukor', 'g'),
(11, 'olaj', 'ml'),
(12, 'vaj', 'g'),
(13, 'víz', 'cl'),
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
(24, 'sajt', 'g'),
(25, 'cukkini', 'db'),
(26, 'darált sertéshús', 'g'),
(27, 'fokhagyma', 'gerezd'),
(28, 'paprika-krém', 'g'),
(29, 'őrölt kömény', 'mk'),
(30, 'vöröshagyma', 'g'),
(31, 'petrzselyem', 'csokor'),
(32, 'fűszerpaprika', 'g'),
(33, 'fahéj', 'g'),
(34, 'schar mix B', 'g'),
(35, 'porélesztő', 'g'),
(36, 'rizsliszt', 'g'),
(37, 'kakaópor', 'g'),
(38, 'porcukor', 'g'),
(39, 'vaníliás cukor', 'g');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapgyak`
--

DROP TABLE IF EXISTS `tapgyak`;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT a táblához `nyersanyag`
--
ALTER TABLE `nyersanyag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
