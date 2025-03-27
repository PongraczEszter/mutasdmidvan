<?php
    session_start();
?>
<nav class="navbar">
<div class="logo">
    <a href="./fooldal.php"><img src="../kepek/logok/mutasdmidvan.png" alt="Mutasd, mid van!"></a>
</div>
<div class="menu-toggle" id="mobile-menu">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
</div>
<ul class="nav-links" id="nav-links">
    <?php
        if(isset($_SESSION['felhasznalo_id']))
        {
            echo "<li><a href='./profil.php'>Profil megtekintése</a></li>";
        }
    ?>
    <li><a href="./veletlenszeru_receptek.php">Véletlenszerű recept</a></li>
    <li><a href="./hozzavalok_kivalasztasa.php">Hozzávaló kiválasztása</a></li>
    <li><a href="./bejelentkezes.php">Bejelentkezés</a></li>
</ul>
</nav>
