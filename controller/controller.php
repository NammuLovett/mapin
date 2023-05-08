<?php

class Controller
{
    public $view;
    private $location;
    public $header;

    public function __construct()
    {
        $this->view = 'location';
        $this->location = new Location();
    }

    public function getLocation()
    {
        $this->view = 'location';
        $this->header = "headerPral";
        return $this->location->getPlaces();
    }

    public function listPlaces()
    {
        $this->view = 'listPlaces';
        $this->header = "headerSec";
        return $this->location->getPlaces();
    }

    public function viewPlace($idPlace = null)
    {
        $this->view = 'place';
        $this->header = "headerSec";
        if (isset($_GET["id"])) $idPlace = $_GET["id"];
        $place = $this->location->getPlaceById($idPlace);

        return $place;
    }

    public function viewManager($idManager = null)
    {
        $this->view = 'manager';
        $this->header = "headerSec";

        if (isset($_GET["id"])) $idManager = $_GET["id"];
        $manager = $this->location->getManagerById($idManager);

        return $manager;
    }

    public function visitor()
    {
        $this->view = 'visitor'; // carga nueva vista
        $this->header = "headerSec"; // carga cabecera
        if (isset($_GET["id"])) $idVisitor = $_GET["id"]; // obtiene el id del visitante

        return $this->location->getVisitorById($idVisitor); // devuelve el visitante
    }
}
