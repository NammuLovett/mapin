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
            // Obtén la información del visitante
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
        include('view/visitorDescubre.php');
    }
    public function verVisitorFavorito()
    {
        $this->view = 'visitorFavorito';
    }
    public function verVisitorMapa()
    {
        $this->view = 'visitorMapa';
    }

    public function verVisitorMapaCategory()
    {
        $this->view = 'visitorMapaCategory';
    }


    public function verVisitorPlace()
    {
        if (isset($_GET['id'])) {
            $idPlace = $_GET['id'];

            $place = Place::getPlaceById($idPlace);


            $this->view = 'visitorPlace';


            $_SESSION['mapin'] = $place;
        } else {
            echo "ERROR: ";
        }
    }
}
