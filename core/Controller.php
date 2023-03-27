<?php
class Controller extends Application {
    protected $_controller, $_action;
    public $view;
    protected $UsersModel,$CustomersModel,$ScheduleModel,$ProductsModel;


    public function __construct($controller, $action){
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }

    protected function load_model($model){
        
        $model1 = "App\Models\\". $model;
        if(class_exists($model1)){
            $this->{$model.'Model'} = new $model1(strtolower($model));
        }
    }
}