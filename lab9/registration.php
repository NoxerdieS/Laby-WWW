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
    $email = $_POST['email'];
    $hashed = md5($haslo);

    $stmt = $conn->prepare("INSERT INTO uzytkownicy (login, haslo, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $login, $hashed, $email);

    if ($stmt->execute()) {
        echo "
        <head>
            <meta charset='UTF-8'>
            <title>Rejestracja</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <div class='form' style='margin-top: 50px;'>
                <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/>
                <p class='link'>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p>
              </div>";
    } else {
        echo "
                <head>
            <meta charset='UTF-8'>
            <title>Rejestracja</title>
            <link rel='stylesheet' href='style.css'>
        </head><div class='form' style='margin-top: 50px;'>
                <h3>Nie udało się zarejestrować użytkownika.</h3><br/>
                <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a>.</p>
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
        <title>Rejestracja</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <form class="form" method="post" action="registration.php">
            <h1 class="login-title">Rejestracja</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" required />
            <input type="password" class="login-input" name="haslo" placeholder="Hasło" required />
            <input type="email" class="login-input" name="email" placeholder="Adres email" required />
            <input type="submit" value="Zarejestruj się" class="login-button" />
            <p class="link"><a href="login.php">Zaloguj się</a></p>
        </form>
    </body>

    </html>
<?php
}
?>