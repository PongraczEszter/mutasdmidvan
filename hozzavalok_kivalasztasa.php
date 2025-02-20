<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hozzávalók kiválasztása</title>
    <link rel="icon" href="./kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/hozzavalok_kivalasztasa.css">
    <link rel="stylesheet" href="./css/navbar-red.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php
        include './navbar.php';
    ?>

    <div class="container">
        <h1>Hozzávalók kiválasztása</h1>
        <div class="input-section">
            <input type="text" id="ingredient-input" placeholder="Pl.: csirkemell, tojás, krumpli">
            <div class="diet-options">
                <label><input type="checkbox"> gluténmentes</label>
                <label><input type="checkbox"> laktózmentes</label>
                <label><input type="checkbox"> rákfélék-mentes</label>
                <label><input type="checkbox"> tojásmentes</label>
                <label><input type="checkbox"> halmentes</label>
                <label><input type="checkbox"> diófélék-mentes</label>
                <label><input type="checkbox"> szójamentes</label>
                <label><input type="checkbox"> zellermetes</label>
                <label><input type="checkbox"> mustármentes</label>
                <label><input type="checkbox"> szezámmag mentes</label>
                <label><input type="checkbox"> vegetáriánus</label>
                <label><input type="checkbox"> vegán</label>
            </div>
            <button onclick="showRecipes()">Mutasd a recepteket!</button>
        </div>

        <div class="recipes" id="recipes">
            <div class="recipe">
                <img src="./kepek/etelek/rantott-csirkemell-krumplival.png" alt="Recept 1">
                <h3>Rántott csirkemell</h3>
            </div>
            <div class="recipe">
                <img src="./kepek/etelek/csirkeporkolt.png" alt="Recept 2">
                <h3>Csirkepörkölt</h3>
            </div>
        </div>

        <div class="pagination">
            <button onclick="prevPage()">Előző</button>
            <button onclick="nextPage()">Következő</button>
        </div>
    </div>

    <br>

    <?php
        include './footer.php';
    ?>

    <script src="./js/navbar.js"></script>
    <script>
        function showRecipes() {
            const input = document.getElementById("ingredient-input").value.trim();
            const recipesDiv = document.getElementById("recipes");

            if (input === "") {
                alert("Kérlek, adj meg legalább egy hozzávalót!");
                return;
            }

            recipesDiv.style.display = "flex";
        }
    </script>
</body>
</html>