<?php
require_once 'conn.php';

header('Content-Type: application/json');

$search = isset($_GET['query']) ? $_GET['query'] : '';

$sql = "SELECT nazwa FROM produkty WHERE nazwa LIKE '%$search%' LIMIT 10";
$result = $polaczenie->query($sql);

$suggestions = [];
while($row = $result->fetch_assoc()) {
    $suggestions[] = $row['nazwa'];
}

echo json_encode($suggestions);
$polaczenie->close();
exit();
?>
