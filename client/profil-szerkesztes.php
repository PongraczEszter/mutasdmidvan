<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recept feltöltése</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/profil-szerkesztese.css">
    <link rel="stylesheet" href="../css/navbar-drap.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php include './navbar.php'; ?>

    <div class="admin-container">

        <h1>Profil szerkesztése</h1>

        <form method="POST" class="profil-form">
            <label for="vezeteknev">Vezetéknév</label>
            <input type="text" id="vezeteknev" name="vezeteknev" required>

            <label for="keresztnev">Keresztnév</label>
            <input type="text" id="keresztnev" name="keresztnev"required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="jelszo">Jelszó</label>
            <input type="password" id="jelszo" name="jelszo" required>
            
            <label for="szuletesidatum">Születési dátum</label>
            <input type="date" id="szuletesidatum" name="szuletesidatum" required>

            <label for="telefonszam">Telefonszám</label>
            <input type="text" id="telefonszam" name="telefonszam" required>

            <button id="modositas_gomb">Módosítás mentése</button>
        </form>

    </div>

    <?php include './footer.php'; ?>

    <script src="../js/profil-szerkesztes.js"></script>
    <script src="../js/navbar.js"></script>
</body>

</html>