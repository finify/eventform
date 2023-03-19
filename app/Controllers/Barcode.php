<?php 

namespace App\Controllers;

use Session;

class Barcode extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }

    public function indexAction(){

        $this->view->setLayout('Barcode');
        $this->view->render('home/barcode');
    }
}