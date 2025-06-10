<?php
require("session.php");
require("db.php");

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $stmt = $conn->prepare("SELECT id, haslo FROM uzytkownicy WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($userId, $hashed);
    if ($stmt->fetch() && $hashed === md5($haslo)) {
        $_SESSION['login'] = $login;
        $_SESSION['id']    = $userId;
        header("Location: index.php");
        exit;
    } else {
        $error = 'Nieprawidłowy login lub hasło.';
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="form" method="post" action="login.php">
        <h1 class="login-title">Logowanie</h1>
        <?php if ($error): ?>
            <div class="form-error" style="margin-bottom:15px; color:#ff6b6b; text-align:center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <input type="text" class="login-input" name="login" placeholder="Login" required autofocus />
        <input type="password" class="login-input" name="haslo" placeholder="Hasło" required />
        <input type="submit" value="Zaloguj" class="login-button" />
        <p class="link"><a href="registration.php">Zarejestruj się</a></p>
    </form>
</body>
</html>
