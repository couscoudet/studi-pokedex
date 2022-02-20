<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Pokedex Studi - Créer un Pokemon</title>
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
require_once("TypesManager.php");
$typeManager = new TypesManager();
$types = $typeManager->getAll();
if ($_POST) {
    $number = $_POST['number'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    if ($_FILES['image']['size'] < 2000000) {
        require_once("ImagesManager.php");
        $imagesManager = new ImagesManager();
        //pdo = data
    }
}
?>

<main class="container d-flex justify-content-center">
    <form method="post" enctype="multipart/form-data>
        <label for="number" class="form-label">Numéro</label>
        <input type="number" name="number" class="form-control" id="number" placeholder="Numéro du Pokémon" min="1" max="800" required><br>
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nom du Pokémon" required><br>
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Tapez la description" required></textarea><br>
        <label for="type1" class="form-label">Type (1)</label>
        <select name="type1" id="type1" class="form-select" required><br>
            <option value="">--</option>
            <?php foreach($types as $type) {
                echo "<option value='". $type->getId() ."' style='background:". $type->getColor() ."'>".$type->getName()."</option>";
            }  ?>
        </select>
        <label for="type2" class="form-label">Type (2)</label>
        <select name="type2" id="type2" class="form-select"><br>
            <option value="">--</option>
            <?php foreach ($types as $type): ?>
            <option value="<?= $type->getId() ?>"><?= $type->getName(); ?></option>
            <?php endforeach ?>
        </select>
        <label for="image" class="form-label">Télécharger l'image : </label>
        <input type="file" name="image" id="image" class="form-control">
        <input type="submit" value="Créer" class="form-control mt-5 mb-5 btn btn-success">
    </form>
</main>
</body>
</html>