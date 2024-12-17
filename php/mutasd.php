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
    case 'regisztracio.html':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($bodyAdatok['felhasznalonev'], $bodyAdatok['teljesnev'], $bodyAdatok['email'], $bodyAdatok['jelszo'])) {
                $felhasznalonev = $bodyAdatok['felhasznalonev'];
                $email = $bodyAdatok['email'];
    
                // Ellenőrzés, hogy a felhasználónév vagy az email már létezik-e
                $ellenorzes_sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = ? OR email = ?";
                $lepes = adatLekeres($ellenorzes_sql, 'ss', [$felhasznalonev, $email]);
    
                if (is_array($lepes) && count($lepes) > 0) {
                    echo json_encode(['hiba' => 'A felhasználónév vagy az email cím már foglalt!']);
                    http_response_code(400);
                    exit;
                }
    
                // Ha nincs ilyen felhasználó, akkor beszúrás
                $jelszoHash = password_hash($bodyAdatok['jelszo'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO felhasznalo (felhasznalonev, teljesnev, email, jelszo) VALUES (?, ?, ?, ?)";
                $valasz = adatValtozas($sql, 'ssss', [$felhasznalonev, $bodyAdatok['teljesnev'], $email, $jelszoHash]);
    
                echo json_encode(['valasz' => $valasz]);
            } else {
                echo json_encode(['hiba' => 'Hiányzó adatok!']);
                http_response_code(400);
            }
        }
        break;
    case 'bejelentkezes.html':
        break;
    default:
        echo 'Default ág.';
        break;
    }


?>
