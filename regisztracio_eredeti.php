<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="icon" href="./kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/regisztracio.css">
    <link rel="stylesheet" href="./css/navbar-red.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php
        include './navbar.php';
    ?>

    <div class="wrapper">
    <div class="container">
        <div class="registration-panel">
            <h1 class="koszones">Szia!</h1>
            <p class="regisztralj-be-felirat">Regisztrálj be!</p>
            <form method="POST" action="regisztracio.php">
                <input type="text" placeholder="Felhasználónév" name="felhasznalonev" required>
                <input type="text" placeholder="Teljes név" name="teljesnev" required>
                <input type="email" placeholder="E-mail" name="email">
                <div class="password-container">
                    <input type="password" placeholder="Jelszó" id="password" name="jelszo" required>
                    <span class="jelszo-lathatosag" id="jelszo-lathatosag">
                        👁️
                    </span>
                </div>
                <button type="submit" class="registration-button">Regisztráció</button>
                <p class="mar-regisztralt-felirat">Már regisztrálva vagy?</p>
                <a href="bejelentkezes.php"><button type="button" class="login-button" id="login-button">Bejelentkezés</button></a>
            </form>
        </div>
        <div class="right-panel">
            <h1 class="regisztracio-felirat">REGISZTRÁCIÓ</h1>
            <div class="wall">
                <div class="mutasdmidvan-logo">
                    <img class="logo" src="./kepek/logok/mutasdmidvan.png" alt="Logó">
                </div>
                <p class="kovess-minket">Kövess minket máshol is!</p>
                <div class="icons">
                    <a href="https://www.facebook.com/" target="_blank"><img src="./kepek/logok/socmedia/facebook-drapp.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="./kepek/logok/socmedia/instagram-drapp.png" alt="Instagram"></a>
                    <a href="https://www.tiktok.com/" target="_blank"><img src="./kepek/logok/socmedia/tiktok-drapp.png" alt="TikTok"></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/regisztracio.js"></script>
    <script src="./js/navbar.js"></script>
    
    <?php
    include './footer.php';
    include './sql_fuggvenyek.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Adatok lekérése a form-ból
        $felhasznalonev = trim($_POST['felhasznalonev']);
        $teljesnev = trim($_POST['teljesnev']);
        $email = trim($_POST['email']);
        $jelszo = $_POST['jelszo'];
        
        // Alapvető validációk
        if (empty($felhasznalonev) || empty($teljesnev) || empty($email) || empty($jelszo)) {
            echo "Kérjük, töltsd ki az összes mezőt!";
            exit;
        }

        if (strlen($felhasznalonev) < 3) {
            echo "A felhasználónév túl rövid!";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Érvénytelen email cím!";
            exit;
        }

        // Jelszó erősségének ellenőrzése
        $jelszoMinta = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*?_-]).{8,}$/";
        if (!preg_match($jelszoMinta, $jelszo)) {
            echo "A jelszónak legalább 8 karakter hosszúnak kell lennie, tartalmaznia kell egy kisbetűt, egy nagybetűt, egy számot és egy speciális karaktert!";
            exit;
        }

        // Ellenőrzés, hogy létezik-e már ilyen email vagy felhasználónév
        $stmt = $conn->prepare("SELECT id FROM felhasznalo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Ez az email már foglalt!";
            exit;
        }

        // Felhasználónév ellenőrzése
        $stmt = $conn->prepare("SELECT id FROM felhasznalo WHERE felhasznalonev = ?");
        $stmt->bind_param("s", $felhasznalonev);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Ez a felhasználónév már foglalt!";
            exit;
        }

        // Jelszó hashelése
        $hashedJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

        // Név felbontása
        $nevek = explode(" ", $teljesnev, 2);
        $vezeteknev = $nevek[0];
        $keresztnev = isset($nevek[1]) ? $nevek[1] : "";

        // Adatok beszúrása az adatbázisba
        $stmt = $conn->prepare("INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $felhasznalonev, $email, $hashedJelszo, $vezeteknev, $keresztnev);

        if ($stmt->execute()) {
            echo "Sikeres regisztráció!";
            header("Location: bejelentkezes.php"); // Átirányítás a bejelentkezési oldalra
            exit;
        } else {
            echo "Hiba történt: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>
</body>
</html>
