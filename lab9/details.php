<?php
$id = (int)$_GET["id"];
$conn = new mysqli("localhost", "root", "", "dzbanyv2db");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły dzbana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php

$srednia = $conn->query("SELECT AVG(ocena) AS srednia FROM recenzje WHERE idDzbana=$id")
               ->fetch_object()->srednia;


$sql = "SELECT idKategorii, k.nazwa AS nazwaKat, d.nazwa, obrazek, d.opis, pojemnosc, wysokosc 
        FROM dzbany d JOIN kategorie k ON d.idKategorii = k.id WHERE d.id = $id";
$row = $conn->query($sql)->fetch_object();

echo "<div class='dzban'>
        <img src='obrazki/{$row->obrazek}' alt=''>
        <div class='dzban-info'>
            <h2>{$row->nazwa}</h2>
            <p>Kategoria: <a href='index.php?idKat={$row->idKategorii}'>{$row->nazwaKat}</a></p>
            <p>{$row->opis}</p>
            <p>Pojemność: {$row->pojemnosc} ml</p>
            <p>Wysokość: {$row->wysokosc} cm</p>
            <p><strong>Średnia ocen:</strong> " . round($srednia, 2) . "</p>
        </div>
      </div>";
?>

<form action="insertReview.php" method="post">
    <input type="hidden" name="idDzbana" value="<?= $id ?>">
    <input type="text" name="nick" placeholder="Twój nick">
    <select name="ocena">
        <?php for ($i = 1; $i <= 5; $i++) echo "<option>$i</option>"; ?>
    </select>
    <textarea name="tresc" placeholder="Twoja recenzja..."></textarea>
    <input type="submit" value="Dodaj recenzję">
</form>

<?php

$result = $conn->query("SELECT nick, ocena, tresc, data FROM recenzje WHERE idDzbana = $id");
while ($r = $result->fetch_object()) {
    echo "
    <div class='review'>
        <strong>{$r->nick}</strong> ({$r->ocena}/5)
        <small>{$r->data}</small>
        <p>{$r->tresc}</p>
    </div>";
}
$conn->close();
?>
<a class="back-link" href="index.php">Powrót</a>
</div>
</body>
</html>
