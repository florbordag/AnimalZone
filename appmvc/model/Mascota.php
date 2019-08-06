<?php
class Mascota extends EntidadBase{
    private $id_mascota;
    private $user; //id_usuario
    private $nombre;
    private $especie;
    private $raza;
    private $nacimiento=null;
    private $foto_perfil=null;
    private $descripcion=null;
    
    public function __construct($adapter) {
        $table="mascota";
        parent::__construct($table, $adapter);
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

    public function save(){
		require_once "Usuario.php";
		
		//verifico si el mascota se encuentra en la BD
		//sino es null entonces UPDATE
		//si es null entonces INSERT

      $id=$this->user->id_usuario;
			$query= "INSERT INTO `mascota`(`id_mascota`, `id_usuario`, `nombre`, `especie`, `raza`, `nacimiento`, `foto_perfil`, `descripcion`) VALUES ('$this->id_mascota','$id','$this->nombre','$this->especie','$this->raza','$this->nacimiento','$this->foto_perfil','$this->descripcion');";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
    }

    public function editar(){
      if($this->id_mascota){
			
        $query= "UPDATE `mascota` SET `descripcion`='$this->descripcion',`nombre`='$this->titulo',`foto_perfil`='$this->foto_perfil',`raza`='$this->raza' WHERE ID_mascota=$this->id_mascota;";
        
        $save=$this->db()->query($query);
        //echo $this->db()->error;
        return $save;
        
      }
    }

    public function getmascota($id){
      $query=$this->db()->query("SELECT * FROM mascota WHERE ID_mascota=$id;");

      if($row = $query->fetch_object()) {
         $resultSet=$row;
      }
      
      return $resultSet;
    }

    public function getAllMascotas($id){
      $sql="SELECT m.* FROM mascota m JOIN usuario u ON m.id_usuario = u.ID_USUARIO
      WHERE u.ID_USUARIO =$id;";
  
      $query=$this->db()->query($sql);
      while ($row = $query->fetch_object()) { 
          $resultSet[]=$row;
         
      }
      $resultSet=isset($resultSet)?$resultSet:NULL;
      return $resultSet;
  }
  
}

?>