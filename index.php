<?php
require_once 'bdd.php';
$afficher = $conn->query('SELECT * FROM personnes');
$personnes = $afficher->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>CRUD</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="create.php" class="btn btn-success"><i class="material-icons"></i> <span>Ajouter </span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Âge</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personnes as $personne): ?>
                            <tr>
                                <td><?php echo ($personne['id_personne']); ?></td>
                                <td><?php echo ($personne['nom_personne']); ?></td>
                                <td><?php echo ($personne['prenom_personne']); ?></td>
                                <td><?php echo ($personne['age_personne']); ?></td>
                                <td><?php echo ($personne['email_personne']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $personne['id_personne']; ?>" class="edit"><i class="material-icons" title="Edit"></i></a>
                                    <a href="voir.php?id=<?php echo $personne['id_personne']; ?>" class="voir" title="voir"><i class="material-icons">&#xE417;</i></a>
                                    <a href="supp.php?id=<?php echo $personne['id_personne']; ?>" class="delete"><i class="material-icons" title="Supprimer"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
