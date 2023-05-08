<?php

class Location
{
    private $idLocation;
    private $nameLocation;
    private $imgLocation;
    private $coordinatesLocation;
    private $showLocation;
    private $places;

    // Constructor
    public function __construct($idLocation, $nameLocation, $imgLocation, $coordinatesLocation, $showLocation)
    {
        $this->idLocation = $idLocation;
        $this->nameLocation = $nameLocation;
        $this->imgLocation = $imgLocation;
        $this->coordinatesLocation = $coordinatesLocation;
        $this->showLocation = $showLocation;
        $this->places = array();
    }

    // Getters
    public function getIdLocation()
    {
        return $this->idLocation;
    }

    public function getNameLocation()
    {
        return $this->nameLocation;
    }

    public function getImgLocation()
    {
        return $this->imgLocation;
    }

    public function getCoordinatesLocation()
    {
        return $this->coordinatesLocation;
    }

    public function getShowLocation()
    {
        return $this->showLocation;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    // Setters
    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }

    public function setNameLocation($nameLocation)
    {
        $this->nameLocation = $nameLocation;
    }

    public function setImgLocation($imgLocation)
    {
        $this->imgLocation = $imgLocation;
    }

    public function setCoordinatesLocation($coordinatesLocation)
    {
        $this->coordinatesLocation = $coordinatesLocation;
    }

    public function setShowLocation($showLocation)
    {
        $this->showLocation = $showLocation;
    }

    // Métodos para manejar el array de lugares
    public function addPlace($place)
    {
        array_push($this->places, $place);
    }

    public function removePlace($place)
    {
        $index = array_search($place, $this->places);
        if ($index !== false) {
            array_splice($this->places, $index, 1);
        }
    }
}
