<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hozzávalók kiválasztása</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/hozzavalok_kivalasztasa.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php
        include './navbar.php';
    ?>

    <div class="wrapper">
    <div class="container">
        <h1>Hozzávalók kiválasztása</h1>
        <div class="input-section">
            <input type="text" id="ingredient-input" placeholder="Pl.: tej, tojás">
            <div class="diet-options">
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
            <button onclick="getRecipes()">Mutasd a recepteket!</button>
        </div>

        <div id="keresesEredmenye">   
        </div>

        <!-- Felugró ablak -->
        <div id="modal" class="modal" style="display: none;">
            <div class="modal-content">
                <h3>Hozzávalók</h3>
                <ul>Ide jönnek a hozzávalók.</ul>
                <h3>Elkészítés</h3>
                <p>Ide jön az elkészítés.</p>
                <button class="close-btn" onclick="closeModal()">Bezárás</button>
            </div>
        </div>

    </div>
    </div>

    <br>

    <?php
        include './footer.php';
    ?>

    <script src="../js/navbar.js"></script>
    <script src="../js/hozzavalok_kivalasztasa.js"></script>
</body>
</html>