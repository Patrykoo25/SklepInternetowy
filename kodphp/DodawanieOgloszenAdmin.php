<?php 

require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['przyciskPrzegladaj'])) {
  // Pobierane dane z formularza
  $nazwa = isset($_POST['nazwa']) ? $_POST['nazwa'] : ' ';
  $cena = isset($_POST['cena']) ? $_POST['cena'] : '';
  $opis = isset($_POST['opis']) ? $_POST['opis'] : '';
  $waga = isset($_POST['waga']) ? $_POST['waga'] : '';
  $dodatkoweInfo = isset($_POST['dodatkoweInfo']) ? $_POST['dodatkoweInfo'] : '';

$stmt = $polaczenie->prepare("INSERT INTO produkty(nazwa, cena, opis, waga, dodatkoweInfo) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $nazwa, $cena, $opis, $waga, $dodatkoweInfo);
if($stmt->error) {
    echo "Błąd zapytania: " . $stmt->error;
}
$stmt->execute();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

header("Cache-Control: no-cache, must-revalidate");

$id = $polaczenie->insert_id;

$total = count($_FILES['image']['name']);

for( $i=0 ; $i < $total ; $i++ ) {
    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
    if ($tmpFilePath != ""){
        $newFilePath = ".././uploadFiles/" . $id . $_FILES['image']['name'][$i];
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            $sql = "INSERT INTO produktyimages(`produktyid`,`linkimg`) VALUES('".$id."','".$newFilePath."');";
            $result = $polaczenie->query($sql);
        }
    }
}

}
    


$polaczenie->close();
?> 