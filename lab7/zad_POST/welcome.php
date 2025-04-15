<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css">
  <title>Welcome!</title>
  <style>
    p {
      color: <?= htmlspecialchars($_POST['color']) ?>;
    }
  </style>
</head>
<body>
  <p>Welcome <?= htmlspecialchars($_POST['firstName']) ?> <?= htmlspecialchars($_POST['lastName']) ?>!</p>
  <a href="index.html">Powrót</a>
</body>
</html>
