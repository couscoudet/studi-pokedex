<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Pokedex Studi</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="img/pokeball.png" width="20" alt="logo-pokedex"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Types</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
        </div>
    </div>
</nav>

<?php
require_once("PokemonsManager.php");
$manager = new PokemonsManager();
$pokemons = $manager->getAll();
?>

<main class="container">
    <a href="./create.php" class="btn btn-primary">Créer un pokemon</a>
    <section class="d-flex flex-wrap justify-content-center">
        <?php
        foreach($pokemons as $pokemon):
        ?>

        <div class="card m-5" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $pokemon->getNumber() ?># <?= $pokemon->getName() ?></h5>
            <p class="card-text"><?= $pokemon->getDescription() ?></p>
            <a href="#" class="btn btn-success">Modifier</a>
            <a href="delete.php?id=<?= $pokemon->getId() ?>" class="btn btn-danger">Supprimer</a>
        </div>
        </div>

        <?php 
        endforeach ?>
        
    </section>
</main>
</body>
</html>