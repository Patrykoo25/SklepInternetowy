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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Panel użytkownika</title>
</head>
<body>
<style>
<style>
.suggestion-item {
    border: 1px solid #ccc;
    padding: 5px;
    margin-bottom: 2px;
    cursor: pointer;
    width: 100%; 
    box-sizing: border-box;
}
</style>
    <a href="../kodphp/logout.php">Wyloguj</a>
    <a href="koszyk.php">Koszyk</a>
    <?php if($_SESSION['admin'] == 1): ?>
        <a href="FormularzDoDodawaniaOgloszenAdmin.php">Dodaj ogłoszenie</a>
    <?php endif; ?>

    <form action="../kodphp/wyszukaj.php" method="get">
    <script>
$(document).ready(function() {
    $("#searchInput").on("input", function() {
        var query = $(this).val();
        if(query.length >= 2) { 
            $.ajax({
                url: "../kodphp/sugestie.php",
                method: "GET",
                data: { query: query },
                success: function(data) {
                    $("#suggestions").empty(); 
                    data.forEach(function(suggestion) {
                        var suggestionElement = $("<div style='border: 1px solid #ccc; padding: 5px; margin-bottom: 2px; cursor: pointer;'>"+suggestion+"</div>");
                        suggestionElement.on("click", function() {
                            $("#searchInput").val(suggestion);
                            $("#suggestions").empty();
                        });
                        $("#suggestions").append(suggestionElement);
                        
                    });
                }
            });
        } else {
            $("#suggestions").empty();
        }
    });
});
</script>


<input type="text" name="szukaj" placeholder="Wpisz nazwę produktu" id="searchInput"><input type="submit" value="Szukaj">
    <div id="suggestions"></div>
    
    </form>
    <?php
 require_once "../kodphp/liczbaDostepnychOgloszen.php"; 
 require_once "../kodphp/OgloszeniaMain.php";
 ?>

</body>
</html>
