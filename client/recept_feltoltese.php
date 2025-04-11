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
    
        <div class="nev">
            <h2 class="cimsorok">Recept neve</h2>
            <div class="nev-input">
                <input type="text" id="nev" placeholder="Recept neve">
            </div>
        </div>

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

        <div class="erzekenyseg">
            <h2 class="cimsorok">Érzékenységek</h2>
            <div class="erzekenyseg-checkbox">
            <label><input type="checkbox" value="1"> gluténmentes</label>
                <label><input type="checkbox" value="2"> laktózmentes</label>
                <label><input type="checkbox" value="3"> rákfélék-mentes</label>
                <label><input type="checkbox" value="4"> tojásmentes</label>
                <label><input type="checkbox" value="5"> halmentes</label>
                <label><input type="checkbox" value="6"> diófélék-mentes</label>
                <label><input type="checkbox" value="7"> szójamentes</label>
                <label><input type="checkbox" value="8"> zellermentes</label>
                <label><input type="checkbox" value="9"> mustármentes</label>
                <label><input type="checkbox" value="10"> szezámmag mentes</label>
                <label><input type="checkbox" value="11"> vegetáriánus</label>
                <label><input type="checkbox" value="12"> vegán</label>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
