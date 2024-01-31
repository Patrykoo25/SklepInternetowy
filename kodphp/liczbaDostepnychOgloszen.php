<?php
require_once "conn.php";

$sqlCount = "SELECT COUNT(*) as liczba_ogloszen FROM produkty";
$resultCount = $polaczenie->query($sqlCount);

if ($resultCount && $resultCount->num_rows > 0) {
    $rowCount = $resultCount->fetch_assoc();
    $liczba_ogloszen = $rowCount['liczba_ogloszen'];

    echo '<div class="naglowejDoOgloszen">';
    echo '<p class="mniejszynaglowekdoogloszen">Liczba Produktów: ' . $liczba_ogloszen . '</p>';
    echo '</div>';
} else {
    echo '<div class="naglowejDoOgloszen">';
    echo '<p class="mniejszynaglowekdoogloszen">Liczba Produktów: 0</p>';
    echo '</div>';
}

$polaczenie->close();
?>