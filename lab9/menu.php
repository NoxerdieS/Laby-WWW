<?php
require("session.php");
require("db.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<div class="user-info">
    Witaj, <strong><?= htmlspecialchars($_SESSION['login']) ?></strong> |
    <a href="index.php">Strona główna</a> |
    <a href="favourites.php">Ulubione</a> |
    <a href="myReviews.php">Moje recenzje</a> |
    <a href="logout.php">Wyloguj</a>
</div>
<nav class="menu">
    <?php
    $stmtCat = $conn->prepare("SELECT id, nazwa FROM kategorie");
    $stmtCat->execute();
    $resCat = $stmtCat->get_result();
    while ($cat = $resCat->fetch_object()):
    ?>
        <a href="index.php?idKat=<?= (int)$cat->id ?>"><?= htmlspecialchars($cat->nazwa) ?></a>
    <?php
    endwhile;
    $stmtCat->close();
    ?>
</nav>
