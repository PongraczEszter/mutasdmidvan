<?php
    include '../api/sql_fuggvenyek_veletlen_recept.php';

    if(isset($_GET["allergenek"]))
    {
        $allergenek = join(",",explode(" ", $_GET["allergenek"]));
        $recept = randomReceptAllergennel($allergenek)[0];
    }
    else
    {
        $recept = randomRecept()[0];
    }
    
    $etelId = $recept['id'];

    $hozzavalok = hozzavalokLekerdezese($etelId);
    $elkeszites = elkeszitesLekerdezese($etelId);

    $kep = '../kepek/etelek/' . $recept['kep'];
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véletlenszerű receptek</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/veletlenszeru_receptek.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php include './navbar.php'; ?>

    <main class="container">
        <section class="recipe">
            <div class="recipe-details">
                <h1><?php echo $recept['etelnev']; ?></h1><br>
                <h3>Hozzávalók:</h3>
                <ul>
                    <?php
                    if(is_string($hozzavalok))
                    {
                        echo '<i>Hozzávalók feltöltés alatt.</i>';
                    }
                    else {
                        foreach ($hozzavalok as $hozzavalo) {
                            echo "<li>" . $hozzavalo['mennyiseg'] . $hozzavalo['mertekegyseg'] . "  " . $hozzavalo['hozzavalonev'] . "</li>";
                        }
                    }
                    ?>
                </ul><br>
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
                <button class="btn ujrecept" id="masikReceptButton">Másikat kérek!</button>
                
                <br><br>

                <h3>Elkészítés:</h3>
                <p id="elkeszites-p"><?php echo $elkeszites[0]['elkeszitese']; ?></p>

            </div>
            <div class="recipe-image" >
                <img src="<?php echo htmlspecialchars($kep); ?>" alt="<?php echo $recept['etelnev']; ?>">
            </div>
        </section>
    </main>

    <?php include './footer.php'; ?>

    <script>
        function masikRecept()
        {
            let allergenek = Array.from(document.querySelectorAll("input[type=checkbox]")).reduce((array, item) => {
                if(item.checked)
                {
                    array.push(item.value);
                }
                return array;
            }, []).join("+");
            let link = "../client/veletlenszeru_receptek.php";
            if(allergenek != "")
            {
                link += "?allergenek="+allergenek;
            }
            setTimeout(() => {
                    window.location.href = link;
            }, 100);
        }

        window.addEventListener("load", () => {
            let inputs = document.querySelectorAll("input[type=checkbox]");
            let values = new URLSearchParams(document.location.search).get("allergenek");
            if(values != null)
            {
                let gets = values.split(" ");
                inputs.forEach((input) => {
                    gets.forEach((value) => {
                        input.checked = input.value == value;
                    })
                })
            }

            let btn = document.getElementById("masikReceptButton");
            btn.addEventListener("click", masikRecept);
        });
    </script>
    <script src="../js/navbar.js"></script>

</body>

</html>
