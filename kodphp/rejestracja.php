<?php
session_start();
require_once "conn.php";

if ($polaczenie->connect_errno == 0) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['user'];
        $haslo = $_POST['haslo'];
        $email = $_POST['email'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        $stmt = $polaczenie->prepare("SELECT * FROM user WHERE user=?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['blad_rejestracji'] = '<div class="error">Użytkownik o podanym loginie już istnieje!</div>';
            header('Location: ../strona/register.php');
            exit();
        } 

        $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);

        $stmt = $polaczenie->prepare("INSERT INTO user (user, pass, email) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $login, $hashed_password, $email);
            if ($stmt->execute()) {
                $_SESSION['zalogowany'] = true;
                $_SESSION['name'] = $login;
                unset($_SESSION['blad_rejestracji']);
                header('Location: ../strona/login.php');
                exit();
            } else {
                $_SESSION['blad_rejestracji'] = '<div class="error">Błąd rejestracji!</div>';
                header('Location: ../strona/register.php');
                exit();
            }
        } else {
                $_SESSION['blad_rejestracji'] = '<div class="error">Błąd przygotowania zapytania!</div>';
                header('Location: ../strona/register.php');
                exit();
            }
        }
    }
$polaczenie->close();
?>
