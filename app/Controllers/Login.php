<?php

namespace App\Controllers;

use Router;

class Login extends \Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('Loginlayout');
    }

    public function indexAction(){
        $validation = new \Validate();
       
        if($_POST){
            $validation->check($_POST, [
                'username' => [
                    'display' => "Username",
                    'required' => true
                ],
                'password' => [
                    'display' => "Password",
                    'required' => true,
                    'min' => 6
                ]
            ]);

            $username = $_POST['username'];
            $password = $_POST['password'];

        
            
            if($validation->passed()){
                $user = $this->usersModel->findByUsername($username);
                if($user && password_verify(\Input::get('password'),$user->Password)){
                    $remember = (isset($_POST['username']) && \Input::get('remember'))? true : false;
                    $this->usersModel->login($remember,$user->id);
                    Router::redirect('home/index');
                }else{
                    $validation->addError("Username or password does not match");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('Login/index');
    }

    public function logoutAction(){
        if(currentUser()){
            currentUser()->logout();
        }
        Router::redirect('login/index');
    }
}

?>