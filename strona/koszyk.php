<style>
    div.product {
        margin-bottom: 20px;
    }

    div.summary {
        margin-top: 20px;
    }
</style>

<?php
session_start();


if (!isset($_SESSION['zalogowany'])) {
    header('Location: login.php');
    exit();
}

require_once '../kodphp/conn.php';

if (!isset($_SESSION['koszyk']) || empty($_SESSION['koszyk'])) {
    echo "<p>Jeszcze nic nie dodałeś do koszyka.</p>";
} else {
    $produktyWKoszyku = $_SESSION['koszyk'];
    $łącznaCena = 0;
    $cenyProduktów = [];

    echo "<div style='width:100%;'>"; 

    $sql = "SELECT p.id, p.nazwa, p.cena, pi.linkimg FROM produkty p INNER JOIN produktyimages pi ON p.id = pi.produktyid WHERE p.id = ?";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("i", $idProduktu);

    foreach ($produktyWKoszyku as $idProduktu) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div style='margin-bottom: 20px;'><img src='".$row['linkimg']."' style='width:100px; height:auto;'><p>Nazwa".$row['nazwa']."</p><p>Cena: ".$row['cena']." zł</p>";
                $łącznaCena += $row['cena'];
                $cenyProduktów[] = $row['cena'];
                
                echo "<button class='usun-z-koszyka' data-id='".$row['id']."'>Usuń z koszyka</button>";
                echo "</div>";
            }
        }
    }

    echo "</div>";

    
    echo "<div style='margin-top: 20px;'>";
    echo "<h2>Łączna cena: $łącznaCena zł</h2>";
    echo "<h3>Ceny produktów:</h3>";
    foreach ($cenyProduktów as $cena) {
        echo "<p>$cena zł</p>";
    }
    echo "</div>";
}

$polaczenie->close();
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.usun-z-koszyka').forEach(button => {
        button.addEventListener('click', function() {
            const produktId = this.getAttribute('data-id');
            
            fetch('../kodphp/skryptKoszyk.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `akcja=usunZKoszyka&produktId=${produktId}`
            })
            .then(response => response.text())
            .then(data => {
                if(data === 'ok') {
                    location.reload();
                } else {
                    alert('Wystąpił błąd przy usuwaniu produktu z koszyka.');
                }
            });
        });
    });
});
</script>
