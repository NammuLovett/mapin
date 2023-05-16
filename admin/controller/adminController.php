<?php

class adminController
{
    public $view;
    public $mapin;


    public function __construct()
    {
        $this->view = 'managerLogin';
        $this->mapin = new Mapin();
    }

    /* LOGIN */

    public function login()
    {
        if (isset($_SESSION['manager'])) {
            return $this->verManagerDashboard();
        } else {
            $this->view = 'managerLogin';
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
        unset($_SESSION['manager']);
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

        global $categories;
        $categories = Category::getAllCategories();
        if (!is_array($categories) && !($categories instanceof Traversable)) {
            echo 'Error: $categories no es un array o un objeto recorrible.';
            exit;
        }
        include_once('view/managerCategory.php');
    }

    public function verManagerCategoryForm()
    {
        $this->view = 'managerCategoryForm';
    }

    public function verManagerPlace()
    {
        $places = Place::getAllPlaces();

        $this->view = 'managerPlace';
        include('view/managerPlace.php');
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

            global $categories;
            $categories = Category::getAllCategories();

            return $category;
        }
    }



    public function verEditCategory()
    {
        $idCategory = $_GET['id'];
        $category = Category::getCategoryById($idCategory);
        include_once('view/managerCategory.php');

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

        global $categories;
        $categories = Category::getAllCategories();
        include_once('view/managerCategory.php');
    }




    public function deleteCategory()
    {

        $idCategory = $_GET['id'];
        $categoria = new Category($idCategory, null, null);
        $categoria->deleteCategory($idCategory);

        $this->view = 'managerCategory';

        global $categories;
        $categories = Category::getAllCategories();
        include_once('view/managerCategory.php');
    }
    /* index.php?action=insertCategory */


    /* LUGARES */


    public function insertPlace()
    {
        $this->view = 'managerPlace';

        if (isset($_POST["namePlace"]) && isset($_POST["descriptionPlace"])) {

            $namePlace = $_POST['namePlace'];
            $infoPlace = $_POST['infoPlace'];
            $descriptionPlace = $_POST['descriptionPlace'];
            $addressPlace = $_POST['addressPlace'];
            $imgPlace = $_POST['imgPlace'];
            $latPlace = $_POST['latPlace'];
            $lonPlace = $_POST['lonPlace'];
            $showPlace = $_POST['showPlace'];
            $categories = isset($_POST['category']) ? $_POST['category'] : null;

            $place = new Place($idPlace = null, $namePlace, $infoPlace, $descriptionPlace, $addressPlace, $imgPlace = null, $latPlace, $lonPlace, $showPlace = 1, $idLocation = 1);
            $placeId = $place->addPlace($namePlace, $infoPlace, $descriptionPlace, $addressPlace, $imgPlace, $latPlace, $lonPlace, $showPlace, $idLocation);
            // Si se seleccionaron categorías y el lugar fue insertado correctamente
            if ($categories && $placeId) {
                $place->assignCategories($placeId, $categories);
            }

            global $places;
            $places = Place::getAllPlaces();
            return $place;
        }
    }



    public function deletePlace()
    {

        $idPlace = $_GET['id'];
        $place = new Place($idPlace, null, null, null, null, null, null, null, null, null, null, null);
        $place->deletePlace($idPlace);

        $this->view = 'managerPlace';

        global $places;
        $places = Place::getAllPlaces();
        include_once('view/managerPlace.php');
    }
}
