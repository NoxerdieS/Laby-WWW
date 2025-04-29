<?php
$conn = new mysqli("localhost", "root", "", "dzbanydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kolekcja Dzbanów</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1>Moja kolekcja dzbanów</h1>
        <p><a href="insertForm.php">Dodaj nowy dzban</a></p>

        <?php
        $sql = "SELECT id, nazwa FROM dzbany";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_object()) {
                echo "<li><a href='details.php?id={$row->id}'>{$row->nazwa}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nie masz żadnych dzbanów w swojej kolekcji.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
