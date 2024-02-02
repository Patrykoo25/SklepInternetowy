<?php
session_start();

if (!isset($_SESSION['koszyk'])) {
    $_SESSION['koszyk'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produktId = $_POST['produktId'];
    $akcja = $_POST['akcja'];

    switch ($akcja) {
        case 'dodajDoKoszyka':
            if (!in_array($produktId, $_SESSION['koszyk'])) {
                $_SESSION['koszyk'][] = $produktId;
            }
            break;
        case 'usunZKoszyka':
            if (($key = array_search($produktId, $_SESSION['koszyk'])) !== false) {
                unset($_SESSION['koszyk'][$key]);
            }
            break;
    }
    echo 'ok';
} else {
    echo 'error';
}
?>
