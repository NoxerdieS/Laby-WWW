<?php
$conn = new mysqli("localhost", "root", "", "dzbanydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int)$_POST["id"];
$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$pojemnosc = (int)$_POST["pojemnosc"];
$wysokosc = (int)$_POST["wysokosc"];

$sql = "UPDATE dzbany 
        SET nazwa='$nazwa', opis='$opis', pojemnosc=$pojemnosc, wysokosc=$wysokosc 
        WHERE id=$id";
$conn->query($sql);

$conn->close();
header("Location: details.php?id=$id");
exit;
