<?php
require_once("PokemonsManager.php");
$pokemonsManager = new PokemonsManager;
$pokemonsManager->delete($_GET["id"]);

//sinon à la place du javascript
//header("Location: ./index.php");
?>

<script>
    window.location.href = "./index.php"
</script>