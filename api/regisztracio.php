<?php
include '../sql_fuggvenyek.php';

// Hibák gyűjtése egy tömbben
$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/regisztracio")) {
    // Adatok lekérése a form-ból
    $post = json_decode(file_get_contents('php://input'), true);
    $vezeteknev = trim($post['vezeteknev']);
    $keresztnev = trim($post['keresztnev']);
    $email = trim($post['email']);
    $jelszo = $post['jelszo'];
    //$feltetelek = isset($post['feltetelek']) ? $post['feltetelek'] : '';

    // Alapvető validációk
    if (empty($vezeteknev)) {
        $hibak[] = "A vezetéknév megadása kötelező.";
    }

    if (empty($keresztnev)) {
        $hibak[] = "A keresztnév megadása kötelező.";
    }

    if (empty($email)) {
        $hibak[] = "Az email cím megadása kötelező.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hibak[] = "Érvénytelen email cím!";
    }

    if (empty($jelszo)) {
        $hibak[] = "A jelszó megadása kötelező.";
    }


    /*if (empty($feltetelek)) {
        $hibak[] = "A felhasználási feltételek elfogadása kötelező.";
    }*/

    // Jelszó erősségének ellenőrzése
    $jelszoMinta = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
    if (!preg_match($jelszoMinta, $jelszo)) {
        $hibak[] = "A jelszónak legalább 8 karakter hosszúnak kell lennie, tartalmaznia kell kis- és nagybetűt, valamint számot!";
    }

    // Ha nincsenek hibák, folytatjuk a feldolgozást
    if (empty($hibak)) {
        // Ellenőrzés, hogy létezik-e már ilyen email vagy felhasználónév
        $stmt = $conn->prepare("SELECT `id` FROM `felhasznalo` WHERE `email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $hibak[] = "Az email cím vagy a felhasználónév már foglalt!";
        } else {
            // Jelszó hashelése
            $hashedJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

            // Adatok beszúrása az adatbázisba
            $stmt = $conn->prepare("INSERT INTO felhasznalo (email, jelszo, vezeteknev, keresztnev) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $hashedJelszo, $vezeteknev, $keresztnev);

            if ($stmt->execute()) {
                // Sikeres regisztráció, átirányítás a bejelentkezési oldalra
                echo json_encode(["valasz" => "Sikeres regisztráció!"]);
                exit;
            } else {
                $hibak[] = "Hiba történt a regisztráció során. Kérjük, próbáld meg később!";
            }
        }
        $stmt->close();
    }

    $conn->close();
}
?>