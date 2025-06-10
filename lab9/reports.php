<?php
// reports.php
require("session.php");
require("db.php");
if ($_SESSION['rola'] !== 'admin') {
    header("Location: index.php");
    exit;
}
$stmt = $conn->prepare("
    SELECT z.id, u.login, z.tresc, z.data 
    FROM zgloszenia z 
    JOIN uzytkownicy u ON z.idUzytkownika = u.id 
    ORDER BY z.data DESC
");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel zgłoszeń</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php include 'menu.php'; ?>
    <h1>Zgłoszenia użytkowników</h1>
    <?php while ($r = $result->fetch_object()): ?>
        <div class="report">
            <strong><?= htmlspecialchars($r->login) ?></strong>
            <small><?= htmlspecialchars($r->data) ?></small>
            <p><?= nl2br(htmlspecialchars($r->tresc)) ?></p>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
