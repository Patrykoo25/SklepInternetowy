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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../kodphp/logout.php">wyloguj</a>
</body>
</html>