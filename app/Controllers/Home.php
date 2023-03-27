<?php 

namespace App\Controllers;

use Session;

class Home extends \Controller{
    public $row_updated = 0,$row_uploaded = 0, $data;
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Customers');
        $this->load_model('Schedule');
    }

    public function getdetails(){
        $CustomersCount = $this->CustomersModel->getCustomersCount();
        $this->view->CustomersCount = $CustomersCount;

        $this->view->Customers = $this->CustomersModel->getCustomers(); 


        $EventsCount = $this->ScheduleModel->getSchedulesCount();
        $this->view->EventsCount = $EventsCount;
    }

    public function indexAction($data = null){

        $this->getdetails();


        $this->view->render('home/index',$data);
        
    }

    public function uploadAction()
    {
        // $this->getdetails();

        // Allowed mime types
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['csv_file']['name']) && in_array($_FILES['csv_file']['type'], $fileMimes))
        {
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            //variable to get the number of uploaded rows
            $row_uploaded = 0;
            $row_updated = 0;
            
            // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                
                // Get row data
                $Handle = $getData[0];
                $Title = $getData[1];
                $Body_Html = $getData[2];
                $Vendor = $getData[3];
                $Type = $getData[5];
                $Published = $getData[7];
                $Option1_Name = $getData[8];
                $Option1_Value = $getData[9];
                $Option2_Name = $getData[10];
                $Option2_Value = $getData[11];
                $Option3_Name = $getData[12];
                $Option3_Value = $getData[13];
                $Variant_SKU = $getData[14];
                $Variant_SKU = trim($Variant_SKU, "'");

                $Variant_Price = $getData[19];
                $Image_Src = $getData[24];
                $Variant_Image = $getData[43];
                $Created_At = date("d/m/Y");
                $Updated_At = date("d/m/Y");

                $fields = [
                    'Handle' => $Handle,
                    'Title' => $Title,
                    'Body_Html' => $Body_Html,
                    'Vendor' => $Vendor,
                    'Type' => $Type,
                    'Published' => $Published,
                    'Option1_Name' => $Option1_Name,
                    'Option1_Value' => $Option1_Value,
                    'Option2_Name' => $Option2_Name,
                    'Option2_Value' => $Option2_Value,
                    'Option3_Name' => $Option3_Name,
                    'Option3_Value' => $Option3_Value,
                    'Variant_SKU' => $Variant_SKU,
                    'Variant_Price' => $Variant_Price,
                    'Image_Src' => $Image_Src,
                    'Variant_Image' => $Variant_Image,
                    'Created_At' => $Created_At,
                    'Updated_At' => $Updated_At
                ];



                // dnd($fields);
                
                //If variant sku is present 
                $variant_found = $this->ProductsModel->findByVariantSKU($Variant_SKU);

                if (!$variant_found) {
                    $rowinserted = $this->ProductsModel->insertRows($fields);
                    if($rowinserted){
                        $this->row_uploaded++;
                    }
                }else{
                    
                    $rowupdated = $this->ProductsModel->updateRows($fields,'Variant_SKU', $Variant_SKU);
                    
                    if($rowupdated){
                        $this->row_updated++;
                    }
                }
                
               
               
            }
            
            $this->data = [
                'status'=> true,
                'row_updated' => $this->row_updated,
                'row_uploaded' => $this->row_uploaded
            ];

            

            
        }else{
            $this->data = [
                'error'=> true
            ];
        }
        // dnd($this->data);

        $this->indexAction($this->data);


    }



    public function deletepurchaseAction($params){
        $data = [];
        $params = intval($params);
        $deleted = $this->PurchaseModel->deletePurchase($params);
        if($deleted){
           $data = [
               'deletedstatus'=> true
           ];
       }else{
           $data = [
               'deletedstatus'=> false
           ];
       }
       $this->indexAction($data);
   }


}