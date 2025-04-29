<?php
$conn = new mysqli("localhost", "root", "", "dzbanydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$pojemnosc = (int)$_POST["pojemnosc"];
$wysokosc = (int)$_POST["wysokosc"];

$sql = "INSERT INTO dzbany (nazwa, opis, pojemnosc, wysokosc) 
        VALUES ('$nazwa', '$opis', $pojemnosc, $wysokosc)";
$conn->query($sql);

$conn->close();
header("Location: index.php");
exit;
