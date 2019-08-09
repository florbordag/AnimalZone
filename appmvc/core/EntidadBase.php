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
		$query=$this->db()->query("SELECT DISTINCT* from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=1;");
	
        while ($row = $query->fetch_object()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }
    
    public function getNoAmigos($id){
        $id= (int)$id;
		$query=$this->db()->query("SELECT * FROM usuario WHERE ID_USUARIO NOT IN (SELECT DISTINCT(ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=1)
        AND ID_USUARIO NOT IN (SELECT DISTINCT(ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=0) AND ID_USUARIO!=$id LIMIT 4");
	
        while ($row = $query->fetch_object()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }

    public function getNoAmigosxPais($id, $pais){
        $id= (int)$id;
		$query=$this->db()->query("SELECT * FROM usuario WHERE ID_USUARIO NOT IN (SELECT DISTINCT(ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=1)
        AND ID_USUARIO NOT IN (SELECT DISTINCT(ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=0) AND PAIS='$pais' LIMIT 5");
	
        while ($row = $query->fetch_object()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }

    public function getNoAmigosXinteres($arr, $id){
        if(is_array($arr)) {$intereses= implode('% OR INTERESES LIKE %',$arr); $intereses=$intereses.'none%';} else { $intereses=$arr;}

		$query=$this->db()->query("SELECT * FROM usuario WHERE intereses LIKE '$intereses' 
        AND ID_USUARIO NOT IN(SELECT DISTINCT u.ID_USUARIO from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
        where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
        and u.ID_USUARIO != $id
        and a.ESTADO=1)
        AND ID_USUARIO !=$id
        LIMIT 5");
	
        while ($row = $query->fetch_object()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL; echo $this->db()->error;
		 return $resultSet;
    }
    public function buscarMiAmigo($username, $yo){

		$query=$this->db()->query("SELECT * FROM usuario WHERE ID_USUARIO IN
        (SELECT DISTINCT u.ID_USUARIO from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
               where (a.ID_USUARIO_S=$yo or a.ID_USUARIO_R=$yo)
               and u.ID_USUARIO != $yo
               and a.ESTADO=1)
       AND USERNAME LIKE '$username' OR MAIL LIKE '$username'");
	
        while ($row = $query->fetch_object()) {
			$resultSet[]=$row;
		 }
		 $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }



    public function getMisPost($id){
        $id= (int)$id;
        
		$query=$this->db()->query("SELECT * FROM POST WHERE ID_USUARIO= '$id' ORDER BY FECHA DESC;");
	
            while ($row = $query->fetch_object()) { 
             $resultSet[]=$row;
            
		 }
	     $resultSet=isset($resultSet)?$resultSet:NULL;
		 return $resultSet;
    }
    public function getPostStalk($id){
        $id= (int)$id;
        
		$query=$this->db()->query("SELECT * FROM POST WHERE ID_USUARIO= '$id' AND PUBLICO=1 ORDER BY FECHA DESC;");
	
            while ($row = $query->fetch_object()) { 
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

        
    public function getAmi($id){
        $query=$this->db->query("SELECT * FROM usuario WHERE ID_USUARIO=$id;");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }


public function postajenos($id){
    $sql="SELECT * FROM 
    (SELECT * FROM post as posteos WHERE ESTADO=1) 
    AS posteos
    WHERE ID_USUARIO!=$id 
    AND (PUBLICO=1 OR ID_USUARIO IN(SELECT DISTINCT(u.ID_USUARIO) from usuario u join amigo a on u.ID_USUARIO=a.ID_USUARIO_S or u.ID_USUARIO=a.ID_USUARIO_R
    where (a.ID_USUARIO_S=$id or a.ID_USUARIO_R=$id)
    and u.ID_USUARIO !=$id
     and a.ESTADO=1)) ORDER BY FECHA DESC";

    $query=$this->db()->query($sql);
    while ($row = $query->fetch_object()) { 
        $resultSet[]=$row;
       
    }
    $resultSet=isset($resultSet)?$resultSet:NULL;
    return $resultSet;
}




    
    public function getBy($column,$value){
        $sql = "SELECT * FROM $this->table WHERE $column = '$value';";
        $result= $this->db()->query($sql); 
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                        } else{$row=null;}
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
