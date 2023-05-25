<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

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
            $idVisitor = $_SESSION['visitor'];
            if ($visitor === null) {
                die("No se pudo encontrar el visitante con el ID: " . $_SESSION['visitor']);
            }

            //categorías de lugares visitados por el visitante
            $visitedCategoriesData = Place::getVisitedPlacesCategoriesCountByVisitor($idVisitor);

            // Calcular el porcentaje de lugares visitados
            $totalPlaces = Place::getTotalPlaces();
            $visitedPlacesCount = Place::getVisitedPlacesCount($idVisitor);
            $percentageVisited = round(($visitedPlacesCount / $totalPlaces) * 100);

            // todos los lugares y conviértelos a arrays
            $places = array_map(function ($place) {
                return $place->toArray();
            }, Place::getAllPlaces());
            $places_json = json_encode($places); //convertir datos en PHP a una cadena en formato JSON 

            // Pasa la información del visitante a la vista
            include 'view/visitorDashboard.php';
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

        /* echo "<script>console.log(" . json_encode($places) . ");</script>"; */

        // Pasar los datos a la vista
        include('view/visitorFavorito.php');
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
            $isFavorited = $favoritedData ? true : false;
            $visitDate = $visitData ? $visitData['dateVVP'] : null;
            $_SESSION['mapin'] = $place;

            include 'view/visitorPlace.php';
        } else {
            echo "ERROR: La vista no se ha cargado correctamente";
        }
    }

    // Esta función se usa para marcar o desmarcar un lugar como visitado
    public function toggleVisited()
    {
        // Verificar si se ha proporcionado el id del lugar a través de GET
        if (isset($_GET['idPlace'])) {
            $idPlace = $_GET['idPlace'];
            $idVisitor = $_SESSION['visitor'];  // ID del visitante actual
            $place = Place::getPlaceById($idPlace);  // Obtener el objeto Lugar correspondiente
            $result = $place->toggleVisited($idVisitor, $idPlace);  // Cambiar el estado de visitado

            // Verificar si la operación fue exitosa
            if ($result) {
                // Comprobar si el lugar ha sido visitado y obtener la fecha de la visita
                $visitData = $place->checkIfVisited($idVisitor, $idPlace);
                $visitDate = null;
                if ($visitData) {
                    $visitDate = $visitData['dateVVP'];
                    $visitDate = date('m/d/Y', strtotime($visitDate)); // Formatear la fecha
                }
                // Devolver un JSON con el resultado de la operación
                echo json_encode(array('success' => true, 'Visitado' => $visitData ? true : false, 'fecha' => $visitDate));
            } else {
                // Devolver un JSON con un error
                echo json_encode(array('success' => false, 'error' => 'Error de consulta SQL'));
            }
        } else {
            // Devolver un JSON con un error
            echo json_encode(array('success' => false, 'error' => 'ID No encontrado'));
        }
        exit;
    }

    // Esta función se usa para marcar o desmarcar un lugar como favorito
    public function toggleFavorited()
    {
        // Verificar si se ha proporcionado el id del lugar a través de GET
        if (isset($_GET['idPlace'])) {
            $idPlace = $_GET['idPlace'];
            $idVisitor = $_SESSION['visitor'];  // ID del visitante actual
            $place = Place::getPlaceById($idPlace);  // Obtener el objeto Lugar correspondiente
            $result = $place->toggleFavorited($idVisitor, $idPlace);  // Cambiar el estado de favorito

            // Verificar si la operación fue exitosa
            if ($result) {
                // Devolver un JSON con el resultado de la operación
                echo json_encode(array('success' => true, 'favorited' => $place->checkIfFavorited($idVisitor, $idPlace)));
            } else {
                // Devolver un JSON con un error
                echo json_encode(array('success' => false, 'error' => 'Error de consulta SQL'));
            }
        } else {
            // Devolver un JSON con un error
            echo json_encode(array('success' => false, 'error' => 'ID No encontrado'));
        }
        exit;
    }

    // Esta función se usa para insertar un nuevo visitante en la base de datos
    public function insertVisitor()
    {
        // Establecer la vista
        $this->view = 'visitorLogin';

        // Verificar si se han proporcionado todos los datos necesarios a través de POST
        if (isset($_POST["nameVisitor"]) && isset($_POST["surnameVisitor"]) && isset($_POST["emailVisitor"]) && isset($_POST["passwordVisitor"]) && isset($_POST["genderVisitor"]) && isset($_POST["datebirthVisitor"]) && isset($_POST["cityVisitor"])) {

            // Obtener los datos del visitante
            $nameVisitor = $_POST['nameVisitor'];
            $surnameVisitor = $_POST['surnameVisitor'];
            $emailVisitor = $_POST['emailVisitor'];
            $passwordVisitor = $_POST['passwordVisitor'];
            $genderVisitor = $_POST['genderVisitor'];
            $datebirthVisitor = $_POST['datebirthVisitor'];
            $cityVisitor = $_POST['cityVisitor'];

            // Crear un nuevo objeto Visitante
            $visitor = new Visitor($idVisitor = null, $nameVisitor, $surnameVisitor, $emailVisitor, $passwordVisitor, $genderVisitor, $datebirthVisitor, $cityVisitor);
            // Insertar el visitante en la base de datos
            $visitor->addVisitor($nameVisitor, $surnameVisitor, $emailVisitor, $passwordVisitor, $genderVisitor, $datebirthVisitor, $cityVisitor);

            // Devolver el objeto Visitante
            return $visitor;
        }
    }

    // Esta función muestra un mapa con los lugares de una categoría específica
    public function verVisitorMapaCategory()
    {
        // Obtener el id de la categoría a través de GET
        $categoryId = $_GET['id'];
        // Obtener todos los lugares de la categoría
        $places_objects = Place::getPlacesByCategoryId($categoryId);
        // Obtener el objeto Categoría correspondiente
        $category = Category::getCategoryById($categoryId);


        // Convertir cada objeto Lugar en un array
        $places = array_map(function ($place) {
            return $place->toArray();
        }, $places_objects);

        // Codificar los lugares en JSON
        $places_json = json_encode($places);

        // Pasar los datos a la vista
        include 'view/visitorMapaCategory.php';

        // Debugging
        echo "<script>console.log(" . json_encode($places) . ");</script>";

        // Establecer la vista
        $this->view = 'visitorMapaCategory';
    }
}
