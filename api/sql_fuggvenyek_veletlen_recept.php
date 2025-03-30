<?php
    include '../api/sql_fuggvenyek.php';
    function randomRecept()
    {
        global $conn;
        $muvelet = "SELECT * FROM etel ORDER BY RAND() LIMIT 1";
        return adatokLekerese($muvelet);
    }

    function randomReceptAllergennel($allergenek)
    {
        global $conn;
        $muvelet = "SELECT * FROM `etel`
        WHERE `etel`.`id` NOT IN
        ( SELECT `erzekenyseg`.`etelId` FROM `erzekenyseg` WHERE `erzekenyseg`.`allergenId` IN ($allergenek)) ORDER BY RAND() LIMIT 1;";
        return adatokLekerese($muvelet);
    }

    function hozzavalokLekerdezese($etelId)
    {
        $muvelet = "SELECT nyersanyag.hozzavalonev, hozzavalo.mennyiseg, nyersanyag.mertekegyseg 
                    FROM hozzavalo 
                    JOIN nyersanyag ON hozzavalo.nyersanyagId = nyersanyag.id 
                    WHERE hozzavalo.etelId = $etelId";
        return adatokLekerese($muvelet);
    }

    if($_SERVER["REQUEST_METHOD"] == "GET" && str_contains($_SERVER["REQUEST_URI"], "/hozzavalokLekerdezese"))
    {
        if(isset($_GET["id"]))
        {
            echo json_encode(hozzavalokLekerdezese($_GET["id"]), JSON_UNESCAPED_UNICODE);
        }
        else
        {
            echo json_encode(["alternativ" => "Feltöltés alatt..."], JSON_UNESCAPED_UNICODE);
        }
    }

    function elkeszitesLekerdezese($etelId)
    {
        $muvelet = "SELECT elkeszitese FROM etel WHERE id = $etelId";
        return adatokLekerese($muvelet);
    }

?>