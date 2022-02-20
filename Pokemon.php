<?php
//video19.08
class Pokemon 
{
    //déclaré en private > principe d'encapsulation pour protéger les données
    private int $id;
    private int $number;
    private string $name;
    private string $description;
    private string $type1;
    private $type2;
    private $image;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    //Methode d'hydratation : donner des valeurs aux attributs
    public function hydrate(array $datas): void
    {
        foreach($datas as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }

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
    public function setId($id)
    {
            $this->id = $id;
    }

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

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}