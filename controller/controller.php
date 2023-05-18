<?php

class Controller
{
    public $view;
    private $mapin;



    public function __construct()
    {
        $this->view = 'landing';
        $this->mapin = new Mapin();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'toggleVisited':
                    $this->toggleVisited();
                    break;
                case 'toggleFavorited':
                    $this->toggleFavorited();
                    break;
            }
        }
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
        if (!isset($_SESSION['visitor'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        $idVisitor = $visitor->getIdVisitor();
        $places_objects = Place::getAllFavoritePlacesBy($idVisitor);

        // Convertir cada objeto Place en un array
        $places = array_map(function ($place) {
            return $place->toArray();
        }, $places_objects);

        $places_json = json_encode($places);

        // Pasar los datos a la vista
        include 'view/visitorFavorito.php';

        // Console.log para verificar los datos antes de convertir a JSON
        echo "<script>console.log(" . json_encode($places) . ");</script>";

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

            $idVisitor = $_SESSION['visitor'];

            // Consulta para verificar si el visitante ha visitado el lugar
            $visitData = $place->checkIfVisited($idVisitor, $idPlace);

            // Consulta para verificar si el visitante ha marcado el lugar como favorito
            $favoritedData = $place->checkIfFavorited($idVisitor, $idPlace);

            // Pasamos la variable $hasVisited y $isFavorited a la vista
            $this->view = 'visitorPlace';
            $this->mapin = $place;
            $hasVisited = $visitData ? true : false;
            $visitDate = $visitData ? $visitData['dateVVP'] : null;
            $isFavorited = $favoritedData ? true : false;
            $_SESSION['mapin'] = $place;

            // Consulta para obtener las categorías de lugares visitados por el visitante
            $visitedCategoriesData = Place::getVisitedPlacesCategoriesCountByVisitor($idVisitor);


            // Calcular el porcentaje de lugares visitados
            $totalPlaces = Place::getTotalPlaces();
            $visitedPlacesCount = Place::getVisitedPlacesCount($idVisitor);
            $percentageVisited = round(($visitedPlacesCount / $totalPlaces) * 100);


            include 'view/visitorPlace.php';
        } else {
            echo "ERROR: ";
        }
    }




    public function toggleVisited()
    {
        if (isset($_POST['idPlace'])) {
            $idPlace = $_POST['idPlace'];
            $idVisitor = $_SESSION['visitor'];
            $place = Place::getPlaceById($idPlace);
            $result = $place->toggleVisited($idVisitor, $idPlace);
            echo json_encode(array('success' => $result));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function toggleFavorited()
    {
        if (isset($_POST['idPlace'])) {
            $idPlace = $_POST['idPlace'];
            $idVisitor = $_SESSION['visitor'];
            $place = Place::getPlaceById($idPlace);
            $result = $place->toggleFavorited($idVisitor, $idPlace);
            echo json_encode(array('success' => $result));
        } else {
            echo json_encode(array('success' => false));
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
