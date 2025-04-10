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
    
    <li><a href="./veletlenszeru_receptek.php">Véletlenszerű recept</a></li>
    <li><a href="./hozzavalok_kivalasztasa.php">Hozzávaló kiválasztása</a></li>
    <?php
        if (!isset($_SESSION['felhasznalo_id']))
        {
            echo "<li><a href='./bejelentkezes.php'>Bejelentkezés</a></li>";
            
        } 
        else 
        {
            echo "<li><a href='./profil.php'>Profil megtekintése</a></li>";
            echo "<li><a href='./recept_feltoltese.php'>Recept feltöltése</a></li>";
            

            if ($_SESSION['admin']) 
            {
                echo "<li><a href='./admin.php'>Admin felület</a></li>";
            }

            echo "<li><a href='#' onclick='confirmLogout()'>Kijelentkezés</a></li>";
        }
        
    ?>
</ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/kijelentkezes.js"></script>