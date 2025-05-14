<?php
$obrazek = basename($_FILES["obrazek"]["name"]);
move_uploaded_file($_FILES["obrazek"]["tmp_name"], "obrazki/$obrazek");

$conn = new mysqli("localhost", "root", "", "dzbanyv2db");
$stmt = $conn->prepare("INSERT INTO dzbany (idKategorii, nazwa, obrazek, opis, pojemnosc, wysokosc) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssii", $_POST["idKategorii"], $_POST["nazwa"], $obrazek, $_POST["opis"], $_POST["pojemnosc"], $_POST["wysokosc"]);
$stmt->execute();
$conn->close();

header("Location: index.php");
exit;
