<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/regisztracio.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
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
                <form method="POST">
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
                        <img class="logo" src="../kepek/logok/mutasdmidvan.png" alt="Logó">
                    </div>
                    <p class="kovess-minket">Kövess minket máshol is!</p>
                    <div class="icons">
                        <a href="https://www.facebook.com/" target="_blank"><img src="../kepek/logok/socmedia/facebook-drapp.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/" target="_blank"><img src="../kepek/logok/socmedia/instagram-drapp.png" alt="Instagram"></a>
                        <a href="https://www.tiktok.com/" target="_blank"><img src="../kepek/logok/socmedia/tiktok-drapp.png" alt="TikTok"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/regisztracio.js"></script>
    <script src="../js/navbar.js"></script>

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