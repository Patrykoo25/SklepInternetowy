<?php
    session_start();

    if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
    {
        header('Location: ../strona/main.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kasyno</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<form action="../kodphp/zaloguj.php" method="post">
    <div>
    <label for="emailInput">Login:</label>
    <input class="email2"type="text" name="user" id="emailInput">
    <div>
    <label for="passwordInput">Hasło:</label>
    <input class="haslo2"type="password" name="haslo" id="passwordInput"> 
    </div>
    <input class="przycisk" type="submit" value="Zaloguj">
    <?php
            if(isset($_SESSION['blad']))
            {
                echo '<div class="error">'.$_SESSION['blad'].'</div>';
                unset($_SESSION['blad']);
            }
     ?>
</form>
</body>
</html>