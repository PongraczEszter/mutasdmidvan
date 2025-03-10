<?php
    include './sql_fuggvenyek.php';

    // Hibák gyűjtése egy tömbben
    $hibak = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && str_contains($_SERVER["REQUEST_URI"], "/bejelentkezes")) {
        // Adatok lekérése a form-ból
        $email = $_POST['email'];
        $jelszo = $_POST['jelszo'];  

        if (empty($email)) {
            $hibak[] = "Az email cím megadása kötelező.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hibak[] = "Érvénytelen email cím!";
        }
    
        if (empty($jelszo)) {
            $hibak[] = "A jelszó megadása kötelező.";
        }
        


    }


?>