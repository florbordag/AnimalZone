<?php
class Pais extends EntidadBase{
    private $codigo;
    private $pais;
    
    public function __construct($adapter) {
        $table="pais";
        parent::__construct($table, $adapter);
    }
    public function save(){
        $query="INSERT INTO pais (codigo,pais)
                VALUES('".$this->codigo.",".$this->pais."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

    public function __get($property) { 
        if (property_exists($this, $property)) { 
        return $this->$property; } 
        }
        
        public function __set($property, $value) { 
        if (property_exists($this, $property)) { 
        $this->$property = $value; } 
        return $this; 
        } 
}
?>