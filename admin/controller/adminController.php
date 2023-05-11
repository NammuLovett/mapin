<?php

class adminController
{
    public $view;
    public $header;

    public function __construct()
    {
        //$this->view = 'location';
        //$this->location = new Location();
    }

    public function insertCategory()
    {
        $this->view = 'managerCategory';
        /* $this->header = "headerSec"; */
        if (isset($_POST["nameCategory"]) && isset($_POST["descriptionCategory"])) {

            $nameCategory = $_POST['nameCategory'];
            $descriptionCategory = $_POST['descriptionCategory'];
            $category = new Category($idCategory = null, $nameCategory, $descriptionCategory);
            $category->addCategory($nameCategory, $descriptionCategory);
            return $category;
        }
    }
}
