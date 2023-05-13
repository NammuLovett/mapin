<?php

class Controller
{
    public $view;
    public $header;
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

    public function login()
    {
        $this->view = 'login.php';
    }
    public function visitorDashboard()
    {
    }
}
