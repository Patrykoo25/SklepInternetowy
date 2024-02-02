<?php
session_start();

if(!isset($_SESSION['zalogowany'])) {
    header('Location: ../strona/login.php');
    exit();
}

require_once 'conn.php'; 

$szukaj = isset($_GET['szukaj']) ? $_GET['szukaj'] : '';

header("Location: ../strona/wyswietloneOgloszenia.php?szukaj=$szukaj");
exit();
?>
