<?php
function adatLekeres($muvelet, $tipus = null, $sqlparameter = null){
    $db = new mysqli('localhost', 'root', '', 'mutasd');

    if ($db->connect_errno != 0) return $db -> connect_error;

    if(!is_null($tipus) && !is_null($sqlparameter)){
        $stmt = $db -> prepare($muvelet);
        $stmt->bind_param($tipus, ...$sqlparameter);
        $stmt->execute();
        $eredmeny = $stmt->get_result();
    }
    else $eredmeny = $db -> query($muvelet);

    if($db -> errno != 0) return $db -> error;

    if($eredmeny -> num_rows == 0) return 'Nincsenek találatok!';

    return $eredmeny -> fetch_all(MYSQLI_ASSOC);
}

function adatValtozas($muvelet, $tipus = null, $sqlparameter = null){
    $db = new mysqli('localhost', 'root', '', 'mutasd');

    if ($db->connect_errno != 0) return $db -> connect_error;

    if(!is_null($tipus) && !is_null($sqlparameter)){
        $stmt = $db -> prepare($muvelet);
        $stmt->bind_param($tipus, ...$sqlparameter);
        $stmt->execute();
    }
    else $db -> query($muvelet);

    if($db -> errno != 0) return $db -> error;

    return $db -> affected_rows > 0 ? 'Sikeres művelet!' : 'Sikertelen művelet!';
}


$teljesURL = explode('/', $_SERVER['REQUEST_URI']);
$url = explode('?', end($teljesURL))[0];

$bodyAdatok = json_decode(file_get_contents('php://input'), true);

switch (mb_strtolower($url)) {
    case 'napokszama':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $napokszama_sql = "SELECT ROUND(SUM(((film.hossz)/60))/10, 0) AS napokszama FROM `film` WHERE film.youtube = 1;";
            $napokszama = adatLekeres($napokszama_sql);
            if (is_array($napokszama)) {
                echo json_encode($napokszama, JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    case 'haborualatt' :
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $haborualatt_sql = "SELECT COUNT(film.id) AS haborualatt FROM `film` WHERE film.gyartas BETWEEN 1939 AND 1945;";
            $haborualatt = adatLekeres($haborualatt_sql);
            if (is_array($haborualatt)) {
                echo json_encode($haborualatt, JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
        case 'youtubra':
            if($_SERVER['REQUEST_METHOD'] == 'PUT') {
                if(!empty($bodyAdatok["id"])){
                    $youtubra_sql = "UPDATE film SET youtube = '1' WHERE film.id = ?;";
                    $youtubra = adatValtozas($youtubra_sql, 'i', [$bodyAdatok['id']]);
                    $youtubraID_sql = "SELECT * FROM film WHERE id = ?";
                    $youtubraID = adatLekeres($youtubraID_sql, 'i', [$bodyAdatok['id']]);
                    echo json_encode(['valasz' => $youtubraID], JSON_UNESCAPED_UNICODE);
                    header('OK', true, 200);
                }
                else{
                    echo json_encode(['valasz' => 'Hiányos adatok!'], JSON_UNESCAPED_UNICODE);
                    header('bad request', true, 400);
                }
            }
            else{
                echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
                header('bad request', true, 400);
            }
            break;
    default:
        echo 'Alapértelmezett.';
        break;
}

?>



case 'regisztracio.html':
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bodyAdatok = json_decode(file_get_contents('php://input'), true);
        if (isset($bodyAdatok['felhasznalonev'], $bodyAdatok['teljesnev'], $bodyAdatok['email'], $bodyAdatok['jelszo'])) {
            $jelszoHash = password_hash($bodyAdatok['jelszo'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO felhasznalok (felhasznalonev, teljesnev, email, jelszo) VALUES (?, ?, ?, ?)";
            $valasz = adatValtozas($sql, 'ssss', [$bodyAdatok['felhasznalonev'], $bodyAdatok['teljesnev'], $bodyAdatok['email'], $jelszoHash]);
            echo json_encode(['valasz' => $valasz]);
        } else {
            echo json_encode(['hiba' => 'Hiányzó adatok!']);
            http_response_code(400);
        }
    }
    break;
