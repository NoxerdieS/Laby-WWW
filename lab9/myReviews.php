<?php
require("session.php");
require("db.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$login = $_SESSION['login'];

$stmt = $conn->prepare("
    SELECT r.ocena, r.tresc, r.data, d.id AS idDzbana, d.nazwa 
    FROM recenzje r 
    JOIN dzbany d ON r.idDzbana = d.id 
    WHERE r.nick = ? 
    ORDER BY r.data DESC
");
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje recenzje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <div class="user-info">
            Witaj, <strong><?= htmlspecialchars($login) ?></strong> |
            <a href="index.php">Strona główna</a> |
            <a href="logout.php">Wyloguj</a>
        </div>
        <h1>Moje recenzje</h1>
    </header>
    <?php if ($result->num_rows === 0): ?>
        <p>Nie dodałeś jeszcze żadnej recenzji.</p>
    <?php else: ?>
        <?php while ($r = $result->fetch_object()): ?>
            <div class="review">
                <h3><a href="details.php?id=<?= (int)$r->idDzbana ?>"><?= htmlspecialchars($r->nazwa) ?></a></h3>
                <p>Ocena: <?= (int)$r->ocena ?>/5</p>
                <small><?= htmlspecialchars($r->data) ?></small>
                <p><?= nl2br(htmlspecialchars($r->tresc)) ?></p>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <a class="back-link" href="index.php">⟵ Powrót do listy dzbanów</a>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
