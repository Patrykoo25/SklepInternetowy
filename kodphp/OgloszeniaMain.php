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
    echo "<button class='toggle-koszyk' data-id='".$ogloszenie['id']."' data-w-koszyku='".(in_array($ogloszenie['id'], $_SESSION['koszyk'] ?? []) ? "tak" : "nie")."'>".(in_array($ogloszenie['id'], $_SESSION['koszyk'] ?? []) ? "Usuń z koszyka" : "Dodaj do koszyka")."</button>";
    echo "</div>";
}
echo "</div>";

$polaczenie->close();
?>


<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.toggle-koszyk').forEach(button => {
        button.addEventListener('click', function() {
            const produktId = this.getAttribute('data-id');
            const wKoszyku = this.getAttribute('data-w-koszyku') === 'tak';
            const akcja = wKoszyku ? 'usunZKoszyka' : 'dodajDoKoszyka';

            fetch('../kodphp/skryptKoszyk.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `akcja=${akcja}&produktId=${produktId}`
            })
            .then(response => response.text())
            .then(data => {
                if(data === 'ok') {
                    this.textContent = wKoszyku ? 'Dodaj do koszyka' : 'Usuń z koszyka';
                    this.setAttribute('data-w-koszyku', wKoszyku ? 'nie' : 'tak');
                } else {
                    alert('Wystąpił błąd');
                }
            });
        });
    });
});
</script>