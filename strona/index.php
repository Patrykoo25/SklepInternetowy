<?php
    session_start();

    if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
    {
        header('Location: main.php');
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
    <a href="login.php">login</a>
    <a href="register.php">register</a>
    <form action="../kodphp/wyszukaj.php" method="get">
   
    <input type="text" name="szukaj" placeholder="Wpisz nazwę produktu" id="searchInput"><input type="submit" value="Szukaj">
    <div id="suggestions"></div>
    
    </form>
    <?php
 require_once "../kodphp/liczbaDostepnychOgloszen.php"; 
 require_once "../kodphp/OgloszeniaIndex.php";
 ?>
</body>
</body>
</html>