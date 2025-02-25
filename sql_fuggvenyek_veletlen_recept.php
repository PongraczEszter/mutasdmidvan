<?php
    include './sql_fuggvenyek.php';
    // Véletlenszerű recept lekérdezése
    function randomRecept()
    {
        global $conn;
        $muvelet = "SELECT * FROM etel ORDER BY RAND() LIMIT 1";
        return adatokLekerese($muvelet);
    }

    // Hozzávalók lekérdezése recept alapján
    function hozzavalokLekerdezese($etelId)
    {
        $muvelet = "SELECT nyersanyag.hozzavalonev, hozzavalo.mennyiseg, nyersanyag.mertekegyseg 
                    FROM hozzavalo 
                    JOIN nyersanyag ON hozzavalo.nyersanyagId = nyersanyag.id 
                    WHERE hozzavalo.etelId = $etelId";
        return adatokLekerese($muvelet);
    }

    // Elkészítési mód lekérdezése recept alapján
    function elkeszitesLekerdezese($etelId)
    {
        $muvelet = "SELECT elkeszitese FROM etel WHERE id = $etelId";
        return adatokLekerese($muvelet);
    }

?>