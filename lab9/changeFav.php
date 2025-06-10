<?php
// changeFav.php
require("session.php");
require("db.php");

$idDzbana = isset($_POST['idDzbana']) ? (int)$_POST['idDzbana'] : 0;
$idU = $_SESSION['id'];

if (!$idDzbana) {
    echo "error";
    exit;
}

// sprawdź, czy już jest w ulubionych
$stmt = $conn->prepare("SELECT id FROM ulubione WHERE idDzbana = ? AND idUzytkownika = ?");
$stmt->bind_param("ii", $idDzbana, $idU);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // usuń
    $stmt->bind_result($favId);
    $stmt->fetch();
    $stmt->close();
    $del = $conn->prepare("DELETE FROM ulubione WHERE id = ?");
    $del->bind_param("i", $favId);
    if ($del->execute()) {
        echo "sukces";
    } else {
        echo "error";
    }
    $del->close();
} else {
    // dodaj
    $stmt->close();
    $ins = $conn->prepare("INSERT INTO ulubione (idDzbana, idUzytkownika) VALUES (?, ?)");
    $ins->bind_param("ii", $idDzbana, $idU);
    if ($ins->execute()) {
        echo "sukces";
    } else {
        echo "error";
    }
    $ins->close();
}

$conn->close();
