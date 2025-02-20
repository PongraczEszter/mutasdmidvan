<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miben gondolkozol ma?</title>
    <link rel="icon" href="./kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/mibengondolkozol.css">
    <link rel="stylesheet" href="./css/navbar-drap.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php
        include './navbar.php';
    ?>
    <main class="page-content">
        <div class="container">
            <br>
            <h1>Miben gondolkozol ma?</h1><br>
            <div class="options">
                <div class="option">
                    <img src="./kepek/etelek/mibengondolkodsz-1.png" alt="Véletlenszerű recept képe">
                    <h2>Véletlenszerű recept</h2>
                    <p>Ha nincs ötleted a holnapi ebédhez, kérj egy gyorsan elkészíthető, de annál finomabb receptet!</p>
                    <a href="veletlenszeru_receptek.php"><button>Ezt választom!</button></a>
                </div>

                <div class="option">
                    <img src="./kepek/etelek/mibengondolkodsz-2.png" alt="Hozzávalók kiválasztása képe">
                    <h2>Hozzávalók kiválasztása</h2>
                    <p>"Van otthon csirkemellem és lisztem, de nem tudom, miket készíthetnék belőle..." - akkor mi megmutatjuk!</p>
                    <a href="hozzavalok_kivalasztasa.php"><button>Ezt választom!</button></a>
                </div>
            </div>
        </div>
    </main>
    <?php
        include './footer.php';
    ?>
    <script src="./js/navbar.js"></script>
</body>
</html>