<?php 

namespace App\Controllers;


class Api extends \Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Products');
    }

    

    public function indexAction(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if($_POST){
            $sku = $_POST['sku'];

            $results = $this->ProductsModel->findByVariantSKU($sku);
            
            echo json_encode($results);
        }else{
            echo "yes";
        }
        
    }




}

?>