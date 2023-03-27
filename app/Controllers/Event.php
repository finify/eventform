<?php 

namespace App\Controllers;

use Session;

class Event extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Schedule');
    }

    public function getdetails(){
        $this->view->EventsCount = $this->ScheduleModel->getSchedulesCount();
        $this->view->Schedules = $this->ScheduleModel->getSchedules(); 
    }

    public function indexAction($data = null){
        
        $data = [];
        if($_POST){
            $Event_Name = $_POST['Event_Name'];
            $max = $_POST['max'];
            $Event_Date = $_POST['Event_Date'];
            $Position =  $_POST['Position'];
            $datecreated = date("d/m/Y");
            
            $fields = [
                'Event_Name' => $Event_Name,
                'Event_Day' => $Event_Date,
                'Attendees' => 0,
                'Max_Attendees' => $max,
                'Position' => $Position,
                'Created' => $datecreated 
            ];

            $cols = [
                'conditions'=>[' Event_Name = ?',' Event_Day = ?',' Position = ?'], 
                'bind'=>[$Event_Name, $Event_Date , $Position]
            ];

            if($this->ScheduleModel->findByCol($cols)){
                $data = [
                    'insertedstatus'=> false
                ];
            }else{
                $inserted = $this->ScheduleModel->insertRows($fields);

                if($inserted){
                    $data = [
                        'insertedstatus'=> true
                    ];
                }
            }
        
        }

        $this->getdetails();
        $this->view->render('home/event',$data);
    }
}