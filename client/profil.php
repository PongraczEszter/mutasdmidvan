<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saját profil</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/fooldal.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/profil.css">
</head>
<body>
    <?php include './navbar.php'; ?>

    <div class="profil-container">
        <div class="profil-header">
            <div class="szoveg-container">
                <h1>Felhasználónév</h1>
                <div class="buttons">
                    <a href="#"><button class="profil-szerkesztese-gomb">Profil szerkesztése</button></a> 
                    <a href="./recept_feltoltese.php"><button class="recept-feltoltese-gomb">Recept feltöltése</button></a> 
                </div>
            </div>
            <div class="kep-container">
                <img src="../kepek/etelek/kenyer.jpg" alt="Profil Kép">
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>
</body>
</html>
