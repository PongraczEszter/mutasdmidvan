<?php
// Adatbázis lekérdezéshez szükséges függvények
function adatLekeres($muvelet, $tipus = null, $sqlparameter = null)
{
    $db = new mysqli('localhost', 'root', '', 'mutasd');

    if ($db->connect_errno != 0) return $db->connect_error;

    if (!is_null($tipus) && !is_null($sqlparameter)) {
        $stmt = $db->prepare($muvelet);
        $stmt->bind_param($tipus, ...$sqlparameter);
        $stmt->execute();
        $eredmeny = $stmt->get_result();
    } else {
        $eredmeny = $db->query($muvelet);
    }

    if ($db->errno != 0) return $db->error;

    return $eredmeny->fetch_all(MYSQLI_ASSOC);
}

function adatValtozas($muvelet, $tipus = null, $sqlparameter = null)
{
    $db = new mysqli('localhost', 'root', '', 'mutasd');

    if ($db->connect_errno != 0) return $db->connect_error;

    if (!is_null($tipus) && !is_null($sqlparameter)) {
        $stmt = $db->prepare($muvelet);
        $stmt->bind_param($tipus, ...$sqlparameter);
        $stmt->execute();
    } else {
        $db->query($muvelet);
    }

    return $db->affected_rows > 0 ? 'Sikeres művelet!' : 'Sikertelen művelet!';
}

// Regisztrációs logika
$hiba = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $felhasznalonev = $_POST['felhasznalonev'] ?? null;
    $teljesnev = $_POST['teljesnev'] ?? null;
    $email = $_POST['email'] ?? null;
    $jelszo = $_POST['jelszo'] ?? null;

    // Ellenőrzés, hogy a felhasználónév vagy email már létezik-e
    $ellenorzes_sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = ? OR email = ?";
    $lepes = adatLekeres($ellenorzes_sql, 'ss', [$felhasznalonev, $email]);

    if (is_array($lepes) && count($lepes) > 0) {
        $hiba = "A felhasználónév vagy az email cím már foglalt!";
    } else {
        $jelszoHash = password_hash($jelszo, PASSWORD_DEFAULT);
        $sql = "INSERT INTO felhasznalo (felhasznalonev, teljesnev, email, jelszo) VALUES (?, ?, ?, ?)";
        $valasz = adatValtozas($sql, 'ssss', [$felhasznalonev, $teljesnev, $email, $jelszoHash]);

        if ($valasz === 'Sikeres művelet!') {
            $siker = "Sikeres regisztráció!";
        } else {
            $hiba = "Hiba történt a regisztráció során!";
        }
    }
}
?>

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
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="./fooldal.html"><img src="./kepek/logok/mutasdmidvan.png" alt="Mutasd, mid van!"></a>
        </div>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="#">Profil megtekintése</a></li>
            <li><a href="./veletlenszeru_receptek.html">Véletlenszerű recept</a></li>
            <li><a href="./hozzavalok_kivalasztasa.html">Hozzávaló kiválasztása</a></li>
            <li><a href="#">Beállítások</a></li>
            <li><a href="bejelentkezes.html">Bejelentkezés</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="registration-panel">
            <h1 class="koszones">Szia!</h1>
            <p>Regisztrálj be!</p>
            <form method="POST" action="regisztracio.php">
                <input type="text" name="felhasznalonev" placeholder="Felhasználónév" required>
                <input type="text" name="teljesnev" placeholder="Teljes név" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <div class="password-container">
                    <input type="password" name="jelszo" placeholder="Jelszó" id="password" required>
                    <span class="jelszo-lathatosag" id="jelszo-lathatosag">
                        👁️
                    </span>
                </div>
                <button type="submit" class="registration-button">Regisztráció</button>
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
    <footer>
        <p>&copy; 2024 Minden jog fenntartva.</p>
        <ul>
            <li><a href="#">Kapcsolat</a></li>
            <li><a href="#">Adatvédelmi nyilatkozat</a></li>
            <li><a href="#">Felhasználási feltételek</a></li>
        </ul>
    </footer>
    <script src="./js/regisztracio.js"></script>
</body>

</html>