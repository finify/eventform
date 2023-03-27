<?php 

namespace App\Controllers;

use Session;

class Verify extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->setLayout('Formlayout');
        $this->load_model('Customers');
        $this->load_model('Schedule');
    }

    public function indexAction($data = []){

        $cols = [
            'conditions'=>[' Confirm_code = ?'], 
            'bind'=>[$data]
        ];

        $verifydata = [];


        if($result = $this->CustomersModel->findByCol($cols)){
            $fields = [
                'Confirmed' => 1
            ];
            $updated = $this->CustomersModel->updateCustomer($fields, $result->id);
            if($updated){
                $verifydata = [
                    'status'=> 'updated'
                ];
                $schedcols = [
                    'conditions'=>[' Event_Day = ?'], 
                    'bind'=>[$result->Day]
                ];

                if($Scheduleresult = $this->ScheduleModel->findByCol($schedcols)){
                    $newAttendees = $Scheduleresult->Attendees + 1;
                    $fields = [
                        'Attendees' => $newAttendees
                    ];

                    if($newAttendees <= $Scheduleresult->Max_Attendees){
                        $schedupdated = $this->ScheduleModel->updateSchedule($fields, $Scheduleresult->id);

                        if($schedupdated){
                            $verifydata = [
                                'status'=> 'updated'
                            ];
                        }
                    }
                }else{
                    echo 'no schedule';
                }
            }
        }else{
            $verifydata = [
                'status'=> 'notfound'
            ];
        }
        $this->view->render('home/verify',$verifydata);
    }
}