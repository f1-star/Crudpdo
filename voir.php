<?php
require_once 'bdd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $voir = $conn->prepare('SELECT * FROM personnes WHERE id_personne = :id');
    $voir->bindValue(':id', $id);
    $voir->execute();
    $personne = $voir->fetch();

    if ($personne) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Afficher une personne</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body class="d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow" style="width: 30rem;">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h1>Voir les informations</h1>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">Nom: <?= ($personne['nom_personne']) ?></li>
                        <li class="list-group-item">Prénom: <?= ($personne['prenom_personne']) ?></li>
                        <li class="list-group-item">Âge: <?= ($personne['age_personne']) ?></li>
                        <li class="list-group-item">Email: <?= ($personne['email_personne']) ?></li>
                    </ul>
                    <a href="index.php" class="btn btn-primary mt-3">Voir tout mes enregistrements</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Personne non trouvée.";
    }
}
?>
