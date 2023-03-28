<?php

namespace App\Models;

class Customers extends \Model
{
    public $table_name = 'Customers';
    
    public function __construct($user = ''){
        $table = 'Customers';
        parent::__construct($table);
    }

    public function findByVariantSKU($Variant_SKU){
        return $this->_db->findFirst($this->table_name,['conditions'=>' Variant_SKU = ?', 'bind'=>[$Variant_SKU]]);
    }

    public function findByCol($colvalues){
        return $this->_db->findFirstCol($this->table_name,$colvalues,' OR');
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getCustomer($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getCustomers(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getCustomersByDay(){
        $sql = "SELECT * FROM {$this->table_name} WHERE Day=0 order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getCustomersCount(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deleteCustomer($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateCustomer($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}