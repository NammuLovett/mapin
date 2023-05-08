<?php

class Category
{
    private $idCategory;
    private $nameCategory;
    private $descriptionCategory;

    // Constructor
    public function __construct($idCategory, $nameCategory, $descriptionCategory)
    {
        $this->idCategory = $idCategory;
        $this->nameCategory = $nameCategory;
        $this->descriptionCategory = $descriptionCategory;
    }

    // Getters
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    public function getDescriptionCategory()
    {
        return $this->descriptionCategory;
    }

    // Setters
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }

    public function setDescriptionCategory($descriptionCategory)
    {
        $this->descriptionCategory = $descriptionCategory;
    }
}
