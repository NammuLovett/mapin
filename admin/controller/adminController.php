<?php

class adminController
{
    public $view;
    public $mapin;
    public $title;
    public $vars = array();


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
            }
        }
    }


    public function logearUsuario()
    {

        $logeo = $this->mapin->login($_POST['email'], $_POST['password']);
        if ($logeo !== false) {
            $this->verManagerDashboard();
            return $logeo;
        } else {
            $this->login();
        }
    }

    public function cerrarSesion()
    {
        $this->mapin->close();
        $this->login();
    }



    public function verManagerDashboard()
    {
        if (isset($_SESSION['manager'])) {
            $this->view = 'managerDashboard';
            return $this->mapin->getManagerById($_SESSION['manager']);
        } else {
            $this->login();
        }
    }

    /* CARGAR VISTAS MANAGER*/
    public function verManagerCategory()
    {
        $this->view = 'managerCategory';
    }

    public function verManagerCategoryForm()
    {
        $this->view = 'managerCategoryForm';
    }

    public function verManagerPlace()
    {
        $this->view = 'managerPlace';
    }

    public function verManagerPlaceForm()
    {
        $this->view = 'managerPlaceForm';
    }


    /* CATEGORÏA */

    public function insertCategory()
    {
        $this->view = 'managerCategory';

        if (isset($_POST["nameCategory"]) && isset($_POST["descriptionCategory"])) {

            $nameCategory = $_POST['nameCategory'];
            $descriptionCategory = $_POST['descriptionCategory'];
            $category = new Category($idCategory = null, $nameCategory, $descriptionCategory);
            $category->addCategory($nameCategory, $descriptionCategory);
            return $category;
        }
    }

    public function verEditCategory()
    {
        $idCategory = $_GET['id'];
        $category = Category::getCategoryById($idCategory);
        $this->vars = [];
        $this->vars['category'] = $category;
        $this->view = 'managerCategoryFormEdit';
    }

    public function editCategory()
    {
        $idCategory = $_GET['id'];
        if (isset($_POST['nameCategory']) && isset($_POST['descriptionCategory'])) {
            $nameCategory = $_POST['nameCategory'];
            $desCategory = $_POST['descriptionCategory'];

            $categoria = new Category($idCategory, $nameCategory, $desCategory);
            $categoria->editCategory($idCategory);
        }

        $this->view = 'managerCategory';
    }




    public function deleteCategory()
    {

        $idCategory = $_GET['id'];
        $categoria = new Category($idCategory, null, null);
        $categoria->deleteCategory($idCategory);

        $this->view = 'managerCategory';
    }
    /* index.php?action=insertCategory */
}
