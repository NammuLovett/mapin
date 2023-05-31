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

    /* DASHBOARD */
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

            // Coge los lugares de la BD y los pasa a array
            $places = array_map(function ($place) {
                return $place->toArray();
            }, Place::getAllPlaces());
            $places_json = json_encode($places); //convertir datos en PHP a una cadena en formato JSON 

            // Pasa la información del visitante a la vista
            include_once 'view/visitorDashboard.php';
        } else {
            $this->login();
        }
    }


    /* DESCUBRE Total */
    public function verVisitorDescubre()
    {
        // Obtiene todos los lugares disponibles
        $places = Place::getAllPlaces();

        $this->view = 'visitorDescubre';
        require_once('view/visitorDescubre.php');
    }

    /* DESCUBRE visitado */
    public function verVisitorDescubreV()
    {
        if (!isset($_SESSION['visitor'])) {
            header('Location: index.php?action=login');
            exit();
        }
        // Por la ID de sesión obtiene al visitante
        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        // Guarda la ID del visitante
        $idVisitor = $visitor->getIdVisitor();
        // Obtiene todos los lugares que ha visitado el visitante
        $places = Place::getAllPlacesVisitedBy($idVisitor);

        require_once('view/visitorDescubreV.php');
        $this->view = 'visitorDescubreV';
    }

    /* DESCUBRE No visitado */
    public function verVisitorDescubreNV()
    {
        if (!isset($_SESSION['visitor'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        $idVisitor = $visitor->getIdVisitor();
        // Obtiene todos los lugares NO visitados
        $places = Place::getAllPlacesNotVisitedBy($idVisitor);

        require_once('view/visitorDescubreNV.php');
        $this->view = 'visitorDescubreNV';
    }


    /* FAVORITO  */
    public function verVisitorFavorito()
    {
        // Comprueba si el visitante ha iniciado sesión. Si no es así, redirige a la página de inicio de sesión.
        if (!isset($_SESSION['visitor'])) {
            header('Location: index.php?action=login');
            exit();
        }
        // Recupera el visitante actual por la ID de la sesión
        $visitor = Visitor::getVisitorById($_SESSION['visitor']);
        $idVisitor = $visitor->getIdVisitor();

        // Botiene todos los lugares favoritos del visitante
        $places_objects = Place::getAllFavoritePlacesBy($idVisitor);

        // Convertir cada objeto Places en un array
        $places = array_map(function ($place) {
            return $place->toArray();
        }, $places_objects);

        // Convierte los lugares en formato JSON
        $places_json = json_encode($places);

        /* echo "<script>console.log(" . json_encode($places) . ");</script>"; */

        // Pasa los datos a la vista
        include('view/visitorFavorito.php');
        $this->view = 'visitorFavorito';
    }


    /* VISTA CATEGORÍAS */
    public function verVisitorMapa()
    {
        $this->view = 'visitorMapa';
    }

    /* VISTA DETALLE DE LUGAR */

    public function verVisitorPlace()
    {
        if (isset($_GET['id'])) {
            $idPlace = $_GET['id'];

            // Obtiene los detalles del lugar por la IdPlace
            $place = Place::getPlaceById($idPlace);

            $idVisitor = $_SESSION['visitor'];

            // Consulta para verificar si el visitante ha visitado el lugar
            $visitData = $place->checkIfVisited($idVisitor, $idPlace);

            // Consulta para verificar si el visitante ha marcado el lugar como favorito
            $favoritedData = $place->checkIfFavorited($idVisitor, $idPlace);

            // Pasamos la variable $hasVisited y $isFavorited a la vista
            $this->view = 'visitorPlace';
            $this->mapin = $place;

            // Determina si el visitante ha visitado el lugar y si lo ha marcado como favorito con un ternario
            $hasVisited = $visitData ? true : false;
            $isFavorited = $favoritedData ? true : false;

            // Recupera la fecha de la visita, si existe
            $visitDate = $visitData ? $visitData['dateVVP'] : null;
            $_SESSION['mapin'] = $place;

            include 'view/visitorPlace.php';
        } else {
            echo "ERROR: La vista no se ha cargado correctamente";
        }
    }

    // Se usa para marcar o desmarcar un lugar como visitado
    public function toggleVisited()
    {
        // Comprueba si se ha proporcionado el id del lugar a través de GET
        if (isset($_GET['idPlace'])) {
            $idPlace = $_GET['idPlace'];
            // ID del visitante actual
            $idVisitor = $_SESSION['visitor'];
            // Obtener el objeto Lugar correspondiente
            $place = Place::getPlaceById($idPlace);
            // Cambia el estado de visitado
            $result = $place->toggleVisited($idVisitor, $idPlace);

            // si la operación fue correcta
            if ($result) {
                // Comprobar si el lugar ha sido visitado y obtener la fecha de la visita
                $visitData = $place->checkIfVisited($idVisitor, $idPlace);
                $visitDate = null;
                if ($visitData) {
                    $visitDate = $visitData['dateVVP'];
                    $visitDate = date('d/m/Y', strtotime($visitDate)); // Formatear la fecha
                }
                // Devolver un JSON con el resultado
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

            // si la operación fue correcta 
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



    // Esta función se usa para añadir un nuevo visitante en la base de datos
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
        // Obtener el objeto Categoría correspondiente por id de categoría
        $category = Category::getCategoryById($categoryId);


        // Convertir cada objeto Lugar en un array
        $places = array_map(function ($place) {
            return $place->toArray();
        }, $places_objects);

        // Codificar los lugares en JSON
        $places_json = json_encode($places);

        // Pasar los datos a la vista
        include 'view/visitorMapaCategory.php';

        /* echo "<script>console.log(" . json_encode($places) . ");</script>"; */

        // Establecer la vista
        $this->view = 'visitorMapaCategory';
    }
}
