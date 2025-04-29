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
    <title>Edytuj dzban</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edytuj dzban</h1>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <p>
                Nazwa:
                <input type="text" name="nazwa" value="<?= htmlspecialchars($row->nazwa) ?>" required>
            </p>
            <p>
                Opis:
                <textarea name="opis" cols="30" rows="10" required><?= htmlspecialchars($row->opis) ?></textarea>
            </p>
            <p>
                Pojemność (ml):
                <input type="number" name="pojemnosc" value="<?= $row->pojemnosc ?>" required>
            </p>
            <p>
                Wysokość (cm):
                <input type="number" name="wysokosc" value="<?= $row->wysokosc ?>" required>
            </p>
            <input type="submit" value="Zapisz zmiany">
        </form>
        <p><a href="details.php?id=<?= $row->id ?>">Anuluj i wróć</a></p>
    </div>
</body>
</html>
