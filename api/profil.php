<?php
session_start();
include './sql_fuggvenyek.php';

$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "GET" && str_contains($_SERVER["REQUEST_URI"], "/osszes"))
{
    if(!$_SESSION['admin']){
        $hibak[] = "Jogosultság hiányzik a művelet elvégézéséhez.";
    }

    if(empty($hibak)) {    
        $query = "SELECT * FROM `felhasznalo`";
        echo json_encode(adatokLekerese($query), JSON_UNESCAPED_UNICODE);
        return;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && str_contains($_SERVER["REQUEST_URI"], "/sajat"))
{
    if(!isset($_SESSION['felhasznalo_id']))
    {
        $hibak[] = "Nem vagy bejelentkezve!";
    } else {    
        $query = "SELECT `email`, `vezeteknev`, `jelszo`, `keresztnev`, `szuletesiido`, `telefonszam` FROM `felhasznalo` WHERE `id` = ".$_SESSION['felhasznalo_id'];
        echo json_encode(adatokLekerese($query), JSON_UNESCAPED_UNICODE);
        return;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE" && str_contains($_SERVER["REQUEST_URI"], "/torles"))
{
    if(!$_SESSION['admin']){
        $hibak[] = "Jogosultság hiányzik a művelet elvégézéséhez.";
    }

    if(!isset($_GET['id']))
    {
        $hibak[] = "Nincs megadva melyik felhasználót kell törölni!";
    }

    if(empty($hibak)) {    
        $stmt = $conn->prepare("DELETE FROM `felhasznalo` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($stmt->affected_rows > 0)
        {
            echo json_encode(["valasz" => "Sikeres törlés!"]);
            return;
        }
        else
        {
            $hibak[] = "Található az adott felhasználó!";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/sajat_modositas"))
{
    if(!isset($_SESSION['felhasznalo_id']))
    {
        $hibak[] = "Nem vagy bejelentkezve!";
    }

    $post = json_decode(file_get_contents('php://input'), true);
    $id = $_SESSION['felhasznalo_id'];
    $email = trim($post['email']);
    $jelszo = $post['password'];
    $keresztnev = trim($post['firstName']);
    $vezeteknev = trim($post['lastName']);
    $szuletesiido = $post['birthdate'];
    $telefon = $post['phone'];

    if (
        !isset($email) || 
        !isset($jelszo) || 
        !isset($keresztnev) || 
        !isset($vezeteknev) || 
        !isset($szuletesiido) || 
        !isset($telefon)
        ) {
        $hibak[] = "Valamelyik adat nincs megadva.";
    }

    if(empty($hibak))
    {
        $stmt = $conn->prepare("SELECT `jelszo` FROM `felhasznalo` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($tarolt_jelszo);
            $stmt->fetch();

            if($tarolt_jelszo != $jelszo)
            {
                $hashedJelszo = password_hash($jelszo, PASSWORD_DEFAULT);
            }
            else
            {
                $hashedJelszo = $tarolt_jelszo;
            }
            
            $query = "UPDATE `felhasznalo` SET `email` = ?, `jelszo` = ?, `vezeteknev` = ?, `keresztnev` = ?, `szuletesiido` = ?, `telefonszam` = ? WHERE `felhasznalo`.`id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssi", $email, $hashedJelszo, $vezeteknev, $keresztnev, $szuletesiido, $telefon, $id);

            if ($stmt->execute()) {
                echo json_encode(["valasz" => "Sikeres modósítás!"]);
                exit;
            } else {
                $hibak[] = "Hiba történt a regisztráció során. Kérjük, próbáld meg később!";
            }
            $stmt->close();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/modositas"))
{
    if(!$_SESSION['admin']){
        $hibak[] = "Jogosultság hiányzik a művelet elvégézéséhez.";
    }

    $post = json_decode(file_get_contents('php://input'), true);
    $id=$post['id'];
    $email = trim($post['email']);
    $jelszo = $post['password'];
    $keresztnev = trim($post['firstName']);
    $vezeteknev = trim($post['lastName']);
    $szuletesiido = $post['birthdate'];
    $telefon = $post['phone'];
    $admin = $post['admin'];

    var_dump($post);

    if (
        !isset($id) || 
        !isset($email) || 
        !isset($jelszo) || 
        !isset($keresztnev) || 
        !isset($vezeteknev) || 
        !isset($szuletesiido) || 
        !isset($telefon) || 
        !isset($admin)
        ) {
        $hibak[] = "Valamelyik adat nincs megadva.";
    }

    if(empty($hibak))
    {
        $stmt = $conn->prepare("SELECT `jelszo` FROM `felhasznalo` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($tarolt_jelszo);
            $stmt->fetch();

            if($tarolt_jelszo != $jelszo)
            {
                $hashedJelszo = password_hash($jelszo, PASSWORD_DEFAULT);
            }
            else
            {
                $hashedJelszo = $tarolt_jelszo;
            }
            
            $query = "UPDATE `felhasznalo` SET `email` = ?, `jelszo` = ?, `vezeteknev` = ?, `keresztnev` = ?, `admin` = ?, `szuletesiido` = ?, `telefonszam` = ? WHERE `felhasznalo`.`id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssissi", $email, $hashedJelszo, $vezeteknev, $keresztnev, $admin, $szuletesiido, $telefon, $id);

            if ($stmt->execute()) {
                echo json_encode(["valasz" => "Sikeres modósítás!"]);
                exit;
            } else {
                $hibak[] = "Hiba történt a regisztráció során. Kérjük, próbáld meg később!";
            }
            $stmt->close();
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