<?php 

namespace App\Controllers;

use Session;

class Form extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->setLayout('Formlayout');

        $this->load_model('Schedule');
    }
    public function getdetails(){
        $this->view->EventsCount = $this->ScheduleModel->getSchedulesCount();
        $this->view->Schedules = $this->ScheduleModel->getSchedules('Position','ASC'); 


    }

    public function indexAction(){

        $this->getdetails();

        $Schedules = $this->view->Schedules;
        $Event_Count = $this->view->EventsCount;

        $Event_maxed = 0;
        if(!empty($Schedules)){
           
            foreach($Schedules as $Schedule){
                if($Schedule->Event_Name == 'customer'){
                    if($Schedule->Attendees == $Schedule->Max_Attendees){
                        $Event_maxed = $Event_maxed + 1;
                    }
                }
            }
        }

        if($Event_maxed == $Event_Count){
            $this->view->render('home/register');
        }else{
            $this->view->render('home/form');
        }
        // else{
        //     echo "<option>No Event Found</option>";
        // }

        
        
    }
}