<?php 

namespace App\Controllers;

class Api extends \Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Schedule');
        $this->load_model('Customers');
    }

    

    public function indexAction(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if($_POST){
            $event_day = $_POST['event_day'];

            $cols = [
                'conditions'=>[' Event_Day = ?'], 
                'bind'=>[$event_day]
            ];

            $result = $this->ScheduleModel->findByCol($cols);

            echo json_encode($result);
        }else{
            echo "yes";
        }
        
    }

    public function addAction(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if($_POST){
            $event_day = $_POST['event_day'];
            $full_name = $_POST['full_name'];
            $email_address = $_POST['email_address'];
            $subscribe = $_POST['subscribe'];
            $confirm_code = getRandomString(15);
            $created = date("d/m/Y");

            $verify_link = PROOT."verify/index/".$confirm_code;

            $this->view->Customers = $this->CustomersModel->getCustomers();


            $fields = [
                'Email' => $email_address,
                'Full_Name' => $full_name,
                'Subscribe' => $subscribe,
                'Day' => $event_day,
                'Confirmed' => 0,
                'Confirm_code' => $confirm_code,
                'Created' => $created,
            ];

            $cols = [
                'conditions'=>[' Email = ?'], 
                'bind'=>[$email_address]
            ];


            if($this->CustomersModel->findByCol($cols)){
                $data = [
                    'status'=> 'foundemail'
                ];
            }else{
                $inserted = $this->CustomersModel->insertRows($fields);

                if($inserted){
                    

                    $to      = $email_address; 

                    $subject = 'Invitation Confirmation'; 

                    $message = '<html><body>';
                    $message .= '<div style="background-color: white; text-align: left;color: black; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
                    $message .= "<img src='".PROOT."assets/img/bcode.png' alt='bcode' style='width:200px; display:block; margin:auto;' >";
                    $message .= "<h2 style='font-style:bold;'> Transaction Confirmation </h2>";
                    $message .= "<h2> Good day, ". $full_name ."</h2>";
                    $message .= "<h3>Thank you for taking out time to submit an invitation for the Event</h3>";
                    $message .= "<h3>Please Click here to confirm your invitation</h3>";
                    $message .= "<a href='".$verify_link."' style='padding:20px; background:green; color:white; font-size:30px;'>CONFIRM INVITE</a>";
                    $message .= '</div>';
                    $message .= "</body></html>";

                    $message = wordwrap($message, 70, "\r\n");

                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // More headers
                    $headers .= 'From: <support@invite.brandco.tech>' . "\r\n";
                    $headers .= 'Cc: ifeanyiizuegbu@yahoo.com' . "\r\n";

                    mail($to,$subject,$message,$headers);

                    $data = [
                        'status'=> 'inserted'
                    ];

                    // mailto($to,$subject,$message);
                }
            }


            echo json_encode($data);
        }else{
            echo "yes";
        }
        
    }

    public function addnewAction(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if($_POST){
            $event_day = $_POST['event_day'];
            $full_name = $_POST['full_name'];
            $email_address = $_POST['email_address'];
            $subscribe = $_POST['subscribe'];
            $confirm_code = 0;
            $created = date("d/m/Y");


            $this->view->Customers = $this->CustomersModel->getCustomers();


            $fields = [
                'Email' => $email_address,
                'Full_Name' => $full_name,
                'Subscribe' => $subscribe,
                'Day' => $event_day,
                'Confirmed' => 0,
                'Confirm_code' => $confirm_code,
                'Created' => $created,
            ];

            $cols = [
                'conditions'=>[' Email = ?'], 
                'bind'=>[$email_address]
            ];


            if($this->CustomersModel->findByCol($cols)){
                $data = [
                    'status'=> 'foundemail'
                ];
            }else{
                $inserted = $this->CustomersModel->insertRows($fields);

                if($inserted){
                    

                    $to      = $email_address; 

                    $subject = 'Invitation Confirmation'; 

                    $message = '<html><body>';
                    $message .= '<div style="background-color: white; text-align: left;color: black; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
                    $message .= "<img src='".PROOT."assets/img/bcode.png' alt='bcode' style='width:200px; display:block; margin:auto;' >";
                    $message .= "<h2 style='font-style:bold;'> Transaction Confirmation </h2>";
                    $message .= "<h2> Good day, ". $full_name ."</h2>";
                    $message .= "<h3>Thank you for taking out time to submit an invitation for the Event</h3>";
                    $message .= '</div>';
                    $message .= "</body></html>";

                    $message = wordwrap($message, 70, "\r\n");

                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // More headers
                    $headers .= 'From: <support@invite.brandco.tech>' . "\r\n";
                    $headers .= 'Cc: ifeanyiizuegbu@yahoo.com' . "\r\n";

                    mail($to,$subject,$message,$headers);

                    $data = [
                        'status'=> 'inserted'
                    ];

                    // mailto($to,$subject,$message);
                }
            }


            echo json_encode($data);
        }else{
            echo "yes";
        }
        
    }
}

?>