<?php

class Place
{
    private $idPlace;
    private $namePlace;
    private $infoPlace;
    private $descriptionPlace;
    private $addressPlace;
    private $imgPlace;
    private $coordinatesPlace;
    private $showPlace;
    private $idLocation;
    private array $categories = array();



    // Constructor
    public function __construct($idPlace, $namePlace, $infoPlace, $descriptionPlace, $addressPlace, $imgPlace, $coordinatesPlace, $showPlace, $idLocation)
    {
        $this->idPlace = $idPlace;
        $this->namePlace = $namePlace;
        $this->infoPlace = $infoPlace;
        $this->descriptionPlace = $descriptionPlace;
        $this->addressPlace = $addressPlace;
        $this->imgPlace = $imgPlace;
        $this->coordinatesPlace = $coordinatesPlace;
        $this->showPlace = $showPlace;
        $this->idLocation = $idLocation;
    }



    // Getters
    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function getNamePlace()
    {
        return $this->namePlace;
    }

    public function getInfoPlace()
    {
        return $this->infoPlace;
    }

    public function getDescriptionPlace()
    {
        return $this->descriptionPlace;
    }

    public function getAddressPlace()
    {
        return $this->addressPlace;
    }

    public function getImgPlace()
    {
        return $this->imgPlace;
    }

    public function getCoordinatesPlace()
    {
        return $this->coordinatesPlace;
    }

    public function getShowPlace()
    {
        return $this->showPlace;
    }

    public function getIdLocation()
    {
        return $this->idLocation;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    // Setters
    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function setNamePlace($namePlace)
    {
        $this->namePlace = $namePlace;
    }

    public function setInfoPlace($infoPlace)
    {
        $this->infoPlace = $infoPlace;
    }

    public function setDescriptionPlace($descriptionPlace)
    {
        $this->descriptionPlace = $descriptionPlace;
    }

    public function setAddressPlace($addressPlace)
    {
        $this->addressPlace = $addressPlace;
    }

    public function setImgPlace($imgPlace)
    {
        $this->imgPlace = $imgPlace;
    }

    public function setCoordinatesPlace($coordinatesPlace)
    {
        $this->coordinatesPlace = $coordinatesPlace;
    }

    public function setShowPlace($showPlace)
    {
        $this->showPlace = $showPlace;
    }

    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }

    // Métodos para manejar el array de categorías
    public function addCategory($category)
    {
        array_push($this->categories, $category);
    }

    public function removeCategory($category)
    {
        $index = array_search($category, $this->categories);
        if ($index !== false) {
            array_splice($this->categories, $index, 1);
        }
    }

    /* FUNCIONES */

    public static function getAllPlaces()
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM place"; // Asume que 'place' es el nombre de tu tabla
        $result = $conection->query($sql);
        $places = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['coordinatesPlace'], $row['showPlace'], $row['idLocation']);
                // Tendrás que añadir las categorías después de crear el objeto place, si es necesario.
                $places[] = $place;
            }
        }

        return $places;
    }

    public static function getPlaceById($idPlace)
    {
        $dbObj = new Db();
        $conection = $dbObj->conection;

        $sql = "SELECT * FROM place WHERE idPlace = '$idPlace'";

        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $place = new Place($row['idPlace'], $row['namePlace'], $row['infoPlace'], $row['descriptionPlace'], $row['addressPlace'], $row['imgPlace'], $row['coordinatesPlace'], $row['showPlace'], $row['idLocation']);
            return $place;
        } else {
            return null;
        }
    }
}
