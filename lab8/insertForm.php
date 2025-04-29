<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj nowy dzban</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1>Dodaj nowy dzban</h1>
        <form action="insert.php" method="post">
            <p>
                Nazwa: 
                <input type="text" name="nazwa" required>
            </p>
            <p>
                Opis: 
                <textarea name="opis" cols="30" rows="10" required></textarea>
            </p>
            <p>
                Pojemność (ml): 
                <input type="number" name="pojemnosc" required>
            </p>
            <p>
                Wysokość (cm): 
                <input type="number" name="wysokosc" required>
            </p>
            <input type="submit" value="Dodaj dzbana">
        </form>
        <p><a href="index.php">Anuluj i wróć do listy</a></p>
    </div>
</body>
</html>
