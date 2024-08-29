<?php
session_start();
require_once 'bdd.php';
extract($_POST);
$id = $_GET['id'];
$errors = [];

if (isset($_POST['editer'])) {
    $nom = empty($nom) ? $errors['nom'] = "Nom obligatoire" : $nom;
    $prenom = empty($prenom) ? $errors['prenom'] = "Prénom obligatoire" : $prenom;
    $age = empty($age) ? $errors['age'] = "Âge obligatoire" : $age;
    $email = empty($email) ? $errors['email'] = "Email obligatoire" : $email;

    if (empty($errors)) {
        $req = $conn->prepare('UPDATE personnes SET nom_personne = :nom, prenom_personne = :prenom, age_personne = :age, email_personne = :email WHERE id_personne = :id');
        $req->bindValue(':nom', $nom);
        $req->bindValue(':prenom', $prenom);
        $req->bindValue(':age', $age);
        $req->bindValue(':email', $email);
        $req->bindValue(':id', $id);
        $req->execute();
        header('Location: index.php');
        exit();
    }
}

$req = $conn->prepare('SELECT * FROM personnes WHERE id_personne = :id');
$req->bindValue(':id', $id);
$req->execute();
$personne = $req->fetch();

if (!$personne) {
    echo "Personne non trouvee";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Personne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 30rem;">
        <div class="card-body">
            <div class="card-title text-center">
                <h1>Modifier Personne</h1>
            </div>
            <form action="edit.php?id=<?= $id ?>" method="POST">
                <div class="mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?=($personne['nom_personne']) ?>">
                    <span class="text-danger small"><?= $errors['nom'] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?=($personne['prenom_personne']) ?>">
                    <span class="text-danger small"><?= $errors['prenom'] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="age">Âge</label>
                    <input type="text" id="age" name="age" class="form-control" value="<?= ($personne['age_personne']) ?>">
                    <span class="text-danger small"><?= $errors['age'] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?= ($personne['email_personne']) ?>">
                    <span class="text-danger small"><?= $errors['email'] ?? '' ?></span>
                </div>
                <button type="submit" name="editer" class="mb-3 btn btn-primary">Editer</button>
            </form>
        </div>
    </div>
</body>
</html>
