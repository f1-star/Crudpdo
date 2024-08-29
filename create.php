<?php
session_start();
require_once 'bdd.php';
extract($_POST);
$errors = [];

if (isset($_POST['Ajouter'])) {
    $nom = empty($nom) ? $errors['nom'] = "nom obligatoire" : $nom;
    $prenom = empty($prenom) ? $errors['prenom'] = "prenom obligatoire" : $prenom;
    $age = empty($age) ? $errors['age'] = "age obligatoire" : $age;
    $email = empty($email) ? $errors['email'] = "email obligatoire" : $email;

    if (empty($errors)) {
        $requete = $conn->prepare('INSERT INTO personnes (nom_personne, prenom_personne, age_personne, email_personne) VALUES (:nom, :prenom, :age, :email)');
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':prenom', $prenom);
        $requete->bindValue(':age', $age);
        $requete->bindValue(':email', $email);
        $requete->execute();
        header('location:index.php');
        
    }
    $_SESSION['errors'] = $errors;
}  

?>

<?php require_once "errors.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 30rem;">
        <div class="card-body">
            <div class="card-title text-center">
                <h1>Ajouter une personne</h1>
            </div>
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control">
                    <span class="text-danger small"><?= error_session('nom') ?></span>
                </div>
                <div class="mb-3">
                    <label for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control">
                    <span class="text-danger small"><?= error_session('prenom') ?></span>
                </div>
                <div class="mb-3">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control">
                    <span class="text-danger small"><?= error_session('age') ?></span>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control">
                    <span class="text-danger small"><?= error_session('email') ?></span>
                </div>
                <button type="submit" name="Ajouter" class="mb-3 btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

    <?php unset($_SESSION['errors']); ?>
</body>
</html>
