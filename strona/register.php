<?php
session_start();

if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany'] == true)) {
    header('Location: ../strona/register.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style_user.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Rejestracja</title>
</head>

<body>
    <main>
        <form action="../kodphp/rejestracja.php" method="post">
            <div>
                <label for="login">Login</label><br>
                <input class="login" type="text" name="user" id="login" required>
            </div>
            <div>
                <label for="email">E-mail</label><br>
                <input class="email" type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="passwordInput">Hasło</label><br>
                <input class="haslo2" type="password" name="haslo" id="passwordInput" required>
            </div>
            <button class="submitBtn" type="submit">Zarejestruj</button>
            <?php
            if (isset($_SESSION['blad_rejestracji'])) {
                echo '<div class="error">' . $_SESSION['blad_rejestracji'] . '</div>';
                unset($_SESSION['blad_rejestracji']);
            }
            ?>
        </form>
    </main>
</body>

</html> 