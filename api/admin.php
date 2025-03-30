<?php
include './sql_fuggvenyek.php';

header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT id, email, jelszo, vezeteknev, keresztnev, szuletesi_ido, telefonszam FROM felhasznalo");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $email, $jelszo, $vezeteknev, $keresztnev, $szuletesi_ido, $telefonszam);

$users = [];

while ($stmt->fetch()) {
    $users[] = [
        'id' => $id,
        'email' => $email,
        'jelszo' => $jelszo,
        'vezeteknev' => $vezeteknev,
        'keresztnev' => $keresztnev,
        'szuletesi_ido' => $szuletesi_ido,
        'telefonszam' => $telefonszam
    ];
}

echo json_encode($users);

$stmt->close();
$conn->close();
?>
