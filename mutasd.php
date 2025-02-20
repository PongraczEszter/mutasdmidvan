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
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $osszesfelhasznalo_sql = "";
            $osszesfelhasznalo = adatLekeres($osszesfelhasznalo_sql);
            if (is_array($osszesfelhasznalo)) {
                echo json_encode($osszesfelhasznalo, JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    default:
        echo 'Default ág a Switch-Casebe.';
        break;
    }


?>
