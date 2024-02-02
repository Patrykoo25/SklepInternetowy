<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../kodphp/conn.php'; 

if (!isset($_SESSION['koszyk'])) {
    $_SESSION['koszyk'] = [];
}

$szukaj = isset($_GET['szukaj']) ? $polaczenie->real_escape_string($_GET['szukaj']) : '';

if (empty($szukaj)) {
    echo "Nie wpisałeś nic.";
} else {
    $sql = "SELECT produkty.*, produktyimages.linkimg FROM produkty
            LEFT JOIN produktyimages ON produkty.id = produktyimages.produktyid
            WHERE produkty.nazwa LIKE '%$szukaj%'";

    $result = $polaczenie->query($sql);

    $produktyWKoszyku = $_SESSION['koszyk'];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div><h3>".$row['nazwa']."</h3><p>Opis: ".$row['opis']."</p><p>Cena: ".$row['cena']."</p>";
            if (!empty($row['linkimg'])) {
                echo "<img src='".$row['linkimg']."' alt='".$row['nazwa']."' style='width:300px;height:auto;'>";
            }
            $jestWKoszyku = in_array($row['id'], $produktyWKoszyku);
            echo "<button class='toggle-koszyk' data-id='".$row['id']."' data-w-koszyku='".($jestWKoszyku ? "tak" : "nie")."'>".($jestWKoszyku ? "Usuń z koszyka" : "Dodaj do koszyka")."</button>";
        }
    } else {
        echo "Brak wyników";
    }
}

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

