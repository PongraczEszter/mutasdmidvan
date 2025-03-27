<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Felhasználók kezelése</title>
    <link rel="icon" href="../kepek/logok/mutasdmidvan.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php include './navbar.php'; ?>

    <div class="admin-container">
        <h2>Felhasználók kezelése</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Email</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody id="user-table">
                
            </tbody>
        </table>
    </div>

    <?php include './footer.php'; ?>
    <script src="../js/admin.js"></script>
</body>
</html>
