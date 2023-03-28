<?php 

namespace App\Controllers;

use Session;

class Customers extends \Controller{
    public $row_updated = 0,$row_uploaded = 0, $data;
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Customers');
        $this->load_model('Schedule');
    }

    public function getdetails(){
        $CustomersCount = $this->CustomersModel->getCustomersCount();
        $this->view->CustomersCount = $CustomersCount;

        $this->view->Customers = $this->CustomersModel->getCustomersByDay(); 


        $EventsCount = $this->ScheduleModel->getSchedulesCount();
        $this->view->EventsCount = $EventsCount;
    }

    public function indexAction($data = null){

        $this->getdetails();


        $this->view->render('home/customers',$data);
        
    }

   
    public function deleteAction($params){
        $data = [];
        $params = intval($params);

        $cols = [
            'conditions'=>[' id = ?'], 
            'bind'=>[$params],
        ];
        $result = $this->CustomersModel->findByCol($cols);

        if($result->Confirmed == 1){
            $resultday = $result->Day;
            $resultid = $result->id;

            $eventcols = [
                'conditions'=>[' Event_Day = ?'], 
                'bind'=>[$resultday],
            ];

            if($eventday = $this->ScheduleModel->findByCol($eventcols)){
              
                $eventid = $eventday->id;

                if($eventday->Attendees >= 1){
                    $newAttendees = $eventday->Attendees - 1;
                    $fields = [
                        'Attendees' => $newAttendees
                    ];
                    $schedupdated = $this->ScheduleModel->updateSchedule($fields, $eventid);
                    if($schedupdated){
                        $deleted = $this->CustomersModel->deleteCustomer($params);
                        if($deleted){
                            $data = [
                                'deletedstatus'=> true
                            ];
                        }else{
                            $data = [
                                'deletedstatus'=> false
                            ];
                        }
                    }
                }
            }
       }else{
            $deleted = $this->CustomersModel->deleteCustomer($params);
            if($deleted){
                $data = [
                    'deletedstatus'=> true
                ];
            }else{
                $data = [
                    'deletedstatus'=> false
                ];
            }
       }
       $this->indexAction($data);
    //    $this->indexAction($data);
   }


}