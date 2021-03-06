<?php

require_once('Image.php');

class ImagesManager
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

    public function create(Image $image)
    {
        $req = $this->db->prepare("INSERT INTO `image` (name, path) VALUE (:name, :path)");
        $req->bindValue(":name", $image->getName(), PDO::PARAM_STR);
        $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);
        $req->execute();
    }

    public function get(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `image` WHERE id=:id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $datas = $req->fetch();
        $image = new Image($datas);
        return $image;

    }

    public function getLastImageId() {
        $req = $this->db->query("SELECT * FROM `image` ORDER BY id DESC LIMIT 1");
        $datas = $req->fetch()["id"];
        return $datas;
    }

    public function update(Image $image)
    {
        $req = $this->db->prepare("UPDATE `image` SET name = :name, path = :path");
        
        $req->bindValue(":name", $image->getName(),PDO::PARAM_STR);
        $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `image` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_STR);
        $req->execute();
    }
}