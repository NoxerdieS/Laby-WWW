<?php
require("session.php");
require("db.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT d.id, d.nazwa, d.obrazek
    FROM dzbany d
    JOIN ulubione u ON d.id = u.idDzbana
    WHERE u.idUzytkownika = ?
");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ulubione</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <?php include "menu.php"; ?>
        <h1>Ulubione</h1>
    </header>

    <div class="tabela-dzbanow">
        <?php if ($result->num_rows === 0): ?>
            <p>Nie masz jeszcze żadnych ulubionych dzbanów.</p>
        <?php else: ?>
            <?php while ($row = $result->fetch_object()): ?>
                <div class="dzban">
                    <img src="obrazki/<?= htmlspecialchars($row->obrazek) ?>" alt="">
                    <div class="dzban-info">
                        <h3><a href="details.php?id=<?= (int)$row->id ?>"><?= htmlspecialchars($row->nazwa) ?></a></h3>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <a class="back-link" href="index.php">⟵ Wszystkie dzbanki</a>
</div>
<?php
$stmt->close();
$conn->close();
?>
</body>
</html>
