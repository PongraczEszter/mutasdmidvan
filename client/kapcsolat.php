<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/kapcsolat.css">
    <link rel="stylesheet" href="../css/navbar-drap.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Kapcsolat</title>
</head>
<body>
    <?php
        include './navbar.php';
    ?>
    <div class="wrapper">
        <div class="kapcsolat-container">
            <form action="https://api.web3forms.com/submit" method="post" class="left-container" id="form">
                <h2 class="kapcsolat-title">Maradjunk kapcsolatban!</h2><hr>

                <input type="hidden" name="access_key" value="cfb62307-8682-47ee-8b7e-dc4b5643bca1">

                <input type="text" name="name" class="kapcsolat-input" placeholder="Név" required>

                <input type="text" name="email" class="kapcsolat-input" placeholder="E-mail" required>
                
                <textarea name="message" class="textarea" placeholder="Üzenet" required></textarea>
                
                <br>

                <button type="submit">Küldés</button>
            </form>
            
            <div class="right-container">
                <img src="../kepek/email.png" alt="Üzenetküldési kép">
            </div>
        </div>
    </div>

    <div id="result"></div>

    <script src="../js/kapcsolat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
        include './footer.php';
    ?>
</body>
</html>