<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutasd, mid van!</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/fooldal.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php
        include './navbar.php';
    ?>

    <header class="hero-section">
        <div class="szoveg-container">
            <h1>Receptek - ahogy te szereted</h1>
            <p>Nézd meg, milyen hozzávalóid vannak, mi pedig megmondjuk, mit készíts belőle!</p>
            <div class="buttons">
                <a href="./mibengondolkozol.php"><button class="recipes-button">Mutasd a recepteket!</button></a>
                <a href="./bejelentkezes.php"><button class="login-button">Bejelentkezés</button></a>
                <a href="./regisztracio.php"><button class="registration-button">Regisztráció</button></a>
            </div>
        </div>
        <div class="kep-container">
            <img src="../kepek/fooldal_spagetti.jfif" alt="Spagetti">
        </div>
    </header>
    <br><br><br>

    <?php
        include './footer.php';
    ?>

    <script src="../js/navbar.js"></script>

</body>
</html>
