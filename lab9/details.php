<?php
include("db.php");
$id = (int)$_GET["id"];


// Pobranie informacji o stanie ulubionych
$stmtFav = $conn->prepare("SELECT id FROM ulubione WHERE idDzbana = ? AND idUzytkownika = ?");
$stmtFav->bind_param("ii", $id, $_SESSION['id']);
$stmtFav->execute();
$stmtFav->store_result();
$isFav = $stmtFav->num_rows > 0;
$stmtFav->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły dzbana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <?php include "menu.php"; ?>
        <h1>Szczegóły dzbana</h1>
    </header>
    <?php
    $stmtAvg = $conn->prepare("SELECT AVG(ocena) AS srednia FROM recenzje WHERE idDzbana = ?");
    $stmtAvg->bind_param("i", $id);
    $stmtAvg->execute();
    $srednia = $stmtAvg->get_result()->fetch_object()->srednia;
    $stmtAvg->close();

    // Dane dzbana
    $stmt = $conn->prepare("
        SELECT d.idKategorii, k.nazwa AS nazwaKat, d.nazwa, d.obrazek, d.opis, d.pojemnosc, d.wysokosc 
        FROM dzbany d 
        JOIN kategorie k ON d.idKategorii = k.id 
        WHERE d.id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_object();
    $stmt->close();

    if ($row):
    ?>
        <div class="dzban">
            <img src="obrazki/<?= htmlspecialchars($row->obrazek) ?>" alt="">
            <div class="dzban-info">
                <h2><?= htmlspecialchars($row->nazwa) ?></h2>
                <p>Kategoria: <a href="index.php?idKat=<?= (int)$row->idKategorii ?>"><?= htmlspecialchars($row->nazwaKat) ?></a></p>
                <p><?= nl2br(htmlspecialchars($row->opis)) ?></p>
                <p>Pojemność: <?= (int)$row->pojemnosc ?> ml</p>
                <p>Wysokość: <?= (int)$row->wysokosc ?> cm</p>
                <p><strong>Średnia ocen:</strong> <?= round((float)$srednia, 2) ?></p>
                <!-- Przycisk ulubionych -->
                <img 
                    class="fav" 
                    data-dzban="<?= $id ?>" 
                    src="icons/<?= $isFav ? 'heart-filled.png' : 'heart-empty.png' ?>" 
                    alt="Ulubione" 
                    style="cursor:pointer; width:32px; margin-top:10px;"
                >
            </div>
        </div>
    <?php else: ?>
        <p>Nie znaleziono dzbana o ID = <?= $id ?>.</p>
    <?php endif; ?>

    <section class="add-review">
        <h3>Dodaj nową recenzję</h3>
        <p>Recenzja zostanie opublikowana jako: <strong><?= htmlspecialchars($_SESSION['login']) ?></strong></p>
        <form action="insertReview.php" method="post">
            <input type="hidden" name="idDzbana" value="<?= $id ?>">
            <label for="ocena">Ocena:</label>
            <select name="ocena" id="ocena">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
            <label for="tresc">Twoja recenzja:</label>
            <textarea name="tresc" id="tresc" placeholder="Napisz, co myślisz..." required></textarea>
            <input type="submit" value="Dodaj recenzję">
        </form>
    </section>

    <section class="reviews-list">
        <h3>Opinie użytkowników</h3>
        <?php
        $stmt2 = $conn->prepare("SELECT nick, ocena, tresc, data FROM recenzje WHERE idDzbana = ? ORDER BY data DESC");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $result = $stmt2->get_result();

        if ($result->num_rows === 0):
            echo "<p>Brak recenzji dla tego dzbana. Bądź pierwszy, który oceni!</p>";
        else:
            while ($r = $result->fetch_object()): ?>
                <div class="review">
                    <strong><?= htmlspecialchars($r->nick) ?></strong> (<?= $r->ocena ?>/5)
                    <small><?= htmlspecialchars($r->data) ?></small>
                    <p><?= nl2br(htmlspecialchars($r->tresc)) ?></p>
                </div>
            <?php endwhile;
        endif;
        $stmt2->close();
        $conn->close();
        ?>
    </section>

    <a class="back-link" href="index.php">⟵ Powrót do listy dzbanów</a>
    <?php include 'footer.php'; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>
