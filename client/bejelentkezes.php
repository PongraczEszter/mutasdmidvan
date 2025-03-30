<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bejelentkezes.css">
    <link rel="stylesheet" href="../css/navbar-drap.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <div>
        <?php
            include './navbar.php';
        ?>
    </div>
    <div class="wrapper">
    <div class="container">
        <div class="left-panel">
            <h1 class="bejelentkezes-felirat">BEJELENTKEZÉS</h1>
            <div class="wall">
                <div class="mutasdmidvan-logo">
                    <img class="logo" src="../kepek/logok/mutasdmidvan.png" alt="Logó">
                </div>
                <p>Kövess minket máshol is!</p>
                <div class="kovess-minket">
                    <a href="https://www.facebook.com/" target="_blank"><img src="../kepek/logok/socmedia/facebook-piros.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../kepek/logok/socmedia/instagram-piros.png" alt="Instagram"></a>
                    <a href="https://www.tiktok.com/" target="_blank"><img src="../kepek/logok/socmedia/tiktok-piros.png" alt="TikTok"></a>
                </div>
            </div>
        </div>
        <div class="login-panel">
            <h2 class="koszones">Szia!</h2>
            <p>Örülünk, hogy újra látunk!</p>
            <form>
                <input type="email" placeholder="E-mail cím" id="email" required>
                <div class="password-container">
                    <input type="password" placeholder="Jelszó" id="jelszo" name="jelszo" required>
                    <span class="jelszo-lathatosag" id="jelszo-lathatosag">
                        👁️
                    </span>
                </div>
                <button class="login-button" type="submit" id="bejelentkezes">Bejelentkezés</button>
            </form>
            <p class="meg-nem-regisztralt-felirat">Még nem vagy regisztrálva?</p>
            <a href="./regisztracio.php"><button type="button" class="registration-button">Regisztráció</button></a>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/bejelentkezes.js"></script>
    <script src="../js/navbar.js"></script>
    
    <?php
        include './footer.php';
    ?>
</body>
</html>
