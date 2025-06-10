
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
        <?php include "menu.php"; ?>
        <h1>Moje Dzbanki</h1>
    </header>

    <form class="search-form" method="get" action="index.php">
        <input type="text" name="fraza" placeholder="Szukaj dzbana..." value="<?= isset($_GET['fraza']) ? htmlspecialchars($_GET['fraza']) : '' ?>">
        <input type="submit" value="Wyszukaj">
    </form>

    <a class="back-link" href="insertForm.php">➕ Dodaj dzban</a>

    <div class="tabela-dzbanow">
        <?php
        if (isset($_GET["idKat"])) {
            $idKat = (int)$_GET["idKat"];
            $stmt = $conn->prepare("SELECT id, nazwa, obrazek FROM dzbany WHERE idKategorii = ?");
            $stmt->bind_param("i", $idKat);
        } elseif (!empty($_GET["fraza"])) {
            $fraza = "%{$_GET['fraza']}%";
            $stmt = $conn->prepare("SELECT id, nazwa, obrazek FROM dzbany WHERE nazwa LIKE ?");
            $stmt->bind_param("s", $fraza);
        } else {
            $stmt = $conn->prepare("SELECT id, nazwa, obrazek FROM dzbany");
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()):
        ?>
                <div class='dzban'>
                    <img src='obrazki/<?= htmlspecialchars($row->obrazek) ?>' alt=''>
                    <div class='dzban-info'>
                        <h3><a href='details.php?id=<?= (int)$row->id ?>'><?= htmlspecialchars($row->nazwa) ?></a></h3>
                    </div>
                </div>
        <?php
            endwhile;
        } else {
            echo "<p>Brak wyników.</p>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </div>
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
