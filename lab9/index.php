<?php
$conn = new mysqli("localhost", "root", "", "dzbanyv2db");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje Dzbanki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Moje Dzbanki</h1>
        <nav class="menu">
            <a href="index.php">Wszystkie</a>
            <?php
            $sql = "SELECT id, nazwa FROM kategorie";
            $result = $conn->query($sql);
            while($row = $result->fetch_object()) {
                echo "<a href='index.php?idKat={$row->id}'>{$row->nazwa}</a>";
            }
            ?>
        </nav>
    </header>

    <form>
        <input type="text" name="fraza" placeholder="Szukaj dzbana...">
        <input type="submit" value="Wyszukaj">
    </form>

    <a class="back-link" href="insertForm.php">➕ Dodaj dzban</a>

    <div class="tabela-dzbanow">
        <?php
        $sql = "SELECT id, nazwa, obrazek FROM dzbany";
        if (isset($_GET["idKat"])) {
            $idKat = (int)$_GET["idKat"];
            $sql .= " WHERE idKategorii = $idKat";
        } elseif (isset($_GET["fraza"])) {
            $fraza = $conn->real_escape_string($_GET["fraza"]);
            $sql .= " WHERE nazwa LIKE '%$fraza%'";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo "
                <div class='dzban'>
                    <img src='obrazki/{$row->obrazek}' alt=''>
                    <div class='dzban-info'>
                        <h3><a href='details.php?id={$row->id}'>{$row->nazwa}</a></h3>
                    </div>
                </div>";
            }
        } else {
            echo "<p>Brak wyników.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
