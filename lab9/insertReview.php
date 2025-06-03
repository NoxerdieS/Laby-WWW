<?php
 require ("session.php");
 require("db.php");
$stmt = $conn->prepare("INSERT INTO recenzje (idDzbana, nick, ocena, tresc) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isis", $_POST["idDzbana"], $_SESSION["login"], $_POST["ocena"], $_POST["tresc"]);
$stmt->execute();
$conn->close();

header("Location: details.php?id=" . $_POST["idDzbana"]);
?>
