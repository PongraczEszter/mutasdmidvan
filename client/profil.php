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
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/profil.css">
</head>
<body>
    <?php include './navbar.php'; ?>

    <div class="wrapper">
    <div class="profil-container">
        <div class="profil-header">
            <div class="szoveg-container">
                <h1>
                    <?php
                        if(isset($_SESSION['nev']))
                        {
                            echo $_SESSION['nev'];
                        }
                    ?>
                </h1>
                <h2>
                    <?php
                        if(isset($_SESSION['email']))
                        {
                            echo $_SESSION['email'];
                        }
                    ?>
                </h2>
                <div class="buttons">
                    <a href="./profil-szerkesztes.php"><button class="profil-szerkesztese-gomb">Profil szerkesztése</button></a> 
                </div>
            </div>
            <div class="kep-container">
                <img src="../kepek/etelek/kenyer.jpg" alt="Profil Kép">
            </div>
        </div>
    </div>
    </div>

    <script src="../js/navbar.js"></script>
    
    <?php include './footer.php'; ?>
</body>
</html>
