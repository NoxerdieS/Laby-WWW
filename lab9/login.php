<?php
require("session.php");
require("db.php");

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $stmt = $conn->prepare("SELECT haslo FROM uzytkownicy WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($hashed);
    if ($stmt->fetch() && $hashed === md5($haslo)) {
        $_SESSION['login'] = $login;
        header("Location: index.php");
        exit;
    } else {
        echo "        <head>
            <meta charset='UTF-8'>
            <title>Rejestracja</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <div class='form' style='margin-top: 50px;'>
                <h3>Nieprawidłowy login lub hasło.</h3><br/>
                <p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>
              </div>";
    }
    $stmt->close();
    $conn->close();
} else {
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
        <input type="text" class="login-input" name="login" placeholder="Login" required autofocus />
        <input type="password" class="login-input" name="haslo" placeholder="Hasło" required />
        <input type="submit" value="Zaloguj" class="login-button" />
        <p class="link"><a href="registration.php">Zarejestruj się</a></p>
    </form>
</body>
</html>
<?php
}
