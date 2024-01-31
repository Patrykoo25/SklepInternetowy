<?php
session_start();
require_once "conn.php";

if ($polaczenie->connect_errno == 0) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userInput = $_POST['user'];
        $haslo = $_POST['haslo'];

        $userInput = htmlentities($userInput, ENT_QUOTES, "UTF-8");

        // sprawdza czy jest emialem
        if (filter_var($userInput, FILTER_VALIDATE_EMAIL)) {
            // Jeśli tak to używamy go do szukania w kolumnie email
            $query = "SELECT * FROM user WHERE email=?";
        } else {
            // Jesli nie to  używamy go jako login
            $query = "SELECT * FROM user WHERE user=?";
        }

        $stmt = $polaczenie->prepare($query);
        $stmt->bind_param("s", $userInput);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $wiersz = $result->fetch_assoc();
            if (password_verify($haslo, $wiersz['pass'])) {
                $_SESSION['zalogowany'] = true;
                $_SESSION['name'] = $wiersz['user'];
                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['admin'] = $wiersz['isAdmin'];
                
                unset($_SESSION['blad']);
                header('Location: ../strona/main.php');
                exit();
            } else {
                $_SESSION['blad'] = '<div class="error">Nieprawidłowe hasło!</div>';
                header('Location: ../strona/login.php');
                exit();
            }
        } else {
            $_SESSION['blad'] = '<div class="error">Nieprawidłowy login lub hasło!</div>';
            header('Location: ../strona/login.php');
            exit();
        }
    }
}
$polaczenie->close();
?>
