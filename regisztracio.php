<?php
session_start();
include './sql_fuggvenyek.php';

// Hibák gyűjtése egy tömbben
$hibak = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adatok lekérése a form-ból
    $felhasznalonev = trim($_POST['felhasznalonev']);
    $vezeteknev = trim($_POST['vezeteknev']);
    $keresztnev = trim($_POST['keresztnev']);
    $email = trim($_POST['email']);
    $jelszo = $_POST['jelszo'];
    $feltetelek = isset($_POST['feltetelek']) ? $_POST['feltetelek'] : '';

    // Alapvető validációk
    if (empty($felhasznalonev)) {
        $hibak[] = "A felhasználónév megadása kötelező.";
    } elseif (strlen($felhasznalonev) < 3) {
        $hibak[] = "A felhasználónév túl rövid! Legalább 3 karakter legyen.";
    }

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


    if (empty($feltetelek)) {
        $hibak[] = "A felhasználási feltételek elfogadása kötelező.";
    }

    // Jelszó erősségének ellenőrzése
    $jelszoMinta = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
    if (!preg_match($jelszoMinta, $jelszo)) {
        $hibak[] = "A jelszónak legalább 8 karakter hosszúnak kell lennie, tartalmaznia kell kis- és nagybetűt, valamint számot!";
    }

    // Ha nincsenek hibák, folytatjuk a feldolgozást
    if (empty($hibak)) {
        // Ellenőrzés, hogy létezik-e már ilyen email vagy felhasználónév
        $stmt = $conn->prepare("SELECT id FROM felhasznalo WHERE email = ? OR felhasznalonev = ?");
        $stmt->bind_param("ss", $email, $felhasznalonev);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $hibak[] = "Az email cím vagy a felhasználónév már foglalt!";
        } else {
            // Jelszó hashelése
            $hashedJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

            // Adatok beszúrása az adatbázisba
            $stmt = $conn->prepare("INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $felhasznalonev, $email, $hashedJelszo, $vezeteknev, $keresztnev);

            if ($stmt->execute()) {
                // Sikeres regisztráció, átirányítás a bejelentkezési oldalra
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sikeres regisztráció!',
                        text: 'Most már bejelentkezhetsz.',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'bejelentkezes.php';
                        }
                    });
                </script>";
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

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="icon" href="./kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/regisztracio.css">
    <link rel="stylesheet" href="./css/navbar-red.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- SweetAlert CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include './navbar.php'; ?>

    <div class="wrapper">
        <div class="container">
            <div class="registration-panel">
                <h1 class="koszones">Szia!</h1>
                <p class="regisztralj-be-felirat">Regisztrálj be!</p>
                <form method="POST" action="regisztracio.php">
                    <input type="text" placeholder="Felhasználónév" name="felhasznalonev" value="<?= isset($felhasznalonev) ? htmlspecialchars($felhasznalonev) : '' ?>" required>
                    <input type="text" placeholder="Vezetéknév" name="vezeteknev" value="<?= isset($vezeteknev) ? htmlspecialchars($vezeteknev) : '' ?>" required>
                    <input type="text" placeholder="Keresztnév" name="keresztnev" value="<?= isset($keresztnev) ? htmlspecialchars($keresztnev) : '' ?>" required>
                    <input type="email" placeholder="E-mail" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                    <div class="password-container">
                        <input type="password" placeholder="Jelszó" id="password" name="jelszo" required>
                        <span class="jelszo-lathatosag" id="jelszo-lathatosag">
                            👁️
                        </span>
                    </div>
                    <!--div class="feltetelek">
                        <input type="checkbox" name="feltetelek" id="feltetelek" required>
                        <label for="feltetelek">Elfogadom a <a href="felhasznalasi-feltetelek.php">felhasználási feltételeket</a>.</label>
                    </div-->
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

    <script src="./js/regisztracio.js"></script>
    <script src="./js/navbar.js"></script>

    <?php include './footer.php'; ?>

    <?php
    // Hibák megjelenítése SweetAlert segítségével
    if (!empty($hibak)) {
        $hibauzenet = implode("<br>", $hibak);
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Hiba!',
                html: '$hibauzenet',
                confirmButtonText: 'Ok'
            });
        </script>";
    }
    ?>
</body>
</html>
