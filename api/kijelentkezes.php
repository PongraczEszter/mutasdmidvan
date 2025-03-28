<?php
session_start();
session_unset();  
session_destroy(); 

header("Location: ../client/fooldal.php");
exit();
?>
