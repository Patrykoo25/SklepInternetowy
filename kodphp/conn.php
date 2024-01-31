<?php

$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'sklep';

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno) {
    echo "Error: " . $polaczenie->connect_error;
    exit();
}
?>
