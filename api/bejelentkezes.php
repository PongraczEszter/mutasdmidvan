<?php
session_start();
include './sql_fuggvenyek.php';


$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/bejelentkezes")) {
    
    $post = json_decode(file_get_contents('php://input'), true);
    $email = trim($post['email']);
    $jelszo = $post['jelszo'];  

    if (empty($email)) {
        $hibak[] = "Az email cím megadása kötelező.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hibak[] = "Érvénytelen email cím!";
    }

    if (empty($jelszo)) {
        $hibak[] = "A jelszó megadása kötelező.";
    }

    if (empty($hibak)) {

        $stmt = $conn->prepare("SELECT id, vezeteknev, keresztnev, jelszo FROM felhasznalo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id,$vezeteknev,$keresztnev,  $hashedJelszo);
            $stmt->fetch();
            
            if (password_verify($jelszo, $hashedJelszo)) {
                $_SESSION['felhasznalo_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['nev'] = $vezeteknev." ".$keresztnev;
                echo json_encode(["valasz" => "Sikeres bejelentkezés!"], JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                $hibak[] = "Hibás jelszó!";
            }
        } else {
            $hibak[] = "Nincs ilyen email címmel regisztrált felhasználó.";
        }
        
        $stmt->close();
        $conn->close();
    }
}

if (!empty($hibak)) {
    http_response_code(400);
    echo json_encode(["hibak" => $hibak], JSON_UNESCAPED_UNICODE);
}
?>