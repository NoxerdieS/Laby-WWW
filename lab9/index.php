<?php
require("session.php");
require("db.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
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
        <div class="user-info">
            Witaj, <strong><?= htmlspecialchars($_SESSION['login']) ?></strong> |
            <a href="myReviews.php">Moje recenzje</a> |
            <a href="logout.php">Wyloguj</a>
        </div>
        <h1>Moje Dzbanki</h1>
        <nav class="menu">
            <a href="index.php">Wszystkie</a>
            <?php
            $stmt = $conn->prepare("SELECT id, nazwa FROM kategorie");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_object()) {
                echo "<a href='index.php?idKat=" . (int)$row->id . "'>" . htmlspecialchars($row->nazwa) . "</a>";
            }
            $stmt->close();
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
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo "
                <div class='dzban'>
                    <img src='obrazki/" . htmlspecialchars($row->obrazek) . "' alt=''>
                    <div class='dzban-info'>
                        <h3><a href='details.php?id=" . (int)$row->id . "'>" . htmlspecialchars($row->nazwa) . "</a></h3>
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
