<?php

namespace App\Models;

class Products extends \Model
{
    public $table_name = 'products';
    
    public function __construct($user = ''){
        $table = 'products';
        parent::__construct($table);
    }

    public function findByVariantSKU($Variant_SKU){
        return $this->_db->findFirst($this->table_name,['conditions'=>' Variant_SKU = ?', 'bind'=>[$Variant_SKU]]);
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getProduct($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getProducts(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getProductsCount(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deleteProduct($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateProduct($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}