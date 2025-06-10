<?php
// sendReport.php
require("session.php");
require("db.php");
$tresc = trim($_POST['tresc'] ?? '');
$idU = $_SESSION['id'];
if ($tresc === '') {
    echo 'empty';
    exit;
}
$stmt = $conn->prepare("INSERT INTO zgloszenia (idUzytkownika, tresc) VALUES (?, ?)");
$stmt->bind_param("is", $idU, $tresc);
echo $stmt->execute() ? 'sukces' : 'error';
$stmt->close();
$conn->close();
