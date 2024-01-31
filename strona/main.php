<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel użytkownika</title>
</head>
<body>
    <a href="../kodphp/logout.php">Wyloguj</a>
    <?php if($_SESSION['admin'] == 1): ?>
        <a href="FormularzDoDodawaniaOgloszenAdmin.php">Dodaj ogłoszenie</a>
    <?php endif; ?>
    
</body>
</html>
