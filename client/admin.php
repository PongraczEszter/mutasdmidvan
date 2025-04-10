
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Felület</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <div>
        <?php
            include './navbar.php';

            if(!isset($_SESSION['admin']) || !$_SESSION['admin'])
            {
                http_response_code(403);
                die("Forbidden");
            }
        ?>
    </div>
    <div class="admin-container">
        <h1>Admin Felület</h1>
        <div class="buttons">
            <a href="./admin-felhasznalok.php"><button class="user-management">Felhasználók kezelése</button></a>
        </div>
        <div class="udvozlo-szoveg">
            <p>Üdvözlünk az admin felületen! Itt kezelheted a felhasználókat és az adatokat.</p>
        </div>
    </div>

    
    <script src="../js/navbar.js"></script>

    <?php
        include './footer.php';
    ?>
</body>
</html>
