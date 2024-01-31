<?php
session_start();

if(!isset($_SESSION['zalogowany']) || $_SESSION['admin'] != 1)
{
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dodaj ogłoszenie</title>
</head>
<body>
    <?php 
    require_once "../kodphp/DodawanieOgloszenAdmin.php";
    ?>
    <h2>Dodaj ogłoszenie</h2>
    <form action="FormularzDoDodawaniaOgloszenAdmin.php" method="post" enctype="multipart/form-data">
                <div class="">
                    <label name="nazwa">nazwa:</label><br>
                    <input type="text" name="nazwa" id="nazwa" value="" placeholder="nazwa" required>
                </div>
                <div class="">
                    <label name="cena">cena:</label><br>
                    <input type="text" name="cena" id="cena" value="" placeholder="cena" required>
                </div>
                <div class="">
                    <label name="opis">opis:</label><br>
                    <input type="text" name="opis" id="opis" value="" placeholder="opis" required>
                </div>
                <div class="">
                    <label name="waga">waga:</label><br>
                    <input type="text" name="waga" id="waga" value="" placeholder="waga" required>
                </div>
                <div class="">
                    <label name="dodatkoweInfo">dodatkowe info:</label><br>
                    <input type="text" name="dodatkoweInfo" id="dodatkoweInfo" value="" placeholder="dodatkoweInfo">
                </div>

                <div class="">
                        <label name="image">Dodaj zdjęcie produktu</label><br>
                    <span class="upload">
                        <input name="image[]" type="file" multiple value="zjdecie">
                        <label class="upload-label">Przeglądaj</label>
                    </span>
                   
                </div>
                <div class="uploaded-images">

                </div>

                <input type="submit">
            </form>
</body>
</html>
