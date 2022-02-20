<?php

require_once("Pokemon.php");

class PokemonsManager
{
    private $db;

    public function __construct()
    {
        $dbname = "studi-pokedex";
        $port = 3306;
        $login = "root";
        $pwd = "root";
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbname;port=$port", $login, $pwd);
        }
        catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function create(Pokemon $pokemon): void
    {//valeurs qu'on ne connait pas pour plus de sécurité
        $req = $this->db->prepare("INSERT INTO `pokemon` (number, name, description, type1, type2) VALUE (:number, :name, :description, :type1, :type2)");
        
        //on associe ensuite les valeurs, cela évite les failles et injections possibles si l'utilisateur met des guillemets simples ou doubles dans les inputs
        $req->bindValue(":number",$pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(":name",$pokemon->getName(), PDO::PARAM_STR);
        $req->bindValue(":description",$pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":type1",$pokemon->getType1(), PDO::PARAM_STR);
        $req->bindValue(":type2",$pokemon->getType2(), PDO::PARAM_STR);

        $req->execute();
    }

    public function get(int $id): Pokemon
    {
        $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE id = :id");

        $req->bindValue(":id", $id, PDO::PARAM_INT);
        //on recupere le tableau de données
        $datas = $req->fetch();
        //on stocke les données sous forme d'objet pokemon avec la methode d'hydratation
        $pokemon = new Pokemon($datas);
        return $pokemon;
    }

    public function getAll(): array
    {
        $pokemons = [];
        $req = $this->db->query("SELECT * FROM `pokemon` ORDER BY number");
        //on recupere un tableau de tableaux
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new Pokemon($data);
            $pokemons[] = $pokemon;
        }
        $req->closeCursor();
        return $pokemons;
    }   

    public function getAllByString(string $input)
    {
        $pokemons = [];
        $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE name LIKE :input ORDER BY number");
        
        $req->bindValue(":input", $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new Pokemon($data);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    public function getAllByType(string $typeInput)
    {
        $pokemons = [];
        $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE type1 LIKE :typeInput OR  type2 LIKE :typeInput ORDER BY number");
        
        $req->bindValue(":typeInput", $typeInput, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $pokemon = new Pokemon($data);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    public function update(Pokemon $pokemon)
    {
        $req = $this->db->prepare("UPDATE `pokemon` SET number = :number, name = :name, description = :description, type1 = :type1, type2 = :type2");
        
        $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
        $req->bindValue(":name",$pokemon->getName(),PDO::PARAM_STR);
        $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":type1", $pokemon->getType1(), PDO::PARAM_STR);
        $req->bindValue(":type2", $pokemon->getType2(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `pokemon` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_STR);
        $req->execute();
    }
}