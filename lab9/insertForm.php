<?php $conn = new mysqli("localhost", "root", "", "dzbanyv2db"); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj dzban</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>➕ Dodaj nowy dzban</h2>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nazwa" placeholder="Nazwa dzbana">
        <textarea name="opis" placeholder="Opis dzbana"></textarea>
        <input type="number" name="pojemnosc" placeholder="Pojemność (ml)">
        <input type="number" name="wysokosc" placeholder="Wysokość (cm)">
        <input type="file" name="obrazek">
        <select name="idKategorii">
            <?php
            $result = $conn->query("SELECT id, nazwa FROM kategorie ORDER BY nazwa");
            while ($row = $result->fetch_object()) {
                echo "<option value='{$row->id}'>{$row->nazwa}</option>";
            }
            $conn->close();
            ?>
        </select>
        <input type="submit" value="Zapisz dzban">
    </form>
    <a class="back-link" href="index.php">⏪ Powrót</a>
</div>
</body>
</html>
