<?php
include "./sql_fuggvenyek.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $elkeszites = $_POST["elkeszites"];
    $hozzavalok = json_decode($_POST["hozzavalok"], true);

    if (!$elkeszites || empty($hozzavalok))
    {
        echo "Hiba: Hiányzó adatok!";
        exit;
    }

    
}
?>
