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
            return $this->mapin->getVisitorById($_SESSION['visitor']);
        } else {
            $this->login();
        }
    }

    public function verVisitorDescubre()
    {
        $this->view = 'visitorDescubre';
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
        $this->view = 'visitorPlace';
    }
}
