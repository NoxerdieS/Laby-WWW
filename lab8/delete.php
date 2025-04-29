<?php
$conn = new mysqli("localhost", "root", "", "dzbanydb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int)$_GET["id"];

$sql = "DELETE FROM dzbany WHERE id=$id";
$conn->query($sql);

$conn->close();
header("Location: index.php");
exit;
