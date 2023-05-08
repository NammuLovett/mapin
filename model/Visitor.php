<?php

class Visitor
{
    private $idVisitor;
    private $nameVisitor;
    private $surnameVisitor;
    private $emailVisitor;
    private $passwordVisitor;
    private $genderVisitor;
    private $datebirthVisitor;
    private $cityVisitor;
    private $places;
    private $favorites;

    // Constructor
    public function __construct($idVisitor, $nameVisitor, $surnameVisitor, $emailVisitor, $passwordVisitor, $genderVisitor, $datebirthVisitor, $cityVisitor)
    {
        $this->idVisitor = $idVisitor;
        $this->nameVisitor = $nameVisitor;
        $this->surnameVisitor = $surnameVisitor;
        $this->emailVisitor = $emailVisitor;
        $this->passwordVisitor = $passwordVisitor;
        $this->genderVisitor = $genderVisitor;
        $this->datebirthVisitor = $datebirthVisitor;
        $this->cityVisitor = $cityVisitor;
        $this->places = array();
        $this->favorites = array();
    }

    // Getters
    public function getIdVisitor()
    {
        return $this->idVisitor;
    }

    public function getNameVisitor()
    {
        return $this->nameVisitor;
    }

    public function getSurnameVisitor()
    {
        return $this->surnameVisitor;
    }

    public function getEmailVisitor()
    {
        return $this->emailVisitor;
    }

    public function getPasswordVisitor()
    {
        return $this->passwordVisitor;
    }

    public function getGenderVisitor()
    {
        return $this->genderVisitor;
    }

    public function getDatebirthVisitor()
    {
        return $this->datebirthVisitor;
    }

    public function getCityVisitor()
    {
        return $this->cityVisitor;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    public function getFavorites()
    {
        return $this->favorites;
    }

    // Setters
    public function setIdVisitor($idVisitor)
    {
        $this->idVisitor = $idVisitor;
    }

    public function setNameVisitor($nameVisitor)
    {
        $this->nameVisitor = $nameVisitor;
    }

    public function setSurnameVisitor($surnameVisitor)
    {
        $this->surnameVisitor = $surnameVisitor;
    }

    public function setEmailVisitor($emailVisitor)
    {
        $this->emailVisitor = $emailVisitor;
    }

    public function setPasswordVisitor($passwordVisitor)
    {
        $this->passwordVisitor = $passwordVisitor;
    }

    public function setGenderVisitor($genderVisitor)
    {
        $this->genderVisitor = $genderVisitor;
    }

    public function setDatebirthVisitor($datebirthVisitor)
    {
        $this->datebirthVisitor = $datebirthVisitor;
    }

    public function setCityVisitor($cityVisitor)
    {
        $this->cityVisitor = $cityVisitor;
    }

    // Métodos para manejar los arrays de lugares y favoritos
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

    public function addFavorite($favorite)
    {
        array_push($this->favorites, $favorite);
    }

    public function removeFavorite($favorite)
    {
        $index = array_search($favorite, $this->favorites);
        if ($index !== false) {
            array_splice($this->favorites, $index, 1);
        }
    }
}
