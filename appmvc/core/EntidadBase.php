<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();
		 
		$this->conectar = null;
		$this->db = $adapter;
    }
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table;");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getPaises(){
        $query=$this->db->query("SELECT * FROM PAIS ORDER BY codigo ASC;");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    public function obtenerAmigos($id){
        $id= (int)$id;
		$query=$this->db()->query("SELECT ID_USUARIO_R FROM amigo WHERE ID_USUARIO_S= '$id' AND ESTADO=1;");
	
        while ($row = $query->fetch_assoc()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }
    

    public function getPostAmigos($id){
        $id= (int)$id;
        $hoy=strftime( "%Y-%m-%d-%H-%M-%S", time() );
        $fecha = new DateTime();
        $fecha->sub(new DateInterval('P7D'));
        $fecha=$fecha->format('Y-m-d H:i:s');
		$query=$this->db()->query("SELECT * FROM post WHERE ID_USUARIO= '$id' AND FECHA BETWEEN '$fecha' AND '$hoy' ORDER BY FECHA ASC;");
	
        while ($row = $query->fetch_assoc()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }
    
    
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }

    
    public function getBy($column,$value){
        $sql = "SELECT * FROM $this->table WHERE $column = '$value';";
        $result= $this->db()->query($sql); 
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                        }
                            return $row;
                        }
    
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
    
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }

    public function getPais($value){
        $query=$this->db->query("SELECT * FROM pais WHERE codigo='".$value."';");
        while($row = $query->fetch_object("Pais"))  {
           $resultSet[]=$row;
           
        }
        
        return $resultSet;
    }

    /*
     * Aqui podemos agregar otros métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */

}
?>
