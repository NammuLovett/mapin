<?php

class adminController
{
    public $view;
    public $mapin;
    public $title;

    public function __construct()
    {
        $this->view = 'managerLogin';
        $this->mapin = new Mapin();
    }



    public function login()
    {
        if (isset($_SESSION['manager'])) {
            return $this->verManagerCategory();
        } else {
            if (isset($_SESSION['manager'])) {
                return $this->verManagerCategory();
            } else {
                $this->view = 'managerLogin';
                $this->title = 'Inicio de Sesión';
            }
        }
    }


    public function logearUsuario()
    {

        $logeo = $this->mapin->login($_POST['email'], $_POST['password']);
        if ($logeo !== false) {
            $this->verManagerCategory();
            return $logeo;
        } else {
            var_dump($_POST['email'], $_POST['password']);

            $this->login();
        }
    }

    public function cerrarSesion()
    {
        $this->mapin->close();
        $this->login();
    }

    public function verManagerCategory()
    {
        if (isset($_SESSION['manager'])) {
            $this->view = 'managerCategory';
            $this->title = 'Manager Category';
            return $this->mapin->getManagerById($_SESSION['manager']);
        } else {
            $this->login();
        }
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
