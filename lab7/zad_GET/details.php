<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../zad_POST/css/style.css">
    <title>Info</title>
</head>
<body>
    <main class="movieContainer">
        
        <h1>Tytuł: 
            <?php 
                $id = $_GET['id'];
                switch ($id) {
                    case 1:
                        echo "Incepcja";
                        break;
                    case 2:
                        echo "Interstellar";
                        break;
                    case 3:
                        echo "Matrix";
                        break;
                    case 4:
                        echo "Pulp Fiction";
                        break;
                    default:
                        echo "Nieznany tytuł";
                }
            ?>
        </h1>
    
        <p class="movieDescription">
            <?php 
                switch ($id) {
                    case 1:
                        echo "Film Christophera Nolana z 2010 roku. Grupa specjalistów od kradzieży informacji z podświadomości próbuje przeprowadzić incepcję – zaszczepić myśl.";
                        break;
                    case 2:
                        echo "Film science fiction z 2014 roku, również wyreżyserowany przez Nolana. Grupa astronautów wyrusza przez tunel czasoprzestrzenny w poszukiwaniu nowego domu dla ludzkości.";
                        break;
                    case 3:
                        echo "Kultowy film science fiction braci Wachowskich z 1999 roku, opowiadający o świecie kontrolowanym przez maszyny.";
                        break;
                    case 4:
                        echo "Czarna komedia Quentina Tarantino z 1994 roku. Kultowa narracja, brutalność i świetne dialogi.";
                        break;
                    default:
                        echo "Brak opisu dla wybranego filmu.";
                }
            ?>
        </p>
    
        <?php 
            switch ($id) {
                case 1:
                    echo '<img src="img/incepcja.jpg" alt="Incepcja" width="300">';
                    break;
                case 2:
                    echo '<img src="img/interstellar.jpg" alt="Interstellar" width="300">';
                    break;
                case 3:
                    echo '<img src="img/matrix.jpg" alt="Matrix" width="300">';
                    break;
                case 4:
                    echo '<img src="img/pulpfiction.jpg" alt="Pulp Fiction" width="300">';
                    break;
            }
        ?>
    
        <p><a href="index.html" class="returnBtn">← Powrót do listy filmów</a></p>
    </main>
</body>
</html>
