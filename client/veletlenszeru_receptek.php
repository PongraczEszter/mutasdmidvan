<?php
    include '../api/sql_fuggvenyek_veletlen_recept.php';

    $recept = randomRecept()[0];
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
                <button class="btn"><a class="ujrecept" href="../client/veletlenszeru_receptek.php">Másikat kérek!</a></button>
                
                <br><br>

                <h3>Elkészítés:</h3>
                <p><?php echo $elkeszites[0]['elkeszitese']; ?></p>

            </div>
            <div class="recipe-image" >
                <img src="<?php echo htmlspecialchars($kep); ?>" alt="<?php echo $recept['etelnev']; ?>">
            </div>
        </section>
    </main>

    <?php include './footer.php'; ?>

    <script src="../js/navbar.js"></script>

</body>

</html>
