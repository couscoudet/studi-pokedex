<?php
//video19.08
class Pokemon 
{
    //déclaré en private > principe d'encapsulation pour protéger les données
    private int $id;
    private int $number;
    private string $name;
    private string $description;
    private int $type1;
    private int $type2;

    //getters pour atteindre les propriétés privées depuis l'extérieur de la classe
    public function getId() 
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType1()
    {
        return $this->type1;
    }

    public function getType2()
    {
        return $this->type2;
    }

    //Setters
    public function setNumber($number)
    {
        if (is_int($number) < 800) {
        $this->number = $number;
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        if (is_string($description) && strlen($description) > 5 && strlen($description) < 1000) {
        $this->description = $description;
        }
    }

    public function setType1($type1)
    {
        $this->type1 = $type1;
    }

    public function setType2($type2)
    {
        $this->type2 = $type2;
    }
}