<?php
include "./sql_fuggvenyek.php";
$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/hozzavalok_kivalasztasa")) {

    $post = json_decode(file_get_contents('php://input'), true, 512, JSON_UNESCAPED_UNICODE);
    if(!isset($post["hozzavalok"]))
    {
        $hibak[]="Nincs hozzávaló megadva!";
        return;
    }
    $hozzavalok = explode(",", $post["hozzavalok"]);
    for($i=0;$i<count($hozzavalok);$i++)
    {
        $hozzavalok[$i] = trim($hozzavalok[$i]);
    }

    $bindClause1 = implode(',', array_fill(0, count($hozzavalok), '?'));
    $bindString1 = str_repeat('s', count($hozzavalok));
    $query = "SELECT * FROM `etel` WHERE `etel`.`id` IN
    (SELECT `hozzavalo`.`etelId` FROM `hozzavalo` WHERE `hozzavalo`.`nyersanyagId` IN
    (SELECT `nyersanyag`.`id` FROM `nyersanyag` WHERE `nyersanyag`.`hozzavalonev` IN (".$bindClause1.")))";
    
    if(isset($_GET["allergenek"]))
    {
        $allergenek = explode(" ", $_GET["allergenek"]);
        $bindClause2 = implode(',', array_fill(0, count($allergenek), '?'));
        $bindString2 = str_repeat('s', count($allergenek));
        $query .= "AND `etel`.`id` NOT IN
        (SELECT `erzekenyseg`.`etelId` FROM `erzekenyseg` WHERE `erzekenyseg`.`allergenId` IN (".$bindClause2."));";
    }

    $stmt = $conn->prepare($query);
    if(!isset($_GET["allergenek"]))
    {
        $stmt->bind_param($bindString1, ...$hozzavalok);
    }
    else
    {
        $stmt->bind_param($bindString1.$bindString2, ...$hozzavalok, ...$allergenek);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows != 0) {
        while ( $i = $result->fetch_assoc())  {
            $adatok[]=$i;
        }
        echo json_encode($adatok, JSON_UNESCAPED_UNICODE);
        return;
    }
}

http_response_code(400);
echo json_encode($hibak, JSON_UNESCAPED_UNICODE);
?>