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
    <link rel="stylesheet" href="../css/recept_feltoltese.css">
    <link rel="stylesheet" href="../css/navbar-drap.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php include './navbar.php'; ?>

    <div class="recept-container">
        <div class="hozzavalok">
            <h2 class="cimsorok">Hozzávalók</h2><br>
            <div class="hozzavalo-inputs">
                <input type="text" id="hozzavalo" placeholder="Hozzávaló">
                <input type="number" id="mennyiseg" placeholder="Mennyiség">
                <input type="text" id="mertekegyseg" placeholder="Mértékegység">
                <button onclick="hozzadHozzavalo()">Hozzáadás</button><br>
            </div>
            <ul id="hozzavalo-lista" style="margin-top: 20px;"></ul>
        </div>

        <div class="elkeszites">
            <h2 class="cimsorok">Elkészítés</h2><br>
            <textarea id="elkeszites-text" placeholder="Írd ide az elkészítést..."></textarea>
            <button onclick="mentesRecept()">Végleges felvitel</button>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script src="../js/recept_feltoltese.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>
