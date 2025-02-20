<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mutasd-mid-van";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Kapcsolódási hiba: " . $conn->connect_error);
    }

    function adatokLekerese($muvelet)
    {
        global $conn;

        $eredmeny = $conn->query($muvelet);

        if ($conn->errno == 0) 
        {
            if ($eredmeny->num_rows != 0) 
            {
                return $eredmeny->fetch_all(MYSQLI_ASSOC);
            } 
            
            else 
            {
                return 'Nincsenek találatok!';
            }
        } 
        
        else 
        {
            return $conn->error;
        }
    }
?>
