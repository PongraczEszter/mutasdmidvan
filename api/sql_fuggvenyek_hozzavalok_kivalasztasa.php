<?php
header("Content-Type: application/json");
include "./api/sql_fuggvenyek.php"; // Az adatbázis csatlakozás fájlja

// Oldalszám és hozzávalók beolvasása
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ingredients = isset($_GET['ingredients']) ? explode(',', $_GET['ingredients']) : [];

$limit = 4;
$offset = ($page - 1) * $limit;

// NEMJOOOOOOOOOOO!!!!!!!!!!:
$query = "SELECT DISTINCT r.* FROM receptek r
          JOIN recept_hozzavalo rh ON r.id = rh.recept_id
          JOIN hozzavalok h ON rh.hozzavalo_id = h.id";

// Ha van szűrés, akkor hozzávalók alapján szűrjük a recepteket
if (!empty($ingredients)) {
    $placeholders = implode(',', array_fill(0, count($ingredients), '?'));
    $query .= " WHERE h.id IN ($placeholders)";
}

$query .= " LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);

// Paraméterek hozzárendelése
$params = array_merge($ingredients, [$limit, $offset]);
$types = str_repeat('i', count($ingredients)) . 'ii';

$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

echo json_encode(["recipes" => $recipes]);
?>
