<?php
session_start();
include './sql_fuggvenyek.php';

// Hibák gyűjtése egy tömbben
$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/bejelentkezes")) {
    // Adatok lekérése a form-ból
    $post = json_decode(file_get_contents('php://input'), true);
    $email = trim($post['email']);
    $jelszo = $post['jelszo'];  

    // Email validáció
    if (empty($email)) {
        $hibak[] = "Az email cím megadása kötelező.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hibak[] = "Érvénytelen email cím!";
    }

    // Jelszó validáció
    if (empty($jelszo)) {
        $hibak[] = "A jelszó megadása kötelező.";
    }

    // Ha nincs hiba, ellenőrizzük az adatbázisban
    if (empty($hibak)) {

        $stmt = $kapcsolat->prepare("SELECT id, jelszo FROM felhasznalo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_jelszo);
            $stmt->fetch();
            
            if (password_verify($jelszo, $hashed_jelszo)) {
                // Bejelentkezés sikeres, session létrehozása
                $_SESSION['felhasznalo_id'] = $id;
                $_SESSION['email'] = $email;
                echo json_encode(["valasz" => "Sikeres bejelentkezés!"]);
                exit();
            } else {
                $hibak[] = "Hibás jelszó!";
            }
        } else {
            $hibak[] = "Nincs ilyen email címmel regisztrált felhasználó.";
        }
        
        $stmt->close();
        $kapcsolat->close();
    }
}

// Hibák visszaküldése JSON formátumban
if (!empty($hibak)) {
    echo json_encode(["hibak" => $hibak]);
}
?>

?>