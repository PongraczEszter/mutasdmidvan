<?php
session_start();
include "./sql_fuggvenyek.php";

$hibak = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && str_contains($_SERVER["REQUEST_URI"], "/feltoltes")) {
    if(!isset($_SESSION['felhasznalo_id']))
    {
        $hibak[] = "Nem vagy bejelentkezve!";
    }

    if(empty($hibak))
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $nev = trim($post['nev']);
        $elkeszitese = trim($post['elkeszites']);
        $hozzavalok = $post['hozzavalok'];
        $allergenek = $post['allergenek'];

        $stmt = $conn->prepare("INSERT INTO `etel`(`felhasznaloId`, `etelnev`, `elkeszitese`) VALUES (?,?,?)");
        $stmt->bind_param("iss", $_SESSION['felhasznalo_id'], $nev, $elkeszitese);
        $stmt->execute();
        if($stmt->affected_rows > 0)
        {
            $etelId = $stmt->insert_id;
            if(isset($hozzavalok) && count($hozzavalok) > 0)
            {
                $query = "INSERT INTO `hozzavalo`(`etelId`, `nyersanyagId`, `mennyiseg`) VALUES ";
                foreach ($hozzavalok as $value) {
                    $hozzavaloQuery = "SELECT `id` FROM `nyersanyag` WHERE `hozzavalonev` = ? AND `mertekegyseg` = ?";
                    $hozzavaloQuerySegments = array();
                    $stmt2 = $conn->prepare($hozzavaloQuery);
                    $stmt2->bind_param("ss", $value["hozzavalo"], $value["mertekegyseg"]);
                    $stmt2->execute();
                    $stmt2->store_result();
                    if ($stmt2->num_rows > 0) {
                        $stmt2->bind_result($nyersanyagId);
                        $stmt2->fetch();

                        $hozzavaloQuerySegments[] = "(".$etelId.",".$nyersanyagId.",".$value["mennyiseg"]."),";
                    }
                    else {
                        $stmt3 = $conn->prepare("INSERT INTO `nyersanyag`(`hozzavalonev`, `mertekegyseg`) VALUES (?,?)");
                        $stmt3->bind_param("ss", $value["hozzavalo"], $value["mertekegyseg"]);
                        $stmt3->execute();
                        $nyersanyagId = $stmt3->insert_id;
                        $hozzavaloQuerySegments[] = "(".$etelId.",".$nyersanyagId.",".$value["mennyiseg"].")";
                    }
                }
                $query .= join(',',$hozzavaloQuerySegments);
                $stmt = $conn->prepare($query);
                $stmt->execute();
            }
            if(isset($allergenek) && count($allergenek) > 0)
            {
                $query = "INSERT INTO `erzekenyseg`(`etelId`, `allergenId`) VALUES ";
                $querySegments = array();
                foreach ($allergenek as $value) {
                    $querySegments[] = "(".$etelId.",".$value.")";
                }
                $query .= join(',',$querySegments);
                $stmt = $conn->prepare($query);
                $stmt->execute();
            }
            echo json_encode(["valasz" => "Sikeres felvitel!"]);
            return;
        }
    }
}

if (!empty($hibak)) {
    http_response_code(400);
    echo json_encode(["hibak" => $hibak], JSON_UNESCAPED_UNICODE);
    return;
}

http_response_code(404);
?>
