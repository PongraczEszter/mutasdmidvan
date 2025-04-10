<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Felület - Felhasználók kezelése</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin-felhasznalok.css">
    <link rel="stylesheet" href="../css/navbar-red.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <div>
        <?php
            include './navbar.php';

            if(!isset($_SESSION['admin']) || !$_SESSION['admin'])
            {
                http_response_code(403);
                die("Forbidden");
            }
        ?>
    </div>
    <div class="admin-container">
        <h1>Felhasználók kezelése</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Jelszó</th>
                        <th>Vezetéknév</th>
                        <th>Keresztnév</th>
                        <th>Születési idő</th>
                        <th>Telefonszám</th>
                        <th>Admin</th>
                        <th>Módosítás</th>
                        <th>Törlés</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    
                </tbody>
            </table>
        </div>
    </div>

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Módosítás</h2><br>
            <form id="edit-form">
                <label for="edit-email">Email:</label>
                <input type="email" id="edit-email" required><br><br>
                
                <label for="edit-password">Jelszó:</label>
                <input type="password" id="edit-password" required><br><br>

                <label for="edit-first-name">Vezetéknév:</label>
                <input type="text" id="edit-first-name" required><br><br>

                <label for="edit-last-name">Keresztnév:</label>
                <input type="text" id="edit-last-name" required><br><br>

                <label for="edit-birthdate">Születési idő:</label>
                <input type="date" id="edit-birthdate"><br><br>

                <label for="edit-phone">Telefonszám:</label>
                <input type="text" id="edit-phone"><br><br>

                <label for="edit-phone">Admin:</label>
                <input type="checkbox" id="edit-admin"><br><br>

                <button type="submit">Módosítás mentése</button>
            </form>
        </div>
    </div>

    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Biztos törölni szeretnéd ezt a felhasználót?</h2><br>
            <button id="confirm-delete">Igen, törlés</button>
            <button id="cancel-delete">Mégsem</button>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
    <script src="../js/admin.js"></script>

    <?php
        include './footer.php';
    ?>
</body>

</html>