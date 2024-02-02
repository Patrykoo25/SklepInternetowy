<?php
$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'sklep';

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

$sql = "SELECT produkty.*, produktyimages.linkimg FROM produkty LEFT JOIN produktyimages ON produkty.id = produktyimages.produktyid ORDER BY RAND() LIMIT 8";
$result = $polaczenie->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['ogloszenia'] = $result->fetch_all(MYSQLI_ASSOC); 
} else {
    $_SESSION['ogloszenia'] = []; 
}

$ogloszenia = $_SESSION['ogloszenia'];
echo "<div class='line'>"; 
foreach ($ogloszenia as $i => $ogloszenie) {
    echo "</div><div class='line'>";
    
    echo "<div><h3>".$ogloszenie['nazwa']."</h3><p>".$ogloszenie['opis']."</p><p>Cena: ".$ogloszenie['cena']."</p>";
    if (!empty($ogloszenie['linkimg'])) {
        echo "<img src='".$ogloszenie['linkimg']."' alt='".$ogloszenie['nazwa']."' style='width:100px;height:auto;'>";
    }
    echo "<input type='submit' value='Dodaj do koszyka'>";
    echo "</div>";
}
echo "</div>";

$polaczenie->close();
?>
