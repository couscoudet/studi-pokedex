<?php
require_once("Type.php");
class TypesManager
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

    public function create(Type $type)
    {
        $req = $this->db->prepare("INSERT INTO `type` (name, color) VALUE (:name, :color)");
        $req->bindValue(":name", $type->getName(), PDO::PARAM_STR);
        $req->bindValue(":color", $type->getColor(), PDO::PARAM_STR);
        $req->execute();
    }

    public function get(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `type` WHERE id=:id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $datas = $req->fetch();
        $type = new Type($datas);
        return $type;

    }

    public function getAll(): array
    {
        $types = [];
        $req = $this->db->query("SELECT * FROM `type` ORDER BY name");
        //on recupere un tableau de tableaux
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $type = new Type($data);
            $types[] = $type;
        }
        $req->closeCursor();
        return $types;
    }   

    public function update(Type $type)
    {
        $req = $this->db->prepare("UPDATE `type` SET name = :name, color = :color");
        
        $req->bindValue(":name",$type->getName(),PDO::PARAM_STR);
        $req->bindValue(":color", $type->getColor(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `type` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_STR);
        $req->execute();
    }
}