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

    public function visitorDashboard()
    {
    }
}
