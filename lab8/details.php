<?php
$conn = new mysqli("localhost", "root", "", "dzbanydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int)$_GET["id"];
$sql = "SELECT * FROM dzbany WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_object();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły dzbana</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($row->nazwa) ?></h1>
        <p><strong>Opis:</strong><br><?= nl2br(htmlspecialchars($row->opis)) ?></p>
        <p><strong>Pojemność:</strong> <?= $row->pojemnosc ?> ml</p>
        <p><strong>Wysokość:</strong> <?= $row->wysokosc ?> cm</p>

        <p><a href="updateForm.php?id=<?= $row->id ?>">Edytuj dzban</a></p>
        <p><a href="delete.php?id=<?= $row->id ?>" onclick="return confirm('Czy na pewno chcesz usunąć tego dzbana?')">Usuń dzban</a></p>
        <p><a href="index.php">Wróć do listy</a></p>
    </div>
</body>
</html>
