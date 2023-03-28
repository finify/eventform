<?php

namespace App\Models;

class Schedule extends \Model
{
    public $table_name = 'Schedule';
    
    public function __construct($user = ''){
        $table = 'Schedule';
        parent::__construct($table);
    }

    // public function findByVariantSKU($Variant_SKU){
    //     return $this->_db->findFirst($this->table_name,['conditions'=>' Variant_SKU = ?', 'bind'=>[$Variant_SKU]]);
    // }

    public function findByCol($colvalues){
        return $this->_db->findFirstCol($this->table_name,$colvalues,' AND');
    }

    public function findByColOr($colvalues){
        return $this->_db->findFirstCol($this->table_name,$colvalues,' OR');
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getSchedule($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getSchedules($col = 'id',$arrange = 'DESC'){
        $sql = "SELECT * FROM {$this->table_name} order by $col $arrange";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getSchedulesCount(){
        $sql = "SELECT * FROM {$this->table_name} WHERE Event_Name='customer' order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function getSchedulesCountstaff(){
        $sql = "SELECT * FROM {$this->table_name} WHERE Event_Name='staff' order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deleteSchedule($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateSchedule($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}