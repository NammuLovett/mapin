<?php

class Manager
{
    private $idManager;
    private $nameManager;
    private $surnameManager;
    private $emailManager;
    private $passwordManager;
    private $showManager;
    private $idLocation;
    private $places;

    // Constructor
    public function __construct($idManager, $nameManager, $surnameManager, $emailManager, $passwordManager, $showManager, $idLocation)
    {
        $this->idManager = $idManager;
        $this->nameManager = $nameManager;
        $this->surnameManager = $surnameManager;
        $this->emailManager = $emailManager;
        $this->passwordManager = $passwordManager;
        $this->showManager = $showManager;
        $this->idLocation = $idLocation;
        $this->places = array();
    }

    // Getters
    public function getIdManager()
    {
        return $this->idManager;
    }

    public function getNameManager()
    {
        return $this->nameManager;
    }

    public function getSurnameManager()
    {
        return $this->surnameManager;
    }

    public function getEmailManager()
    {
        return $this->emailManager;
    }

    public function getPasswordManager()
    {
        return $this->passwordManager;
    }

    public function getShowManager()
    {
        return $this->showManager;
    }

    public function getIdLocation()
    {
        return $this->idLocation;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    // Setters
    public function setIdManager($idManager)
    {
        $this->idManager = $idManager;
    }

    public function setNameManager($nameManager)
    {
        $this->nameManager = $nameManager;
    }

    public function setSurnameManager($surnameManager)
    {
        $this->surnameManager = $surnameManager;
    }

    public function setEmailManager($emailManager)
    {
        $this->emailManager = $emailManager;
    }

    public function setPasswordManager($passwordManager)
    {
        $this->passwordManager = $passwordManager;
    }

    public function setShowManager($showManager)
    {
        $this->showManager = $showManager;
    }

    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }
}
