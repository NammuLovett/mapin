<?php

class Controller
{
    public $view;
    private $mapin;


    public function __construct()
    {
        $this->view = 'landing';
        $this->mapin = new Mapin();
    }

    public function landing()
    {
        $this->view = 'landing';
    }

    public function register()
    {
        $this->view = 'register';
    }


    /* LOGIN */

    public function login()
    {
        if (isset($_SESSION['visitor'])) {
            return $this->verVisitorDashboard();
        } else {
            $this->view = 'visitorLogin';
        }
    }


    public function logearUsuario()
    {
        // Primero, verificamos que se haya enviado tanto el correo electrónico como la contraseña.
        $logeo = $this->mapin->loginV($_POST['email'], $_POST['password']);

        if ($logeo !== false) {
            $this->verVisitorDashboard();
            $_SESSION['idVisitor'] = $logeo->getIdVisitor();
            return $logeo;
        } else {
            $this->login();
        }
    }


    public function cerrarSesion()
    {
        $this->mapin->closeV();
        $this->login();
    }

    /* CARGAR VISTAS  VISITOR */
    public function verVisitorDashboard()
    {
        if (isset($_SESSION['visitor'])) {
            $this->view = 'visitorDashboard';
            $visitor = Visitor::getVisitorById($_SESSION['visitor']);
            if ($visitor === null) {
                die("No se pudo encontrar el visitante con el ID: " . $_SESSION['visitor']);
            }
            // Pasa la información del visitante a la vista
            include 'view/visitorDashboard.php';  // Asegúrate de que este es el path correcto a tu archivo de vista
        } else {
            $this->login();
        }
    }

    public function verVisitorDescubre()
    {
        $places = Place::getAllPlaces();

        $this->view = 'visitorDescubre';
        require_once('view/visitorDescubre.php');
    }


    public function verVisitorDescubreV()
    {
        if (!isset($_SESSION['visitor'])) {
            // manejar el caso en que no hay un visitante logueado
            header('Location: index.php?action=login');
            exit();
        }

        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        $idVisitor = $visitor->getIdVisitor();
        $places = Place::getAllPlacesVisitedBy($idVisitor);

        require_once('view/visitorDescubreV.php');
        $this->view = 'visitorDescubreV';
    }

    public function verVisitorDescubreNV()
    {
        if (!isset($_SESSION['visitor'])) {
            // manejar el caso en que no hay un visitante logueado
            header('Location: index.php?action=login');
            exit();
        }

        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        $idVisitor = $visitor->getIdVisitor();
        $places = Place::getAllPlacesNotVisitedBy($idVisitor);

        require_once('view/visitorDescubreNV.php');
        $this->view = 'visitorDescubreNV';
    }





    public function verVisitorFavorito()
    {
        $this->view = 'visitorFavorito';
    }
    public function verVisitorMapa()
    {
        $this->view = 'visitorMapa';
    }


    public function verVisitorPlace()
    {
        if (isset($_GET['id'])) {
            $idPlace = $_GET['id'];

            $place = Place::getPlaceById($idPlace);


            $this->view = 'visitorPlace';
            $this->mapin = $place;



            $_SESSION['mapin'] = $place;
        } else {
            echo "ERROR: ";
        }
    }




    public function insertVisitor()
    {
        $this->view = 'visitorLogin';

        if (isset($_POST["nameVisitor"]) && isset($_POST["surnameVisitor"]) && isset($_POST["emailVisitor"]) && isset($_POST["passwordVisitor"]) && isset($_POST["genderVisitor"]) && isset($_POST["datebirthVisitor"]) && isset($_POST["cityVisitor"])) {

            $nameVisitor = $_POST['nameVisitor'];
            $surnameVisitor = $_POST['surnameVisitor'];
            $emailVisitor = $_POST['emailVisitor'];
            $passwordVisitor = $_POST['passwordVisitor']; // corregido
            $genderVisitor = $_POST['genderVisitor'];
            $datebirthVisitor = $_POST['datebirthVisitor'];
            $cityVisitor = $_POST['cityVisitor'];

            $visitor = new Visitor($idVisitor = null, $nameVisitor, $surnameVisitor, $emailVisitor, $passwordVisitor, $genderVisitor, $datebirthVisitor, $cityVisitor);
            $visitor->addVisitor($nameVisitor, $surnameVisitor, $emailVisitor, $passwordVisitor, $genderVisitor, $datebirthVisitor, $cityVisitor);

            return $visitor;
        }
    }

    public function verVisitorMapaCategory()
    {
        $categoryId = $_GET['id'];
        $places_objects = Place::getPlacesByCategoryId($categoryId);
        $category = Category::getCategoryById($categoryId);

        // Convertir cada objeto Place en un array
        $places = array_map(function ($place) {
            return $place->toArray();
        }, $places_objects);

        $places_json = json_encode($places);

        // Pasar los datos a la vista
        include 'view/visitorMapaCategory.php';

        // Console.log para verificar los datos antes de convertir a JSON
        echo "<script>console.log(" . json_encode($places) . ");</script>";

        $this->view = 'visitorMapaCategory';
    }
}
